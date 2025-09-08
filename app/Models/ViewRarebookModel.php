<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Class ViewRarebookModel
 *
 * This model is used to fetch data for the public-facing rare book views.
 */
class ViewRarebookModel extends Model
{
    /**
     * The table associated with this model.
     *
     * @var string
     */
    protected $table = 'rarebooks_m';

    /**
     * Fetches a limited number of rare book records for display.
     *
     * @return array|false An array of results, or false if no results are found.
     */
    public function getAllRarebooksData()
    {
        $builder = $this->db->table($this->table);
        $builder->limit(30);
        $query = $builder->get();
        $result = $query->getResult();

        return count($result) > 0 ? $result : false;
    }

    /**
     * Fetches the details for a single rare book by its ID.
     *
     * @param int $rb_id The ID of the rare book.
     * @return array|false An array containing the single result, or false if not found.
     */
    public function getRarebookDetails($rb_id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('rb_id', $rb_id);
        $query = $builder->get();
        $result = $query->getResult();

        return count($result) > 0 ? $result : false;
    }
}