<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | All Users</title>

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
        <a href="<?= base_url('users') ?>" class="nav-link">Users</a>
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
      <span class="brand-text font-weight-light">USER MANAGEMENT </span>
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
            <a href="<?= base_url('users') ?>" class="nav-link active">
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
            <h1 class="m-0">User Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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

        <!-- All Users Table -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">All Users</h3>
                <div class="card-tools">
                    <a href="<?= base_url('users/create') ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-user-plus"></i> Add New User
                    </a>
                </div>
            </div>
            <div class="card-body">
                <?php if (empty($allUsers)): ?>
                    <div class="alert alert-info" role="alert">
                        No users found. <a href="<?= base_url('users/create') ?>">Click here to add one!</a>
                    </div>
                <?php else: ?>
                    <table id="usersTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($allUsers as $user): ?>
                            <tr>
                                <td><?= esc($user['id']) ?></td>
                                <td><?= esc($user['name']) ?></td>
                                <td><?= esc($user['email']) ?></td>
                                <td><?= esc($user['phone'] ?? 'N/A') ?></td>
                                <td><?= esc($user['role_title']) ?></td>
                                <td>
                                    <?php if ($user['status'] == 1 && $user['deleted_at'] === null): ?>
                                        <span class="badge badge-success">Active</span>
                                    <?php elseif ($user['deleted_at'] !== null): ?>
                                        <span class="badge badge-danger">Soft-Deleted</span>
                                    <?php else: ?>
                                        <span class="badge badge-warning">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('M d, Y H:i', strtotime($user['created_at'])) ?></td>
                                <td>
                                    <!-- Action buttons (Edit, Delete/Deactivate) -->
                                    <button class="btn btn-sm btn-info edit-user-btn"
                                            data-id="<?= esc($user['id']) ?>"
                                            data-name="<?= esc($user['name']) ?>"
                                            data-email="<?= esc($user['email']) ?>"
                                            data-phone="<?= esc($user['phone']) ?>"
                                            data-role-id="<?= esc($user['role_id']) ?>"
                                            data-status="<?= esc($user['status']) ?>"
                                            data-toggle="modal" data-target="#editUserModal">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <?php if ($user['status'] == 1 && $user['deleted_at'] === null): ?>
                                        <button class="btn btn-sm btn-danger delete-user-btn"
                                                data-id="<?= esc($user['id']) ?>"
                                                data-name="<?= esc($user['name']) ?>"
                                                data-toggle="modal" data-target="#confirmDeleteModal">
                                            <i class="fas fa-trash"></i> Deactivate
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-sm btn-success activate-user-btn"
                                                data-id="<?= esc($user['id']) ?>"
                                                data-name="<?= esc($user['name']) ?>"
                                                data-toggle="modal" data-target="#confirmActivateModal">
                                            <i class="fas fa-check"></i> Activate
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

<!-- Modals for User Management -->

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('users/update') ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="user_id" id="edit_user_id">
        <div class="modal-body">
          <div class="form-group">
            <label for="edit_name">Full Name:</label>
            <input type="text" class="form-control" id="edit_name" name="name" required>
          </div>
          <div class="form-group">
            <label for="edit_email">Email address:</label>
            <input type="email" class="form-control" id="edit_email" name="email" required>
          </div>
          <div class="form-group">
            <label for="edit_phone">Phone (Optional):</label>
            <input type="text" class="form-control" id="edit_phone" name="phone">
          </div>
          <div class="form-group">
            <label for="edit_password">Password (leave blank to keep current):</label>
            <input type="password" class="form-control" id="edit_password" name="password">
          </div>
          <div class="form-group">
            <label for="edit_role_id">Role:</label>
            <select class="form-control" id="edit_role_id" name="role_id" required>
              <?php foreach ($roles as $role): ?>
                <option value="<?= esc($role['id']) ?>"><?= esc($role['title']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="edit_status">Status:</label>
            <select class="form-control" id="edit_status" name="status" required>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
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

<!-- Confirm Deactivate User Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deactivation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to deactivate user "<strong id="deleteUserName"></strong>" (ID: <span id="deleteUserId"></span>)? This will make their account inactive.
      </div>
      <div class="modal-footer">
        <form action="<?= base_url('users/delete') ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="user_id" id="deleteUserIdInput">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Deactivate</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Confirm Activate User Modal -->
<div class="modal fade" id="confirmActivateModal" tabindex="-1" role="dialog" aria-labelledby="confirmActivateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmActivateModalLabel">Confirm Activation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to activate user "<strong id="activateUserName"></strong>" (ID: <span id="activateUserId"></span>)? This will make their account active.
      </div>
      <div class="modal-footer">
        <form action="<?= base_url('users/update') ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="user_id" id="activateUserIdInput">
          <input type="hidden" name="status" value="1"> <!-- Set status to 1 for activation -->
          <!-- Need to pass other required fields for validation if update method requires them -->
          <!-- As a workaround for simple status change, we'd need to fetch existing user data in controller,
               or send all data. For now, this assumes validation allows partial update based on only status and ID.
               Better approach: create a dedicated status toggle route. -->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Activate</button>
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
        $('#usersTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        // Handle Edit User Modal population
        $('#editUserModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var userId = button.data('id');
            var name = button.data('name');
            var email = button.data('email');
            var phone = button.data('phone');
            var roleId = button.data('role-id');
            var status = button.data('status');

            var modal = $(this);
            modal.find('#edit_user_id').val(userId);
            modal.find('#edit_name').val(name);
            modal.find('#edit_email').val(email);
            modal.find('#edit_phone').val(phone);
            modal.find('#edit_role_id').val(roleId);
            modal.find('#edit_status').val(status);
            modal.find('#edit_password').val(''); // Clear password field for security
        });

        // Handle Confirm Deactivate Modal population
        $('#confirmDeleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var userId = button.data('id');
            var userName = button.data('name');

            var modal = $(this);
            modal.find('#deleteUserId').text(userId);
            modal.find('#deleteUserName').text(userName);
            modal.find('#deleteUserIdInput').val(userId);
        });

        // Handle Confirm Activate Modal population
        $('#confirmActivateModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var userId = button.data('id');
            var userName = button.data('name');

            var modal = $(this);
            modal.find('#activateUserId').text(userId);
            modal.find('#activateUserName').text(userName);
            modal.find('#activateUserIdInput').val(userId);
            // No need to set status value here as it's a hidden input with value="1"
        });

        // If there were validation errors for edit/delete forms, re-open the respective modal
        <?php if (session('errors') && (strpos(current_url(), 'users') !== false)): ?>
            <?php if (isset(session('errors')['user_id'])): // Assuming user_id indicates an edit/delete error ?>
                // This logic is a bit tricky with modals and redirects.
                // A better approach for modal validation errors is to use AJAX submission.
                // For now, if there's a user_id error, we can guess it's an edit or delete attempt.
                // This might not precisely re-open the exact modal.
                // If the error pertains to a user ID, we assume it's from an edit/delete action.
                // This part requires careful handling or switching to AJAX for better UX.
                // For simplicity, we'll just ensure the table is visible if we're on the users page.
                // You might need more specific logic to show the correct modal with old data.
            <?php endif; ?>
        <?php endif; ?>
    });
</script>
</body>
</html>
