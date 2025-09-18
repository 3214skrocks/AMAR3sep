<?php

namespace App\Models;

use CodeIgniter\Model;

class ManuscriptModel extends Model
{
    protected $table = 'manuscript1_m';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title_phonetic', 'author_phonetic', 'amar_id', 'file_path', 'status', 'amr_id',
        'supervisor_id', 'approved_by', 'rejected_by', 
        'cataloguer_id', 'cataloguer_approved_at', 'cataloguer_rejected_at',
        'remark_by_supervisor','remark_by_cataloguer'
    ];

    public function data_insert($request)
    {
        $session = session();
        $amr_id = $session->get('id');
        $title = $request->getPost('title_phonetic');
        $author = $request->getPost('author_phonetic');
        $file = $request->getFile('file');

        // Validate the input fields and file
        if (!empty($title) && !empty($author) && $file->isValid() && !$file->hasMoved()) {
            // Generate a new file name
            $newFileName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/assets/uploads', $newFileName);

            $data = [
                'amr_id' => $amr_id,
                'title_phonetic' => $title,
                'author_phonetic' => $author,
                'file_path' => $newFileName,
                'status' => 'Pending' // Default status
            ];

            // Perform the insertion
            if ($this->insert($data)) {
                $inserted_id = $this->insertID(); // Get the last inserted ID

                // Update the `amar_id` field with the generated ID
                $amarId = "AMAR/MS/{$inserted_id}";
                $this->update($inserted_id, ['amar_id' => $amarId]);

                $session->setFlashdata('success', 'Catalogue data inserted successfully');
                return true;
            } else {
                $session->setFlashdata('error', 'Failed to insert catalogue data');
                return false;
            }
        } else {
            $session->setFlashdata('error', 'Title, Author, and File are required');
            return false;
        }
    }
    public function fetch_data()
    {
        return $this->where('status', 'Pending')->findAll();
    }

    public function approve($id, $supervisorId)
    {
        return $this->update($id, [
            'status' => 'Approved',
            'approved_by' => $supervisorId
        ]);
    }

    public function reject($id, $supervisorId)
    {
        return $this->update($id, [
            'status' => 'Rejected',
            'rejected_by' => $supervisorId
        ]);
    }

    public function approveByCataloguer($id, $cataloguerId)
    {
        return $this->update($id, [
            'status' => 'Approved by Cataloguer',
            'cataloguer_id' => $cataloguerId,
            'cataloguer_approved_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function rejectByCataloguer($id, $cataloguerId)
    {
        return $this->update($id, [
            'status' => 'Rejected by Cataloguer',
            'cataloguer_id' => $cataloguerId,
            'cataloguer_rejected_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function fetchApprovedBySupervisor($supervisorId)
    {
        return $this->where('status', 'Approved')
                    ->where('approved_by', $supervisorId)
                    ->findAll();
    }

    public function fetchApprovedByCataloguer()
    {
        return $this->where('status', 'Approved by Cataloguer')->findAll();
    }

    public function amrFetchApproved($user_id)
    {
        return $this->where(['status' => 'Approved','amr_id' => $user_id])->findAll();
    }

    public function amrFetchRejected($user_id)
    {
        return $this->where(['status' => 'Rejected','amr_id' => $user_id])->findAll();
    }

    public function amrFetchRejectedByCataloguer($user_id)
    {
        return $this->where(['status' => 'Rejected by Cataloguer','amr_id' => $user_id])->findAll();
    }

    public function publishedData($id){
        return $this->where(['status' => 'published', 'id' => $id])->first();
    }
}