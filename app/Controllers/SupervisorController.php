<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ManuscriptModel;
use App\Models\RareBookModel;
use App\Models\CatalogueModel;
use App\Models\PeriodicalModel;
use App\Models\ViewManuscriptModel;
use App\Models\ViewRarebookModel;
use App\Models\ViewCatalogueModel;
use App\Models\ViewPeriodicalModel;

class SupervisorController extends Controller
{
    protected $manuscriptModel;
    protected $rareBookModel;
    protected $catalogueModel;
    protected $periodicalModel;
    protected $ViewManuscriptModel;
    protected $ViewRarebookModel;
    protected $ViewCatalogueModel;
    protected $ViewPeriodicalModel;
    protected $session;

    public function __construct()
    { 
        $this->manuscriptModel = new ManuscriptModel();
        $this->rareBookModel = new RareBookModel();
        $this->catalogueModel = new CatalogueModel();
        $this->periodicalModel = new PeriodicalModel();
        $this->ViewManuscriptModel = new ViewManuscriptModel();
        $this->ViewRarebookModel = new ViewRarebookModel();
        $this->ViewCatalogueModel = new ViewCatalogueModel();
        $this->ViewPeriodicalModel = new ViewPeriodicalModel();
        $this->session = session();
    }

    private function checkLogin()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }
    }

    public function getalldata()
    {
        $this->checkLogin();

        $data = [
            'data_manuscript' => $this->manuscriptModel->fetch_data(),
            'data_rarebook' => $this->rareBookModel->fetch_data(),
            'data_catalogue' => $this->catalogueModel->fetch_data(),
            'data_periodical' => $this->periodicalModel->fetch_data(),
        ];

        return view('/partials/SupervisorView', $data);
    }

    public function getCataloguerApprovedData()
    {
        $this->checkLogin();

        $data = [
            'data_manuscript' => $this->manuscriptModel->fetchApprovedByCataloguer(),
            'data_rarebook' => $this->rareBookModel->fetchApprovedByCataloguer(),
            'data_catalogue' => $this->catalogueModel->fetchApprovedByCataloguer(),
            'data_periodical' => $this->periodicalModel->fetchApprovedByCataloguer(),
        ];

        return view('/partials/SupervisorDashboardView', $data);
    }

    public function approved()
    {
        $this->checkLogin();

        $data = [
            'data_manuscript' => $this->manuscriptModel->where('status', 'approved')->findAll(),
            'data_rarebook' => $this->rareBookModel->where('status', 'approved')->findAll(),
            'data_catalogue' => $this->catalogueModel->where('status', 'approved')->findAll(),
            'data_periodical' => $this->periodicalModel->where('status', 'approved')->findAll(),
        ];

        return view('/partials/SupervisorDashboardView', $data);
    }

    public function pending()
    {
        $this->checkLogin();

        $data = [
            'data_manuscript' => $this->manuscriptModel->where('status', 'pending')->findAll(),
            'data_rarebook' => $this->rareBookModel->where('status', 'pending')->findAll(),
            'data_catalogue' => $this->catalogueModel->where('status', 'pending')->findAll(),
            'data_periodical' => $this->periodicalModel->where('status', 'pending')->findAll(),
        ];

        return view('/partials/SupervisorDashboardView', $data);
    }

    public function rejected()
    {
        $this->checkLogin();

        $data = [
            'data_manuscript' => $this->manuscriptModel->where('status', 'rejected')->findAll(),
            'data_rarebook' => $this->rareBookModel->where('status', 'rejected')->findAll(),
            'data_catalogue' => $this->catalogueModel->where('status', 'rejected')->findAll(),
            'data_periodical' => $this->periodicalModel->where('status', 'rejected')->findAll(),
        ];

        return view('/partials/SupervisorDashboardView', $data);
    }

    public function published()
    {
        $this->checkLogin();

        $data = [
            'data_manuscript' => $this->manuscriptModel->where('status', 'published')->findAll(),
            'data_rarebook' => $this->rareBookModel->where('status', 'published')->findAll(),
            'data_catalogue' => $this->catalogueModel->where('status', 'published')->findAll(),
            'data_periodical' => $this->periodicalModel->where('status', 'published')->findAll(),
        ];

        return view('/partials/SupervisorDashboardView', $data);
    }

    public function publish($id, $type)
    {
        $this->checkLogin();
    
        $model = $this->getModelByType($type);
        if (!$model) {
            $this->session->setFlashdata('error', 'Invalid file type.');
            return redirect()->to('/supervisor/dashboard/cataloguer_approved');
        }
    
        $get_model_data = $model->find($id);
        if (!$get_model_data) {
            $this->session->setFlashdata('error', "No data found for $type with ID $id.");
            return redirect()->to('/supervisor/dashboard/cataloguer_approved');
        }
    
        unset($get_model_data['id']);
    
        switch (strtolower($type)) {
            case 'manuscript':
                $MainModel = $this->ViewManuscriptModel;
                break;
            case 'rarebook':
                $MainModel = $this->ViewRarebookModel;
                break;
            case 'catalogue':
                $MainModel = $this->ViewCatalogueModel;
                break;
            case 'periodical':
                $MainModel = $this->ViewPeriodicalModel;
                break;
            default:
                $this->session->setFlashdata('error', 'Invalid file type.');
                return redirect()->to('/supervisor/dashboard/cataloguer_approved');
        }
    
        $inserted = $MainModel->insert($get_model_data);
        if ($inserted) {
            $model->update($id, ['status' => 'published']);
            $this->session->setFlashdata('success', "$type published successfully.");
        } else {
            $this->session->setFlashdata('error', "Failed to publish $type.");
        }
    
        return redirect()->to('/supervisor/dashboard/cataloguer_approved');
    }

    // public function publish($id, $type)
    // {
    //     // Validate input
    //     if (!is_numeric($id) || !ctype_alpha($type)) {
    //         return redirect()->back()->with('error', 'Invalid parameters.');
    //     }

    //     // Get the appropriate model based on type
    //     $model = $this->getModelByType($type);
    //     if (!$model) {
    //         return redirect()->back()->with('error', 'Invalid file type.');
    //     }

    //     // Fetch the record
    //     $record = $model->find($id);
    //     if (!$record) {
    //         return redirect()->back()->with('error', 'File not found.');
    //     }

    //     // Check if the file is cataloguer-approved before publishing
    //     if ($record['status'] !== 'cataloguer_approved') {
    //         return redirect()->back()->with('error', 'File is not cataloguer-approved.');
    //     }

    //     // Update the record status to 'published'
    //     $data = [
    //         'status' => 'published',
    //         'published_at' => date('Y-m-d H:i:s'), // Optional timestamp for publishing
    //     ];
    //     if ($model->update($id, $data)) {
    //         return redirect()->back()->with('success', 'File successfully published.');
    //     } else {
    //         return redirect()->back()->with('error', 'Failed to publish the file.');
    //     }
    // }

    public function handleAction()
{
    $this->checkLogin(); // Ensure the user is logged in

    if ($this->request->getMethod() === 'post') {
        $id = $this->request->getPost('id');
        $tableType = $this->request->getPost('table_type');
        $remark = $this->request->getPost('remark');
        // echo $remark;
        $action = $this->request->getPost('action'); // This will hold 'approve' or 'reject'

        // Select the correct model based on table type
        switch ($tableType) {
            case 'Manuscript':
                $model = $this->manuscriptModel;
                break;
            case 'Rare Book':
                $model = $this->rareBookModel;
                break;
            case 'Catalogue':
                $model = $this->catalogueModel;
                break;
            case 'Periodical':
                $model = $this->periodicalModel;
                break;
            default:
                session()->setFlashdata('error', 'Invalid table type!');
                return redirect()->back();
        }

        // Perform action based on the action type (approve/reject)
        switch ($action) {
            case 'approve':
                // Call the approve method for the selected model
                $this->approveItem($model, $id, $remark);
                break;
            case 'reject':
                // Call the reject method for the selected model
                $this->rejectItem($model, $id, $remark);
                break;
            default:
                session()->setFlashdata('error', 'Invalid action!');
                return redirect()->back();
        }

        return redirect()->to(base_url('supervisor/dashboard/cataloguer_approved'));
    }
}

