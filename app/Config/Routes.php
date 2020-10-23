<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);
// $routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index', ['filter'=>'auto_login']);

$routes->get('/auth', 'Auth::index', ['filter'=>'auto_login']);
$routes->post('/auth/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

$routes->group('/admin', ['filter'=>'cek_login'], function($routes) {
    $routes->add('dashboard', 'Admin\Dashboard::index');

    $routes->group('aspek', function($routes) {	
	    $routes->get('', 'Admin\Aspek::index');
	    $routes->post('datatabel', 'Admin\Aspek::datatabel');
	    $routes->post('detil', 'Admin\Aspek::detil');
	    $routes->post('simpan', 'Admin\Aspek::simpan');
	    $routes->post('hapus', 'Admin\Aspek::hapus');
    });

    $routes->group('kompetensi', function($routes) {	
	    $routes->get('', 'Admin\Kompetensi::index');
	    $routes->post('datatabel', 'Admin\Kompetensi::datatabel');
	    $routes->post('detil', 'Admin\Kompetensi::detil');
	    $routes->post('simpan', 'Admin\Kompetensi::simpan');
	    $routes->post('hapus', 'Admin\Kompetensi::hapus');
    });

    $routes->group('peserta', function($routes) {	
	    $routes->get('', 'Admin\Peserta::index');
	    $routes->post('datatabel', 'Admin\Peserta::datatabel');
	    $routes->post('detil', 'Admin\Peserta::detil');
	    $routes->post('simpan', 'Admin\Peserta::simpan');
	    $routes->post('hapus', 'Admin\Peserta::hapus');
    });

    $routes->group('soal', function($routes) {	
	    $routes->get('', 'Admin\Soal::index');
	    $routes->get('detil_per_jenis/(:alpha)/(:num)', 'Admin\Soal::detil_per_jenis/$1/$2');
	    $routes->get('form_soal/(:alpha)/(:num)/(:num)', 'Admin\Soal::form_soal/$1/$2/$3');
	    $routes->post('form_soal_save', 'Admin\Soal::form_soal_save');
	    $routes->post('datatabel/(:alpha)/(:num)', 'Admin\Soal::datatabel_detil_jenis/$1/$2');
	    $routes->post('hapus', 'Admin\Soal::hapus');
    });
});

// $routes->get('/dashboard', 'Admin::dashboard', ['filter'=>'cek_login']);



/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
