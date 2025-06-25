<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Admin Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
  <style>
    /* Custom styles to override or enhance AdminLTE */
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
        background-color: transparent; /* Ensure footer background is transparent */
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
    <a href="<?= base_url('admin/dashboard') ?>" class="brand-link">
      <img src="https://placehold.co/128x128/007bff/fff?text=AD" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
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
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= base_url('admin/dashboard') ?>" class="nav-link active" id="dashboard-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" id="create-project-link" onclick="showSection('create-project-section', this)">
              <i class="nav-icon fas fa-plus-circle"></i>
              <p>Create Project</p>
            </a>
          </li>
          <!-- NEW: Add User link in sidebar -->
          <li class="nav-item">
            <a href="#" class="nav-link" id="add-user-link" onclick="showSection('add-user-section', this)">
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
            <h1 class="m-0">Admin Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
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

        <!-- Small Boxes / Info Boxes for Summary -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= esc($totalProjects) ?></h3>
                <p>Total Projects</p>
              </div>
              <div class="icon">
                <i class="ion ion-briefcase"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= esc($totalEmployees) ?></h3>
                <p>Total Employees</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->

        <!-- All Projects Section (EXISTING) -->
        <div id="all-projects-section" class="card card-primary card-outline content-section">
            <div class="card-header">
                <h3 class="card-title">All Projects</h3>
            </div>
            <div class="card-body">
                <?php if (empty($projects)): ?>
                    <div class="alert alert-info" role="alert">
                        No projects found. Start by creating a new one!
                    </div>
                <?php else: ?>
                    <div class="row">
                        <?php foreach ($projects as $project): ?>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-header bg-info text-white">
                                        <h5 class="card-title m-0"><?= esc($project['title']) ?> (ID: <?= esc($project['id']) ?>)</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-muted">Created: <?= date('M d, Y', strtotime($project['created_at'])) ?></p>
                                        <p class="card-text text-truncate"><?= esc($project['description'] ?? 'No description provided.') ?></p>

                                        <?php if (!empty($project['tasks'])): ?>
                                            <h6 class="mt-3 mb-2 fw-semibold">Assigned Tasks:</h6>
                                            <ul class="list-group list-group-flush">
                                                <?php foreach ($project['tasks'] as $task): ?>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <span><?= esc($task['task_title']) ?></span>
                                                        <span class="badge badge-secondary badge-pill">Assigned to: <?= esc($task['assigned_employee_name'] ?: 'N/A') ?></span>
                                                        <span class="badge badge-info"><?= esc($task['task_status']) ?></span>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php else: ?>
                                            <p class="text-muted mt-3">No tasks assigned to this project yet.</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-footer bg-transparent border-top-0 d-flex justify-content-end">
                                        <button class="btn btn-sm btn-outline-info mr-2 view-details-btn"
                                                data-toggle="modal"
                                                data-target="#projectDetailsModal"
                                                data-title="<?= esc($project['title']) ?>"
                                                data-description="<?= esc($project['description'] ?? 'No description provided.') ?>"
                                                data-created-at="<?= date('M d, Y H:i', strtotime($project['created_at'])) ?>"
                                                data-project-id="<?= esc($project['id']) ?>">
                                            View Details
                                        </button>
                                        <button class="btn btn-sm btn-outline-primary assign-task-btn"
                                                data-toggle="modal"
                                                data-target="#assignTaskModal"
                                                data-project-id="<?= esc($project['id']) ?>"
                                                data-project-title="<?= esc($project['title']) ?>">
                                            Assign Task
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Create Project Section (EXISTING) -->
        <div id="create-project-section" class="card card-success card-outline content-section" style="display: none;">
            <div class="card-header">
                <h3 class="card-title">Create New Project</h3>
            </div>
            <form action="<?= base_url('admin/projects/store') ?>" method="post">
                <?= csrf_field() ?> <!-- CSRF Protection -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Project Title:</label>
                        <input type="text" class="form-control <?= (session('errors.title')) ? 'is-invalid' : '' ?>"
                               id="title" name="title" value="<?= old('title') ?>" placeholder="Enter project title" required>
                        <?php if (session('errors.title')): ?>
                            <div class="invalid-feedback">
                                <?= session('errors.title') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control <?= (session('errors.description')) ? 'is-invalid' : '' ?>"
                                  id="description" name="description" rows="5" placeholder="Enter project description"><?= old('description') ?></textarea>
                        <?php if (session('errors.description')): ?>
                            <div class="invalid-feedback">
                                <?= session('errors.description') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Create Project</button>
                </div>
            </form>
        </div>

        <!-- NEW: Add User Section (Standalone Form in Admin Dashboard) -->
        <div id="add-user-section" class="card card-primary card-outline content-section" style="display: none;">
            <div class="card-header">
                <h3 class="card-title">Add New User</h3>
            </div>
            <form action="<?= base_url('admin/users/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="add_user_name">Full Name:</label>
                        <input type="text" class="form-control <?= (session('errors.name')) ? 'is-invalid' : '' ?>"
                               id="add_user_name" name="name" value="<?= old('name') ?>" placeholder="Enter full name" required>
                        <?php if (session('errors.name')): ?><div class="invalid-feedback"><?= session('errors.name') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="add_user_email">Email address:</label>
                        <input type="email" class="form-control <?= (session('errors.email')) ? 'is-invalid' : '' ?>"
                               id="add_user_email" name="email" value="<?= old('email') ?>" placeholder="Enter email" required>
                        <?php if (session('errors.email')): ?><div class="invalid-feedback"><?= session('errors.email') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="add_user_phone">Phone (Optional):</label>
                        <input type="text" class="form-control <?= (session('errors.phone')) ? 'is-invalid' : '' ?>"
                               id="add_user_phone" name="phone" value="<?= old('phone') ?>" placeholder="Enter phone number">
                        <?php if (session('errors.phone')): ?><div class="invalid-feedback"><?= session('errors.phone') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="add_user_password">Password:</label>
                        <input type="password" class="form-control <?= (session('errors.password')) ? 'is-invalid' : '' ?>"
                               id="add_user_password" name="password" placeholder="Enter password" required>
                        <?php if (session('errors.password')): ?><div class="invalid-feedback"><?= session('errors.password') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="add_user_role_id">Role:</label>
                        <select class="form-control <?= (session('errors.role_id')) ? 'is-invalid' : '' ?>" id="add_user_role_id" name="role_id" required>
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
                        <label for="add_user_status">Status:</label>
                        <select class="form-control <?= (session('errors.status')) ? 'is-invalid' : '' ?>" id="add_user_status" name="status" required>
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
        <!-- END NEW: Add User Section -->

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

