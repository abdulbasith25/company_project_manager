<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Employee Dashboard</title>

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
    /* Removed: Custom spacer class and scroll-behavior as per request */
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
        <a href="<?= base_url('dashboard/employee') ?>" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links (optional, for user dropdown/logout) -->
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
    <a href="<?= base_url('dashboard/employee') ?>" class="brand-link">
      <img src="https://placehold.co/128x128/28a745/fff?text=EMP" alt="Employee Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Employee Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/img/user1-128x128.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= esc($userName) ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Main Dashboard Link (active when no specific task filter is applied) -->
          <li class="nav-item">
            <a href="<?= base_url('dashboard/employee') ?>" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <!-- Task Management Section (Now points to /tasks page) -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Your Tasks
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('tasks') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Your Tasks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('tasks') ?>?status=Pending" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Tasks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('tasks') ?>?status=In%20Progress" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>In Progress Tasks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('tasks') ?>?status=Completed" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed Tasks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('tasks') ?>?status=Blocked" class="nav-link">
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
            <h1 class="m-0">Employee Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard/employee') ?>">Home</a></li>
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

        <!-- Small Boxes / Info Boxes for Task Summary (Assigned to Employee) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- Total Assigned Tasks -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= esc($totalAssignedTasks) ?></h3>
                <p>Total Assigned Tasks</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url('tasks') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- Pending Assigned Tasks -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?= esc($pendingAssignedTasks) ?></h3>
                <p>Pending Tasks</p>
              </div>
              <div class="icon">
                <i class="ion ion-clock"></i>
              </div>
              <a href="<?= base_url('tasks') ?>?status=Pending" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- In Progress Assigned Tasks -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?= esc($inProgressAssignedTasks) ?></h3>
                <p>In Progress Tasks</p>
              </div>
              <div class="icon">
                <i class="ion ion-refresh"></i>
              </div>
              <a href="<?= base_url('tasks') ?>?status=In%20Progress" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- Completed Assigned Tasks -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= esc($completedAssignedTasks) ?></h3>
                <p>Completed Tasks</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark-round"></i>
              </div>
              <a href="<?= base_url('tasks') ?>?status=Completed" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- Blocked Assigned Tasks -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= esc($blockedAssignedTasks) ?></h3>
                <p>Blocked Tasks</p>
              </div>
              <div class="icon">
                <i class="ion ion-alert"></i>
              </div>
              <a href="<?= base_url('tasks') ?>?status=Blocked" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->

        <!-- REMOVED: Assigned Tasks Section (the table) -->
        <!-- The old div.card for Your Assigned Tasks was here. It has been removed. -->

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

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
</body>
</html>