private function approveItem($model, $id, $remark)
{
    // Logic to approve the item (e.g., update the database record)
    $model->update($id, ['status' => 'Approved', 'remark_by_supervisor' => $remark]);
    session()->setFlashdata('success', 'Item has been approved.');
}

private function rejectItem($model, $id, $remark)
{
    // Logic to reject the item (e.g., update the database record)
    $model->update($id, ['status' => 'rejected', 'remark_by_supervisor' => $remark]);
    session()->setFlashdata('success', 'Item has been rejected.');
}


    public function approveManuscript($id)
    {
        return $this->handleApprovalOrRejection($id, $this->manuscriptModel, 'approve', 'Manuscript');
    }

    public function rejectManuscript($id)
    {
        return $this->handleApprovalOrRejection($id, $this->manuscriptModel, 'reject', 'Manuscript');
    }

    public function approveRareBook($id)
    {
        return $this->handleApprovalOrRejection($id, $this->rareBookModel, 'approve', 'Rare book');
    }

    public function rejectRareBook($id)
    {
        return $this->handleApprovalOrRejection($id, $this->rareBookModel, 'reject', 'Rare book');
    }

    public function approvePeriodical($id)
    {
        return $this->handleApprovalOrRejection($id, $this->periodicalModel, 'approve', 'Periodical');
    }

    public function rejectPeriodical($id)
    {
        return $this->handleApprovalOrRejection($id, $this->periodicalModel, 'reject', 'Periodical');
    }  

    public function approveCatalogue($id)
    {
        return $this->handleApprovalOrRejection($id, $this->catalogueModel, 'approve', 'Catalogue');
    }

    public function rejectCatalogue($id)
    {
        return $this->handleApprovalOrRejection($id, $this->catalogueModel, 'reject', 'Catalogue');
    }

    // Utility method to get the model by file type
    private function getModelByType($type)
    {
        return match ($type) {
            'manuscript' => $this->manuscriptModel,
            'rarebook' => $this->rareBookModel,
            'catalogue' => $this->catalogueModel,
            'periodical' => $this->periodicalModel,
            default => null,
        };
    }
}