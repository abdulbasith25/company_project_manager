<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table          = 'tasks';
    protected $primaryKey     = 'id';
    protected $useAutoIncrement = true; // Assuming auto-increment primary key
    protected $returnType     = 'array'; // Return type of results
    protected $useSoftDeletes = false; // IMPORTANT: Set to false as 'deleted_at' column is NOT in your schema
    protected $deletedField   = 'deleted_at'; // This will not be used as useSoftDeletes is false

    // Add new 'by' fields to allowedFields, keeping existing ones
    protected $allowedFields = [
        'title',
        'description',
        'remarks',
        'file',
        'priority',
        'status',
        'project_id',
        'assigned_to',
        'created_at',
        'updated_at',
        'created_by', // New field
        'updated_by', // New field
        'deleted_by', // New field (will be populated on hard delete if manually set in controller, or for future soft-delete)
    ];

    protected $useTimestamps = true; // Use timestamps for created_at and updated_at
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Model Event Callbacks to populate 'by' fields automatically
    protected $beforeInsert = ['setCreatedBy'];
    protected $beforeUpdate = ['setUpdatedBy'];
    // NOTE: beforeDelete will only be triggered for soft deletes.
    // Since useSoftDeletes is false, this callback will NOT trigger on $this->model->delete($id).
    // If you want to populate deleted_by on HARD deletes, you must do it manually in the controller
    // before calling $this->model->delete($id) or $this->model->where('id', $id)->delete().
    protected $beforeDelete = ['setDeletedBy']; // Kept for consistency and future proofing, but inactive without soft deletes

    /**
     * Set the created_by field before an insert operation.
     *
     * @param array $data The data array being inserted.
     * @return array
     */
    protected function setCreatedBy(array $data)
    {
        $session = service('session');
        $userId = $session->get('id'); // Assuming 'id' is the session key for user ID

        if ($userId !== null) {
            $data['data']['created_by'] = $userId;
        } else {
            log_message('info', 'TaskModel: Task created without a logged-in user context. created_by will be NULL.');
        }

        return $data;
    }

    /**
     * Set the updated_by field before an update operation.
     *
     * @param array $data The data array being updated.
     * @return array
     */
    protected function setUpdatedBy(array $data)
    {
        $session = service('session');
        $userId = $session->get('id'); // Assuming 'id' is the session key for user ID

        if ($userId !== null) {
            $data['data']['updated_by'] = $userId;
        } else {
            log_message('info', 'TaskModel: Task updated without a logged-in user context. updated_by will be NULL.');
        }

        return $data;
    }

    /**
     * Set the deleted_by field before a soft delete operation.
     * NOTE: This will NOT be triggered if useSoftDeletes is false.
     *
     * @param array $data The data array being soft deleted.
     * @return array
     */
    protected function setDeletedBy(array $data)
    {
        $session = service('session');
        $userId = $session->get('id'); // Assuming 'id' is the session key for user ID

        if ($userId !== null) {
            $data['data']['deleted_by'] = $userId;
        } else {
            log_message('info', 'TaskModel: Task soft-deleted without a logged-in user context. deleted_by will be NULL.');
        }

        return $data;
    }

    /**
     * Fetches tasks associated with a specific project, including the assigned employee's name.
     * (Existing method from your provided code)
     *
     * @param int $projectId
     * @return array
     */
    public function getTasksByProjectIdWithEmployee(int $projectId): array
    {
        return $this->select('tasks.*, users.name as assigned_employee_name')
                    ->join('users', 'users.id = tasks.assigned_to', 'left')
                    ->where('tasks.project_id', $projectId)
                    ->findAll();
    }

    /**
     * Fetches all tasks assigned to a specific employee, including the project title.
     * (Existing method from your provided code)
     *
     * @param int $employeeId The user ID of the employee.
     * @return array
     */
    public function getAssignedTasksForEmployee(int $employeeId): array
    {
        return $this->select('tasks.*, projects.title as project_title')
                    ->join('projects', 'projects.id = tasks.project_id', 'left') // Join to get project title
                    ->where('tasks.assigned_to', $employeeId)
                    ->findAll();
    }

    /**
     * Fetches all tasks with details including project title, assigned employee name,
     * and names of users who created, updated, or (potentially) deleted them.
     * This is useful for the main /tasks page and detailed views.
     *
     * @param int|null $assignedToUserId Optional: Filter tasks assigned to a specific user.
     * @return array A list of task data arrays.
     */
    public function getAllTasksWithDetailsAndByNames(?int $assignedToUserId = null): array
    {
        $builder = $this->select('tasks.*,
                                   projects.title as project_title,
                                   assigned_to_user.name as assigned_to_name,
                                   created_by_user.name as created_by_name,
                                   updated_by_user.name as updated_by_name,
                                   deleted_by_user.name as deleted_by_name')
                        ->join('projects', 'projects.id = tasks.project_id', 'left')
                        ->join('users as assigned_to_user', 'assigned_to_user.id = tasks.assigned_to', 'left')
                        ->join('users as created_by_user', 'created_by_user.id = tasks.created_by', 'left')
                        ->join('users as updated_by_user', 'updated_by_user.id = tasks.updated_by', 'left')
                        ->join('users as deleted_by_user', 'deleted_by_user.id = tasks.deleted_by', 'left');

        if ($assignedToUserId !== null) {
            $builder->where('tasks.assigned_to', $assignedToUserId);
        }

        return $builder->findAll();
    }

    /**
     * Counts tasks by status, optionally for a specific assigned user.
     * This method is crucial for the summary boxes on dashboards.
     *
     * @param string $status The status to count (e.g., 'Pending', 'Completed').
     * @param int|null $assignedToUserId Optional: User ID to filter by.
     * @return int The count of tasks matching the criteria.
     */
    public function countTasksByStatus(string $status, ?int $assignedToUserId = null): int
    {
        $builder = $this->where('status', $status);
        if ($assignedToUserId !== null) {
            $builder->where('assigned_to', $assignedToUserId);
        }
        return $builder->countAllResults();
    }

    /**
     * Counts all tasks, optionally for a specific assigned user.
     * This method is crucial for the summary boxes on dashboards.
     *
     * @param int|null $assignedToUserId Optional: User ID to filter by.
     * @return int The total count of tasks matching the criteria.
     */
    public function countAllTasks(?int $assignedToUserId = null): int
    {
        if ($assignedToUserId !== null) {
            return $this->where('assigned_to', $assignedToUserId)->countAllResults();
        }
        return $this->countAllResults();
    }
}
