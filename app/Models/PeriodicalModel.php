<?php

namespace App\Models;

use CodeIgniter\Model;

class PeriodicalModel extends Model
{
    protected $table = 'periodical1'; // Replace with your actual table name
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'per_title', 'publisher', 'amar_id', 'file_path', 'status', 'amr_id',
        'supervisor_id', 'approved_by', 'rejected_by', 
        'cataloguer_id', 'cataloguer_approved_at', 'cataloguer_rejected_at',
        'remark_by_supervisor','remark_by_cataloguer'
    ];

   // protected $validationRules = [
   //     'title' => 'required|min_length[3]',
   //     'author' => 'required|min_length[3]',
    //];

    public function data_insert($request)
    {
        $session = session();
        $amr_id = $session->get('id');
        $title = $request->getPost('per_title');
        $author = $request->getPost('publisher');
        $cataloguer_id = $request->getPost('cataloguer_id');
        $file = $request->getFile('file'); // Retrieve the uploaded file

        // Basic validation
        if (empty($title) || empty($author)) {
            $session->setFlashdata('error', 'Title and Author are required');
            return false;
        }

        // Validate file
        if (!$file->isValid() || $file->hasMoved()) {
            $session->setFlashdata('error', 'Invalid file upload');
            return false;
        }

        // Generate a new file name
        $newFileName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/assets/uploads', $newFileName);

        $data = [
            'amr_id' => $amr_id,
            'per_title' => $title,
            'publisher' => $author,
            'file_path' => $newFileName, // Save the new file name
            'status' => 'Pending',
            'cataloguer_id' => $cataloguer_id
        ];

        // Perform the insertion
        if ($this->insert($data)) {
            $inserted_id = $this->insertID();
            $amar_id = 'AMAR/PR/' . $inserted_id;

            // Update the amar_id field using CodeIgniter's Query Builder
            $this->update($inserted_id, ['amar_id' => $amar_id]);

            $session->setFlashdata('success', 'Periodical data inserted successfully');
            return true;
        } else {
            $session->setFlashdata('error', 'Failed to insert periodical data');
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

    public function approveByCataloguer($id, $cataloguerId, $remark)
    {
        return $this->update($id, [
            'status' => 'Approved by Cataloguer',
            'cataloguer_id' => $cataloguerId,
            'cataloguer_approved_at' => date('Y-m-d H:i:s'),
            'remark_by_cataloguer' => $remark
        ]);
    }

    public function rejectByCataloguer($id, $cataloguerId, $remark)
    {
        return $this->update($id, [
            'status' => 'Rejected by Cataloguer',
            'cataloguer_id' => $cataloguerId,
            'cataloguer_rejected_at' => date('Y-m-d H:i:s'),
            'remark_by_cataloguer' => $remark
        ]);
    }

    public function fetchApprovedBySupervisor()
    {
        return $this->where('status', 'Approved')->findAll();
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