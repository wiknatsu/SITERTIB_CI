<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Pages::landing');
$routes->get('/login', 'Pages::login');
$routes->get('/dashboard', 'Pages::dashboard');
$routes->get('/catat-pelanggaran', 'Pages::catatPelanggaran');
$routes->get('/riwayat-pelanggaran', 'Pages::riwayatPelanggaran');
$routes->get('/murid', 'Pages::murid');
$routes->get('/guru', 'Pages::guru');
$routes->get('/jenis-pelanggaran', 'Pages::jenisPelanggaran');
$routes->get('/tahun-ajaran', 'Pages::tahunAjaran');
$routes->get('/users', 'Pages::users');
$routes->get('/sistem-backup', 'Pages::sistemBackup');
$routes->get('/riwayat-pelanggaran-murid', 'Pages::muridListPelanggaran');

$routes->group('api', ['namespace' => 'App\Controllers\Api'], static function ($routes) {
    $routes->post('login', 'AuthController::login');
    $routes->get('pelanggaran-murid/(:segment)', 'PelanggaranMuridController::searchByNis/$1');

    $routes->group('', ['filter' => 'auth'], static function ($routes) {
        $routes->post('logout', 'AuthController::logout');
        $routes->get('user', 'AuthController::me');

        $routes->get('murids', 'MuridController::index');
        $routes->get('murids/(:num)', 'MuridController::show/$1');
        $routes->post('murids', 'MuridController::create');
        $routes->post('murids-import', 'MuridController::import');
        $routes->get('murids-export', 'MuridController::export');
        $routes->put('murids/(:num)', 'MuridController::update/$1');
        $routes->delete('murids/(:num)', 'MuridController::delete/$1');

        $routes->get('gurus', 'GuruController::index');
        $routes->get('gurus/(:num)', 'GuruController::show/$1');
        $routes->post('gurus', 'GuruController::create');
        $routes->post('gurus-import', 'GuruController::import');
        $routes->get('gurus-export', 'GuruController::export');
        $routes->put('gurus/(:num)', 'GuruController::update/$1');
        $routes->delete('gurus/(:num)', 'GuruController::delete/$1');

        $routes->get('users', 'UserController::index');
        $routes->get('users/(:num)', 'UserController::show/$1');
        $routes->post('users', 'UserController::create');
        $routes->post('users/sync-gurus', 'UserController::syncFromGurus');
        $routes->put('users/(:num)', 'UserController::update/$1');
        $routes->delete('users/(:num)', 'UserController::delete/$1');

        $routes->get('pelanggarans', 'PelanggaranController::index');
        $routes->get('pelanggarans/(:num)', 'PelanggaranController::show/$1');
        $routes->post('pelanggarans', 'PelanggaranController::create');
        $routes->post('pelanggarans-import', 'PelanggaranController::import');
        $routes->get('pelanggarans-export', 'PelanggaranController::export');
        $routes->put('pelanggarans/(:num)', 'PelanggaranController::update/$1');
        $routes->delete('pelanggarans/(:num)', 'PelanggaranController::delete/$1');

        $routes->get('tahun-ajarans', 'TahunAjaranController::index');
        $routes->get('tahun-ajarans/(:num)', 'TahunAjaranController::show/$1');
        $routes->post('tahun-ajarans', 'TahunAjaranController::create');
        $routes->put('tahun-ajarans/(:num)', 'TahunAjaranController::update/$1');
        $routes->delete('tahun-ajarans/(:num)', 'TahunAjaranController::delete/$1');
        $routes->put('tahun-ajarans/(:num)/set-active', 'TahunAjaranController::setActive/$1');

        $routes->get('pelanggaran-murids', 'PelanggaranMuridController::index');
        $routes->get('pelanggaran-murids/(:num)', 'PelanggaranMuridController::show/$1');
        $routes->post('pelanggaran-murids', 'PelanggaranMuridController::create');
        $routes->put('pelanggaran-murids/(:num)', 'PelanggaranMuridController::update/$1');
        $routes->delete('pelanggaran-murids/(:num)', 'PelanggaranMuridController::delete/$1');
    });
});
