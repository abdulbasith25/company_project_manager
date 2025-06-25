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
    $routes->get('admin', 'Auth::dashboard');
    $routes->get('employee', 'EmployeeController::index');
    $routes->post('employee/tasks/update_status', 'EmployeeController::updateTaskStatus');
    $routes->get('hr', 'HrController::index');
    $routes->get('general', 'Auth::dashboard');
});

// Admin specific routes, protected by 'auth' AND 'admin' filters
$routes->group('admin', ['filter' => ['auth', 'admin']], static function ($routes) {
    $routes->get('dashboard', 'AdminController::index');
    $routes->post('projects/store', 'AdminController::storeProject');
    $routes->post('tasks/store', 'AdminController::storeTask');
    $routes->post('users/store', 'AdminController::storeUser'); // NEW: Add new user by Admin
});

// HR specific routes, protected by 'auth' AND 'hr' filters
$routes->group('hr', ['filter' => ['auth', 'hr']], static function ($routes) {
    $routes->get('dashboard', 'HrController::index');
    $routes->post('users/store', 'HrController::storeUser');
    $routes->post('users/update', 'HrController::updateUser');
    $routes->post('users/delete', 'HrController::deleteUser');
    $routes->post('tasks/store', 'HrController::storeTask');
});

// Example of other public routes
// $routes->get('/', 'Home::index');

