<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Class ManuscriptModel
 *
 * This model handles all database operations related to manuscripts.
 * It manages creating, updating, and fetching manuscript data through various workflow stages.
 */
class ManuscriptModel extends Model
{
    protected $table = 'manuscript1_m'; // TODO: Consider a more descriptive table name
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title_phonetic', 'author_phonetic', 'amar_id', 'file_path', 'status', 'amr_id',
        'supervisor_id', 'approved_by', 'rejected_by',
        'cataloguer_id', 'cataloguer_approved_at', 'cataloguer_rejected_at',
        'remark_by_supervisor', 'remark_by_cataloguer'
    ];

    /**
     * Inserts new manuscript data from a request.
     *
     * @param \CodeIgniter\HTTP\IncomingRequest $request The request object containing post data and the uploaded file.
     * @return bool True on success, false on failure.
     */
    public function data_insert($request)
    {
        $session = session();
        $amr_id = $session->get('id');
        $title = $request->getPost('title_phonetic');
        $author = $request->getPost('author_phonetic');
        $file = $request->getFile('file');

        if (!empty($title) && !empty($author) && $file->isValid() && !$file->hasMoved()) {
            $newFileName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/assets/uploads', $newFileName);

            $data = [
                'amr_id'          => $amr_id,
                'title_phonetic'  => $title,
                'author_phonetic' => $author,
                'file_path'       => $newFileName,
                'status'          => 'Pending'
            ];

            if ($this->insert($data)) {
                $inserted_id = $this->insertID();
                $amarId = "AMAR/MS/{$inserted_id}";
                $this->update($inserted_id, ['amar_id' => $amarId]);

                $session->setFlashdata('success', 'Manuscript data inserted successfully');
                return true;
            }
        }
        $session->setFlashdata('error', 'Failed to insert manuscript data. Title, Author, and File are required.');
        return false;
    }

    /**
     * Fetches all records with a 'Pending' status.
     *
     * @return array An array of pending manuscript records.
     */
    public function fetch_data()
    {
        return $this->where('status', 'Pending')->findAll();
    }

    /**
     * Approves a manuscript record.
     *
     * @param int $id           The ID of the manuscript record.
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
     * Rejects a manuscript record.
     *
     * @param int $id           The ID of the manuscript record.
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
     * Approves a manuscript record at the cataloguer level.
     *
     * @param int $id           The ID of the manuscript record.
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
     * Rejects a manuscript record at the cataloguer level.
     *
     * @param int $id           The ID of the manuscript record.
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
     * Fetches all records approved by a specific supervisor.
     *
     * @param int $supervisorId The ID of the supervisor.
     * @return array An array of approved records.
     */
    public function fetchApprovedBySupervisor($supervisorId)
    {
        return $this->where('status', 'Approved')
            ->where('approved_by', $supervisorId)
            ->findAll();
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