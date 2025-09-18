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

        $m_model = new ManuscriptModel();
        $r_model = new RareBookModel();
        $c_model = new CatalogueModel();
        $p_model = new PeriodicalModel();

        $data['data_manuscript'] = $m_model->getManuscriptsForRegistrar();
        $data['data_rarebook'] = $r_model->getRareBooksForRegistrar();
        $data['data_catalogue'] = $c_model->getCataloguesForRegistrar();
        $data['data_periodical'] = $p_model->getPeriodicalsForRegistrar();

        return view('partials/RegistrarView', $data);
    }

    public function view_pdf($id, $type)
    {
        try {
            $model = $this->getModelByType($type);
            $record = $model->find($id);

            if ($record && isset($record['file_path'])) {
                $filePath = ROOTPATH . 'public/assets/uploads/' . $record['file_path'];

                if (file_exists($filePath)) {
                    return $this->response->setHeader('Content-Type', 'application/pdf')
                                          ->setHeader('Content-Disposition', 'inline; filename="' . basename($filePath) . '"')
                                          ->setBody(file_get_contents($filePath));
                } else {
                    return redirect()->to('/registrar')->with('error', 'File not found.');
                }
            } else {
                return redirect()->to('/registrar')->with('error', 'Invalid record.');
            }
        } catch (\Exception $e) {
            return redirect()->to('/registrar')->with('error', $e->getMessage());
        }
    }

    public function download($id, $type)
    {
        try {
            $model = $this->getModelByType($type);
            $record = $model->find($id);

            if ($record && isset($record['file_path'])) {
                $filePath = ROOTPATH . 'public/assets/uploads/' . $record['file_path'];

                if (file_exists($filePath)) {
                    return $this->response->download($filePath, null);
                } else {
                    return redirect()->to('/registrar')->with('error', 'File not found.');
                }
            } else {
                return redirect()->to('/registrar')->with('error', 'Invalid record.');
            }
        } catch (\Exception $e) {
            return redirect()->to('/registrar')->with('error', $e->getMessage());
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