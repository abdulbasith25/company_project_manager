<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// If you want the login page to be the default
$routes->get('/', 'Auth::loginForm');

// Login and Logout routes
$routes->get('login', 'Auth::loginForm');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

// Registration Routes (Public self-registration)
$routes->get('register', 'Auth::registerForm');
$routes->post('register', 'Auth::register');

// Group for general authenticated dashboards
$routes->group('dashboard', ['filter' => 'auth'], static function ($routes) {
    $routes->get('admin', 'Auth::dashboard'); // This route will now redirect to /admin/dashboard
    $routes->get('employee', 'EmployeeController::index');
    $routes->post('employee/tasks/update_status', 'EmployeeController::updateTaskStatus');
    $routes->get('hr', 'HrController::index');
    $routes->get('general', 'Auth::dashboard');
});

// Admin specific routes, protected by 'auth' AND 'admin' filters
$routes->group('admin', ['filter' => ['auth', 'admin']], static function ($routes) {
    $routes->get('dashboard', 'AdminController::index');
    // $routes->post('projects/store', 'AdminController::storeProject'); // Moved to ProjectController
    $routes->post('tasks/store', 'AdminController::storeTask'); // Remains here for now
    // $routes->post('users/store', 'AdminController::storeUser'); // Moved to UserController
});

// Project Management Routes (Admin Only)
$routes->group('projects', ['filter' => ['auth', 'admin']], static function ($routes) {
    $routes->get('/', 'ProjectController::index');
    $routes->get('create', 'ProjectController::create');
    $routes->post('store', 'ProjectController::store');
});

// User Management Routes (Admin Only) - NOW INCLUDING UPDATE AND DELETE
$routes->group('users', ['filter' => ['auth', 'admin']], static function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->post('update', 'UserController::update'); // ADDED: Route for updating users
    $routes->post('delete', 'UserController::delete'); // ADDED: Route for deleting/deactivating users
});


// HR specific routes, protected by 'auth' AND 'hr' filters
// NOTE: These HR user management routes should eventually be removed/redirected to UserController
$routes->group('hr', ['filter' => ['auth', 'hr']], static function ($routes) {
    $routes->get('dashboard', 'HrController::index');
    $routes->post('users/store', 'HrController::storeUser'); // These will be removed later
    $routes->post('users/update', 'HrController::updateUser'); // These will be removed later
    $routes->post('users/delete', 'HrController::deleteUser'); // These will be removed later
    $routes->post('tasks/store', 'HrController::storeTask');
});

// Example of other public routes
// $routes->get('/', 'Home::index');

