<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
 
 //-------- AMAR Routes --------------
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about_us');
$routes->get('/contact', 'Home::contact_us');
// $routes->get('/login', view('login_view'));
// $routes->post('/login/submit', 'Login::submit');
// $routes->get('/dashboard', 'Dashboard::index');

//================Admin Controller Login Logout=====================
$routes->get('/admin/login', 'AdminController::login');
$routes->get('/logout', 'AdminController::logout');
$routes->post('/admin/authenticate', 'AdminController::authenticate');
$routes->get('/admin/dashboard', 'AdminController::dashboard');
$routes->get('/home', 'AdminController::home');



 //ManuscriptController
$routes->get('/manuscript', 'ManuscriptController::index');
$routes->get('/manuscript_details/(:any)', 'ManuscriptController::viewFullManuscriptDetails/$1');
$routes->get('/manuscript_system_details/(:any)', 'ManuscriptController::getAllSystemManuscripts/$1'); // get all system mss 

 //RarebookController
$routes->get('/rarebook', 'RarebookController::index');
$routes->get('/rarebook_details/(:any)', 'RarebookController::viewFullRarebookDetails/$1');

 //CatalogueController
$routes->get('/catalogue', 'CatalogueController::index');
$routes->get('/catalogue_details/(:any)', 'CatalogueController::viewFullCatalogueDetails/$1');

 //PeriodicalController
$routes->get('/periodicals', 'PeriodicalController::index');
$routes->get('/periodical_details/(:any)', 'PeriodicalController::viewFullPeriodicalDetails/$1');

 //SearchController
$routes->get('search', 'SearchController::index');
$routes->get('viewdata/(:num)', 'SearchController::viewalldata/$1');

$routes->get('/welcome', 'WelcomeController::index');


//============================= AMR ROUTES =========================================
$routes->get('/amr/dashboard', 'AdminController::amrView');
$routes->get('/amr/menu', 'AMRController::menu');
$routes->get('/amr/manuscript', 'AMRController::manuscript');
$routes->get('/amr/rareBooks', 'AMRController::rareBooks');
$routes->get('/amr/catalogues', 'AMRController::catalogues');
$routes->get('/amr/periodicals', 'AMRController::periodicals');
// $routes->get('/amr/form/(:any)', 'AMRController::form/$1');
$routes->post('/amr/submitManuscript', 'AMRController::submitManuscript');
$routes->post('/amr/submitRareBooks', 'AMRController::submitRareBooks');
$routes->post('/amr/submitCatalogues', 'AMRController::submitCatalogues');
$routes->post('/amr/submitPeriodicals', 'AMRController::submitPeriodicals');
$routes->get('/amr/approved/(:num)', 'AMRController::statuswisedata/$1');
$routes->get('/amr/rejected/(:num)', 'AMRController::statuswisedata/$1');
$routes->get('/amr/rejectedbycataloguer/(:num)', 'AMRController::statuswisedata/$1');
$routes->get('/amr/statuswisedata/(:num)', 'AMRController::statuswisedata/$1');
$routes->get('/amr/statuswisedata/1', 'AMRController::statuswisedata/1');
$routes->get('/amr/statuswisedata/2', 'AMRController::statuswisedata/2');
$routes->get('/amr/statuswisedata/3', 'AMRController::statuswisedata/3');
$routes->get('/amr/success', function() {
    return view('amr/success');
    
});
$routes->get('/view/pdf/(:any)','AMRController::viewpdf/$1');


//=============================== SUPERVISOR ROUTES ===================================================
$routes->get('/supervisor/dashboard', 'SupervisorController::getalldata');
$routes->post('/supervisor/approveManuscript/(:num)', 'SupervisorController::approveManuscript/$1');
$routes->post('/supervisor/rejectManuscript/(:num)', 'SupervisorController::rejectManuscript/$1');
$routes->post('/supervisor/approveRareBook/(:num)', 'SupervisorController::approveRareBook/$1');
$routes->post('/supervisor/rejectRareBook/(:num)', 'SupervisorController::rejectRareBook/$1');
$routes->post('/supervisor/approvePeriodical/(:num)', 'SupervisorController::approvePeriodical/$1');
$routes->post('/supervisor/rejectPeriodical/(:num)', 'SupervisorController::rejectPeriodical/$1');
$routes->post('/supervisor/approveCatalogue/(:num)', 'SupervisorController::approveCatalogue/$1');
$routes->post('/supervisor/rejectCatalogue/(:num)', 'SupervisorController::rejectCatalogue/$1');
$routes->get('/supervisor/dashboard/cataloguer_approved', 'SupervisorController::getCataloguerApprovedData');
$routes->get('/supervisor/cataloguer-approved', 'SupervisorController::getCataloguerApprovedData');
$routes->get('/supervisor/approved', 'SupervisorController::approved');
$routes->get('/supervisor/pending', 'SupervisorController::pending');
$routes->get('/view/pdf/(:any)','AMRController::viewpdf/$1');
$routes->get('/supervisor/dashboard', 'SupervisorController::getalldata');
$routes->post('/supervisor/approveManuscript/(:num)', 'SupervisorController::approveManuscript/$1');
$routes->post('/supervisor/rejectManuscript/(:num)', 'SupervisorController::rejectManuscript/$1');
$routes->post('/supervisor/approveRareBook/(:num)', 'SupervisorController::approveRareBook/$1');
$routes->post('/supervisor/rejectRareBook/(:num)', 'SupervisorController::rejectRareBook/$1');





