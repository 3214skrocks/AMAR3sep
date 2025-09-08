<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ManuscriptModel;
use App\Models\RareBookModel;
use App\Models\CatalogueModel;
use App\Models\PeriodicalModel;

/**
 * Class AMRController
 *
 * This controller handles functionalities related to Accessioning and Metadata Recording (AMR).
 * It manages the submission and viewing of manuscripts, rare books, catalogues, and periodicals.
 * All methods in this controller require the user to be logged in.
 */
class AMRController extends Controller
{
    /**
     * Checks if the user is logged in.
     *
     * @return bool True if the user is logged in, false otherwise.
     */
    public function isloggedin()
    {
        $session = session();
        return (bool) $session->get('isLoggedIn');
    }

    /**
     * Displays the AMR menu view if the user is logged in.
     * Otherwise, redirects to the login page.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|string The AMR menu view or a redirect response.
     */
    public function menu()
    {
        if (!$this->isloggedin()) {
            return redirect()->to('/admin/login');
        } else {
            return view('partials/AMRMenu_view');
        }
    }

    /**
     * Displays the manuscript submission form.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|string The manuscript form view or a redirect response.
     */
    public function manuscript()
    {
        if (!$this->isloggedin()) {
            return redirect()->to('/admin/login');
        } else {
            return view('partials/manuscript_form');
        }
    }

    /**
     * Displays the rare books submission form.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|string The rare books form view or a redirect response.
     */
    public function rareBooks()
    {
        if (!$this->isloggedin()) {
            return redirect()->to('/admin/login');
        } else {
            return view('partials/rare_books_form');
        }
    }

    /**
     * Displays the catalogues submission form.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|string The catalogues form view or a redirect response.
     */
    public function catalogues()
    {
        helper('upload_url');
        if (!$this->isloggedin()) {
            return redirect()->to('/admin/login');
        } else {
            return view('partials/catalogues_form');
        }
    }

    /**
     * Displays the periodicals submission form.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|string The periodicals form view or a redirect response.
     */
    public function periodicals()
    {
        if (!$this->isloggedin()) {
            return redirect()->to('/admin/login');
        } else {
            return view('partials/periodicals_form');
        }
    }

    /**
     * Handles the submission of the manuscript form.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects back to the manuscript form with a success or error message.
     */
    public function submitManuscript()
    {
        $model = new ManuscriptModel();
        $request = service('request');

        if ($request->getMethod() === 'post' && $this->validate(['title_phonetic' => 'required', 'author_phonetic' => 'required'])) {
            $success = $model->data_insert($request);
            if ($success) {
                session()->setFlashdata('success', 'Manuscript data inserted successfully');
                return redirect()->to('/amr/manuscript')->with('success', 'Manuscript data inserted successfully');
            } else {
                return redirect()->to('/amr/manuscript')->with('error', 'Failed to insert manuscript data');
            }
        } else {
            return redirect()->to('/amr/manuscript')->with('error', 'Form Validation failed.');
        }
    }

    /**
     * Handles the submission of the rare books form.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects back to the rare books form with a success or error message.
     */
    public function submitRareBooks()
    {
        $model = new RareBookModel();
        $request = service('request');

        if ($request->getMethod() === 'post' && $this->validate(['title_phonetic' => 'required', 'author_phonetic' => 'required'])) {
            $success = $model->data_insert($request);
            if ($success) {
                session()->setFlashdata('success', 'Rarebook data inserted successfully');
                return redirect()->to('/amr/rareBooks')->with('success', 'Rarebook data inserted successfully');
            } else {
                return redirect()->to('/amr/rareBooks')->with('error', 'Failed to insert rarebooks data');
            }
        } else {
            return redirect()->to('/amr/rareBooks')->with('error', 'Form Validation failed.');
        }
    }

