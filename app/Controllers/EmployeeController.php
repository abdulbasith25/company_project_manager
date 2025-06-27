<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\Controller;
// REMOVED: use CodeIgniter\HTTP\RequestInterface; // No longer needed as $this->request is not explicitly used for list filtering here

class EmployeeController extends Controller
{
    protected $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    /**
     * Displays the Employee Dashboard with task summaries only.
     * The detailed task list is moved to a separate page (/tasks).
     *
     * @return string The rendered employee dashboard view.
     */
    public function index(): string
    {
        $session = session();
        $employeeId = $session->get('userId'); // Using 'userId' as per your provided code

        // Fetch task counts for the current employee's assigned tasks (these are ALWAYS overall counts)
        $totalAssignedTasks      = $this->taskModel->countAllTasks($employeeId);
        $pendingAssignedTasks    = $this->taskModel->countTasksByStatus('Pending', $employeeId);
        $inProgressAssignedTasks = $this->taskModel->countTasksByStatus('In Progress', $employeeId);
        $completedAssignedTasks  = $this->taskModel->countTasksByStatus('Completed', $employeeId);
        $blockedAssignedTasks    = $this->taskModel->countTasksByStatus('Blocked', $employeeId);

        // REMOVED: Logic to fetch and filter assignedTasks list as it's moved to /tasks page
        // $assignedTasksQuery = $this->taskModel->select('tasks.*, projects.title as project_title')
        //                                       ->join('projects', 'projects.id = tasks.project_id', 'left')
        //                                       ->where('tasks.assigned_to', $employeeId);
        // if (!empty($statusFilter) && in_array($statusFilter, ['Pending', 'In Progress', 'Completed', 'Blocked'])) {
        //     $assignedTasksQuery->where('tasks.status', $statusFilter);
        // }
        // $assignedTasks = $assignedTasksQuery->findAll();


        $data = [
            'userName'                => $session->get('userName'),
            // REMOVED: 'assignedTasks' => $assignedTasks, // No longer passed here
            'totalAssignedTasks'      => $totalAssignedTasks,
            'pendingAssignedTasks'    => $pendingAssignedTasks,
            'inProgressAssignedTasks' => $inProgressAssignedTasks,
            'completedAssignedTasks'  => $completedAssignedTasks,
            'blockedAssignedTasks'    => $blockedAssignedTasks,
            'validation'              => service('validation'),
            // REMOVED: 'request'                 => $this->request,       // Not needed for summary-only dashboard
            // REMOVED: 'currentStatusFilter'     => $statusFilter         // Not needed for summary-only dashboard
        ];

        return view('dashboards/employee', $data);
    }

    // REMOVED: updateTaskStatus method from EmployeeController. It will be moved to TaskController.
    // public function updateTaskStatus()
    // {
    //     // ... logic was here ...
    // }
}
