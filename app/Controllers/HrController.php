<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\ProjectModel;
use App\Models\TaskModel;
use CodeIgniter\Controller;

class HrController extends Controller
{
    protected $userModel;
    protected $roleModel;
    protected $projectModel;
    protected $taskModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
        $this->projectModel = new ProjectModel();
        $this->taskModel = new TaskModel();
    }

    /**
     * Displays the HR Dashboard with summary counts ONLY for users.
     * It no longer fetches or displays project or task counts.
     *
     * @return string The rendered HR dashboard view.
     */
    public function index(): string
    {
        // Calculate user summary counts
        $totalUsers         = $this->userModel->countAllResults();
        $totalActiveUsers   = $this->userModel->where('status', 1)->countAllResults();
        $totalInactiveUsers = $this->userModel->where('status', 0)->countAllResults();
        $totalEmployees     = $this->userModel->where('role_id', 2)->countAllResults();
        $totalAdmins        = $this->userModel->where('role_id', 1)->countAllResults();
        $totalHRs           = $this->userModel->where('role_id', 3)->countAllResults();

        // Removed: All project and task count fetching logic from here
        // (e.g., totalProjects, activeProjects, pendingTasks, etc.)

        // Fetch all roles, projects, and employees for dropdowns in modals (if modals remain on dashboard)
        // These are kept because the modals are still present in dashboards/hr.php for now.
        $roles = $this->roleModel->findAll();
        $projects = $this->projectModel->findAll(); // Still needed for Assign Task modal
        $employees = $this->userModel->where('role_id', 2)->findAll(); // Still needed for Assign Task modal

        $data = [
            'userName'            => session()->get('userName'),
            // User Counts ONLY
            'totalUsers'          => $totalUsers,
            'totalActiveUsers'    => $totalActiveUsers,
            'totalInactiveUsers'  => $totalInactiveUsers,
            'totalEmployees'      => $totalEmployees,
            'totalAdmins'         => $totalAdmins,
            'totalHRs'            => $totalHRs,
            // Removed: 'totalProjects', 'activeProjects', 'completedProjects', 'onHoldProjects'
            // Removed: 'totalTasks', 'pendingTasks', 'inProgressTasks', 'completedTasks', 'blockedTasks'

            'roles'               => $roles,
            'projects'            => $projects,
            'employees'           => $employees,
            'validation'          => service('validation')
        ];

        return view('dashboards/hr', $data);
    }

    /**
     * Handles the creation of a new user by HR.
     * NOTE: This method should ideally be moved to UserController for centralization.
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
     * NOTE: This method should ideally be moved to UserController for centralization.
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
     * NOTE: This method should ideally be moved to UserController for centralization.
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
     * NOTE: This method should ideally be moved to TaskController for centralization.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function storeTask()
    {
        $session = session();
        $validation = service('validation');

        $rules = [
            'project_id'       => 'required|numeric|is_not_unique[projects.id]',
            'task_title'       => 'required|min_length[3]|max_length[255]',
            'task_description' => 'permit_empty|max_length[5000]',
            'priority'         => 'required|in_list[Low,Medium,High]',
            'status'           => 'required|in_list[Pending,In Progress,Completed,Blocked]',
            'assigned_to'      => 'required|numeric|is_not_unique[users.id]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to('/hr/dashboard')->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'project_id'    => $this->request->getPost('project_id'),
            'title'         => $this->request->getPost('task_title'),
            'description'   => $this->request->getPost('task_description'),
            'remarks'       => '',
            'file'          => '',
            'priority'      => $this->request->getPost('priority'),
            'status'        => $this->request->getPost('status'),
            'assigned_to'   => $this->request->getPost('assigned_to'),
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
