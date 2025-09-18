<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Class ViewCatalogueModel
 *
 * This model is used to fetch data for the public-facing catalogue views.
 */
class ViewCatalogueModel extends Model
{
    /**
     * The table associated with this model.
     *
     * @var string
     */
    protected $table = 'catalogue_m';

    /**
     * Fetches a limited number of catalogue records for display.
     *
     * @return array|false An array of results, or false if no results are found.
     */
    public function getAllCataloguesData()
    {
        $builder = $this->db->table($this->table);
        $builder->limit(30);
        $query = $builder->get();
        $result = $query->getResult();

        return count($result) > 0 ? $result : false;
    }

    /**
     * Fetches the details for a single catalogue by its ID.
     *
     * @param int $cat_id The ID of the catalogue.
     * @return array|false An array containing the single result, or false if not found.
     */
    public function getCatalogueDetails($cat_id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('cat_id', $cat_id);
        $query = $builder->get();
        $result = $query->getResult();

        return count($result) > 0 ? $result : false;
    }
}