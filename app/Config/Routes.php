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
    // REMOVED: EmployeeController::updateTaskStatus route, as it's now centralized in TaskController
    // $routes->post('employee/tasks/update_status', 'EmployeeController::updateTaskStatus');
    $routes->get('hr', 'HrController::index');
    $routes->get('general', 'Auth::dashboard');
});

// Admin specific routes, protected by 'auth' AND 'admin' filters
$routes->group('admin', ['filter' => ['auth', 'admin']], static function ($routes) {
    $routes->get('dashboard', 'AdminController::index');
    // REMOVED: AdminController::storeTask route, as it's now centralized in TaskController
    // $routes->post('tasks/store', 'AdminController::storeTask');
});

// Project Management Routes (Admin Only)
$routes->group('projects', ['filter' => ['auth', 'admin']], static function ($routes) {
    $routes->get('/', 'ProjectController::index');
    $routes->get('create', 'ProjectController::create');
    $routes->post('store', 'ProjectController::store');
    // ADDED from previous ProjectController update if not already there:
    $routes->post('update', 'ProjectController::update');
    $routes->post('delete', 'ProjectController::delete');
    $routes->post('restore', 'ProjectController::restore');
});

// User Management Routes (Admin Only)
$routes->group('users', ['filter' => ['auth', ]], static function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->post('update', 'UserController::update');
    $routes->post('delete', 'UserController::delete');
    // ADDED from previous UserController update if not already there:
    $routes->post('restore', 'UserController::restore');
});


// HR specific routes, protected by 'auth' AND 'hr' filters
$routes->group('hr', ['filter' => ['auth', 'hr']], static function ($routes) {
    $routes->get('dashboard', 'HrController::index');
    
    // NOTE: These HR user management routes should eventually be removed/redirected to UserController
    // $routes->post('users/store', 'HrController::storeUser');
    // $routes->post('users/update', 'HrController::updateUser');
    // $routes->post('users/delete', 'HrController::deleteUser');

    // REMOVED: HrController::storeTask, as it's now centralized in TaskController
    // $routes->post('tasks/store', 'HrController::storeTask');
});

// NEW: Centralized Task Management Routes (Accessible by Admin, Employee, and HR)
$routes->group('tasks', ['filter' => 'auth:1,2,3'], static function ($routes) {
    $routes->get('/', 'TaskController::index'); // Main tasks list page with filters
    $routes->post('store', 'TaskController::store'); // For adding new tasks (Admin/HR only, controlled in controller)
    $routes->post('update', 'TaskController::update'); // For updating tasks (Admin/HR only)
    $routes->post('delete', 'TaskController::delete'); // For deleting tasks (Admin/HR only)
    $routes->post('update-status', 'TaskController::updateTaskStatus'); // For status updates (All roles, controlled in controller)
});

// Example of other public routes
// $routes->get('/', 'Home::index');
