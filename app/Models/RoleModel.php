<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table      = 'roles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title']; // Only 'title' can be mass-assigned
    protected $useTimestamps = false; // Roles table typically doesn't have created_at/updated_at
}
