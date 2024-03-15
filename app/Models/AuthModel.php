<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'username', 'password', 'role_id'];

    /**
     * Function to authenticate user based on username and password
     *
     * @param string $username
     * @param string $password
     * @return array|bool
     */
    public function authenticate($username, $password)
    {
        // Fetch user from database
        $user = $this->where('username', $username)->first();

        if ($user) {
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Password matches, return user data
                return $user;
            }
        }

        // User not found or password doesn't match
        return false;
    }

    /**
     * Function to check if user has specific role
     *
     * @param int $userId
     * @param string $role
     * @return bool
     */
    public function hasRole($userId, $role)
    {
        // Fetch user from database
        $user = $this->find($userId);

        // Check if user exists and has the specified role
        return ($user && $user['role_id'] == $role);
    }
}
