<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Class User_model
 *
 * This model appears to be a legacy file from a previous version of CodeIgniter.
 * It is not used by the current application, which handles authentication in the AdminController.
 *
 * @deprecated This model is unused and contains severe security vulnerabilities (plain MD5 passwords). It should be removed.
 */
class User_model extends Model
{
    /**
     * The table associated with this model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Fetches a user from the database.
     * NOTE: This method is from a legacy system and uses MD5 for passwords, which is insecure.
     *
     * @param string $username   The user's username.
     * @param string $password   The user's password (in plain text, will be hashed with MD5).
     * @param string $department The user's department.
     * @return object|null The user object or null if not found.
     */
    public function get_user($username, $password, $department)
    {
        // Using MD5 is highly insecure. This is for legacy compatibility only.
        $hashedPassword = md5($password);

        return $this->where('Username', $username)
            ->where('Password', $hashedPassword)
            ->where('Department', $department)
            ->first();
    }
}
