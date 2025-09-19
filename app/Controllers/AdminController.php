<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class AdminController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        return view('partials/login_view');
    }

    public function authenticate()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $department = $this->request->getPost('department');

        $user = $this->userModel->where('Username', $username)
                                ->where('Department', $department)
                                ->first();

        if ($user && password_verify($password, $user['Password'])) {
            $session->set([
                'id' => $user['id'],
                'username' => $user['Username'],
                'department' => $user['Department'],
                'isLoggedIn' => true
            ]);

            return redirect()->to('/admin/dashboard');
        } else {
            $session->setFlashdata('error', 'Invalid username, password, or department');
            return redirect()->to('/admin/login');
        }
    }

    public function dashboard()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $department = $session->get('department');
        switch (strtolower($department)) {
            case 'admin':
                return view('admin/dashboard');
            case 'amr':
                return redirect()->to('/amr/dashboard');
            case 'supervisor':
                return redirect()->to('/supervisor/dashboard');
            case 'cataloguer':
                return redirect()->to('/cataloguer/dashboard');
            case 'registrar':
                return redirect()->to('/registrar/dashboard');
            default:
                return redirect()->to('/home');
        }
    }

    public function users()
    {
        $data['users'] = $this->userModel->getUsers();
        return view('admin/users', $data);
    }

    public function addUser()
    {
        return view('admin/add_user');
    }

    public function storeUser()
    {
        $data = [
            'Username' => $this->request->getPost('username'),
            'Password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'Department' => $this->request->getPost('department'),
            'role' => $this->request->getPost('role')
        ];

        $this->userModel->insert($data);
        return redirect()->to('/admin/users');
    }

    public function editUser($id)
    {
        $data['user'] = $this->userModel->find($id);
        return view('admin/edit_user', $data);
    }

    public function updateUser($id)
    {
        $data = [
            'Username' => $this->request->getPost('username'),
            'Department' => $this->request->getPost('department'),
            'role' => $this->request->getPost('role')
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['Password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);
        return redirect()->to('/admin/users');
    }

    public function deleteUser($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/admin/users');
    }


    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('/admin/login');
    }
 
}
?>