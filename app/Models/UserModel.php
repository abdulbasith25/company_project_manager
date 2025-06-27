<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    // Define the table name for your users
    protected $table = 'users';

    // Define the primary key
    protected $primaryKey = 'id';

    // Specify the fields that are allowed to be inserted or updated
    // IMPORTANT: Add 'created_at', 'updated_at', and 'deleted_at' to allowedFields
    protected $allowedFields = ['name', 'phone', 'email', 'password', 'role_id', 'status', 'created_at', 'updated_at', 'deleted_at','created_by','deleted_by','updated_by'];

    // Enable timestamps (if not already enabled for created_at/updated_at)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // NEW: Enable Soft Deletes
    protected $useSoftDeletes = true;
    protected $deletedField  = 'deleted_at'; // The column to store deletion timestamp

    // Add beforeInsert and beforeUpdate hooks if you decide to hash passwords later
    // protected $beforeInsert = ['hashPassword'];
    // protected $beforeUpdate = ['hashPassword'];
    // protected function hashPassword(array $data) {
    //     if (isset($data['data']['password']) && !empty($data['data']['password'])) {
    //         $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
    //     }
    //     return $data;
    // }


    /**
     * Finds a user by email and password for basic authentication.
     * This method does not include password hashing as per your current setup.
     *
     * @param string $email The user's email address.
     * @param string $password The user's plain text password.
     * @return array|null The user data if found and credentials match, otherwise null.
     */
    public function getUserByCredentials(string $email, string $password): ?array
    {
        // For soft deletes, first() by default only retrieves non-deleted records.
        // If you need to check credentials against *all* records (including soft-deleted)
        // to provide a more specific error or allow reactivation from login,
        // you would use ->onlyDeleted(true)->withDeleted()->where(...)
        // But for direct login, current setup is fine (only non-deleted can log in).
        $user = $this->where('email', $email)->where('password', $password)->first();

        // Ensure user is active for login (status = 1)
        if ($user && $user['status'] == 1) {
            return $user;
        }

        return null; // No user found, password mismatch, or user is inactive/soft-deleted
    }
}
