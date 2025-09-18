<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Class SearchModel
 *
 * This model handles the public-facing search functionality.
 * It retrieves data from the 'lht_details' table.
 */
class SearchModel extends Model
{
    /**
     * The table associated with this model.
     *
     * @var string
     */
    protected $table = 'lht_details';

    /**
     * Fetches all records from the details table.
     *
     * @return array|false An array of results, or false if no results are found.
     */
    public function getData()
    {
        $builder = $this->db->table($this->table);
        $query = $builder->get();
        $result = $query->getResult();

        return count($result) > 0 ? $result : false;
    }

    /**
     * Fetches a single record from the details table by its ID.
     * This method uses the Query Builder to prevent SQL injection.
     *
     * @param int $num The ID of the record to fetch.
     * @return array|false An array containing the single result, or false if not found.
     */
    public function getFullData($num)
    {
        $builder = $this->db->table($this->table);
        $builder->where('lht_id', $num);
        $query = $builder->get();
        $result = $query->getResult();

        return count($result) > 0 ? $result : false;
    }
}