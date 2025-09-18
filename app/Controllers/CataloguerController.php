<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ManuscriptModel;
use App\Models\RareBookModel;
use App\Models\CatalogueModel;
use App\Models\PeriodicalModel;

class CataloguerController extends Controller
{
    public function dashboard()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $cataloguerId = $session->get('id');

        $manuscriptModel = new ManuscriptModel();
        $rareBookModel = new RareBookModel();
        $catalogueModel = new CatalogueModel();
        $periodicalModel = new PeriodicalModel();

        $data['manuscripts'] = $manuscriptModel->getAssignedManuscripts($cataloguerId);
        $data['rare_books'] = $rareBookModel->getAssignedRareBooks($cataloguerId);
        $data['catalogues'] = $catalogueModel->getAssignedCatalogues($cataloguerId);
        $data['periodicals'] = $periodicalModel->getAssignedPeriodicals($cataloguerId);

        return view('partials/cataloguerdashboardview', $data);
    }


    public function approve($id, $type)
    {
        $session = session();
        $cataloguerId = $session->get('id'); // Get the cataloguer's ID from the session

        try {
            $model = $this->getModelByType($type);
            if ($model->approveByCataloguer($id, $cataloguerId)) {
                return redirect()->to('/cataloguer/dashboard')->with('success', 'File approved successfully.');
            }
        } catch (\Exception $e) {
            return redirect()->to('/cataloguer/dashboard')->with('error', $e->getMessage());
        }

        return redirect()->to('/cataloguer/dashboard')->with('error', 'Failed to approve the file.');
    }

    public function reject($id, $type)
    {
        $session = session();
        $cataloguerId = $session->get('id'); // Get the cataloguer's ID from the session

        try {
            $model = $this->getModelByType($type);
            if ($model->rejectByCataloguer($id, $cataloguerId)) {
                return redirect()->to('/cataloguer/dashboard')->with('success', 'File rejected successfully.');
            }
        } catch (\Exception $e) {
            return redirect()->to('/cataloguer/dashboard')->with('error', $e->getMessage());
        }

        return redirect()->to('/cataloguer/dashboard')->with('error', 'Failed to reject the file.');
    }

    public function view_pdf($id, $type)
    {
        try {
            $model = $this->getModelByType($type);
            $record = $model->find($id);

            if ($record && isset($record['file_path'])) {
                $filePath = ROOTPATH . 'public/assets/uploads/' . $record['file_path'];

                if (file_exists($filePath)) {
                    return $this->response->download($filePath, null)->setHeader('Content-Type', 'application/pdf');
                }

                return redirect()->to('/cataloguer')->with('error', 'File not found.');
            }

            return redirect()->to('/cataloguer')->with('error', 'Invalid record.');
        } catch (\Exception $e) {
            return redirect()->to('/cataloguer')->with('error', $e->getMessage());
        }
    }

    public function saveRemark($id, $type)
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $remark = $this->request->getPost('remark');
        if (empty($remark)) {
            return redirect()->back()->with('error', 'Remark is required.');
        }

        try {
            $model = $this->getModelByType($type);

            // Update the remark in the database
            $updateData = ['remark' => $remark];
            if ($model->update($id, $updateData)) {
                return redirect()->to('/cataloguer')->with('success', 'Remark saved successfully.');
            }
        } catch (\Exception $e) {
            return redirect()->to('/cataloguer')->with('error', $e->getMessage());
        }

        return redirect()->to('/cataloguer')->with('error', 'Failed to save the remark.');
    }

    private function getModelByType($type)
    {
        switch (strtolower($type)) {
            case 'manuscript':
                return new ManuscriptModel();
            case 'rarebook':
                return new RareBookModel();
            case 'catalogue':
                return new CatalogueModel();
            case 'periodical':
                return new PeriodicalModel();
            default:
                throw new \Exception('Invalid type specified.');
        }
    }
}