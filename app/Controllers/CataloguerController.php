<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ManuscriptModel;
use App\Models\RareBookModel;
use App\Models\CatalogueModel;
use App\Models\PeriodicalModel;

/**
 * Class CataloguerController
 *
 * This controller manages the workflow for the "Cataloguer" user role.
 * It allows cataloguers to view, approve, reject, and comment on various types of documents.
 */
class CataloguerController extends Controller
{
    /**
     * Fetches all data approved by a supervisor and displays it to the cataloguer.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|string The cataloguer view or a redirect to the login page.
     */
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

    /**
     * Fetches manuscript data approved by a specific supervisor.
     *
     * @param int $supervisorId The ID of the supervisor.
     * @return array An array of manuscript data.
     */
    private function get_manuscript_data($supervisorId)
    {
        $model = new ManuscriptModel();
        return $model->fetchApprovedBySupervisor($supervisorId);
    }

    /**
     * Fetches rare book data approved by a specific supervisor.
     *
     * @param int $supervisorId The ID of the supervisor.
     * @return array An array of rare book data.
     */
    private function get_rarebook_data($supervisorId)
    {
        $model = new RareBookModel();
        return $model->fetchApprovedBySupervisor($supervisorId);
    }

    /**
     * Fetches periodical data approved by a specific supervisor.
     *
     * @param int $supervisorId The ID of the supervisor.
     * @return array An array of periodical data.
     */
    private function get_periodical_data($supervisorId)
    {
        $model = new PeriodicalModel();
        return $model->fetchApprovedBySupervisor($supervisorId);
    }

    /**
     * Fetches catalogue data approved by a specific supervisor.
     *
     * @param int $supervisorId The ID of the supervisor.
     * @return array An array of catalogue data.
     */
    private function get_catalogue_data($supervisorId)
    {
        $model = new CatalogueModel();
        return $model->fetchApprovedBySupervisor($supervisorId);
    }

    /**
     * Approves a document by its ID and type.
     *
     * @param int    $id   The ID of the document.
     * @param string $type The type of the document (e.g., 'manuscript', 'rarebook').
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects with a success or error message.
     */
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

    /**
     * Rejects a document by its ID and type.
     *
     * @param int    $id   The ID of the document.
     * @param string $type The type of the document.
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects with a success or error message.
     */
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

    /**
     * Allows viewing a PDF file associated with a document.
     *
     * @param int    $id   The ID of the document.
     * @param string $type The type of the document.
     * @return \CodeIgniter\HTTP\DownloadResponse|\CodeIgniter\HTTP\RedirectResponse A download response for the PDF or a redirect with an error.
     */
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

    /**
     * Saves a remark for a specific document.
     *
     * @param int    $id   The ID of the document.
     * @param string $type The type of the document.
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects with a success or error message.
     */
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

    /**
     * Returns the appropriate model based on the document type.
     *
     * @param string $type The type of the document.
     * @return \CodeIgniter\Model An instance of the corresponding model.
     * @throws \Exception If the type is invalid.
     */
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