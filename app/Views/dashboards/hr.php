<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | HR Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
    <style>
        /* Custom styles */
        .brand-link .brand-image {
            float: left;
            line-height: .8;
            margin-left: .8rem;
            margin-right: .5rem;
            margin-top: -.3rem;
            max-height: 33px;
            width: auto;
        }
        .card-footer {
            background-color: transparent;
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
                <a href="<?= base_url('hr/dashboard') ?>" class="nav-link">Home</a>
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
        <a href="<?= base_url('hr/dashboard') ?>" class="brand-link">
            <img src="https://placehold.co/128x128/dc3545/fff?text=HR" alt="HR Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">HR Panel</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/img/user8-128x128.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?= esc($userName) ?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="<?= base_url('hr/dashboard') ?>" class="nav-link active">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('users') ?>" class="nav-link"> <!-- Direct link to /users page -->
                            <i class="nav-icon fas fa-users"></i>
                            <p>Manage Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('projects') ?>" class="nav-link">
                            <i class="nav-icon fas fa-project-diagram"></i>
                            <p>Manage Projects</p>
                        </a>
                    </li>
                    <!-- Removed: Manage Projects and Manage Tasks sidebar links -->
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
                        <h1 class="m-0">HR Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('hr/dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
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

                <!-- Small Boxes / Info Boxes for User Summary ONLY -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- Total Users -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?= esc($totalUsers) ?></h3>
                                <p>Total Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-stalker"></i>
                            </div>
                            <a href="<?= base_url('users') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- Total Active Users -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?= esc($totalActiveUsers) ?></h3>
                                <p>Active Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-checkmark-circled"></i>
                            </div>
                            <a href="<?= base_url('users') ?>?status=1" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- Total Inactive Users -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?= esc($totalInactiveUsers) ?></h3>
                                <p>Inactive Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-alert-circled"></i>
                            </div>
                            <a href="<?= base_url('users') ?>?status=0" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- Total Employees -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3><?= esc($totalEmployees) ?></h3>
                                <p>Total Employees</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-briefcase"></i>
                            </div>
                            <a href="<?= base_url('users') ?>?role_id=2" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- Total Admins -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?= esc($totalAdmins) ?></h3>
                                <p>Total Admins</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="<?= base_url('users') ?>?role_id=1" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- Total HRs -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3><?= esc($totalHRs) ?></h3>
                                <p>Total HRs</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="<?= base_url('users') ?>?role_id=3" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /.row (User Summaries) -->

                <!-- Removed: Project Summary row -->
                <!-- Removed: Task Summary row -->

                <!-- Action Buttons Section (for modals still on this page) -->
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center mb-3">
                        <button class="btn btn-success mx-2"
                                data-toggle="modal"
                                data-target="#assignTaskByHrModal"
                                title="Assign New Task">
                            <i class="fas fa-tasks mr-1"></i> Assign New Task
                        </button>
                        <button class="btn btn-success mx-2"
                                data-toggle="modal"
                                data-target="#addUserModal"
                                title="Add New User">
                            <i class="fas fa-plus-circle mr-1"></i> Add New User
                        </button>
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

<!-- Add User Modal (EXISTING) -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('hr/users/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="add_name">Full Name:</label>
                        <input type="text" class="form-control <?= (session('errors.name')) ? 'is-invalid' : '' ?>"
                               id="add_name" name="name" value="<?= old('name') ?>" placeholder="Enter full name" required>
                        <?php if (session('errors.name')): ?><div class="invalid-feedback"><?= session('errors.name') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="add_email">Email address:</label>
                        <input type="email" class="form-control <?= (session('errors.email')) ? 'is-invalid' : '' ?>"
                               id="add_email" name="email" value="<?= old('email') ?>" placeholder="Enter email" required>
                        <?php if (session('errors.email')): ?><div class="invalid-feedback"><?= session('errors.email') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="add_phone">Phone (Optional):</label>
                        <input type="text" class="form-control <?= (session('errors.phone')) ? 'is-invalid' : '' ?>"
                               id="add_phone" name="phone" value="<?= old('phone') ?>" placeholder="Enter phone number">
                        <?php if (session('errors.phone')): ?><div class="invalid-feedback"><?= session('errors.phone') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="add_password">Password:</label>
                        <input type="password" class="form-control <?= (session('errors.password')) ? 'is-invalid' : '' ?>"
                               id="add_password" name="password" placeholder="Enter password" required>
                        <?php if (session('errors.password')): ?><div class="invalid-feedback"><?= session('errors.password') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="add_role_id">Role:</label>
                        <select class="form-control <?= (session('errors.role_id')) ? 'is-invalid' : '' ?>" id="add_role_id" name="role_id" required>
                            <option value="">Select Role</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= esc($role['id']) ?>" <?= (old('role_id') == $role['id']) ? 'selected' : '' ?>>
                                    <?= esc($role['title']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (session('errors.role_id')): ?><div class="invalid-feedback"><?= session('errors.role_id') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="add_status">Status:</label>
                        <select class="form-control <?= (session('errors.status')) ? 'is-invalid' : '' ?>" id="add_status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="1" <?= (old('status') === '1') ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= (old('status') === '0') ? 'selected' : '' ?>>Inactive</option>
                        </select>
                        <?php if (session('errors.status')): ?><div class="invalid-feedback"><?= session('errors.status') ?></div><?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View User Details Modal (EXISTING) -->
<div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewUserModalLabel">User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> <span id="view_user_id"></span></p>
                <p><strong>Name:</strong> <span id="view_user_name"></span></p>
                <p><strong>Email:</strong> <span id="view_user_email"></span></p>
                <p><strong>Phone:</strong> <span id="view_user_phone"></span></p>
                <p><strong>Role:</strong> <span id="view_user_role"></span></p>
                <p><strong>Status:</strong> <span id="view_user_status"></span></p>
                <p><strong>Created At:</strong> <span id="view_user_created_at"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal (EXISTING) -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('hr/users/update') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="user_id" id="edit_user_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_name">Full Name:</label>
                        <input type="text" class="form-control <?= (session('errors.name')) ? 'is-invalid' : '' ?>"
                               id="edit_name" name="name" value="<?= old('name') ?>" required>
                        <?php if (session('errors.name')): ?><div class="invalid-feedback"><?= session('errors.name') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="edit_email">Email address:</label>
                        <input type="email" class="form-control <?= (session('errors.email')) ? 'is-invalid' : '' ?>"
                               id="edit_email" name="email" value="<?= old('email') ?>" required>
                        <?php if (session('errors.email')): ?><div class="invalid-feedback"><?= session('errors.email') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="edit_phone">Phone (Optional):</label>
                        <input type="text" class="form-control <?= (session('errors.phone')) ? 'is-invalid' : '' ?>"
                               id="edit_phone" name="phone" value="<?= old('phone') ?>">
                        <?php if (session('errors.phone')): ?><div class="invalid-feedback"><?= session('errors.phone') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="edit_password">New Password (leave blank to keep current):</label>
                        <input type="password" class="form-control <?= (session('errors.password')) ? 'is-invalid' : '' ?>"
                               id="edit_password" name="password" placeholder="Leave blank to keep current">
                        <?php if (session('errors.password')): ?><div class="invalid-feedback"><?= session('errors.password') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="edit_role_id">Role:</label>
                        <select class="form-control <?= (session('errors.role_id')) ? 'is-invalid' : '' ?>" id="edit_role_id" name="role_id" required>
                            <option value="">Select Role</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= esc($role['id']) ?>" <?= (old('role_id') == $role['id']) ? 'selected' : '' ?>>
                                    <?= esc($role['title']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (session('errors.role_id')): ?><div class="invalid-feedback"><?= session('errors.role_id') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="edit_status">Status:</label>
                        <select class="form-control <?= (session('errors.status')) ? 'is-invalid' : '' ?>" id="edit_status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="1" <?= (old('status') === '1') ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= (old('status') === '0') ? 'selected' : '' ?>>Inactive</option>
                        </select>
                        <?php if (session('errors.status')): ?><div class="invalid-feedback"><?= session('errors.status') ?></div><?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete User Confirmation Modal (EXISTING) -->
<div class="modal fade" id="deleteUserConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserConfirmModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('hr/users/delete') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="user_id" id="delete_user_id">
                <div class="modal-body">
                    <p>Are you sure you want to delete user: <strong id="delete_user_name"></strong> (ID: <strong id="delete_user_display_id"></strong>)?</p>
                    <p class="text-danger">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- NEW: Assign Task by HR Modal -->
<div class="modal fade" id="assignTaskByHrModal" tabindex="-1" role="dialog" aria-labelledby="assignTaskByHrModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignTaskByHrModalLabel">Assign New Task (by HR)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('tasks/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="hr_assign_project_id">Select Project:</label>
                        <select class="form-control <?= (session('errors.project_id')) ? 'is-invalid' : '' ?>" id="hr_assign_project_id" name="project_id" required>
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
                        <label for="hr_assign_task_title">Task Title:</label>
                        <input type="text" class="form-control <?= (session('errors.task_title')) ? 'is-invalid' : '' ?>"
                               id="hr_assign_task_title" name="task_title" value="<?= old('task_title') ?>" required>
                        <?php if (session('errors.task_title')): ?><div class="invalid-feedback"><?= session('errors.task_title') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="hr_assign_task_description">Task Description:</label>
                        <textarea class="form-control <?= (session('errors.task_description')) ? 'is-invalid' : '' ?>"
                                 id="hr_assign_task_description" name="task_description" rows="3"><?= old('task_description') ?></textarea>
                        <?php if (session('errors.task_description')): ?><div class="invalid-feedback"><?= session('errors.task_description') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="hr_assign_priority">Priority:</label>
                        <select class="form-control <?= (session('errors.priority')) ? 'is-invalid' : '' ?>" id="hr_assign_priority" name="priority" required>
                            <option value="">Select Priority</option>
                            <option value="Low" <?= (old('priority') == 'Low') ? 'selected' : '' ?>>Low</option>
                            <option value="Medium" <?= (old('priority') == 'Medium') ? 'selected' : '' ?>>Medium</option>
                            <option value="High" <?= (old('priority') == 'High') ? 'selected' : '' ?>>High</option>
                        </select>
                        <?php if (session('errors.priority')): ?><div class="invalid-feedback"><?= session('errors.priority') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="hr_assign_status">Status:</label>
                        <select class="form-control <?= (session('errors.status')) ? 'is-invalid' : '' ?>" id="hr_assign_status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="Pending" <?= (old('status') == 'Pending') ? 'selected' : '' ?>>Pending</option>
                            <option value="In Progress" <?= (old('status') == 'In Progress') ? 'selected' : '' ?>>In Progress</option>
                            <option value="Completed" <?= (old('status') == 'Completed') ? 'selected' : '' ?>>Completed</option>
                            <option value="Blocked" <?= (old('status') == 'Blocked') ? 'selected' : '' ?>>Blocked</option>
                        </select>
                        <?php if (session('errors.status')): ?><div class="invalid-feedback"><?= session('errors.status') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="hr_assign_assigned_to">Assign to Employee:</label>
                        <select class="form-control <?= (session('errors.assigned_to')) ? 'is-invalid' : '' ?>" id="hr_assign_assigned_to" name="assigned_to" required>
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
                    <button type="submit" class="btn btn-primary">Assign Task</button>
                </div>
            </form>
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

<script>
    // General script for showing validation errors in modals on page load after redirect
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session('errors')): ?>
            // Identify which modal the old input belongs to (Add User, Edit User, or Assign Task)
            if (old('name') || old('email') || old('password') || old('role_id') || old('status')) { // Add/Edit User fields
                if (old('user_id')) { // It's an Edit User form submission
                    $('#editUserModal').modal('show');
                    // Re-populate edit form with old data if validation failed for edit
                    $('#edit_user_id').val('<?= old('user_id') ?>');
                    $('#edit_name').val('<?= old('name') ?>');
                    $('#edit_email').val('<?= old('email') ?>');
                    $('#edit_phone').val('<?= old('phone') ?>');
                    $('#edit_role_id').val('<?= old('role_id') ?>');
                    $('#edit_status').val('<?= old('status') ?>');
                    // Password field is intentionally not pre-filled for security
                } else { // It's an Add User form submission
                    $('#addUserModal').modal('show');
                }
            } else if (old('project_id') || old('task_title') || old('assigned_to')) { // Assign Task fields
                $('#assignTaskByHrModal').modal('show');
                // Re-populate assign task form with old data
                $('#hr_assign_project_id').val('<?= old('project_id') ?>');
                $('#hr_assign_task_title').val('<?= old('task_title') ?>');
                $('#hr_assign_task_description').val('<?= old('task_description') ?>');
                $('#hr_assign_priority').val('<?= old('priority') ?>');
                $('#hr_assign_status').val('<?= old('status') ?>');
                $('#hr_assign_assigned_to').val('<?= old('assigned_to') ?>');
            }
        <?php endif; ?>
    });

    // NEW: jQuery to handle Assign Task by HR modal population
    $('#assignTaskByHrModal').on('show.bs.modal', function (event) {
        // --- ADDED console.log FOR DEBUGGING ---
        console.log("Modal show event triggered for #assignTaskByHrModal");
        var formElement = $(this).find('form');
        console.log("Found form element:", formElement);
        console.log("Form element count:", formElement.length);

        // Clear form fields on fresh open
        // Check if there are no old inputs from a failed submission before resetting
        <?php if (!session('errors') || (!old('project_id') && !old('task_title') && !old('assigned_to'))): ?>
            // --- MODIFIED LINE FOR SAFER RESET ---
            if (formElement.length > 0) { // Check if form was actually found
                formElement[0].reset();
                console.log("Form reset.");
            } else {
                console.warn("Form element not found within modal, cannot reset.");
            }
        <?php else: ?>
            console.log("Form not reset due to existing validation errors or old input.");
        <?php endif; ?>
    });

    // jQuery to handle View User Details modal population
    $('#viewUserModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var name = button.data('name');
        var email = button.data('email');
        var phone = button.data('phone');
        var role = button.data('role');
        var status = button.data('status');
        var createdAt = button.data('created-at');

        var modal = $(this);
        modal.find('#view_user_id').text(id);
        modal.find('#view_user_name').text(name);
        modal.find('#view_user_email').text(email);
        modal.find('#view_user_phone').text(phone);
        modal.find('#view_user_role').text(role);
        modal.find('#view_user_status').text(status);
        modal.find('#view_user_created_at').text(createdAt);
    });

    // jQuery to handle Edit User modal population
    $('#editUserModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var name = button.data('name');
        var email = button.data('email');
        var phone = button.data('phone');
        var roleId = button.data('role-id');
        var status = button.data('status');

        var modal = $(this);
        modal.find('#edit_user_id').val(id);
        modal.find('#edit_name').val(name);
        modal.find('#edit_email').val(email);
        modal.find('#edit_phone').val(phone);
        modal.find('#edit_role_id').val(roleId); // Set the selected option for role
        modal.find('#edit_status').val(status); // Set the selected option for status
        modal.find('#edit_password').val(''); // Clear password field on modal open for security
    });

    // jQuery to handle Delete User Confirmation modal population
    $('#deleteUserConfirmModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var name = button.data('name');

        var modal = $(this);
        modal.find('#delete_user_id').val(id); // --- ADDED LINE FOR delete_user_id ---
        modal.find('#delete_user_name').text(name);
        modal.find('#delete_user_display_id').text(id); // --- ADDED LINE FOR delete_user_display_id ---
    });
</script>
</body>
</html>
