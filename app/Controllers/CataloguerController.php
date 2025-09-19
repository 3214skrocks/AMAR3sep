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

        $cataloguerId = $session->get('id');

        $data = [
            'data_manuscript' => $this->get_manuscript_data($cataloguerId),
            'data_rarebook'   => $this->get_rarebook_data($cataloguerId),
            'data_catalogue'  => $this->get_catalogue_data($cataloguerId),
            'data_periodical' => $this->get_periodical_data($cataloguerId),
        ];

        return view('partials/cataloguerdashboardview', $data);
    }

    private function get_manuscript_data($cataloguerId)
    {
        $model = new ManuscriptModel();
        return $model->where('cataloguer_id', $cataloguerId)->where('status', 'Pending')->findAll();
    }

    private function get_rarebook_data($cataloguerId)
    {
        $model = new RareBookModel();
        return $model->where('cataloguer_id', $cataloguerId)->where('status', 'Pending')->findAll();
    }

    private function get_periodical_data($cataloguerId)
    {
        $model = new PeriodicalModel();
        return $model->where('cataloguer_id', $cataloguerId)->where('status', 'Pending')->findAll();
    }

    private function get_catalogue_data($cataloguerId)
    {
        $model = new CatalogueModel();
        return $model->where('cataloguer_id', $cataloguerId)->where('status', 'Pending')->findAll();
    }

    public function approve($id, $type)
    {
        $session = session();
        $cataloguerId = $session->get('id'); // Get the cataloguer's ID from the session
        $remark = $this->request->getPost('remark');

        try {
            $model = $this->getModelByType($type);
            if ($model->approveByCataloguer($id, $cataloguerId, $remark)) {
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
        $remark = $this->request->getPost('remark');

        try {
            $model = $this->getModelByType($type);
            if ($model->rejectByCataloguer($id, $cataloguerId, $remark)) {
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