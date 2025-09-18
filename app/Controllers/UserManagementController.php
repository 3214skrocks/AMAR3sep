<?php

namespace App\Controllers;

use CodeIgniter\Controller;

/**
 * Class UserManagementController
 *
 * This controller handles all user management functionalities for the admin panel,
 * including listing, creating, and storing users.
 */
class UserManagementController extends BaseController
{
    /**
     * Constructor.
     *
     * Ensures that only users with the 'Admin' role can access this controller.
     */
    public function __construct()
    {
        $session = session();
        if ($session->get('department') !== 'Admin') {
            // Using echo and exit is not ideal, but we want to stop execution immediately.
            // A proper redirect would be better, but this ensures no further code runs.
            echo 'Access Denied';
            exit;
        }
    }

    /**
     * Displays a list of all users.
     *
     * @return string The view for the user list.
     */
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $query = $builder->get();
        $data['users'] = $query->getResult();

        return view('admin/users/index', $data);
    }

    /**
     * Displays the form to create a new user.
     *
     * @return string The view for the user creation form.
     */
    public function create()
    {
        return view('admin/users/create');
    }

    /**
     * Stores a new user in the database.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function store()
    {
        $session = session();
        $db = \Config\Database::connect();
        $builder = $db->table('users');

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $department = $this->request->getPost('department');

        // Basic validation
        if (empty($username) || empty($password) || empty($department)) {
            $session->setFlashdata('error', 'All fields are required.');
            return redirect()->to('/admin/users/create');
        }

        $data = [
            'Username'   => $username,
            'Password'   => md5($password), // Consistent with existing login
            'Department' => $department,
        ];

        if ($builder->insert($data)) {
            $session->setFlashdata('success', 'User created successfully.');
        } else {
            $session->setFlashdata('error', 'Failed to create user.');
        }

        return redirect()->to('/admin/users');
    }
}
