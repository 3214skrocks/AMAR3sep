<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Username', 'Password', 'Department', 'role'];

    public function getCataloguers()
    {
        return $this->where('Department', 'cataloguer')->findAll();
    }

    public function getUsers()
    {
        return $this->findAll();
    }
}