$routes->post('/supervisor/approvePeriodical/(:num)', 'SupervisorController::approvePeriodical/$1');
$routes->post('/supervisor/rejectPeriodical/(:num)', 'SupervisorController::rejectPeriodical/$1');
$routes->post('/supervisor/approveCatalogue/(:num)', 'SupervisorController::approveCatalogue/$1');
$routes->post('/supervisor/rejectCatalogue/(:num)', 'SupervisorController::rejectCatalogue/$1');
$routes->get('/supervisor/dashboard/cataloguer_approved', 'SupervisorController::getCataloguerApprovedData');
$routes->get('/supervisor/dashboard/approved', 'SupervisorController::approved');
$routes->get('/supervisor/dashboard/pending', 'SupervisorController::pending');
$routes->get('/supervisor/cataloguer-approved', 'SupervisorController::getCataloguerApprovedData');
$routes->get('supervisor/dashboard/rejected', 'SupervisorController::rejected');
$routes->get('supervisor/dashboard/published', 'SupervisorController::published');
$routes->get('supervisor/publish/(:num)/(:alpha)', 'SupervisorController::publish/$1/$2');
// $routes->get('supervisor/handleAction', 'SupervisorController::handleAction');
$routes->post('supervisor/approve', 'SupervisorController::handleAction');   
//==============================================CHATGPT ADDON =================================================
// Generic Route for Approving Items
// $routes->post('/supervisor/approve/(:num)/(:alpha)', 'SupervisorController::approve/$1/$2');
// $routes->group('supervisor', function($routes) {
    // Route for the Supervisor Dashboard
//     $routes->get('dashboard/approved', 'SupervisorController::approvedFiles');
//     $routes->get('dashboard/pending', 'SupervisorController::pendingFiles');
//     $routes->get('dashboard/rejected', 'SupervisorController::rejectedFiles');
//     $routes->get('dashboard/cataloguer_approved', 'SupervisorController::cataloguerApprovedFiles');
//     $routes->get('dashboard/published', 'SupervisorController::publishedFiles');

//     // Routes for approving, rejecting, and publishing files
//     $routes->post('approve', 'SupervisorController::approveFile');
//     $routes->post('reject', 'SupervisorController::rejectFile');
//     $routes->post('publish', 'SupervisorController::publishFile');
// });


//=================================== CATALOGUER ROUTES ============================================
$routes->get('/cataloguer/dashboard', 'CataloguerController::getalldata');
$routes->get('/cataloguer/approve/(:num)/(:any)', 'CataloguerController::approve/$1/$2');
$routes->get('/cataloguer/reject/(:num)/(:any)', 'CataloguerController::reject/$1/$2');  
$routes->get('/cataloguer/view_pdf/(:num)/(:any)', 'CataloguerController::view_pdf/$1/$2');
$routes->get('/cataloguer/approveManuscript/(:num)', 'cataloguerController::approveManuscript/$1');
$routes->get('/cataloguer/rejectManuscript/(:num)', 'cataloguerController::rejectManuscript/$1');
$routes->get('catalogue/approved', 'CataloguerController::fetchApprovedBySupervisor');
$routes->get('/cataloguer', 'CataloguerController::getalldata');
$routes->get('/cataloguer/approve/(:num)/(:segment)', 'CataloguerController::approve/$1/$2');
$routes->get('/cataloguer/reject/(:num)/(:segment)', 'CataloguerController::reject/$1/$2');
$routes->post('cataloguer/save_remark/(:num)/(:alpha)', 'CataloguerController::saveRemark/$1/$2');


//=================================== REGISTRAR ROUTES ===============================================
$routes->get('registrar', 'RegistrarController::getalldata');
$routes->get('registrar/dashboard', 'RegistrarController::index');
$routes->get('registrar/view_pdf/(:num)/(:segment)', 'RegistrarController::view_pdf/$1/$2');
$routes->get('registrar/download/(:num)/(:segment)', 'RegistrarController::download/$1/$2');