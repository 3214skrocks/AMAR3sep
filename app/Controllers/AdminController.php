<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Class AdminController
 *
 * This controller handles admin-related functionalities such as login, authentication,
 * dashboard redirection, and logout.
 */
class AdminController extends Controller
{
    /**
     * Displays the login page.
     *
     * @return string The login view.
     */
    public function login()
    {
        return view('partials/login_view');
    }

    /**
     * Authenticates the user based on the submitted login form.
     *
     * It validates user credentials against the database and sets session data upon success.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects to the appropriate dashboard or back to the login page.
     */
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
                'id' => $user->id,
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

    /**
     * Redirects logged-in users to their respective dashboards based on their department.
     * If the user is not logged in, it redirects them to the login page.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|string A redirect response or a script for redirection.
     */
    public function dashboard()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $department = $session->get('department');
        switch (strtolower($department)) {
            case 'admin':
                return redirect()->to('/admin/dashboard');
            case 'amr':
                return redirect()->to('/amr/dashboard');
            case 'supervisor':
                return redirect()->to('/supervisor/dashboard');
            case 'cataloguer':
                return redirect()->to('/cataloguer/dashboard');
            case 'registrar':
                return redirect()->to('/registrar/dashboard');
            default:
                // Redirect to a default page if department is not matched
                return redirect()->to('/');
        }
    }

    /**
     * Displays the home page view.
     *
     * @return string The home page view.
     */
    public function home()
    {
        return view('partials/home_view');
    }

    /**
     * Displays the AMR (Accessioning and Metadata Recording) menu view.
     * If the user is not logged in, it redirects them to the login page.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|string The AMR menu view or a redirect response.
     */
    public function amrView()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }
        return view('partials/AMRMenu_view');
    }

    /**
     * Logs the user out by destroying the session.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects the user to the login page.
     */
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/admin/login');
    }
}
?>