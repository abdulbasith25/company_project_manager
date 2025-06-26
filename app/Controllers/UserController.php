<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    protected $userModel;
    protected $roleModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
    }

    /**
     * Displays a list of all users.
     * This will be the dedicated page for viewing all users.
     * Accessible by Admin (and later HR).
     *
     * @return string The rendered all users view.
     */
    public function index(): string
    {
        // Fetch ALL users including soft-deleted ones (if useSoftDeletes is true in model,
        // then onlyDeleted(false) or withDeleted() is needed to see all).
        // For the current UserModel, we explicitly select 'deleted_at'
        // to ensure it's available for the view's conditional logic.
        $allUsers = $this->userModel
                         ->select('users.id, users.name, users.email, users.phone, users.status, users.created_at, users.updated_at, users.deleted_at, users.role_id, roles.title as role_title')
                         ->join('roles', 'roles.id = users.role_id', 'left')
                         // If UserModel has useSoftDeletes = true and you want to see ALL (including soft-deleted):
                         // ->onlyDeleted(false) // This would be used if Model had useSoftDeletes = true
                         ->findAll();

        // Fetch all roles for the edit modal/page
        $roles = $this->roleModel->findAll();

        $data = [
            'userName' => session()->get('userName'), // Pass for sidebar/navbar
            'allUsers' => $allUsers,
            'roles' => $roles, // Pass roles for edit/view modals/pages if needed in this view
        ];
        return view('users/index', $data);
    }

    /**
     * Displays the form for creating a new user.
     * This will be the dedicated page for user creation.
     * Accessible by Admin (and later HR).
     *
     * @return string The rendered user creation form view.
     */
    public function create(): string
    {
        // Fetch all roles to populate the dropdown in the user creation form
        $roles = $this->roleModel->findAll();

        $data = [
            'validation' => service('validation'),
            'roles' => $roles,
            'userName' => session()->get('userName') // Pass for sidebar/navbar
        ];
        return view('users/create', $data);
    }

    /**
     * Handles the submission of the new user form.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function store()
    {
        $session = session();
        $validation = service('validation');

        $rules = [
            'name'      => 'required|min_length[3]|max_length[100]',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'phone'     => 'permit_empty|max_length[20]',
            'password'  => 'required|min_length[6]', // Validation for plain text password
            'role_id'   => 'required|numeric|in_list[1,2,3]',
            'status'    => 'required|numeric|in_list[0,1]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
            'password'  => $this->request->getPost('password'), // Direct assignment for plain text password
            'role_id'   => $this->request->getPost('role_id'),
            'status'    => $this->request->getPost('status'),
            'deleted_at' => null, // Explicitly ensure new users are not marked as deleted
        ];

        if ($this->userModel->insert($data)) {
            $session->setFlashdata('success', 'User "' . esc($data['name']) . '" added successfully!');
            return redirect()->to('/users'); // Redirect to the all users list
        } else {
            log_message('error', 'User addition failed: ' . json_encode($this->userModel->errors()));
            $session->setFlashdata('error', 'Failed to add user. Please check logs or try again.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Handles updating an existing user's details.
     * This method also handles user activation if status is set to 1 and user was soft-deleted.
     * Accessible by Admin (and later HR).
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function update()
    {
        $session = session();
        $validation = service('validation');

        $userId = $this->request->getPost('user_id');

        // IMPORTANT: Fetch original user data including soft-deleted ones to correctly
        // check its current `deleted_at` status for reactivation logic.
        $originalUserData = $this->userModel->withDeleted(true)->find($userId);
        if (!$originalUserData) {
            $session->setFlashdata('error', 'User not found for update.');
            return redirect()->to('/users'); // Redirect to users list if user not found
        }

        $rules = [
            'user_id'   => 'required|numeric',
            'name'      => 'required|min_length[3]|max_length[100]',
            'email'     => 'required|valid_email|is_unique[users.email,id,' . $userId . ']',
            'phone'     => 'permit_empty|max_length[20]',
            'password'  => 'permit_empty|min_length[6]', // Password is optional for update
            'role_id'   => 'required|numeric|in_list[1,2,3]',
            'status'    => 'required|numeric|in_list[0,1]',
        ];

        if (! $this->validate($rules)) {
            // For modal forms, redirecting back with errors means errors are lost if not handled client-side.
            // A common workaround is to use AJAX for modal submissions, or pre-populate data after redirect.
            return redirect()->to('/users')->withInput()->with('errors', $validation->getErrors()); // Redirect to main users page
        }

        $data = [
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
            'role_id'   => $this->request->getPost('role_id'),
            'status'    => $this->request->getPost('status'),
            'updated_at' => date('Y-m-d H:i:s'), // Manually set updated_at if not handled by Model's timestamps
        ];

        // Handle password update only if a new password is provided
        if (! empty($this->request->getPost('password'))) {
            $data['password'] = $this->request->getPost('password'); // Will be plain text as per current setup
        }

        // If status is set to '1' (Active), and they were previously soft-deleted,
        // then set deleted_at to null to "un-soft-delete" them (Reactivation).
        if ($data['status'] == 1 && $originalUserData['deleted_at'] !== null) {
            $data['deleted_at'] = null; // Remove soft-delete timestamp for reactivation
        }

        // IMPORTANT: Use onlyDeleted(true) or withDeleted() for update to ensure
        // you can update records even if they are soft-deleted.
        if ($this->userModel->withDeleted(true)->update($userId, $data)) {
            $session->setFlashdata('success', 'User "' . esc($data['name']) . '" updated successfully!');
        } else {
            log_message('error', 'User update failed for ID ' . $userId . ': ' . json_encode($this->userModel->errors()));
            $session->setFlashdata('error', 'Failed to update user. Please check logs or try again.');
        }

        return redirect()->to('/users'); // Always redirect to the all users list
    }

    /**
     * Handles soft deleting a user.
     * This method will set the `deleted_at` timestamp and also explicitly set `status` to 0 (inactive).
     * Accessible by Admin (and later HR).
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete()
    {
        $session = session();
        $userId = $this->request->getPost('user_id');

        // Fetch user including soft-deleted ones to ensure we can operate on them.
        $user = $this->userModel->withDeleted(true)->find($userId);
        if (!$user) {
            $session->setFlashdata('error', 'User not found for deactivation/deletion.');
            return redirect()->to('/users');
        }

        // Explicitly set status to 0 (inactive) before soft deleting.
        // This update needs to target the record regardless of its soft-delete status.
        $this->userModel->withDeleted(true)->update($userId, ['status' => 0]);

        // CodeIgniter's delete() method will perform a soft delete if $useSoftDeletes is true in UserModel.
        if ($this->userModel->delete($userId)) {
            $session->setFlashdata('success', 'User "' . esc($user['name']) . '" has been deactivated and soft-deleted.');
        } else {
            log_message('error', 'User deactivation/soft-deletion failed for ID ' . $userId . ': ' . json_encode($this->userModel->errors()));
            $session->setFlashdata('error', 'Failed to deactivate user. Please try again.');
        }

        return redirect()->to('/users'); // Always redirect to the all users list
    }
}
