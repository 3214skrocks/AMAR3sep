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

/**
 * Class SupervisorController
 *
 * This controller manages the workflow for the "Supervisor" user role.
 * Supervisors can review, approve, reject, and publish various types of documents.
 */
class SupervisorController extends Controller
{
    /** @var ManuscriptModel */
    protected $manuscriptModel;
    /** @var RareBookModel */
    protected $rareBookModel;
    /** @var CatalogueModel */
    protected $catalogueModel;
    /** @var PeriodicalModel */
    protected $periodicalModel;
    /** @var ViewManuscriptModel */
    protected $ViewManuscriptModel;
    /** @var ViewRarebookModel */
    protected $ViewRarebookModel;
    /** @var ViewCatalogueModel */
    protected $ViewCatalogueModel;
    /** @var ViewPeriodicalModel */
    protected $ViewPeriodicalModel;
    /** @var \CodeIgniter\Session\Session */
    protected $session;

    /**
     * Constructor.
     * Initializes all the necessary models and the session service.
     */
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

    /**
     * Checks if a user is logged in. If not, redirects to the login page.
     * This is a private helper method.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|void
     */
    private function checkLogin()
    {
        if (!$this->session->get('isLoggedIn')) {
            // This should return a response object to be handled by the caller.
            return redirect()->to('/admin/login');
        }
    }

    /**
     * Fetches all data submitted for review and displays the main supervisor view.
     *
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function getalldata()
    {
        if ($redirect = $this->checkLogin()) { return $redirect; }

        $data = [
            'data_manuscript' => $this->manuscriptModel->fetch_data(),
            'data_rarebook'   => $this->rareBookModel->fetch_data(),
            'data_catalogue'  => $this->catalogueModel->fetch_data(),
            'data_periodical' => $this->periodicalModel->fetch_data(),
        ];

        return view('/partials/SupervisorView', $data);
    }

    /**
     * Fetches all data that has been approved by a cataloguer.
     *
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function getCataloguerApprovedData()
    {
        if ($redirect = $this->checkLogin()) { return $redirect; }

        $data = [
            'data_manuscript' => $this->manuscriptModel->where('status', 'Approved by cataloguer')->findAll(),
            'data_rarebook'   => $this->rareBookModel->where('status', 'Approved by cataloguer')->findAll(),
            'data_catalogue'  => $this->catalogueModel->where('status', 'Approved by cataloguer')->findAll(),
            'data_periodical' => $this->periodicalModel->where('status', 'Approved by cataloguer')->findAll(),
            'isCataloguerApproved' => true,
        ];

        return view('/partials/cataloguerdashboardview', $data);
    }

    /**
     * Displays all documents with 'approved' status.
     *
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function approved()
    {
        if ($redirect = $this->checkLogin()) { return $redirect; }

        $data = [
            'data_manuscript' => $this->manuscriptModel->where('status', 'approved')->findAll(),
            'data_rarebook'   => $this->rareBookModel->where('status', 'approved')->findAll(),
            'data_catalogue'  => $this->catalogueModel->where('status', 'approved')->findAll(),
            'data_periodical' => $this->periodicalModel->where('status', 'approved')->findAll(),
        ];

        return view('/partials/SupervisorDashboardView', $data);
    }

    /**
     * Displays all documents with 'pending' status.
     *
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function pending()
    {
        if ($redirect = $this->checkLogin()) { return $redirect; }

        $data = [
            'data_manuscript' => $this->manuscriptModel->where('status', 'pending')->findAll(),
            'data_rarebook'   => $this->rareBookModel->where('status', 'pending')->findAll(),
            'data_catalogue'  => $this->catalogueModel->where('status', 'pending')->findAll(),
            'data_periodical' => $this->periodicalModel->where('status', 'pending')->findAll(),
        ];

        return view('/partials/SupervisorDashboardView', $data);
    }

    /**
     * Displays all documents with 'rejected' status.
     *
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function rejected()
    {
        if ($redirect = $this->checkLogin()) { return $redirect; }

        $data = [
            'data_manuscript' => $this->manuscriptModel->where('status', 'rejected')->findAll(),
            'data_rarebook'   => $this->rareBookModel->where('status', 'rejected')->findAll(),
            'data_catalogue'  => $this->catalogueModel->where('status', 'rejected')->findAll(),
            'data_periodical' => $this->periodicalModel->where('status', 'rejected')->findAll(),
        ];

        return view('/partials/SupervisorDashboardView', $data);
    }

    /**
     * Displays all documents with 'published' status.
     *
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function published()
    {
        if ($redirect = $this->checkLogin()) { return $redirect; }

        $data = [
            'data_manuscript' => $this->manuscriptModel->where('status', 'published')->findAll(),
            'data_rarebook'   => $this->rareBookModel->where('status', 'published')->findAll(),
            'data_catalogue'  => $this->catalogueModel->where('status', 'published')->findAll(),
            'data_periodical' => $this->periodicalModel->where('status', 'published')->findAll(),
        ];

        return view('/partials/SupervisorDashboardView', $data);
    }

    /**
     * Publishes a document.
     * This method fetches data from a source table, filters it based on a hardcoded
     * list of fields, and inserts it into a destination table.
     *
     * @param int    $id   The ID of the document to publish.
     * @param string $type The type of the document.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function publish($id, $type)
    {
        if ($redirect = $this->checkLogin()) { return $redirect; }

        $model = $this->getModelByType($type);
        if (!$model) {
            $this->session->setFlashdata('error', 'Invalid file type.');
            return redirect()->to('/supervisor/dashboard/cataloguer_approved');
        }

        $get_model_data = $model->publishedData($id);
        if (!$get_model_data) {
            $this->session->setFlashdata('error', "No data found for $type with ID $id.");
            return redirect()->to('/supervisor/dashboard/cataloguer_approved');
        }

        unset($get_model_data['id']);

        // NOTE: The field mappings are hardcoded here. This is not ideal and makes the code hard to maintain.
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
            $this->session->setFlashdata('error', "Failed to publish $type.");
        }

        return redirect()->to('/supervisor/dashboard/cataloguer_approved');
    }

    /**
     * Handles the approval or rejection of a document based on POST data.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function handleAction()
    {
        if ($redirect = $this->checkLogin()) { return $redirect; }

        if ($this->request->getMethod() === 'post') {
            $id = $this->request->getPost('id');
            $tableType = $this->request->getPost('table_type');
            $remark = $this->request->getPost('remark');
            $action = $this->request->getPost('action');

            $model = null;
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

            switch ($action) {
                case 'approve':
                    $this->approveItem($model, $id, $remark);
                    break;
                case 'reject':
                    $this->rejectItem($model, $id, $remark);
                    break;
                default:
                    session()->setFlashdata('error', 'Invalid action!');
                    return redirect()->back();
            }

            return redirect()->to(base_url('supervisor/dashboard/cataloguer_approved'));
        }
        return redirect()->back();
    }

    /**
     * Updates an item's status to 'approved'.
     *
     * @param \CodeIgniter\Model $model  The model to use.
     * @param int                $id     The ID of the item.
     * @param string             $remark The supervisor's remark.
     */
    private function approveItem($model, $id, $remark)
    {
        $model->update($id, ['status' => 'approved', 'remark_by_supervisor' => $remark]);
        session()->setFlashdata('success', 'Item has been approved.');
    }

