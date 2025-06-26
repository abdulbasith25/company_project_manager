<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Add New User</title>

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
        <a href="<?= base_url('admin/dashboard') ?>" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url('users/create') ?>" class="nav-link">Add User</a>
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
    <a href="<?= base_url('admin/dashboard') ?>" class="brand-link">
      <img src="https://placehold.co/128x128/007bff/fff?text=AD" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

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
          <li class="nav-item">
            <a href="<?= base_url('admin/dashboard') ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <!-- Projects Links -->
          <li class="nav-item">
            <a href="<?= base_url('projects') ?>" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>All Projects</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('projects/create') ?>" class="nav-link">
              <i class="nav-icon fas fa-plus-circle"></i>
              <p>Create Project</p>
            </a>
          </li>
          <!-- User Management Links -->
          <li class="nav-item">
            <a href="<?= base_url('users') ?>" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Manage Users</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('users/create') ?>" class="nav-link active">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>Add New User</p>
            </a>
          </li>
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
            <h1 class="m-0">Add New User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('users') ?>">Users</a></li>
              <li class="breadcrumb-item active">Add</li>
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

        <!-- Add New User Form (Moved from admin dashboard) -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">User Details</h3>
            </div>
            <form action="<?= base_url('users/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Full Name:</label>
                        <input type="text" class="form-control <?= (session('errors.name')) ? 'is-invalid' : '' ?>"
                               id="name" name="name" value="<?= old('name') ?>" placeholder="Enter full name" required>
                        <?php if (session('errors.name')): ?><div class="invalid-feedback"><?= session('errors.name') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control <?= (session('errors.email')) ? 'is-invalid' : '' ?>"
                               id="email" name="email" value="<?= old('email') ?>" placeholder="Enter email" required>
                        <?php if (session('errors.email')): ?><div class="invalid-feedback"><?= session('errors.email') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone (Optional):</label>
                        <input type="text" class="form-control <?= (session('errors.phone')) ? 'is-invalid' : '' ?>"
                               id="phone" name="phone" value="<?= old('phone') ?>" placeholder="Enter phone number">
                        <?php if (session('errors.phone')): ?><div class="invalid-feedback"><?= session('errors.phone') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control <?= (session('errors.password')) ? 'is-invalid' : '' ?>"
                               id="password" name="password" placeholder="Enter password" required>
                        <?php if (session('errors.password')): ?><div class="invalid-feedback"><?= session('errors.password') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="role_id">Role:</label>
                        <select class="form-control <?= (session('errors.role_id')) ? 'is-invalid' : '' ?>" id="role_id" name="role_id" required>
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
                        <label for="status">Status:</label>
                        <select class="form-control <?= (session('errors.status')) ? 'is-invalid' : '' ?>" id="status" name="status" required>
                          <option value="">Select Status</option>
                          <option value="1" <?= (old('status') === '1') ? 'selected' : '' ?>>Active</option>
                          <option value="0" <?= (old('status') === '0') ? 'selected' : '' ?>>Inactive</option>
                        </select>
                        <?php if (session('errors.status')): ?><div class="invalid-feedback"><?= session('errors.status') ?></div><?php endif; ?>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024-<?= date('Y') ?> <a href="#">Your Company</a>.</strong>
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

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
</body>
</html>
