<?php

namespace App\Controllers;

use CodeIgniter\Controller;

/**
 * Class Dashboard
 *
 * This controller appears to be a legacy file from a previous version of CodeIgniter.
 * It is likely not in use and should be considered for removal.
 * The dashboard logic is handled by AdminController.
 *
 * @deprecated This controller is not compatible with CodeIgniter 4 and is likely unused.
 */
class Dashboard extends Controller
{
    /**
     * Loads the admin dashboard view.
     * Note: This uses the old CodeIgniter 3 view loading syntax.
     *
     * @return string The admin dashboard view.
     */
    public function admin()
    {
        return view('admin_dashboard_view');
    }

    /**
     * Loads the supervisor dashboard view.
     * Note: This uses the old CodeIgniter 3 view loading syntax.
     *
     * @return string The supervisor dashboard view.
     */
    public function supervisor()
    {
        return view('supervisor_dashboard_view');
    }

    /**
     * Loads the AMR dashboard view.
     * Note: This uses the old CodeIgniter 3 view loading syntax.
     *
     * @return string The AMR dashboard view.
     */
    public function amr()
    {
        return view('amr_dashboard_view');
    }

    /**
     * Loads the cataloguer dashboard view.
     * Note: This uses the old CodeIgniter 3 view loading syntax.
     *
     * @return string The cataloguer dashboard view.
     */
    public function cataloguer()
    {
        return view('cataloguer_dashboard_view');
    }
}
