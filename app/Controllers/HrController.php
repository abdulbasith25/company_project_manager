<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\ProjectModel; // Import ProjectModel
use App\Models\TaskModel;    // Import TaskModel
use CodeIgniter\Controller;

class HrController extends Controller
{
    protected $userModel;
    protected $roleModel;
    protected $projectModel; // Declare ProjectModel
    protected $taskModel;    // Declare TaskModel

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
        $this->projectModel = new ProjectModel(); // Initialize ProjectModel
        $this->taskModel = new TaskModel();      // Initialize TaskModel
    }

    /**
     * Displays the HR Dashboard with user statistics, a list of all users, projects, and employees.
     *
     * @return string The rendered HR dashboard view.
     */
    public function index(): string
    {
        // Fetch all users with their role titles
        $allUsers = $this->userModel->select('users.*, roles.title as role_title')
                                     ->join('roles', 'roles.id = users.role_id', 'left')
                                     ->findAll();

        // Calculate summary counts
        $totalUsers = count($allUsers);
        $totalActiveUsers = 0;
        $totalInactiveUsers = 0;
        $totalEmployees = 0;
        $totalAdmins = 0;
        $totalHRs = 0;

        foreach ($allUsers as $user) {
            if ($user['status'] == 1) {
                $totalActiveUsers++;
            } else {
                $totalInactiveUsers++;
            }

            switch ($user['role_id']) {
                case 1:
                    $totalAdmins++;
                    break;
                case 2:
                    $totalEmployees++;
                    break;
                case 3:
                    $totalHRs++;
                    break;
            }
        }

        // Fetch all roles for the 'Add User' and 'Edit User' forms
        $roles = $this->roleModel->findAll();

        // NEW: Fetch all projects for the 'Assign Task' form
        $projects = $this->projectModel->findAll();

        // NEW: Fetch all employees (users with role_id = 2) for 'Assign Task' form
        $employees = $this->userModel->where('role_id', 2)->findAll();

        $data = [
            'userName' => session()->get('userName'),
            'allUsers' => $allUsers,
            'totalUsers' => $totalUsers,
            'totalActiveUsers' => $totalActiveUsers,
            'totalInactiveUsers' => $totalInactiveUsers,
            'totalEmployees' => $totalEmployees,
            'totalAdmins' => $totalAdmins,
            'totalHRs' => $totalHRs,
            'roles' => $roles, // Used for Add/Edit User
            'projects' => $projects, // NEW: Used for Assign Task modal
            'employees' => $employees, // NEW: Used for Assign Task modal
            'validation' => service('validation')
        ];

        return view('dashboards/hr', $data);
    }

    /**
     * Handles the creation of a new user by HR.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function storeUser()
    {
        $session = session();
        $validation = service('validation');

        $rules = [
            'name'      => 'required|min_length[3]|max_length[100]',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'phone'     => 'permit_empty|max_length[20]',
            'password'  => 'required|min_length[6]',
            'role_id'   => 'required|numeric|in_list[1,2,3]',
            'status'    => 'required|numeric|in_list[0,1]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to('/hr/dashboard')->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
            'password'  => $this->request->getPost('password'),
            'role_id'   => $this->request->getPost('role_id'),
            'status'    => $this->request->getPost('status'),
        ];

        if ($this->userModel->insert($data)) {
            $session->setFlashdata('success', 'User "' . esc($data['name']) . '" added successfully!');
        } else {
            log_message('error', 'User addition failed: ' . json_encode($this->userModel->errors()));
            $session->setFlashdata('error', 'Failed to add user. Please check logs or try again.');
        }

        return redirect()->to('/hr/dashboard');
    }

    /**
     * Handles updating an existing user's details by HR.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function updateUser()
    {
        $session = session();
        $validation = service('validation');

        $userId = $this->request->getPost('user_id');

        $rules = [
            'user_id'   => 'required|numeric|is_not_unique[users.id]',
            'name'      => 'required|min_length[3]|max_length[100]',
            'email'     => 'required|valid_email|is_unique[users.email,id,' . $userId . ']',
            'phone'     => 'permit_empty|max_length[20]',
            'password'  => 'permit_empty|min_length[6]',
            'role_id'   => 'required|numeric|in_list[1,2,3]',
            'status'    => 'required|numeric|in_list[0,1]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to('/hr/dashboard')->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
            'role_id'   => $this->request->getPost('role_id'),
            'status'    => $this->request->getPost('status'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if (! empty($this->request->getPost('password'))) {
            $data['password'] = $this->request->getPost('password');
        }

        if ($this->userModel->update($userId, $data)) {
            $session->setFlashdata('success', 'User "' . esc($data['name']) . '" updated successfully!');
        } else {
            log_message('error', 'User update failed for ID ' . $userId . ': ' . json_encode($this->userModel->errors()));
            $session->setFlashdata('error', 'Failed to update user. Please check logs or try again.');
        }

        return redirect()->to('/hr/dashboard');
    }

    /**
     * Handles deleting a user by HR.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function deleteUser()
    {
        $session = session();
        $userId = $this->request->getPost('user_id');

        if ($this->userModel->delete($userId)) {
            $session->setFlashdata('success', 'User (ID: ' . esc($userId) . ') deleted successfully!');
        } else {
            log_message('error', 'User deletion failed for ID ' . $userId . ': ' . json_encode($this->userModel->errors()));
            $session->setFlashdata('error', 'Failed to delete user. Please try again.');
        }

        return redirect()->to('/hr/dashboard');
    }

    /**
     * Handles the assignment of a new task by HR.
     * This is similar to AdminController's storeTask but from HR perspective.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function storeTask()
    {
        $session = session();
        $validation = service('validation');

        $rules = [
            'project_id'  => 'required|numeric|is_not_unique[projects.id]', // Ensure project exists
            'task_title'  => 'required|min_length[3]|max_length[255]',
            'task_description' => 'permit_empty|max_length[5000]',
            'priority'    => 'required|in_list[Low,Medium,High]',
            'status'      => 'required|in_list[Pending,In Progress,Completed,Blocked]',
            'assigned_to' => 'required|numeric|is_not_unique[users.id]', // Ensure user exists
        ];

        if (! $this->validate($rules)) {
            return redirect()->to('/hr/dashboard')->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'project_id'  => $this->request->getPost('project_id'),
            'title'       => $this->request->getPost('task_title'),
            'description' => $this->request->getPost('task_description'),
            'remarks'     => '', // Default empty if not used in form
            'file'        => '', // Default empty if not used in form
            'priority'    => $this->request->getPost('priority'),
            'status'      => $this->request->getPost('status'),
            'assigned_to' => $this->request->getPost('assigned_to'),
            // 'created_at' and 'updated_at' handled by TaskModel timestamps
        ];

        if ($this->taskModel->insert($data)) {
            $session->setFlashdata('success', 'Task "' . esc($data['title']) . '" assigned successfully!');
        } else {
            log_message('error', 'Task assignment failed by HR: ' . json_encode($this->taskModel->errors()));
            $session->setFlashdata('error', 'Failed to assign task. Please try again.');
        }

        return redirect()->to('/hr/dashboard');
    }
}
