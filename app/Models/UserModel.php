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
    protected $allowedFields = ['name', 'phone', 'email', 'password', 'role_id', 'status'];

    /**
     * Finds a user by email and password for basic authentication.
     * This method does not include password hashing as per your request.
     *
     * @param string $email The user's email address.
     * @param string $password The user's plain text password.
     * @return array|null The user data if found and credentials match, otherwise null.
     */
    public function getUserByCredentials(string $email, string $password): ?array
    {
        // Use the where method to filter by email and password
        // getRowArray() returns a single row as an associative array
        return $this->where('email', $email)
                    ->where('password', $password)
                    ->first(); // Use first() to get the first matching row
    }
}
