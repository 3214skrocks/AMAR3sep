<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Class ViewUserModel
 *
 * This model is used to fetch user data.
 * It appears to be for viewing purposes and may not be used in the main application flow.
 */
class ViewUserModel extends Model
{
    /**
     * The table associated with this model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Fetches all users from the database.
     *
     * @return array|null An array of user objects, or null if no users are found.
     */
    public function getUsers()
    {
        $builder = $this->db->table($this->table);
        $query = $builder->get();
        $result = $query->getResult();

        return count($result) > 0 ? $result : null;
    }
}