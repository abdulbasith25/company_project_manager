<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | All Tasks</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
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
    /* Custom spacer class for clear visual separation */
    .section-spacing {
        margin-top: 30px; /* Adjust this value for more or less space */
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
            <a href="<?= base_url('users/create') ?>" class="nav-link">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>Add New User</p>
            </a>
          </li>
          <!-- Tasks Links -->
          <li class="nav-item">
            <a href="<?= base_url('tasks') ?>" class="nav-link active">
              <i class="nav-icon fas fa-tasks"></i>
              <p>All Tasks</p>
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
            <h1 class="m-0">All Tasks</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
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

        <!-- Small Boxes / Info Boxes for Task Summary -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- Total Tasks -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= esc($totalTasks) ?></h3>
                <p>Total Tasks</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- Pending Tasks -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?= esc($pendingTasks) ?></h3>
                <p>Pending Tasks</p>
              </div>
              <div class="icon">
                <i class="ion ion-clock"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- In Progress Tasks -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?= esc($inProgressTasks) ?></h3>
                <p>In Progress Tasks</p>
              </div>
              <div class="icon">
                <i class="ion ion-refresh"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- Completed Tasks -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= esc($completedTasks) ?></h3>
                <p>Completed Tasks</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark-round"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- Blocked Tasks -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= esc($blockedTasks) ?></h3>
                <p>Blocked Tasks</p>
              </div>
              <div class="icon">
                <i class="ion ion-alert"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->

        <!-- ADDED SPACER DIV -->
        <div class="section-spacing"></div>

        <!-- All Tasks Table -->
        <div class="card card-dark card-outline">
            <div class="card-header">
                <h3 class="card-title">Task List</h3>
                <div class="card-tools">
                    <button class="btn btn-primary btn-sm"
                            data-toggle="modal"
                            data-target="#addTaskModal"
                            title="Add New Task">
                        <i class="fas fa-plus"></i> Add New Task
                    </button>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <?php if (empty($tasks)): ?>
                    <div class="alert alert-info m-3" role="alert">
                        No tasks found in the system.
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
                                <th>Created At</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th>Deleted By</th>
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
                                                case 'Low':    $priorityBadgeClass = 'badge-info'; break;
                                                case 'Medium': $priorityBadgeClass = 'badge-warning'; break;
                                                case 'High':   $priorityBadgeClass = 'badge-danger'; break;
                                                default:       $priorityBadgeClass = 'badge-secondary'; break;
                                            }
                                        ?>
                                        <span class="badge <?= $priorityBadgeClass ?>"><?= esc($task['priority']) ?></span>
                                    </td>
                                    <td>
                                        <?php
                                            $statusBadgeClass = '';
                                            switch ($task['status']) {
                                                case 'Pending':    $statusBadgeClass = 'badge-secondary'; break;
                                                case 'In Progress':$statusBadgeClass = 'badge-primary'; break;
                                                case 'Completed':  $statusBadgeClass = 'badge-success'; break;
                                                case 'Blocked':    $statusBadgeClass = 'badge-danger'; break;
                                                default:           $statusBadgeClass = 'badge-info'; break;
                                            }
                                        ?>
                                        <span class="badge <?= $statusBadgeClass ?>"><?= esc($task['status']) ?></span>
                                    </td>
                                    <td><?= date('M d, Y', strtotime($task['created_at'])) ?></td>
                                    <td><?= esc($task['created_by_name'] ?? 'N/A') ?></td>
                                    <td><?= esc($task['updated_by_name'] ?? 'N/A') ?></td>
                                    <td><?= esc($task['deleted_by_name'] ?? 'N/A') ?></td>
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
                                        <!-- Edit Task Button -->
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
                                        <!-- Delete Task Button (Hard Delete) -->
                                        <button class="btn btn-sm btn-danger delete-task-btn"
                                                title="Delete Task"
                                                data-toggle="modal"
                                                data-target="#deleteTaskConfirmModal"
                                                data-id="<?= esc($task['id']) ?>"
                                                data-title="<?= esc($task['title']) ?>">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
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
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tasksTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
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
            var priority = button.data('priority');
            var status = button.data('status');
            var projectId = button.data('project-id');
            var assignedToId = button.data('assigned-to-id');

            var modal = $(this);
            modal.find('#edit_task_id').val(taskId);
            modal.find('#edit_task_title').val(title);
            modal.find('#edit_task_description').val(description);
            modal.find('#edit_task_remarks').val(remarks);
            modal.find('#edit_task_file').val(file);
            modal.find('#edit_task_priority').val(priority);
            modal.find('#edit_task_status').val(status);
            modal.find('#edit_task_project_id').val(projectId);
            modal.find('#edit_task_assigned_to').val(assignedToId);
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
        <?php if (session('errors')): ?>
            // Check if errors are specific to task add/edit
            if (old('title') || old('description') || old('remarks') || old('file') || old('priority') || old('status') || old('project_id') || old('assigned_to')) {
                if (old('task_id')) { // It's an Edit Task form submission
                    $('#editTaskModal').modal('show');
                    // Manually re-populate fields based on old() data
                    $('#edit_task_id').val('<?= old('task_id') ?>');
                    $('#edit_task_title').val('<?= old('title') ?>');
                    $('#edit_task_description').val('<?= old('description') ?>');
                    $('#edit_task_remarks').val('<?= old('remarks') ?>');
                    $('#edit_task_file').val('<?= old('file') ?>');
                    $('#edit_task_priority').val('<?= old('priority') ?>');
                    $('#edit_task_status').val('<?= old('status') ?>');
                    $('#edit_task_project_id').val('<?= old('project_id') ?>');
                    $('#edit_task_assigned_to').val('<?= old('assigned_to') ?>');
                } else { // It's an Add Task form submission
                    $('#addTaskModal').modal('show');
                    // Fields will be pre-populated by old() values automatically due to value attributes
                }
            }
        <?php endif; ?>
    });
</script>
</body>
</html>
