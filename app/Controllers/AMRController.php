<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ManuscriptModel;
use App\Models\RareBookModel;
use App\Models\CatalogueModel;
use App\Models\PeriodicalModel;
use App\Models\UserModel;

class AMRController extends Controller
{
    public function isloggedin()
    {
        $session = session();
        return $session->get('isLoggedIn');
    }

    public function menu()
    {
        if (!$this->isloggedin()) {
            return redirect()->to('/admin/login');
        } else {
            return view('partials/AMRMenu_view');
        }
    }

    public function manuscript()
    {
        if (!$this->isloggedin()) {
            return redirect()->to('/admin/login');
        } else {
            $userModel = new UserModel();
            $data['cataloguers'] = $userModel->getUsersByDepartment('cataloguer');
            return view('partials/manuscript_form', $data);
        }
    }

    public function rareBooks()
    {
        if (!$this->isloggedin()) {
            return redirect()->to('/admin/login');
        } else {
            $userModel = new UserModel();
            $data['cataloguers'] = $userModel->getUsersByDepartment('cataloguer');
            return view('partials/rare_books_form', $data);
        }
    }

    public function catalogues()
    {
        helper('upload_url');
        if (!$this->isloggedin()) {
            return redirect()->to('/admin/login');
        } else {
            $userModel = new UserModel();
            $data['cataloguers'] = $userModel->getUsersByDepartment('cataloguer');
            return view('partials/catalogues_form', $data);
        }
    }

    public function periodicals()
    {
        if (!$this->isloggedin()) {
            return redirect()->to('/admin/login');
        } else {
            $userModel = new UserModel();
            $data['cataloguers'] = $userModel->getUsersByDepartment('cataloguer');
            return view('partials/periodicals_form', $data);
        }
    }

    public function submitManuscript()
    {
        $model = new ManuscriptModel();
        $request = service('request');

        if ($request->getMethod() === 'post' && $this->validate(['title_phonetic' => 'required', 'author_phonetic' => 'required', 'cataloguer_id' => 'required'])) {
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

    public function submitRareBooks()
    {
        $model = new RareBookModel();
        $request = service('request');

        if ($request->getMethod() === 'post' && $this->validate(['title_phonetic' => 'required', 'author_phonetic' => 'required', 'cataloguer_id' => 'required'])) {
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

    public function submitCatalogues()
    { 
        $model = new CatalogueModel();
        $request = service('request');

        if ($request->getMethod() === 'post' && $this->validate(['title_phonetic' => 'required', 'author_phonetic' => 'required', 'cataloguer_id' => 'required'])) {
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

    public function submitPeriodicals()
    {
        $model = new PeriodicalModel();
        $request = service('request');

        if ($request->getMethod() === 'post' && $this->validate(['per_title' => 'required', 'publisher' => 'required', 'cataloguer_id' => 'required'])) {
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

    public function viewpdf($filename)
    {
        if (!$this->isloggedin()) {
            return redirect()->to('/admin/login');
        } else {
            return redirect()->to(base_url() . "/public/assets/uploads/" . $filename);
        }
    }

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