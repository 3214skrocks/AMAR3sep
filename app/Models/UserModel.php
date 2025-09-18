<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'Username',
        'Password',
        'Department',
    ];

    public function getUsersByDepartment($department)
    {
        return $this->where('Department', $department)->findAll();
    }
}
