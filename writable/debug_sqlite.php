<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo 'cwd=' . getcwd() . "\n";
echo 'writepath=' . __DIR__ . "\n";
echo 'exists=' . (file_exists(__DIR__ . '/database.sqlite') ? 'yes' : 'no') . "\n";
echo 'realpath=' . var_export(realpath(__DIR__ . '/database.sqlite'), true) . "\n";
try {
    $db = new SQLite3(__DIR__ . '/database.sqlite');
    echo 'open_ok\n';
    $db->close();
} catch (Exception $e) {
    echo 'open_fail=' . $e->getMessage() . "\n";
}
?>