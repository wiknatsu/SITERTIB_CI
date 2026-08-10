<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

define('APPPATH', realpath(__DIR__ . '/../app') . DIRECTORY_SEPARATOR);
define('WRITEPATH', realpath(__DIR__) . DIRECTORY_SEPARATOR);

echo 'APPPATH=' . APPPATH . "\n";
echo 'WRITEPATH=' . WRITEPATH . "\n";

use Config\Database;

$db = new Database();
var_dump($db->defaultGroup);
var_dump($db->default);

echo 'exists=' . (file_exists($db->default['database']) ? 'yes' : 'no') . "\n";

echo 'realpath=' . var_export(realpath($db->default['database']), true) . "\n";
try {
    $sqlite = new SQLite3($db->default['database']);
    echo 'sqlite open ok\n';
    $sqlite->close();
} catch (Exception $e) {
    echo 'sqlite open fail: ' . $e->getMessage() . "\n";
}
