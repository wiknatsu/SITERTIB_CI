<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require __DIR__ . '/../vendor/autoload.php';

$paths = require __DIR__ . '/../app/Config/Paths.php';
$paths = new Config\Paths();

require SYSTEMPATH . 'bootstrap.php';

$config = config('Database');

var_dump(ENVIRONMENT);
var_dump(isset($config->default));
var_dump($config->default);
var_dump($config->defaultGroup);

// Test reading .env values if possible
$envDB = getenv('database.default.database');
var_dump($envDB);

exit;