<!-- Project Details Modal (EXISTING) -->
<div class="modal fade" id="projectDetailsModal" tabindex="-1" role="dialog" aria-labelledby="projectDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="projectDetailsModalLabel">Project Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 id="modalProjectTitle" class="text-primary mb-3"></h4>
        <p><strong>Project ID:</strong> <span id="modalProjectId"></span></p>
        <p><strong>Created At:</strong> <span id="modalProjectCreatedAt"></span></p>
        <hr>
        <h5>Description:</h5>
        <p id="modalProjectDescription" class="text-justify"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Assign Task Modal (EXISTING) -->
<div class="modal fade" id="assignTaskModal" tabindex="-1" role="dialog" aria-labelledby="assignTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="assignTaskModalLabel">Assign Task to Project: <span id="assignTaskProjectTitle"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/tasks/store') ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="project_id" id="assignTaskProjectId">
        <div class="modal-body">
          <div class="form-group">
            <label for="task_title">Task Title:</label>
            <input type="text" class="form-control <?= (session('errors.task_title')) ? 'is-invalid' : '' ?>"
                   id="task_title" name="task_title" value="<?= old('task_title') ?>" required>
            <?php if (session('errors.task_title')): ?><div class="invalid-feedback"><?= session('errors.task_title') ?></div><?php endif; ?>
          </div>
          <div class="form-group">
            <label for="task_description">Task Description:</label>
            <textarea class="form-control <?= (session('errors.task_description')) ? 'is-invalid' : '' ?>"
                      id="task_description" name="task_description" rows="3"><?= old('task_description') ?></textarea>
            <?php if (session('errors.task_description')): ?><div class="invalid-feedback"><?= session('errors.task_description') ?></div><?php endif; ?>
          </div>
          <div class="form-group">
            <label for="priority">Priority:</label>
            <select class="form-control <?= (session('errors.priority')) ? 'is-invalid' : '' ?>" id="priority" name="priority" required>
              <option value="">Select Priority</option>
              <option value="Low" <?= (old('priority') == 'Low') ? 'selected' : '' ?>>Low</option>
              <option value="Medium" <?= (old('priority') == 'Medium') ? 'selected' : '' ?>>Medium</option>
              <option value="High" <?= (old('priority') == 'High') ? 'selected' : '' ?>>High</option>
            </select>
            <?php if (session('errors.priority')): ?><div class="invalid-feedback"><?= session('errors.priority') ?></div><?php endif; ?>
          </div>
          <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control <?= (session('errors.status')) ? 'is-invalid' : '' ?>" id="status" name="status" required>
              <option value="">Select Status</option>
              <option value="Pending" <?= (old('status') == 'Pending') ? 'selected' : '' ?>>Pending</option>
              <option value="In Progress" <?= (old('status') == 'In Progress') ? 'selected' : '' ?>>In Progress</option>
              <option value="Completed" <?= (old('status') == 'Completed') ? 'selected' : '' ?>>Completed</option>
              <option value="Blocked" <?= (old('status') == 'Blocked') ? 'selected' : '' ?>>Blocked</option>
            </select>
            <?php if (session('errors.status')): ?><div class="invalid-feedback"><?= session('errors.status') ?></div><?php endif; ?>
          </div>
          <div class="form-group">
            <label for="assigned_to">Assign to Employee:</label>
            <select class="form-control <?= (session('errors.assigned_to')) ? 'is-invalid' : '' ?>" id="assigned_to" name="assigned_to" required>
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
    // Function to toggle sections
    function showSection(sectionId, clickedLink = null) {
        document.querySelectorAll('.content-section').forEach(function(section) {
            section.style.display = 'none';
        });
        document.getElementById(sectionId).style.display = 'block';

        // Update active state in sidebar
        document.querySelectorAll('.sidebar .nav-link').forEach(function(link) {
            link.classList.remove('active');
        });
        if (clickedLink) {
            clickedLink.classList.add('active');
        } else if (sectionId === 'all-projects-section') {
            document.getElementById('dashboard-link').classList.add('active');
        }
    }

    // Show all projects section by default on load
    document.addEventListener('DOMContentLoaded', function() {
        showSection('all-projects-section');
    });

    // Handle initial display of validation errors after redirect
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session('errors')): ?>
            if (old('title') || old('description')) { // From Create Project form
                showSection('create-project-section');
                document.getElementById('create-project-link').classList.add('active');
            } else if (old('task_title') || old('assigned_to') || old('project_id')) { // From Assign Task form
                showSection('all-projects-section'); // Stay on projects view
                // For a task assignment modal, you would need to re-open the modal
                // and pre-fill its values, which is more complex with redirects.
                // For now, it will show errors on the main page.
            } else if (old('name') || old('email') || old('password') || old('role_id') || old('status')) { // From Add User form
                showSection('add-user-section'); // Show the Add User form section
                document.getElementById('add-user-link').classList.add('active');
                // Repopulate the form fields with old data
                $('#add_user_name').val('<?= old('name') ?>');
                $('#add_user_email').val('<?= old('email') ?>');
                $('#add_user_phone').val('<?= old('phone') ?>');
                // Password field is intentionally not pre-filled for security
                $('#add_user_role_id').val('<?= old('role_id') ?>');
                $('#add_user_status').val('<?= old('status') ?>');
            }
        <?php elseif (session()->getFlashdata('success') && $this->request->uri->getSegment(2) === 'projects'): ?>
            showSection('all-projects-section');
        <?php elseif (session()->getFlashdata('success') && $this->request->uri->getSegment(2) === 'users'): ?>
            showSection('all-projects-section'); // Keep default view, or you could redirect to a user list if you had one.
        <?php else: ?>
            showSection('all-projects-section');
        <?php endif; ?>
    });


    // jQuery to handle Project Details modal population
    $('#projectDetailsModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var title = button.data('title');
        var description = button.data('description');
        var createdAt = button.data('created-at');
        var projectId = button.data('project-id');

        var modal = $(this);
        modal.find('#modalProjectTitle').text(title);
        modal.find('#modalProjectId').text(projectId);
        modal.find('#modalProjectCreatedAt').text(createdAt);
        modal.find('#modalProjectDescription').text(description);
    });

    // jQuery to handle Assign Task modal population
    $('#assignTaskModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var projectId = button.data('project-id');
        var projectTitle = button.data('project-title');

        var modal = $(this);
        modal.find('#assignTaskProjectId').val(projectId); // Set hidden project_id
        modal.find('#assignTaskProjectTitle').text(projectTitle); // Display project title in modal header

        // Clear form fields on fresh open, unless there were validation errors and old input
        <?php if (!session('errors') || (!old('task_title') && !old('assigned_to') && !old('project_id'))): ?>
            modal.find('form')[0].reset();
        <?php endif; ?>
    });

    // No specific jQuery needed for addUserModal for now as it's a section,
    // but the JS for handling old input for validation errors is in the DOMContentLoaded block.
</script>
</body>
</html>
