<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $db = new SQLite3(__DIR__ . '/database.sqlite');
    echo 'open_ok';
    $db->close();
} catch (Exception $e) {
    echo 'open_fail: ' . $e->getMessage();
}
