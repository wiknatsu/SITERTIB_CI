<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Files\UploadedFile;

class SystemController extends BaseController
{
    use ResponseTrait;

    private const SQLITE_DRIVER = 'SQLite3';
    private const MYSQL_DRIVERS = ['MySQLi', 'MySQL'];

    public function backup()
    {
        $config = config('Database')->default;
        $driver = $config['DBDriver'] ?? '';

        if ($driver === self::SQLITE_DRIVER) {
            return $this->backupSqlite();
        }

        if (in_array($driver, self::MYSQL_DRIVERS, true)) {
            return $this->backupMySQL($config);
        }

        return $this->fail('Backup tidak didukung untuk jenis database saat ini.');
    }

    private function backupSqlite()
    {
        $config = config('Database')->default;
        $databasePath = $this->resolveSqlitePath($config);

        if (!is_file($databasePath) || !is_readable($databasePath)) {
            return $this->failNotFound('Database file tidak ditemukan.');
        }

        return $this->response
            ->download($databasePath, null)
            ->setFileName('database_backup.sqlite');
    }

    private function backupMySQL(array $config)
    {
        $credentials = $this->resolveMySQLCredentials($config);
        $dumpPath = tempnam(sys_get_temp_dir(), 'mysql_backup_') . '.sql';

        if ($mysqldump = $this->findCommand('mysqldump')) {
            $defaultsFile = $this->writeMysqlDefaultsFile($credentials);
            $command = escapeshellcmd($mysqldump)
                . ' --defaults-extra-file=' . escapeshellarg($defaultsFile)
                . ' --skip-comments --skip-lock-tables --single-transaction'
                . ' --default-character-set=' . escapeshellarg($credentials['charset'])
                . ' ' . escapeshellarg($credentials['database']);

            $status = $this->executeShellCommand($command, null, $dumpPath, $output);
            @unlink($defaultsFile);

            if ($status !== 0 || !is_file($dumpPath)) {
                return $this->fail('Gagal membuat backup MySQL: ' . trim($output), ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->response
                ->download($dumpPath, null)
                ->setFileName('database_backup.sql');
        }

        $this->backupMySQLUsingPhp($credentials, $dumpPath);

        if (!is_file($dumpPath)) {
            return $this->fail('Gagal membuat backup MySQL. Tidak ada utilitas mysqldump dan backup PHP gagal.', ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->response
            ->download($dumpPath, null)
            ->setFileName('database_backup.sql');
    }

    public function restore()
    {
        /** @var UploadedFile|null $backupFile */
        $backupFile = $this->request->getFile('file');

        if ($backupFile === null || !$backupFile->isValid()) {
            return $this->failValidationErrors(['file' => 'File backup tidak valid.']);
        }

        $config = config('Database')->default;
        $driver = $config['DBDriver'] ?? '';

        if ($driver === self::SQLITE_DRIVER) {
            return $this->restoreSqlite($backupFile);
        }

        if (in_array($driver, self::MYSQL_DRIVERS, true)) {
            return $this->restoreMySQL($backupFile, $config);
        }

        return $this->fail('Restore tidak didukung untuk jenis database saat ini.');
    }

    private function restoreSqlite(UploadedFile $backupFile)
    {
        $extension = strtolower(pathinfo($backupFile->getClientName(), PATHINFO_EXTENSION));
        if (!in_array($extension, ['sqlite', 'db'], true)) {
            return $this->failValidationErrors(['file' => 'Hanya file SQLite (.sqlite, .db) yang diperbolehkan.']);
        }

        $tempPath = $backupFile->getTempName();
        if (!is_file($tempPath)) {
            return $this->failValidationErrors(['file' => 'File backup tidak ditemukan di server.']);
        }

        $header = @file_get_contents($tempPath, false, null, 0, 16);
        if ($header === false || strpos($header, 'SQLite format 3') !== 0) {
            return $this->failValidationErrors(['file' => 'File backup bukan database SQLite yang valid.']);
        }

        $config = config('Database')->default;
        $destination = $this->resolveSqlitePath($config);

        if (is_file($destination)) {
            $this->closeSqliteConnection();

            if (!is_writable($destination)) {
                return $this->fail('Tidak dapat menimpa file database saat ini.', ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
            }

            $maxAttempts = 5;
            $attempt = 0;
            $deleted = false;
            while ($attempt < $maxAttempts && ! $deleted) {
                clearstatcache(true, $destination);

                if (is_file($destination) && $this->deleteFileQuietly($destination)) {
                    $deleted = true;
                    break;
                }

                $attempt++;
                usleep(200000);
            }

            if (! $deleted) {
                return $this->fail('Database sedang digunakan oleh proses lain atau tidak dapat ditimpa. Tutup koneksi aktif lalu coba lagi.', ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        if (!$backupFile->move(dirname($destination), basename($destination))) {
            return $this->fail('Gagal menyimpan file backup ke database.', ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->respond(['message' => 'Database berhasil dipulihkan.']);
    }

    private function restoreMySQL(UploadedFile $backupFile, array $config)
    {
        $extension = strtolower(pathinfo($backupFile->getClientName(), PATHINFO_EXTENSION));
        if (!in_array($extension, ['sql', 'gz'], true)) {
            return $this->failValidationErrors(['file' => 'Hanya file SQL (.sql) atau SQL gzip (.sql.gz) yang diperbolehkan.']);
        }

        $sqlPath = $backupFile->getTempName();
        if ($extension === 'gz') {
            $sqlPath = $this->decompressGzFile($sqlPath);
            if ($sqlPath === null) {
                return $this->failValidationErrors(['file' => 'Gagal membuka file backup gzip.']);
            }
        }

        $credentials = $this->resolveMySQLCredentials($config);

        if ($mysql = $this->findCommand('mysql')) {
            $defaultsFile = $this->writeMysqlDefaultsFile($credentials);
            $command = escapeshellcmd($mysql)
                . ' --defaults-extra-file=' . escapeshellarg($defaultsFile)
                . ' --database=' . escapeshellarg($credentials['database'])
                . ' --default-character-set=' . escapeshellarg($credentials['charset']);

            $status = $this->executeShellCommand($command, $sqlPath, null, $output);
            @unlink($defaultsFile);
            if ($extension === 'gz' && is_file($sqlPath)) {
                @unlink($sqlPath);
            }

            if ($status !== 0) {
                return $this->fail('Gagal me-restore database MySQL: ' . trim($output), ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->respond(['message' => 'Database berhasil dipulihkan.']);
        }

        $success = $this->restoreMySQLUsingConnection($sqlPath, $credentials);
        if ($extension === 'gz' && is_file($sqlPath)) {
            @unlink($sqlPath);
        }

        if (! $success) {
            return $this->fail('Gagal me-restore database MySQL.', ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->respond(['message' => 'Database berhasil dipulihkan.']);
    }

    private function resolveSqlitePath(array $config): string
    {
        $path = $config['database'] ?? WRITEPATH . 'database.sqlite';
        if (strpos($path, WRITEPATH) === 0) {
            return $path;
        }

        return $path;
    }

    private function closeSqliteConnection(): void
    {
        try {
            $db = db_connect();
            if (method_exists($db, 'close')) {
                $db->close();
            }
        } catch (\Throwable $e) {
            // ignore; file may still be locked by another process, and we will report that back to the caller.
        }
    }

    private function deleteFileQuietly(string $path): bool
    {
        $previousHandler = set_error_handler(static fn() => true);

        try {
            if (! is_file($path)) {
                return true;
            }

            return @unlink($path);
        } finally {
            if ($previousHandler !== null) {
                restore_error_handler();
            }
        }
    }

    private function resolveMySQLCredentials(array $config): array
    {
        $credentials = [
            'hostname' => $config['hostname'] ?? 'localhost',
            'username' => $config['username'] ?? '',
            'password' => $config['password'] ?? '',
            'database' => $config['database'] ?? '',
            'port'     => $config['port'] ?? 3306,
            'charset'  => $config['charset'] ?? 'utf8mb4',
        ];

        if (empty($credentials['database']) && ! empty($config['DSN'])) {
            $dsn = $config['DSN'];
            if (str_contains($dsn, '://')) {
                $parsed = parse_url($dsn);
                if ($parsed !== false) {
                    $credentials['username'] = $parsed['user'] ?? $credentials['username'];
                    $credentials['password'] = $parsed['pass'] ?? $credentials['password'];
                    $credentials['hostname'] = $parsed['host'] ?? $credentials['hostname'];
                    $credentials['database'] = ltrim($parsed['path'] ?? $credentials['database'], '/');
                    $credentials['port'] = isset($parsed['port']) ? (int) $parsed['port'] : $credentials['port'];
                }
            }
        }

        return $credentials;
    }

    private function findCommand(string $command): ?string
    {
        if (! function_exists('exec')) {
            return null;
        }

        $candidates = [
            "command -v $command",
            "which $command",
            "where $command",
        ];

        foreach ($candidates as $candidate) {
            exec($candidate . ' 2>&1', $output, $status);
            if ($status === 0 && ! empty($output[0])) {
                return trim($output[0]);
            }
        }

        return null;
    }

    private function writeMysqlDefaultsFile(array $credentials): string
    {
        $content = "[client]\n"
            . "user=" . $credentials["username"] . "\n"
            . "password=" . $credentials["password"] . "\n"
            . "host=" . $credentials["hostname"] . "\n"
            . "port=" . $credentials["port"] . "\n";

        $tmpFile = tempnam(sys_get_temp_dir(), 'mysql_defaults_');
        file_put_contents($tmpFile, $content);
        return $tmpFile;
    }

    private function executeShellCommand(string $command, ?string $inputPath, ?string $outputPath, ?string &$stderrOutput = null): int
    {
        $descriptors = [
            0 => $inputPath ? ['file', $inputPath, 'r'] : ['pipe', 'r'],
            1 => $outputPath ? ['file', $outputPath, 'w'] : ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];

        $process = proc_open($command, $descriptors, $pipes);
        if (! is_resource($process)) {
            $stderrOutput = 'Tidak dapat menjalankan perintah shell.';
            return 255;
        }

        if (is_resource($pipes[0])) {
            fclose($pipes[0]);
        }

        if (is_resource($pipes[1])) {
            fclose($pipes[1]);
        }

        $stderrOutput = '';
        if (is_resource($pipes[2])) {
            $stderrOutput = stream_get_contents($pipes[2]);
            fclose($pipes[2]);
        }

        return proc_close($process);
    }

    private function backupMySQLUsingPhp(array $credentials, string $dumpPath): void
    {
        $db = db_connect();
        $tables = $db->query('SHOW TABLES')->getResultArray();
        $handle = fopen($dumpPath, 'w');
        if ($handle === false) {
            return;
        }

        fwrite($handle, "SET FOREIGN_KEY_CHECKS=0;\n\n");

        foreach ($tables as $row) {
            $table = reset($row);
            $create = $db->query("SHOW CREATE TABLE `{$table}`")->getRowArray();
            if (! isset($create['Create Table'])) {
                continue;
            }

            fwrite($handle, "DROP TABLE IF EXISTS `{$table}`;\n");
            fwrite($handle, $create['Create Table'] . ";\n\n");

            $result = $db->query("SELECT * FROM `{$table}`");
            foreach ($result->getResultArray() as $record) {
                $columns = array_map(static fn($value) => '`' . str_replace('`', '``', $value) . '`', array_keys($record));
                $values = array_map(static fn($value) => $db->escape($value), array_values($record));
                fwrite($handle, 'INSERT INTO `' . $table . '` (' . implode(', ', $columns) . ') VALUES (' . implode(', ', $values) . ");\n");
            }

            fwrite($handle, "\n");
        }

        fwrite($handle, "SET FOREIGN_KEY_CHECKS=1;\n");
        fclose($handle);
    }

    private function restoreMySQLUsingConnection(string $sqlPath, array $credentials = []): bool
    {
        // Use a dedicated mysqli connection built from provided credentials so
        // we don't interfere with the framework's shared DB connection.
        $host = $credentials['hostname'] ?? '127.0.0.1';
        $user = $credentials['username'] ?? '';
        $pass = $credentials['password'] ?? '';
        $dbName = $credentials['database'] ?? '';
        $port = $credentials['port'] ?? 3306;
        $charset = $credentials['charset'] ?? 'utf8mb4';

        $mysqli = mysqli_init();
        if ($mysqli === false) {
            return false;
        }

        // Suppress warnings and check connection result ourselves
        $connected = @$mysqli->real_connect($host, $user, $pass, $dbName, (int) $port);
        if (! $connected) {
            return false;
        }

        if ($charset) {
            @$mysqli->set_charset($charset);
        }

        $sql = file_get_contents($sqlPath);
        if ($sql === false) {
            $mysqli->close();
            return false;
        }

        $sql = trim($sql);
        if ($sql === '') {
            $mysqli->close();
            return false;
        }

        // Temporarily disable foreign key checks for import.
        $sqlToRun = "SET FOREIGN_KEY_CHECKS=0;\n" . $sql . "\nSET FOREIGN_KEY_CHECKS=1;";

        if (! $mysqli->multi_query($sqlToRun)) {
            $mysqli->close();
            return false;
        }

        do {
            if ($result = $mysqli->store_result()) {
                $result->free();
            }
        } while ($mysqli->more_results() && $mysqli->next_result());

        $mysqli->close();
        return true;
    }

    private function decompressGzFile(string $sourcePath): ?string
    {
        $destPath = tempnam(sys_get_temp_dir(), 'mysql_restore_') . '.sql';
        $source = gzopen($sourcePath, 'rb');
        if (! $source) {
            return null;
        }

        $dest = fopen($destPath, 'wb');
        if (! $dest) {
            gzclose($source);
            return null;
        }

        while (! gzeof($source)) {
            fwrite($dest, gzread($source, 1024 * 512));
        }

        gzclose($source);
        fclose($dest);
        return $destPath;
    }
}
