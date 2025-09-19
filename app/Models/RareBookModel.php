<?php

namespace App\Models;

use CodeIgniter\Model;

class RareBookModel extends Model
{
    protected $table = 'rare_books1';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title_phonetic', 'author_phonetic', 'amar_id', 'file_path', 'status', 'amr_id',
        'supervisor_id', 'approved_by', 'rejected_by', 
        'cataloguer_id', 'cataloguer_approved_at', 'cataloguer_rejected_at',
        'remark_by_supervisor','remark_by_cataloguer'
    ];

    //protected $validationRules = [
      //  'title' => 'required|min_length[3]',
       // 'author' => 'required|min_length[3]',
       // 'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,pdf,doc,docx]' // Optional file validation
   // ];

    public function data_insert($request)
    {
        $session = session();
        $amr_id = $session->get('id');
        $title = $request->getPost('title_phonetic');
        $author = $request->getPost('author_phonetic');
        $cataloguer_id = $request->getPost('cataloguer_id');
        $file = $request->getFile('file');

        // Validate the input fields
        if (empty($title) || empty($author)) {
            $session->setFlashdata('error', 'Title and Author are required');
            return false;
        }

        // File handling
        $newFileName = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Generate a new file name and move the file
            $newFileName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/assets/uploads', $newFileName);
        }

        $data = [
            'amr_id' => $amr_id,
            'title_phonetic' => $title,
            'author_phonetic' => $author,
            'file_path' => $newFileName,
            'status' => 'Pending',
            'cataloguer_id' => $cataloguer_id
        ];

        // Perform the insertion
        if ($this->insert($data)) {
            $inserted_id = $this->insertID();
            $amar_id = 'AMAR/RB/' . $inserted_id;

            // Update the amar_id field
            $this->update($inserted_id, ['amar_id' => $amar_id]);

            $session->setFlashdata('success', 'Rare book data inserted successfully');
            return true;
        } else {
            $session->setFlashdata('error', 'Failed to insert rare book data');
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
        return $this->where(['status' => 'Published','amr_id' => $user_id])->findAll();
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