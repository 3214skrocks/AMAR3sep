<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Class ViewManuscriptModel
 *
 * This model is used to fetch data for the public-facing manuscript views.
 */
class ViewManuscriptModel extends Model
{
    protected $table = 'manuscripts_m';
    protected $primaryKey = 'mssid'; // Assuming 'mssid' is the primary key for views
    protected $allowedFields = [
        'title_phonetic', 'author_phonetic'
    ];

    /**
     * Fetches a limited number of manuscript records for display.
     *
     * @return array|false An array of results, or false if no results are found.
     */
    public function getManuscriptFullData()
    {
        $builder = $this->db->table($this->table);
        $builder->limit(30);
        $query = $builder->get();
        $result = $query->getResult();

        return count($result) > 0 ? $result : false;
    }

    /**
     * Fetches the details for a single manuscript by its ID.
     *
     * @param int $mssid The ID of the manuscript.
     * @return array|false An array containing the single result, or false if not found.
     */
    public function getManuscriptDetails($mssid)
    {
        $builder = $this->db->table($this->table);
        $builder->where('mssid', $mssid);
        $query = $builder->get();
        $result = $query->getResult();

        return count($result) > 0 ? $result : false;
    }

    /**
     * Fetches statistics about manuscripts, grouped by system/topic.
     *
     * @return array|false An array of topic statistics, or false if no results are found.
     */
    public function getallManuscriptSystemData()
    {
        $builder = $this->db->table($this->table);
        $builder->select('topic_id, topic_name, count(topic_name) as count');
        $builder->groupBy('topic_name');
        $query = $builder->get();
        $result = $query->getResult();

        return count($result) > 0 ? $result : false;
    }

    /**
     * Fetches all manuscripts belonging to a specific system/topic.
     *
     * @param int $msstopicid The ID of the topic.
     * @return array|false An array of manuscript results, or false if not found.
     */
    public function getManuscriptSystemDetails($msstopicid)
    {
        $builder = $this->db->table($this->table);
        $builder->where('topic_id', $msstopicid);
        $query = $builder->get();
        $result = $query->getResult();

        return count($result) > 0 ? $result : false;
    }
}