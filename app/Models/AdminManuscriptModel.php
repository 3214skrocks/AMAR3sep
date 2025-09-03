<?php
namespace App\Models;

use CodeIgniter\Model;

class AdminManuscriptModel extends Model
{

    public function __construct()
    {
        $this->insertrow();
    }

    public function insertrow()
    {
        $model = new YourModel();

        // Prepare the empty data
        $data = [
            'column1' => '', // Add all your columns here with empty values
            'column2' => '',
            // ...
        ];

        // Insert the empty row
        $model->insert($data);
    }

    public function insert()
	{
		
		$db = \Config\Database::connect();
		$query = $db->query('INSERT INTO `manuscripts_m` ()');
		$result = $query->getResult();
		if(count($result)>0)
		{
			return $result;
		}
		
	}
}