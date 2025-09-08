<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//==============================================================================
// Public Routes
//==============================================================================
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about_us');
$routes->get('/contact', 'Home::contact_us');
$routes->get('/welcome', 'WelcomeController::index');

// Public View Routes
$routes->get('/manuscript', 'ManuscriptController::index');
$routes->get('/manuscript_details/(:any)', 'ManuscriptController::viewFullManuscriptDetails/$1');
$routes->get('/manuscript_system_details/(:any)', 'ManuscriptController::getAllSystemManuscripts/$1');
$routes->get('/rarebook', 'RarebookController::index');
$routes->get('/rarebook_details/(:any)', 'RarebookController::viewFullRarebookDetails/$1');
$routes->get('/catalogue', 'CatalogueController::index');
$routes->get('/catalogue_details/(:any)', 'CatalogueController::viewFullCatalogueDetails/$1');
$routes->get('/periodicals', 'PeriodicalController::index');
$routes->get('/periodical_details/(:any)', 'PeriodicalController::viewFullPeriodicalDetails/$1');

// Search
$routes->get('search', 'SearchController::index');
$routes->get('viewdata/(:num)', 'SearchController::viewalldata/$1');


//==============================================================================
// Admin & Authentication Routes
//==============================================================================
$routes->get('/admin/login', 'AdminController::login');
$routes->get('/logout', 'AdminController::logout');
$routes->post('/admin/authenticate', 'AdminController::authenticate');
$routes->get('/admin/dashboard', 'AdminController::dashboard');


//==============================================================================
// AMR (Accessioning and Metadata Recording) Routes
//==============================================================================
$routes->group('amr', function ($routes) {
    $routes->get('dashboard', 'AdminController::amrView');
    $routes->get('menu', 'AMRController::menu');
    $routes->get('manuscript', 'AMRController::manuscript');
    $routes->get('rareBooks', 'AMRController::rareBooks');
    $routes->get('catalogues', 'AMRController::catalogues');
    $routes->get('periodicals', 'AMRController::periodicals');
    $routes->post('submitManuscript', 'AMRController::submitManuscript');
    $routes->post('submitRareBooks', 'AMRController::submitRareBooks');
    $routes->post('submitCatalogues', 'AMRController::submitCatalogues');
    $routes->post('submitPeriodicals', 'AMRController::submitPeriodicals');
    $routes->get('statuswisedata/(:num)', 'AMRController::statuswisedata/$1');
    $routes->get('success', fn () => view('amr/success'));
    $routes->get('view/pdf/(:any)', 'AMRController::viewpdf/$1');
});


//==============================================================================
// Supervisor Routes
//==============================================================================
$routes->group('supervisor', function ($routes) {
    $routes->get('dashboard', 'SupervisorController::getalldata');
    $routes->get('dashboard/approved', 'SupervisorController::approved');
    $routes->get('dashboard/pending', 'SupervisorController::pending');
    $routes->get('dashboard/rejected', 'SupervisorController::rejected');
    $routes->get('dashboard/published', 'SupervisorController::published');
    $routes->get('dashboard/cataloguer_approved', 'SupervisorController::getCataloguerApprovedData');

    // This single route handles approve/reject actions from the form
    $routes->post('approve', 'SupervisorController::handleAction');

    // Publishing route
    $routes->get('publish/(:num)/(:alpha)', 'SupervisorController::publish/$1/$2');

    // Legacy/Unused routes - kept for reference but could be removed
    // $routes->post('approveManuscript/(:num)', 'SupervisorController::approveManuscript/$1');
    // $routes->post('rejectManuscript/(:num)', 'SupervisorController::rejectManuscript/$1');
    // $routes->post('approveRareBook/(:num)', 'SupervisorController::approveRareBook/$1');
    // $routes->post('rejectRareBook/(:num)', 'SupervisorController::rejectRareBook/$1');
    // $routes->post('approvePeriodical/(:num)', 'SupervisorController::approvePeriodical/$1');
    // $routes->post('rejectPeriodical/(:num)', 'SupervisorController::rejectPeriodical/$1');
    // $routes->post('approveCatalogue/(:num)', 'SupervisorController::approveCatalogue/$1');
    // $routes->post('rejectCatalogue/(:num)', 'SupervisorController::rejectCatalogue/$1');
});


//==============================================================================
// Cataloguer Routes
//==============================================================================
$routes->group('cataloguer', function ($routes) {
    $routes->get('/', 'CataloguerController::getalldata');
    $routes->get('dashboard', 'CataloguerController::getalldata');
    $routes->get('approve/(:num)/(:segment)', 'CataloguerController::approve/$1/$2');
    $routes->get('reject/(:num)/(:segment)', 'CataloguerController::reject/$1/$2');
    $routes->get('view_pdf/(:num)/(:any)', 'CataloguerController::view_pdf/$1/$2');
    $routes->post('save_remark/(:num)/(:alpha)', 'CataloguerController::saveRemark/$1/$2');
});


//==============================================================================
// Registrar Routes
//==============================================================================
$routes->group('registrar', function ($routes) {
    $routes->get('/', 'RegistrarController::index');
    $routes->get('dashboard', 'RegistrarController::index');
    $routes->get('view_pdf/(:num)/(:segment)', 'RegistrarController::view_pdf/$1/$2');
    $routes->get('download/(:num)/(:segment)', 'RegistrarController::download/$1/$2');
});