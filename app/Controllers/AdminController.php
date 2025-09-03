<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends Controller
{
    public function login()
    {
        return view('partials/login_view');
    }

    public function authenticate()
    {
        $session = session();
        // Connect to the database
        $db = \Config\Database::connect();
        $builder = $db->table('users');

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $department = $this->request->getPost('department');

        $builder->where('Username', $username);
        $builder->where('Password', md5($password));
        $builder->where('Department', $department);

        $query = $builder->get();
        $user = $query->getRow();

        if ($user) {
            $session->set([
                'id'=> $user->id,
                'username' => $username,
                'department' => $department,
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
        }else{
            print_r($_SESSION);
            $department = $_SESSION['department'];
            switch(strtolower($department)){
                case 'admin':
                    return redirect()->to('/admin/dashboard');
                    break;
                case 'amr':
                    return redirect()->to('/amr/dashboard');
                    break;
                case 'supervisor':
                    return redirect()->to('/supervisor/dashboard');
                    break;
                case 'cataloguer':
                    return redirect()->to('/cataloguer/dashboard');
                    break;
                case 'registrar':
                    return redirect()->to('/registrar/dashboard');
                    break;
                default:
                    return "<script>location.href('http://localhost/amar/index.php')</script>";
            }
        }
    }

    public function home()
    {
        return view('partials/home_view');
    }

    public function amrView()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }
        return view('partials/AMRMenu_view');
    }


    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('/admin/login');
    }
 
}
?>