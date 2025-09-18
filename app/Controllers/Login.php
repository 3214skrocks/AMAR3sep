<?php

namespace App\Controllers;

use App\Models\User_model;
use CodeIgniter\Controller;

/**
 * Class Login
 *
 * This controller appears to be a legacy file from a previous version of CodeIgniter.
 * It is likely not in use and should be considered for removal.
 * The login logic is handled by AdminController.
 *
 * @deprecated This controller is not compatible with CodeIgniter 4 and is likely unused.
 */
class Login extends Controller
{
    /**
     * Displays the login view.
     *
     * @return string The login view.
     */
    public function index()
    {
        helper('visitor');
        return view('login_view');
    }

    /**
     * Handles the login form submission.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|string A redirect to the dashboard or the login view with an error.
     */
    public function submit()
    {
        $model = new User_model();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $department = $this->request->getPost('department');

        $user = $model->get_user($username, $password, $department);

        if ($user) {
            $session = session();
            $session->set('username', $username);
            $session->set('password', $password);
            $session->set('department', $user->Department);
            return $this->redirect_to_dashboard($department);
        } else {
            $data['error'] = "Invalid username, password, or department";
            return view('login_view', $data);
        }
    }

    /**
     * Redirects the user to the appropriate dashboard based on their department.
     *
     * @param string $department The user's department.
     * @return \CodeIgniter\HTTP\RedirectResponse A redirect response.
     */
    private function redirect_to_dashboard($department)
    {
        switch ($department) {
            case 'Admin':
                return redirect()->to('dashboard/admin');
            case 'Supervisor':
                return redirect()->to('dashboard/supervisor');
            case 'AMR':
                return redirect()->to('dashboard/amr');
            case 'Cataloguer':
                return redirect()->to('dashboard/cataloguer');
            case 'Registerar':
                return redirect()->to('dashboard/registerar');
            default:
                return redirect()->to('dashboard/search');
        }
    }
}
