<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Class ViewPeriodicalModel
 *
 * This model is used to fetch data for the public-facing periodical views.
 */
class ViewPeriodicalModel extends Model
{
    /**
     * The table associated with this model.
     *
     * @var string
     */
    protected $table = 'periodicals_m';

    /**
     * Fetches a limited number of periodical records for display.
     *
     * @return array|false An array of results, or false if no results are found.
     */
    public function getAllPeriodicalsData()
    {
        $builder = $this->db->table($this->table);
        $builder->limit(30);
        $query = $builder->get();
        $result = $query->getResult();

        return count($result) > 0 ? $result : false;
    }

    /**
     * Fetches the details for a single periodical by its ID.
     *
     * @param int $per_id The ID of the periodical.
     * @return array|false An array containing the single result, or false if not found.
     */
    public function getPeriodicalDetails($per_id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('per_id', $per_id);
        $query = $builder->get();
        $result = $query->getResult();

        return count($result) > 0 ? $result : false;
    }
}