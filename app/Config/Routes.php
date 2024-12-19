<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/post/(:any)', 'Home::blog/$1');
$routes->get('/kategori/(:any)', 'Home::sortKategori/$1');
$routes->get('/konten', 'konten::index');

// api
$routes->group('api', static function ($routes) {

  // login  
  $routes->Post('login', 'Api::login');

  // konten
  $routes->group('konten', ['filter' => 'authFilter'], static function ($routes) {
    $routes->get('/', 'Api::getKonten');
    $routes->post('/', 'Api::saveKonten');
    $routes->get('(:num)', 'Api::deleteKonten/$1');
    $routes->post('edit/(:num)', 'Api::editKonten/$1');
  });

  // lainnya
});

// login & register
$routes->get('register', 'Login::registerview', options: ['filter' => 'notLogin']);
$routes->post('register', 'Login::register', options: ['filter' => 'notLogin']);
$routes->get('login', 'Login::loginView', ['filter' => 'notLogin']);
$routes->post('login', 'Login::login', ['filter' => 'notLogin']);
$routes->get('logout', 'Login::logout', ['filter' => 'isLogin']);


$routes->group('admin', ['filter' => 'isLogin'], static function ($routes) {
  $routes->get('/', 'User::index');
  $routes->get('home', 'User::index');

  $routes->group('user', static function ($routes) {
    $routes->get('/', 'User::userView');
    $routes->post('/', 'User::saveUser');
    $routes->get('(:num)', 'User::deleteUser/$1');
    $routes->post('edit/(:num)', 'User::editUser/$1');
  });

  $routes->group('kategori', static function ($routes) {
    $routes->get('/', 'Kategori::index');
    $routes->post('/', 'Kategori::saveKategori');
    $routes->get('(:num)', 'Kategori::deleteKategori/$1');
    $routes->post('edit/(:num)', 'Kategori::editKategori/$1');
  });

  $routes->group('konten', static function ($routes) {
    $routes->get('/', 'Konten::index');
    $routes->post('/', 'Konten::saveKonten');
    $routes->get('(:num)', 'Konten::deleteKonten/$1');
    $routes->post('edit/(:num)', 'Konten::editKonten/$1');
  });

  $routes->group('konfigurasi', static function ($routes) {
    $routes->get('/', 'Konfigurasi::index');
    $routes->post('edit/(:num)', 'Konfigurasi::editKonfigurasi/$1');
  });

  $routes->group('caraousel', static function ($routes) {
    $routes->get('/', 'Caraousel::index');
    $routes->post('/', 'Caraousel::saveCaraousel');
    $routes->get('(:num)', 'Caraousel::deleteCaraousel/$1');
    $routes->post('edit/(:num)', 'Caraousel::editCaraousel/$1');
  });
});