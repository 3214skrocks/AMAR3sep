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
            $data['cataloguers'] = $userModel->getCataloguers();
            return view('partials/manuscript_form', $data);
        }
    }

    public function rareBooks()
    {
        if (!$this->isloggedin()) {
            return redirect()->to('/admin/login');
        } else {
            $userModel = new UserModel();
            $data['cataloguers'] = $userModel->getCataloguers();
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
            $data['cataloguers'] = $userModel->getCataloguers();
            return view('partials/catalogues_form', $data);
        }
    }

    public function periodicals()
    {
        if (!$this->isloggedin()) {
            return redirect()->to('/admin/login');
        } else {
            $userModel = new UserModel();
            $data['cataloguers'] = $userModel->getCataloguers();
            return view('partials/periodicals_form', $data);
        }
    }

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

    public function edit_manuscript($id) { return $this->_edit_document($id, 'ManuscriptModel', 'edit_manuscript_form', 'manuscript'); }
    public function update_manuscript($id) { return $this->_update_document($id, 'ManuscriptModel', 'edit_manuscript'); }
    public function edit_rarebook($id) { return $this->_edit_document($id, 'RareBookModel', 'edit_rarebook_form', 'rarebook'); }
    public function update_rarebook($id) { return $this->_update_document($id, 'RareBookModel', 'edit_rarebook'); }
    public function edit_catalogue($id) { return $this->_edit_document($id, 'CatalogueModel', 'edit_catalogue_form', 'catalogue'); }
    public function update_catalogue($id) { return $this->_update_document($id, 'CatalogueModel', 'edit_catalogue'); }
    public function edit_periodical($id) { return $this->_edit_document($id, 'PeriodicalModel', 'edit_periodical_form', 'periodical'); }
    public function update_periodical($id) { return $this->_update_document($id, 'PeriodicalModel', 'edit_periodical'); }

    private function _edit_document($id, $modelName, $viewName, $dataKey)
    {
        if (!$this->isloggedin()) {
            return redirect()->to('/admin/login');
        }

        $model = new ("\\App\\Models\\" . $modelName)();
        $userModel = new UserModel();

        $data[$dataKey] = $model->find($id);
        $data['cataloguers'] = $userModel->getCataloguers();

        return view('partials/' . $viewName, $data);
    }

    private function _update_document($id, $modelName, $redirectRoute)
    {
        if (!$this->isloggedin()) {
            return redirect()->to('/admin/login');
        }

        $model = new ("\\App\\Models\\" . $modelName)();
        $request = service('request');

        $data = [
            'cataloguer_id' => $request->getPost('cataloguer_id'),
            'status' => 'Pending',
            'remark_by_cataloguer' => null,
            'remark_by_supervisor' => null,
            'rejected_by' => null,
            'cataloguer_rejected_at' => null
        ];

        if ($modelName == 'PeriodicalModel') {
            $data['per_title'] = $request->getPost('per_title');
            $data['publisher'] = $request->getPost('publisher');
        } else {
            $data['title_phonetic'] = $request->getPost('title_phonetic');
            $data['author_phonetic'] = $request->getPost('author_phonetic');
        }

        $file = $request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newFileName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/assets/uploads', $newFileName);
            $data['file_path'] = $newFileName;
        }

        if ($model->update($id, $data)) {
            session()->setFlashdata('success', 'Data updated successfully');
            return redirect()->to('/amr/menu');
        } else {
            session()->setFlashdata('error', 'Failed to update data');
            return redirect()->to('/amr/' . $redirectRoute . '/' . $id);
        }
    }
    

}