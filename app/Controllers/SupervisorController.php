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
        $data = [
            'data_manuscript' => $this->manuscriptModel->where('status', 'Approved by cataloguer')->findAll(),
            'data_rarebook' => $this->rareBookModel->where('status', 'Approved by cataloguer')->findAll(),
            'data_catalogue' => $this->catalogueModel->where('status', 'Approved by cataloguer')->findAll(),
            'data_periodical' => $this->periodicalModel->where('status', 'Approved by cataloguer')->findAll(),
            'isCataloguerApproved' => true,
        ];

        return view('/partials/cataloguerdashboardview', $data);
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
    
        // Debugging: Log the model being used
        log_message('debug', 'Model: ' . get_class($model));
    
        $get_model_data = $model->publishedData($id);
        if (!$get_model_data) {
            // Debugging: Log the ID and type
            log_message('error', "No data found for $type with ID $id.");
            $this->session->setFlashdata('error', "No data found for $type with ID $id.");
            return redirect()->to('/supervisor/dashboard/cataloguer_approved');
        }
    
        // Debugging: Log fetched data
        log_message('debug', 'Fetched data: ' . print_r($get_model_data, true));
    
        unset($get_model_data['id']); // Ensure 'id' is not included
    
        $field_mappings = [
        'manuscript' => [
            'amar_id', 'state_code', 'state_name', 'source_code', 'source_name',
            'topic_id', 'topic_name', 'subject_id', 'subject_name', 'language_id',
            'language_name', 'script_id', 'script_name',
            'authors_beginning_sentence_unic', 'authors_beginning_sentence_diacritical',
            'scribes_beginning_sentence_unic', 'scribes_beginning_sentence_diacritical',
            'authors_ending_sentence_unic', 'authors_ending_sentence_diacritical',
            'scribes_ending_sentence_unic', 'scribes_ending_sentence_diacritical',
            'colophon_unic', 'colophon_diacritical', 'chapterisation', 'completeness',
            'remarks', 'title_unic', 'title_diacritical', 'title_phonetic', 'other_title',
            'other_title_diacritical', 'author_unic', 'author_phonetic', 'author_diacritical',
            'co_author', 'co_author_diacritical', 'redactor', 'redactor_diacritical',
            'commentator_name_unicode', 'commentator_diacritical', 'name_of_the_commentary',
            'author_date', 'commentator_date', 'scribe', 'scribe_date_and_place',
            'material_id', 'material_name', 'no_of_folios', 'no_of_pages',
            'no_of_lines_per_folio', 'no_of_lines_per_page', 'no_of_letters_per_line',
            'granthamana', 'missing_folios', 'illustrations', 'condition', 'length',
            'width', 'unit', 'cat_status', 'cat_mss_no', 'cat_record_no', 'cat_bundle_no',
            'cat_title', 'cat_part', 'cat_volume', 'cat_editor', 'cat_publisher',
            'cat_yop', 'cat_add_details', 'publication_status', 'public_status',
            'public_language', 'public_availability', 'public_editor', 'public_translator',
            'public_publisher', 'public_yop', 'public_place', 'about_the_book',
            'compiled_by', 'accession_no_at_source', 'accession_no', 'date_of_collection',
            'hr_info', 'data_entry_by', 'images_front', 'images_back', 'file_path', 'status'
        ],
        'rarebook' => [
            'title', 'author', 'isbn', 'publisher', 'year', 'edition',
            'amar_id', 'title_unic', 'title_diacritical', 'title_phonetic',
            'physical_location', 'accession_no_at_source', 'author_unic',
            'author_diacritical', 'author_phonetic', 'time_of_author',
            'edited_by', 'translated_by', 'commentary_by', 'commentary',
            'foreword_by', 'ayush_system', 'subject', 'language', 'script',
            'place_and_state', 'publisher_details', 'year_of_publication',
            'no_of_pages', 'about_the_book', 'other_info', 'digitized_by',
            'date_of_digitization', 'front_image', 'back_image',
            'verified_status', 'file_path', 'status'
        ],
        'catalogue' => [
            'catalogue_name', 'year', 'editor', 'summary', 'volume',
            'amar_id', 'title_unic', 'title_diacritical', 'title_phonetic',
            'author_unic', 'author_diacritical', 'author_phonetic',
            'ayush_system', 'subject', 'language', 'script', 'material',
            'time_period', 'extent', 'physical_location', 'state', 'place',
            'accession_no', 'contact_address', 'cat_public_status',
            'bibliography_references', 'file_path', 'status'
        ],
        'periodical' => [
            'amar_id', 'per_title', 'country_of_publication', 'publisher',
            'editor', 'publication_start_year', 'place_of_publishers', 'frequency',
            'language', 'broad_subject_term', 'source_location', 'access_no',
            'article_id', 'title_of_article', 'authors', 'name_of_the_journal',
            'year', 'volume', 'issue', 'page_no', 'key_words', 'broad_subject',
            'category', 'language_of_the_article', 'abstract', 'file_path', 'status'
        ],
    ];
    
    
        $allowed_fields = $field_mappings[$type] ?? [];
        $filtered_data = array_filter(
            $get_model_data,
            fn($key) => in_array($key, $allowed_fields),
            ARRAY_FILTER_USE_KEY
        );
    
        // Debugging: Log filtered data
        log_message('debug', 'Filtered data: ' . print_r($filtered_data, true));
    
        if (empty($filtered_data)) {
            $this->session->setFlashdata('error', "No valid data to publish for $type.");
            return redirect()->to('/supervisor/dashboard/cataloguer_approved');
        }
    
        switch ($type) {
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
    
        $inserted = $MainModel->insert($filtered_data);
        if ($inserted) {
            $model->update($id, ['status' => 'published']);
            $this->session->setFlashdata('success', "$type published successfully.");
        } else {
            // Debugging: Log insertion error
            log_message('error', 'Failed to insert data into target table: ' . print_r($filtered_data, true));
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
    $model->update($id, ['status' => 'approved', 'remark_by_supervisor' => $remark]);
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