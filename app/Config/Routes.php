<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->get('/login', 'Login::index',['filter' => 'authenticate']);
$routes->get('/login/reset-password/(:segment)', 'Login::reset_password/$1',['filter' => 'authenticate']);
$routes->post('/login/change-password/', 'Login::change_password',['filter' => 'authenticate']);

$routes->match(['post'], '/login', 'Login::index',['filter' => 'authenticate']);
$routes->match(['post', 'get'], '/login/forgot-password', 'Login::forgot_password',['filter' => 'authenticate']);
$routes->get('login/logout', 'Login::logout');

$routes->get('demo-request', 'Demo::index');

$routes->group("demo", ["namespace" => "App\Controllers"], function ($routes) {
    $routes->post('generateOTP', 'Demo::generateOTP');
    $routes->post('verifyOTP', 'Demo::verifyOTP');
    $routes->post('generateSMSOTP', 'Demo::generateSMSOTP');
    $routes->post('verifySMSOTP', 'Demo::verifySMSOTP');
    $routes->post('submit', 'Demo::submit');
});

$routes->group("profile", ["namespace" => "App\Controllers\Clinician"], function ($routes) {
    $routes->get('', 'Profile::index');
    $routes->post('edit', 'Profile::edit');
    $routes->post('update', 'Profile::update');
    $routes->post('change_password', 'Profile::change_password');
    $routes->post('update_password', 'Profile::update_password');
    $routes->post('upload_credentials', 'Profile::upload_credentials');
    $routes->post('test_email', 'Profile::test_email');
    $routes->post('request', 'Profile::request');
    $routes->get('shifts', 'Shifts::index');
    $routes->get('clinician/(:num)', 'Profile::public_profile');
    $routes->post('shifts/list', 'Shifts::list');
    $routes->post('shifts/clockIn', 'Shifts::clockIn');
    $routes->post('shifts/clockOut', 'Shifts::clockOut');
});



$routes->get('/facility/', 'Facility::index');
$routes->get('/facility/manage', 'Facility\Dashboard::index');
$routes->get('/facility/profile/(:num)', 'Facility::profile/$1');
$routes->get('/facility/profile/(:num)/onboarding/(:num)/pdf', 'Facility::onboarding/$1/$2');
$routes->post('/facility/vote', 'Facility::vote');
$routes->get('/facility/manage/profile', 'Facility\Profile::index');
// $routes->get('/facility/manage/clinicians', 'Facility\Clinicians::index');
// $routes->get('/facility/manage/units', 'Facility\Units::index');
// $routes->get('/facility/manage/shifts', 'Facility\Jobs::index');
$routes->get('/facility/manage/users', 'Facility\Users::index');


$routes->group("facility/manage/clinicians", ["namespace" => "App\Controllers\Facility"], function ($routes) {
    $routes->get('', 'Clinicians::index');
    $routes->post('list', 'Clinicians::list');
    $routes->post('get', 'Clinicians::get');
    $routes->post('add', 'Clinicians::insert');
    $routes->post('update', 'Clinicians::update');
});


$routes->group("facility/manage/units", ["namespace" => "App\Controllers\Facility"], function ($routes) {
    $routes->get('', 'Units::index');
    $routes->post('list', 'Units::list');
    $routes->post('get', 'Units::get');
    $routes->post('add', 'Units::insert');
    $routes->post('update', 'Units::update');
});


$routes->group("facility/manage/votes", ["namespace" => "App\Controllers\Facility"], function ($routes) {
    $routes->get('', 'Votes::index');
    $routes->post('list', 'Votes::list');
    $routes->post('get', 'Votes::get');
    $routes->post('add', 'Votes::insert');
    $routes->post('update', 'Votes::update');
});


$routes->group("facility/manage/jobs", ["namespace" => "App\Controllers\Facility"], function ($routes) {
    $routes->get('', 'Jobs::index');
    $routes->post('list', 'Jobs::list');
    $routes->post('get', 'Jobs::get');
    $routes->post('add', 'Jobs::insert');
    $routes->post('update', 'Jobs::update');
    $routes->post('request', 'Jobs::request');
    $routes->post('requests_list', 'Jobs::requests_list');
    $routes->post('respond', 'Jobs::respond_to_application');
});




$routes->group("facility/manage/onboarding", ["namespace" => "App\Controllers\Facility"], function ($routes) {
    $routes->get('', 'Onboarding::index');
    $routes->post('list', 'Onboarding::list');
    $routes->post('get', 'Jobs::get');
    $routes->post('update', 'Onboarding::update');
    $routes->post('edit', 'Onboarding::edit');
    $routes->post('update', 'Onboarding::update');
    $routes->post('update_settings', 'Onboarding::update_settings');
});


$routes->group("facility/manage/shifts", ["namespace" => "App\Controllers\Facility"], function ($routes) {
    $routes->get('', 'Shifts::index');
    $routes->post('list', 'Shifts::list');
});

$routes->get('/employee-award', 'EmployeeAward::index');
$routes->post('/employee-award/submit', 'EmployeeAward::submit');
$routes->get('/jobs', 'Jobs::index');
$routes->post('/jobs/apply', 'Jobs::apply');
$routes->post('/jobs/apply_register', 'Jobs::apply_register_clinician');
$routes->get('/apply', 'Apply::index');