    /**
     * Updates an item's status to 'rejected'.
     *
     * @param \CodeIgniter\Model $model  The model to use.
     * @param int                $id     The ID of the item.
     * @param string             $remark The supervisor's remark.
     */
    private function rejectItem($model, $id, $remark)
    {
        $model->update($id, ['status' => 'rejected', 'remark_by_supervisor' => $remark]);
        session()->setFlashdata('success', 'Item has been rejected.');
    }

    /**
     * Approves a manuscript.
     * @deprecated This method is likely unused and superseded by handleAction(). It calls a non-existent method.
     * @param int $id The manuscript ID.
     */
    public function approveManuscript($id)
    {
        return $this->handleApprovalOrRejection($id, $this->manuscriptModel, 'approve', 'Manuscript');
    }

    /**
     * Rejects a manuscript.
     * @deprecated This method is likely unused and superseded by handleAction(). It calls a non-existent method.
     * @param int $id The manuscript ID.
     */
    public function rejectManuscript($id)
    {
        return $this->handleApprovalOrRejection($id, $this->manuscriptModel, 'reject', 'Manuscript');
    }

    /**
     * Approves a rare book.
     * @deprecated This method is likely unused and superseded by handleAction(). It calls a non-existent method.
     * @param int $id The rare book ID.
     */
    public function approveRareBook($id)
    {
        return $this->handleApprovalOrRejection($id, $this->rareBookModel, 'approve', 'Rare book');
    }

    /**
     * Rejects a rare book.
     * @deprecated This method is likely unused and superseded by handleAction(). It calls a non-existent method.
     * @param int $id The rare book ID.
     */
    public function rejectRareBook($id)
    {
        return $this->handleApprovalOrRejection($id, $this->rareBookModel, 'reject', 'Rare book');
    }

    /**
     * Approves a periodical.
     * @deprecated This method is likely unused and superseded by handleAction(). It calls a non-existent method.
     * @param int $id The periodical ID.
     */
    public function approvePeriodical($id)
    {
        return $this->handleApprovalOrRejection($id, $this->periodicalModel, 'approve', 'Periodical');
    }

    /**
     * Rejects a periodical.
     * @deprecated This method is likely unused and superseded by handleAction(). It calls a non-existent method.
     * @param int $id The periodical ID.
     */
    public function rejectPeriodical($id)
    {
        return $this->handleApprovalOrRejection($id, $this->periodicalModel, 'reject', 'Periodical');
    }

    /**
     * Approves a catalogue.
     * @deprecated This method is likely unused and superseded by handleAction(). It calls a non-existent method.
     * @param int $id The catalogue ID.
     */
    public function approveCatalogue($id)
    {
        return $this->handleApprovalOrRejection($id, $this->catalogueModel, 'approve', 'Catalogue');
    }

    /**
     * Rejects a catalogue.
     * @deprecated This method is likely unused and superseded by handleAction(). It calls a non-existent method.
     * @param int $id The catalogue ID.
     */
    public function rejectCatalogue($id)
    {
        return $this->handleApprovalOrRejection($id, $this->catalogueModel, 'reject', 'Catalogue');
    }

    /**
     * Utility method to get the model by file type.
     *
     * @param string $type The type of the document.
     * @return \CodeIgniter\Model|null The corresponding model or null if not found.
     */
    private function getModelByType($type)
    {
        return match ($type) {
            'manuscript' => $this->manuscriptModel,
            'rarebook'   => $this->rareBookModel,
            'catalogue'  => $this->catalogueModel,
            'periodical' => $this->periodicalModel,
            default      => null,
        };
    }
}