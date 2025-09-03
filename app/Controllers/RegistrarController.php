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

        $data['data_manuscript'] = $m_model->fetchApprovedByCataloguer();
        $data['data_rarebook'] = $r_model->fetchApprovedByCataloguer();
        $data['data_catalogue'] = $c_model->fetchApprovedByCataloguer();
        $data['data_periodical'] = $p_model->fetchApprovedByCataloguer();
//         echo '<pre>';
// print_r($data);
        return view('partials/RegistrarView', $data);
    }

    public function view_pdf($id, $type)
    {
        $model = new RegistrarModel();
        $model->setTableByType($type);
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
        $model = new RegistrarModel();
        $model->setTableByType($type);
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
}