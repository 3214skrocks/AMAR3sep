<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Class RegistrarModel
 *
 * This model is used by the RegistrarController to interact with different data tables
 * dynamically. It sets the table to operate on based on a type parameter.
 */
class RegistrarModel extends Model
{
    /**
     * The table associated with this model, set dynamically.
     *
     * @var string
     */
    protected $table;

    /**
     * Sets the database table for the model instance based on the provided type.
     *
     * @param string $type The type of the document, which maps to a table name.
     * @return void
     */
    public function setTableByType($type)
    {
        $this->table = $this->getTableByType($type);
    }

    /**
     * Maps a type name to a database table name.
     *
     * @param string $type The type of the document.
     * @return string The corresponding table name.
     * @throws \Exception If the type is invalid.
     */
    private function getTableByType($type)
    {
        switch ($type) {
            case 'manuscript':
                return 'manuscript1_m';
            case 'rarebook':
                return 'rare_books1';
            case 'catalogue':
                return 'catalogue1';
            case 'periodical':
                return 'periodical1';
            default:
                // It's better to check the type in the controller before calling this.
                // Throwing an exception here is a good safeguard.
                throw new \Exception('Invalid type specified for RegistrarModel.');
        }
    }
}