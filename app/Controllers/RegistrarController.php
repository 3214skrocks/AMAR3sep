<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\RegistrarModel;
use App\Models\ManuscriptModel;
use App\Models\RareBookModel;
use App\Models\CatalogueModel;
use App\Models\PeriodicalModel;

/**
 * Class RegistrarController
 *
 * This controller is for the "Registrar" user role.
 * It provides functionality to view and download documents that have been approved by the cataloguer.
 */
class RegistrarController extends Controller
{
    /**
     * Displays the main view for the registrar, listing all documents approved by the cataloguer.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|string The registrar's view or a redirect to the login page.
     */
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

        return view('partials/RegistrarView', $data);
    }

    /**
     * Displays a PDF file in the browser.
     *
     * @param int    $id   The ID of the document.
     * @param string $type The type of the document.
     * @return \CodeIgniter\HTTP\Response|\CodeIgniter\HTTP\RedirectResponse The PDF response or a redirect with an error.
     */
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

    /**
     * Downloads a file associated with a document.
     *
     * @param int    $id   The ID of the document.
     * @param string $type The type of the document.
     * @return \CodeIgniter\HTTP\DownloadResponse|\CodeIgniter\HTTP\RedirectResponse The download response or a redirect with an error.
     */
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