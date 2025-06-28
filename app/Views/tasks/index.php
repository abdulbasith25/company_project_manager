<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | All Tasks (Basic)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
    <style>
        .brand-link .brand-image {
            float: left;
            line-height: .8;
            margin-left: .8rem;
            margin-right: .5rem;
            margin-top: -.3rem;
            max-height: 33px;
            width: auto;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <!-- Home link depends on role -->
                <?php if ($currentUserRole == 1): // Admin ?>
                    <a href="<?= base_url('admin/dashboard') ?>" class="nav-link">Home</a>
                <?php elseif ($currentUserRole == 2): // Employee ?>
                    <a href="<?= base_url('dashboard/employee') ?>" class="nav-link">Home</a>
                <?php elseif ($currentUserRole == 3): // HR ?>
                    <a href="<?= base_url('hr/dashboard') ?>" class="nav-link">Home</a>
                <?php else: ?>
                    <a href="<?= base_url('/') ?>" class="nav-link">Home</a>
                <?php endif; ?>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= base_url('tasks') ?>" class="nav-link">Tasks</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="far fa-user"></i> <?= esc($userName) ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <?php if ($currentUserRole == 1): // Admin ?>
            <a href="<?= base_url('admin/dashboard') ?>" class="brand-link">
                <img src="https://placehold.co/128x128/007bff/fff?text=AD" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin Panel</span>
            </a>
        <?php elseif ($currentUserRole == 2): // Employee ?>
            <a href="<?= base_url('dashboard/employee') ?>" class="brand-link">
                <img src="https://placehold.co/128x128/28a745/fff?text=EMP" alt="Employee Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Employee Panel</span>
            </a>
        <?php elseif ($currentUserRole == 3): // HR ?>
            <a href="<?= base_url('hr/dashboard') ?>" class="brand-link">
                <img src="https://placehold.co/128x128/dc3545/fff?text=HR" alt="HR Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">HR Panel</span>
            </a>
        <?php else: ?>
            <a href="<?= base_url('/') ?>" class="brand-link">
                <img src="https://placehold.co/128x128/6c757d/fff?text=APP" alt="App Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">App</span>
            </a>
        <?php endif; ?>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?= esc($userName) ?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Dashboard Link (role-dependent) -->
                    <li class="nav-item">
                        <?php if ($currentUserRole == 1): ?>
                            <a href="<?= base_url('admin/dashboard') ?>" class="nav-link">
                        <?php elseif ($currentUserRole == 2): ?>
                            <a href="<?= base_url('dashboard/employee') ?>" class="nav-link">
                        <?php elseif ($currentUserRole == 3): ?>
                            <a href="<?= base_url('dashboard/hr') ?>" class="nav-link">
                        <?php else: ?>
                            <a href="<?= base_url('dashboard/employee') ?>" class="nav-link">
                        <?php endif; ?>
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Projects Links (Admin/HR Only) -->
                    <?php if (in_array($currentUserRole, [1, 3])): ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-project-diagram"></i>
                            <p>
                                Project Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('projects') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Projects</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('projects/create') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Project</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <!-- User Management Links (Admin/HR Only) -->
                    <?php if (in_array($currentUserRole, [1, 3])): ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                User Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('users') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('users/create') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New User</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <!-- Task Management Links (For All Roles) -->
                    <li class="nav-item has-treeview menu-open"> <!-- 'menu-open' to keep it expanded by default -->
                        <a href="#" class="nav-link active"> <!-- Active for this parent menu -->
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>
                                Task Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('tasks') ?>" class="nav-link <?= empty($currentStatusFilter) ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Tasks</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('tasks') ?>?status=Pending" class="nav-link <?= ($currentStatusFilter == 'Pending') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pending Tasks</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('tasks') ?>?status=In%20Progress" class="nav-link <?= ($currentStatusFilter == 'In Progress') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>In Progress Tasks</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('tasks') ?>?status=Completed" class="nav-link <?= ($currentStatusFilter == 'Completed') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Completed Tasks</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('tasks') ?>?status=Blocked" class="nav-link <?= ($currentStatusFilter == 'Blocked') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Blocked Tasks</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Logout Link -->
                    <li class="nav-item">
                        <a href="<?= base_url('logout') ?>" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">All Tasks</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard/employee') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Tasks</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (session('errors')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h6>Validation Errors:</h6>
                        <ul>
                            <?php foreach (session('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <!-- All Tasks Table -->
                <div class="card card-dark card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Task List</h3>
                        <div class="card-tools">
                            <!-- Add Task button only for Admin/HR -->
                            <?php if (in_array($currentUserRole, [1, 3])): ?>
                            <button class="btn btn-primary btn-sm"
                                    data-toggle="modal"
                                    data-target="#addTaskModal"
                                    title="Add New Task">
                                <i class="fas fa-plus"></i> Add New Task
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <?php if (empty($tasks)): ?>
                            <div class="alert alert-info m-3" role="alert">
                                No tasks found in the system matching the selected filter.
                            </div>
                        <?php else: ?>
                            <table id="tasksTable" class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Project</th>
                                        <th>Assigned To</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th style="width: 150px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tasks as $task): ?>
                                        <tr>
                                            <td><?= esc($task['id']) ?></td>
                                            <td><?= esc($task['title']) ?></td>
                                            <td><?= esc($task['project_title'] ?? 'N/A') ?></td>
                                            <td><?= esc($task['assigned_to_name'] ?? 'N/A') ?></td>
                                            <td>
                                                <?php
                                                    $priorityBadgeClass = '';
                                                    switch ($task['priority']) {
                                                        case 'Low':     $priorityBadgeClass = 'badge-info'; break;
                                                        case 'Medium':  $priorityBadgeClass = 'badge-warning'; break;
                                                        case 'High':    $priorityBadgeClass = 'badge-danger'; break;
                                                        default:        $priorityBadgeClass = 'badge-secondary'; break;
                                                    }
                                                ?>
                                                <span class="badge <?= $priorityBadgeClass ?>"><?= esc($task['priority']) ?></span>
                                            </td>
                                            <td>
                                                <!-- Status Dropdown for ALL roles, which will trigger a full page refresh -->
                                                <select class="form-control form-control-sm status-update-dropdown" data-task-id="<?= esc($task['id']) ?>">
                                                    <option value="Pending" <?= ($task['status'] == 'Pending') ? 'selected' : '' ?>>Pending</option>
                                                    <option value="In Progress" <?= ($task['status'] == 'In Progress') ? 'selected' : '' ?>>In Progress</option>
                                                    <option value="Completed" <?= ($task['status'] == 'Completed') ? 'selected' : '' ?>>Completed</option>
                                                    <option value="Blocked" <?= ($task['status'] == 'Blocked') ? 'selected' : '' ?>>Blocked</option>
                                                </select>
                                            </td>
                                            <td>
                                                <!-- View Details Button -->
                                                <button class="btn btn-sm btn-info mr-1 view-task-btn"
                                                        title="View Details"
                                                        data-toggle="modal"
                                                        data-target="#viewTaskModal"
                                                        data-id="<?= esc($task['id']) ?>"
                                                        data-title="<?= esc($task['title']) ?>"
                                                        data-description="<?= esc($task['description']) ?>"
                                                        data-remarks="<?= esc($task['remarks'] ?? 'N/A') ?>"
                                                        data-file="<?= esc($task['file'] ?? 'N/A') ?>"
                                                        data-priority="<?= esc($task['priority']) ?>"
                                                        data-status="<?= esc($task['status']) ?>"
                                                        data-project="<?= esc($task['project_title'] ?? 'N/A') ?>"
                                                        data-assigned-to="<?= esc($task['assigned_to_name'] ?? 'N/A') ?>"
                                                        data-created-at="<?= date('M d, Y H:i', strtotime($task['created_at'])) ?>"
                                                        data-created-by="<?= esc($task['created_by_name'] ?? 'N/A') ?>"
                                                        data-updated-at="<?= date('M d, Y H:i', strtotime($task['updated_at'] ?? 'N/A')) ?>"
                                                        data-updated-by="<?= esc($task['updated_by_name'] ?? 'N/A') ?>"
                                                        data-deleted-by="<?= esc($task['deleted_by_name'] ?? 'N/A') ?>">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <!-- Edit/Delete Task Buttons (Admin/HR Only) -->
                                                <?php if (in_array($currentUserRole, [1, 3])): ?>
                                                    <button class="btn btn-sm btn-primary mr-1 edit-task-btn"
                                                            title="Edit Task"
                                                            data-toggle="modal"
                                                            data-target="#editTaskModal"
                                                            data-id="<?= esc($task['id']) ?>"
                                                            data-title="<?= esc($task['title']) ?>"
                                                            data-description="<?= esc($task['description']) ?>"
                                                            data-remarks="<?= esc($task['remarks'] ?? '') ?>"
                                                            data-file="<?= esc($task['file'] ?? '') ?>"
                                                            data-priority="<?= esc($task['priority']) ?>"
                                                            data-status="<?= esc($task['status']) ?>"
                                                            data-project-id="<?= esc($task['project_id']) ?>"
                                                            data-assigned-to-id="<?= esc($task['assigned_to']) ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger delete-task-btn"
                                                            title="Delete Task"
                                                            data-toggle="modal"
                                                            data-target="#deleteTaskConfirmModal"
                                                            data-id="<?= esc($task['id']) ?>"
                                                            data-title="<?= esc($task['title']) ?>">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2024-<?= date('Y') ?> <a href="#">Trogon media pvt ltd</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.1.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Modals for Task Management -->

<!-- Add Task Modal -->
<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('tasks/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="add_task_title">Task Title:</label>
                        <input type="text" class="form-control <?= (session('errors.title')) ? 'is-invalid' : '' ?>"
                               id="add_task_title" name="title" value="<?= old('title') ?>" required>
                        <?php if (session('errors.title')): ?><div class="invalid-feedback"><?= session('errors.title') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="add_task_description">Description:</label>
                        <textarea class="form-control <?= (session('errors.description')) ? 'is-invalid' : '' ?>"
                                  id="add_task_description" name="description" rows="3"><?= old('description') ?></textarea>
                        <?php if (session('errors.description')): ?><div class="invalid-feedback"><?= session('errors.description') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="add_task_remarks">Remarks (Optional):</label>
                        <textarea class="form-control <?= (session('errors.remarks')) ? 'is-invalid' : '' ?>"
                                  id="add_task_remarks" name="remarks" rows="2"><?= old('remarks') ?></textarea>
                        <?php if (session('errors.remarks')): ?><div class="invalid-feedback"><?= session('errors.remarks') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="add_task_file">File (Optional - e.g., URL or Name):</label>
                        <input type="text" class="form-control <?= (session('errors.file')) ? 'is-invalid' : '' ?>"
                               id="add_task_file" name="file" value="<?= old('file') ?>">
                        <?php if (session('errors.file')): ?><div class="invalid-feedback"><?= session('errors.file') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="add_task_priority">Priority:</label>
                        <select class="form-control <?= (session('errors.priority')) ? 'is-invalid' : '' ?>" id="add_task_priority" name="priority" required>
                            <option value="">Select Priority</option>
                            <option value="Low" <?= (old('priority') == 'Low') ? 'selected' : '' ?>>Low</option>
                            <option value="Medium" <?= (old('priority') == 'Medium') ? 'selected' : '' ?>>Medium</option>
                            <option value="High" <?= (old('priority') == 'High') ? 'selected' : '' ?>>High</option>
                        </select>
                        <?php if (session('errors.priority')): ?><div class="invalid-feedback"><?= session('errors.priority') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="add_task_status">Status:</label>
                        <select class="form-control <?= (session('errors.status')) ? 'is-invalid' : '' ?>" id="add_task_status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="Pending" <?= (old('status') == 'Pending') ? 'selected' : '' ?>>Pending</option>
                            <option value="In Progress" <?= (old('status') == 'In Progress') ? 'selected' : '' ?>>In Progress</option>
                            <option value="Completed" <?= (old('status') == 'Completed') ? 'selected' : '' ?>>Completed</option>
                            <option value="Blocked" <?= (old('status') == 'Blocked') ? 'selected' : '' ?>>Blocked</option>
                        </select>
                        <?php if (session('errors.status')): ?><div class="invalid-feedback"><?= session('errors.status') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="add_task_project_id">Project:</label>
                        <select class="form-control <?= (session('errors.project_id')) ? 'is-invalid' : '' ?>" id="add_task_project_id" name="project_id" required>
                            <option value="">Select Project</option>
                            <?php foreach ($projects as $project): ?>
                                <option value="<?= esc($project['id']) ?>" <?= (old('project_id') == $project['id']) ? 'selected' : '' ?>>
                                    <?= esc($project['title']) ?> (ID: <?= esc($project['id']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (session('errors.project_id')): ?><div class="invalid-feedback"><?= session('errors.project_id') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="add_task_assigned_to">Assigned To:</label>
                        <select class="form-control <?= (session('errors.assigned_to')) ? 'is-invalid' : '' ?>" id="add_task_assigned_to" name="assigned_to" required>
                            <option value="">Select Employee</option>
                            <?php foreach ($employees as $employee): ?>
                                <option value="<?= esc($employee['id']) ?>" <?= (old('assigned_to') == $employee['id']) ? 'selected' : '' ?>>
                                    <?= esc($employee['name']) ?> (<?= esc($employee['email']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (session('errors.assigned_to')): ?><div class="invalid-feedback"><?= session('errors.assigned_to') ?></div><?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Task Details Modal -->
<div class="modal fade" id="viewTaskModal" tabindex="-1" role="dialog" aria-labelledby="viewTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewTaskModalLabel">Task Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> <span id="view_task_id"></span></p>
                <p><strong>Title:</strong> <span id="view_task_title"></span></p>
                <p><strong>Description:</strong> <span id="view_task_description"></span></p>
                <p><strong>Remarks:</strong> <span id="view_task_remarks"></span></p>
                <p><strong>File:</strong> <span id="view_task_file"></span></p>
                <p><strong>Priority:</strong> <span id="view_task_priority"></span></p>
                <p><strong>Status:</strong> <span id="view_task_status"></span></p>
                <p><strong>Project:</strong> <span id="view_task_project"></span></p>
                <p><strong>Assigned To:</strong> <span id="view_task_assigned_to"></span></p>
                <p><strong>Created At:</strong> <span id="view_task_created_at"></span></p>
                <p><strong>Created By:</strong> <span id="view_task_created_by"></span></p>
                <p><strong>Updated At:</strong> <span id="view_task_updated_at"></span></p>
                <p><strong>Updated By:</strong> <span id="view_task_updated_by"></span></p>
                <p><strong>Deleted By:</strong> <span id="view_task_deleted_by"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Task Modal -->
<div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('tasks/update') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="task_id" id="edit_task_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_task_title">Task Title:</label>
                        <input type="text" class="form-control <?= (session('errors.title')) ? 'is-invalid' : '' ?>"
                               id="edit_task_title" name="title" value="<?= old('title') ?>" required>
                        <?php if (session('errors.title')): ?><div class="invalid-feedback"><?= session('errors.title') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="edit_task_description">Description:</label>
                        <textarea class="form-control <?= (session('errors.description')) ? 'is-invalid' : '' ?>"
                                  id="edit_task_description" name="description" rows="3"><?= old('description') ?></textarea>
                        <?php if (session('errors.description')): ?><div class="invalid-feedback"><?= session('errors.description') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="edit_task_remarks">Remarks (Optional):</label>
                        <textarea class="form-control <?= (session('errors.remarks')) ? 'is-invalid' : '' ?>"
                                  id="edit_task_remarks" name="remarks" rows="2"><?= old('remarks') ?></textarea>
                        <?php if (session('errors.remarks')): ?><div class="invalid-feedback"><?= session('errors.remarks') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="edit_task_file">File (Optional - e.g., URL or Name):</label>
                        <input type="text" class="form-control <?= (session('errors.file')) ? 'is-invalid' : '' ?>"
                               id="edit_task_file" name="file" value="<?= old('file') ?>">
                        <?php if (session('errors.file')): ?><div class="invalid-feedback"><?= session('errors.file') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="edit_task_priority">Priority:</label>
                        <select class="form-control <?= (session('errors.priority')) ? 'is-invalid' : '' ?>" id="edit_task_priority" name="priority" required>
                            <option value="">Select Priority</option>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                        <?php if (session('errors.priority')): ?><div class="invalid-feedback"><?= session('errors.priority') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="edit_task_status">Status:</label>
                        <select class="form-control <?= (session('errors.status')) ? 'is-invalid' : '' ?>" id="edit_task_status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                            <option value="Blocked">Blocked</option>
                        </select>
                        <?php if (session('errors.status')): ?><div class="invalid-feedback"><?= session('errors.status') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="edit_task_project_id">Project:</label>
                        <select class="form-control <?= (session('errors.project_id')) ? 'is-invalid' : '' ?>" id="edit_task_project_id" name="project_id" required>
                            <option value="">Select Project</option>
                            <?php foreach ($projects as $project): ?>
                                <option value="<?= esc($project['id']) ?>">
                                    <?= esc($project['title']) ?> (ID: <?= esc($project['id']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (session('errors.project_id')): ?><div class="invalid-feedback"><?= session('errors.project_id') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="edit_task_assigned_to">Assigned To:</label>
                        <select class="form-control <?= (session('errors.assigned_to')) ? 'is-invalid' : '' ?>" id="edit_task_assigned_to" name="assigned_to" required>
                            <option value="">Select Employee</option>
                            <?php foreach ($employees as $employee): ?>
                                <option value="<?= esc($employee['id']) ?>">
                                    <?= esc($employee['name']) ?> (<?= esc($employee['email']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (session('errors.assigned_to')): ?><div class="invalid-feedback"><?= session('errors.assigned_to') ?></div><?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Confirm Delete Task Modal -->
<div class="modal fade" id="deleteTaskConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteTaskConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTaskConfirmModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete task: "<strong id="delete_task_title"></strong>" (ID: <span id="delete_task_id"></span>)?
                <p class="text-danger">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <form action="<?= base_url('tasks/delete') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="task_id" id="delete_task_id_input">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Task</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
<!-- DataTables JS (still useful for basic table features without complex AJAX) -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTables
        $('#tasksTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        // Handle Status Update via simple form submission (no AJAX)
        // This will cause a full page reload when status is changed
        $('.status-update-dropdown').on('change', function() {
            var taskId = $(this).data('task-id');
            var newStatus = $(this).val();

            // Create a temporary form to submit the status update
            var form = $('<form>', {
                'action': '<?= base_url('tasks/updateStatus') ?>', // Matches the backend route
                'method': 'post',
                'style': 'display:none;'
            }).append($('<input>', {
                'type': 'hidden',
                'name': 'task_id',
                'value': taskId
            })).append($('<input>', {
                'type': 'hidden',
                'name': 'status',
                'value': newStatus
            })).append($('<input>', {
                'type': 'hidden',
                'name': '<?= csrf_token() ?>', // Include CSRF token
                'value': '<?= csrf_hash() ?>'
            }));

            $('body').append(form);
            form.submit(); // Submit the form
        });


        // View Task Modal population
        $('#viewTaskModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var title = button.data('title');
            var description = button.data('description');
            var remarks = button.data('remarks');
            var file = button.data('file');
            var priority = button.data('priority');
            var status = button.data('status');
            var project = button.data('project');
            var assignedTo = button.data('assigned-to');
            var createdAt = button.data('created-at');
            var createdBy = button.data('created-by');
            var updatedAt = button.data('updated-at');
            var updatedBy = button.data('updated-by');
            var deletedBy = button.data('deleted-by');

            var modal = $(this);
            modal.find('#view_task_id').text(id);
            modal.find('#view_task_title').text(title);
            modal.find('#view_task_description').text(description);
            modal.find('#view_task_remarks').text(remarks);
            modal.find('#view_task_file').text(file);
            modal.find('#view_task_priority').text(priority);
            modal.find('#view_task_status').text(status);
            modal.find('#view_task_project').text(project);
            modal.find('#view_task_assigned_to').text(assignedTo);
            modal.find('#view_task_created_at').text(createdAt);
            modal.find('#view_task_created_by').text(createdBy);
            modal.find('#view_task_updated_at').text(updatedAt);
            modal.find('#view_task_updated_by').text(updatedBy);
            modal.find('#view_task_deleted_by').text(deletedBy);
        });

        // Edit Task Modal population
        $('#editTaskModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var taskId = button.data('id');
            var title = button.data('title');
            var description = button.data('description');
            var remarks = button.data('remarks');
            var file = button.data('file');
            var priority = String(button.data('priority') || '').trim(); // Ensure string and trim
            var status = String(button.data('status') || '').trim();     // Ensure string and trim
            var projectId = button.data('project-id');
            var assignedToId = button.data('assigned-to-id');

            // --- DEBUGGING: Log the values received from data attributes ---
            console.log("--- EDIT TASK MODAL OPEN ---");
            console.log("Task ID:", taskId);
            console.log("Received Priority:", priority, "(type:", typeof priority, ")");
            console.log("Received Status:", status, "(type:", typeof status, ")");
            console.log("Received Project ID:", projectId, "(type:", typeof projectId, ")");
            console.log("Received Assigned To ID:", assignedToId, "(type:", typeof assignedToId, ")");
            // --- END DEBUGGING ---

            var modal = $(this);
            modal.find('#edit_task_id').val(taskId);
            modal.find('#edit_task_title').val(title);
            modal.find('#edit_task_description').val(description);
            modal.find('#edit_task_remarks').val(remarks);
            modal.find('#edit_task_file').val(file);

            // --- ROBUST DROPDOWN SELECTION ---
            // Explicitly set 'selected' property and trigger change for all dropdowns
            
            // Priority
            var $prioritySelect = modal.find('#edit_task_priority');
            $prioritySelect.find('option').prop('selected', false); // Deselect all first
            $prioritySelect.find('option[value="' + priority + '"]').prop('selected', true);
            $prioritySelect.trigger('change');
            console.log("Priority dropdown set to (actual):", $prioritySelect.val());

            // Status
            var $statusSelect = modal.find('#edit_task_status');
            $statusSelect.find('option').prop('selected', false); // Deselect all first
            $statusSelect.find('option[value="' + status + '"]').prop('selected', true);
            $statusSelect.trigger('change');
            console.log("Status dropdown set to (actual):", $statusSelect.val());

            // Project
            var $projectSelect = modal.find('#edit_task_project_id');
            $projectSelect.find('option').prop('selected', false); // Deselect all first
            $projectSelect.find('option[value="' + projectId + '"]').prop('selected', true);
            $projectSelect.trigger('change');
            console.log("Project dropdown set to (actual):", $projectSelect.val());

            // Assigned To
            var $assignedToSelect = modal.find('#edit_task_assigned_to');
            $assignedToSelect.find('option').prop('selected', false); // Deselect all first
            $assignedToSelect.find('option[value="' + assignedToId + '"]').prop('selected', true);
            $assignedToSelect.trigger('change');
            console.log("Assigned To dropdown set to (actual):", $assignedToSelect.val());
            // --- END ROBUST DROPDOWN SELECTION ---
        });

        // Delete Task Confirmation Modal population
        $('#deleteTaskConfirmModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var taskId = button.data('id');
            var taskTitle = button.data('title');

            var modal = $(this);
            modal.find('#delete_task_id').text(taskId);
            modal.find('#delete_task_title').text(taskTitle);
            modal.find('#delete_task_id_input').val(taskId);
        });

        // Handle re-opening modals on validation errors
        // This script runs after the DOM is ready, which is correct
        <?php if (session('errors')): ?>
            if (old('title') || old('description') || old('remarks') || old('file') || old('priority') || old('status') || old('project_id') || old('assigned_to')) {
                // Determine which modal to show
                var modalToShow = old('task_id') ? '#editTaskModal' : '#addTaskModal';
                $(modalToShow).modal('show');

                // Manually re-populate fields based on old() data (important for error state)
                if (modalToShow === '#editTaskModal') {
                    $('#edit_task_id').val('<?= old('task_id') ?>');
                    $('#edit_task_title').val('<?= old('title') ?>');
                    $('#edit_task_description').val('<?= old('description') ?>');
                    $('#edit_task_remarks').val('<?= old('remarks') ?>');
                    $('#edit_task_file').val('<?= old('file') ?>');
                    
                    // Repopulate and select dropdowns for edit modal
                    $('#edit_task_priority').val('<?= old('priority') ?>').change();
                    $('#edit_task_status').val('<?= old('status') ?>').change();
                    $('#edit_task_project_id').val('<?= old('project_id') ?>').change();
                    $('#edit_task_assigned_to').val('<?= old('assigned_to') ?>').change();

                } else { // addTaskModal
                    // For addTaskModal, fields are pre-populated by old() directly in HTML value attributes,
                    // but dropdowns still need the .val().change() for selection.
                    $('#add_task_priority').val('<?= old('priority') ?>').change();
                    $('#add_task_status').val('<?= old('status') ?>').change();
                    $('#add_task_project_id').val('<?= old('project_id') ?>').change();
                    $('#add_task_assigned_to').val('<?= old('assigned_to') ?>').change();
                }
            }
        <?php endif; ?>
    });
</script>
</body>
</html>