    /**
     * Handles the submission of the catalogues form.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects back to the catalogues form with a success or error message.
     */
    public function submitCatalogues()
    { 
        $model = new CatalogueModel();
        $request = service('request');

        if ($request->getMethod() === 'post' && $this->validate(['title_phonetic' => 'required', 'author_phonetic' => 'required'])) {
            $success = $model->data_insert($request);
            if ($success) {
                session()->setFlashdata('success', 'Catalogues data inserted successfully');
                return redirect()->to('/amr/catalogues')->with('success', 'Catalogues data inserted successfully');
            } else {
                return redirect()->to('/amr/catalogues')->with('error', 'Failed to insert catalogues data');
            }
        } else {
            return redirect()->to('/amr/catalogues')->with('error', 'Form Validation failed.');
        }
    }

    /**
     * Handles the submission of the periodicals form.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects back to the periodicals form with a success or error message.
     */
    public function submitPeriodicals()
    {
        $model = new PeriodicalModel();
        $request = service('request');

        if ($request->getMethod() === 'post' && $this->validate(['per_title' => 'required', 'publisher' => 'required'])) {
            $success = $model->data_insert($request);
            if ($success) {
                session()->setFlashdata('success', 'Periodicals data inserted successfully');
                return redirect()->to('/amr/periodicals')->with('success', 'Periodicals data inserted successfully');
            } else {
                return redirect()->to('/amr/periodicals')->with('error', 'Failed to insert periodicals data');
            }
        } else {
            return redirect()->to('/amr/periodicals')->with('error', 'Form Validation failed.');
        }
    }

    /**
     * Redirects to a PDF file in the uploads directory.
     *
     * @param string $filename The name of the PDF file.
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects to the PDF file URL.
     */
    public function viewpdf($filename)
    {
        if (!$this->isloggedin()) {
            return redirect()->to('/admin/login');
        } else {
            return redirect()->to(base_url() . "/public/assets/uploads/" . $filename);
        }
    }

    /**
     * Fetches and displays data based on its status (approved, rejected, etc.).
     *
     * @param int $status The status of the data to fetch (1: approved, 2: rejected, 3: rejected by cataloguer).
     * @return \CodeIgniter\HTTP\RedirectResponse|string The view with the fetched data or a redirect response.
     */
    public function statuswisedata($status)
    {
        if (!$this->isloggedin()) {
            return redirect()->to('/admin/login');
        }
    
        $session = session();
        $userId = $session->get('id');
    
        $manuscript = new ManuscriptModel();
        $rarebook = new RareBookModel();
        $catalogue = new CatalogueModel();
        $periodical = new PeriodicalModel();
    
        $data = [];
    
        switch ($status) {
            case 1:
                // Fetch approved data
                $data['data_manuscript'] = $manuscript->amrFetchApproved($userId);
                $data['data_rarebook'] = $rarebook->amrFetchApproved($userId);
                $data['data_catalogue'] = $catalogue->amrFetchApproved($userId);
                $data['data_periodical'] = $periodical->amrFetchApproved($userId);
                break;
    
            case 2:
                // Fetch rejected data
                $data['data_manuscript'] = $manuscript->amrFetchRejected($userId);
                $data['data_rarebook'] = $rarebook->amrFetchRejected($userId);
                $data['data_catalogue'] = $catalogue->amrFetchRejected($userId);
                $data['data_periodical'] = $periodical->amrFetchRejected($userId);
                break;
    
            case 3:
                // Fetch data rejected by cataloguer
                $data['data_manuscript'] = $manuscript->amrFetchRejectedByCataloguer($userId);
                $data['data_rarebook'] = $rarebook->amrFetchRejectedByCataloguer($userId);
                $data['data_catalogue'] = $catalogue->amrFetchRejectedByCataloguer($userId);
                $data['data_periodical'] = $periodical->amrFetchRejectedByCataloguer($userId);
                break;
    
            default:
                echo "Sorry, Invalid status.";
                return;
        }
    
        return view('partials/amrdataview', ['data' => $data]);
    }
    

}