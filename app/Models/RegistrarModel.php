<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrarModel extends Model
{
    protected $table;

    //public function fetchApprovedByCataloguer($type)
    //{
  //      $this->type=$type;
   //     $this->table = $this->getTableByType($this->type);
    //    return $this->where('status', 'Approved by Cataloguer')->findAll();
   // }

    public function setTableByType($type)
    {
        $this->table = $this->getTableByType($type);
    }

    private function getTableByType($type)
    {
        switch ($type) {
            case 'manuscript1_m':
                return 'manuscript1_m';
            case 'rare_books1':
                return 'rare_books1';
            case 'catalogue1':
                return 'catalogue1';
            case 'periodical1':
                return 'periodical1';
            default:
                throw new \Exception('Invalid type');
        }
    }
}