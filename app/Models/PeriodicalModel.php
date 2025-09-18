<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Class PeriodicalModel
 *
 * This model handles all database operations related to periodicals.
 * It manages creating, updating, and fetching periodical data through various workflow stages.
 */
class PeriodicalModel extends Model
{
    protected $table = 'periodical1'; // TODO: Consider a more descriptive table name
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'per_title', 'publisher', 'amar_id', 'file_path', 'status',
        'supervisor_id', 'approved_by', 'rejected_by',
        'cataloguer_id', 'cataloguer_approved_at', 'cataloguer_rejected_at',
        'remark_by_supervisor', 'remark_by_cataloguer'
    ];

    protected $validationRules = [
        'per_title' => 'required|min_length[3]',
        'publisher' => 'required|min_length[3]',
    ];

    /**
     * Inserts new periodical data from a request.
     *
     * @param \CodeIgniter\HTTP\IncomingRequest $request The request object containing post data and the uploaded file.
     * @return bool True on success, false on failure.
     */
    public function data_insert($request)
    {
        $session = session();
        $title = $request->getPost('per_title');
        $publisher = $request->getPost('publisher');
        $file = $request->getFile('file');

        if (empty($title) || empty($publisher) || !$file->isValid() || $file->hasMoved()) {
            $session->setFlashdata('error', 'Invalid input or file upload.');
            return false;
        }

        $newFileName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/assets/uploads', $newFileName);

        $data = [
            'per_title' => $title,
            'publisher' => $publisher,
            'file_path' => $newFileName,
            'status'    => 'Pending'
        ];

        if ($this->insert($data)) {
            $inserted_id = $this->insertID();
            $amar_id = 'AMAR/PR/' . $inserted_id;
            $this->update($inserted_id, ['amar_id' => $amar_id]);

            $session->setFlashdata('success', 'Periodical data inserted successfully');
            return true;
        }

        $session->setFlashdata('error', 'Failed to insert periodical data');
        return false;
    }

    /**
     * Fetches all records with a 'Pending' status.
     *
     * @return array An array of pending periodical records.
     */
    public function fetch_data()
    {
        return $this->where('status', 'Pending')->findAll();
    }

    /**
     * Approves a periodical record.
     *
     * @param int $id           The ID of the periodical record.
     * @param int $supervisorId The ID of the supervisor approving the record.
     * @return bool True on success, false on failure.
     */
    public function approve($id, $supervisorId)
    {
        return $this->update($id, [
            'status'      => 'Approved',
            'approved_by' => $supervisorId
        ]);
    }

    /**
     * Rejects a periodical record.
     *
     * @param int $id           The ID of the periodical record.
     * @param int $supervisorId The ID of the supervisor rejecting the record.
     * @return bool True on success, false on failure.
     */
    public function reject($id, $supervisorId)
    {
        return $this->update($id, [
            'status'      => 'Rejected',
            'rejected_by' => $supervisorId
        ]);
    }

    /**
     * Approves a periodical record at the cataloguer level.
     *
     * @param int $id           The ID of the periodical record.
     * @param int $cataloguerId The ID of the cataloguer approving the record.
     * @return bool True on success, false on failure.
     */
    public function approveByCataloguer($id, $cataloguerId)
    {
        return $this->update($id, [
            'status'                 => 'Approved by Cataloguer',
            'cataloguer_id'          => $cataloguerId,
            'cataloguer_approved_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Rejects a periodical record at the cataloguer level.
     *
     * @param int $id           The ID of the periodical record.
     * @param int $cataloguerId The ID of the cataloguer rejecting the record.
     * @return bool True on success, false on failure.
     */
    public function rejectByCataloguer($id, $cataloguerId)
    {
        return $this->update($id, [
            'status'                 => 'Rejected by Cataloguer',
            'cataloguer_id'          => $cataloguerId,
            'cataloguer_rejected_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Fetches all records approved by any supervisor.
     *
     * @return array An array of approved records.
     */
    public function fetchApprovedBySupervisor()
    {
        return $this->where('status', 'Approved')->findAll();
    }

    /**
     * Fetches all records approved by any cataloguer.
     *
     * @return array An array of cataloguer-approved records.
     */
    public function fetchApprovedByCataloguer()
    {
        return $this->where('status', 'Approved by Cataloguer')->findAll();
    }

    /**
     * Fetches approved records for a specific AMR user.
     *
     * @param int $user_id The ID of the AMR user.
     * @return array An array of approved records for the user.
     */
    public function amrFetchApproved($user_id)
    {
        return $this->where(['status' => 'Approved', 'amr_id' => $user_id])->findAll();
    }

    /**
     * Fetches rejected records for a specific AMR user.
     *
     * @param int $user_id The ID of the AMR user.
     * @return array An array of rejected records for the user.
     */
    public function amrFetchRejected($user_id)
    {
        return $this->where(['status' => 'Rejected', 'amr_id' => $user_id])->findAll();
    }

    /**
     * Fetches records rejected by a cataloguer for a specific AMR user.
     *
     * @param int $user_id The ID of the AMR user.
     * @return array An array of cataloguer-rejected records for the user.
     */
    public function amrFetchRejectedByCataloguer($user_id)
    {
        return $this->where(['status' => 'Rejected by Cataloguer', 'amr_id' => $user_id])->findAll();
    }

    /**
     * Fetches a single published record by its ID.
     *
     * @param int $id The ID of the record.
     * @return array|object|null The published record, or null if not found.
     */
    public function publishedData($id)
    {
        return $this->where(['status' => 'published', 'id' => $id])->first();
    }
}