<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\RegistrarModel;
use App\Models\ManuscriptModel;
use App\Models\RareBookModel;
use App\Models\CatalogueModel;
use App\Models\PeriodicalModel;

class RegistrarController extends Controller
{
    public function index()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $m_model = new \App\Models\ViewManuscriptModel();
        $r_model = new \App\Models\ViewRarebookModel();
        $c_model = new \App\Models\ViewCatalogueModel();
        $p_model = new \App\Models\ViewPeriodicalModel();

        $data['data_manuscript'] = $m_model->findAll();
        $data['data_rarebook'] = $r_model->findAll();
        $data['data_catalogue'] = $c_model->findAll();
        $data['data_periodical'] = $p_model->findAll();

        return view('partials/RegistrarView', $data);
    }

    public function view_pdf($id, $type)
    {
        $model = $this->getModelByType($type);
        $record = $model->find($id);

        if ($record && isset($record['file_path'])) {
            $filePath = ROOTPATH . 'public/assets/uploads/' . $record['file_path'];

            if (file_exists($filePath)) {
                return $this->response->setHeader('Content-Type', 'application/pdf')
                                      ->setHeader('Content-Disposition', 'inline; filename="' . basename($filePath) . '"')
                                      ->setBody(file_get_contents($filePath));
            } else {
                return redirect()->to('/registrar/dashboard')->with('error', 'File not found.');
            }
        } else {
            return redirect()->to('/registrar/dashboard')->with('error', 'Invalid record.');
        }
    }

    public function download($id, $type)
    {
        $model = $this->getModelByType($type);
        $record = $model->find($id);

        if ($record && isset($record['file_path'])) {
            $filePath = ROOTPATH . 'public/assets/uploads/' . $record['file_path'];

            if (file_exists($filePath)) {
                return $this->response->download($filePath, null);
            } else {
                return redirect()->to('/registrar/dashboard')->with('error', 'File not found.');
            }
        } else {
            return redirect()->to('/registrar/dashboard')->with('error', 'Invalid record.');
        }
    }

    private function getModelByType($type)
    {
        switch (strtolower($type)) {
            case 'manuscript':
                return new \App\Models\ViewManuscriptModel();
            case 'rarebook':
                return new \App\Models\ViewRarebookModel();
            case 'catalogue':
                return new \App\Models\ViewCatalogueModel();
            case 'periodical':
                return new \App\Models\ViewPeriodicalModel();
            default:
                return null;
        }
    }
}