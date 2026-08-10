<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';

if (!defined('WRITEPATH')) {
    define('WRITEPATH', __DIR__ . DIRECTORY_SEPARATOR);
}

use Config\Database;

$config = new Database();

echo 'defaultGroup=' . $config->defaultGroup . "\n";
var_dump($config->default);

if (isset($config->default['database'])) {
    echo 'dbpath=' . $config->default['database'] . "\n";
    echo 'exists=' . (file_exists($config->default['database']) ? 'yes' : 'no') . "\n";
}
