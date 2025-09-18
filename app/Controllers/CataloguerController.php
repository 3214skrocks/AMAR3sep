<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ManuscriptModel;
use App\Models\RareBookModel;
use App\Models\CatalogueModel;
use App\Models\PeriodicalModel;

class CataloguerController extends Controller
{
    public function getalldata()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $supervisorId = $session->get('supervisorId'); // Ensure this is set during login

        $data = [
            'data_manuscript' => $this->get_manuscript_data($supervisorId),
            'data_rarebook'   => $this->get_rarebook_data($supervisorId),
            'data_catalogue'  => $this->get_catalogue_data($supervisorId),
            'data_periodical' => $this->get_periodical_data($supervisorId),
        ];

        return view('/partials/CataloguerView', $data);
    }

    private function get_manuscript_data($supervisorId)
    {
        $model = new ManuscriptModel();
        return $model->fetchApprovedBySupervisor($supervisorId);
    }

    private function get_rarebook_data($supervisorId)
    {
        $model = new RareBookModel();
        return $model->fetchApprovedBySupervisor($supervisorId);
    }

    private function get_periodical_data($supervisorId)
    {
        $model = new PeriodicalModel();
        return $model->fetchApprovedBySupervisor($supervisorId);
    }

    private function get_catalogue_data($supervisorId)
    {
        $model = new CatalogueModel();
        return $model->fetchApprovedBySupervisor($supervisorId);
    }

    public function approve($id, $type)
    {
        $session = session();
        $cataloguerId = $session->get('cataloguerId'); // Get the cataloguer's ID from the session

        try {
            $model = $this->getModelByType($type);
            if ($model->approveByCataloguer($id, $cataloguerId)) {
                return redirect()->to('/cataloguer')->with('success', 'File approved successfully.');
            }
        } catch (\Exception $e) {
            return redirect()->to('/cataloguer')->with('error', $e->getMessage());
        }

        return redirect()->to('/cataloguer')->with('error', 'Failed to approve the file.');
    }

    public function reject($id, $type)
    {
        $session = session();
        $cataloguerId = $session->get('cataloguerId'); // Get the cataloguer's ID from the session

        try {
            $model = $this->getModelByType($type);
            if ($model->rejectByCataloguer($id, $cataloguerId)) {
                return redirect()->to('/cataloguer')->with('success', 'File rejected successfully.');
            }
        } catch (\Exception $e) {
            return redirect()->to('/cataloguer')->with('error', $e->getMessage());
        }

        return redirect()->to('/cataloguer')->with('error', 'Failed to reject the file.');
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