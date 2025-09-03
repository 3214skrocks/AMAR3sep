<?php
namespace App\Models;

use CodeIgniter\Model;

class ViewUserModel extends Model
{
    public function getUsers()
	{
		
		$db = \Config\Database::connect();
		$query = $db->query('SELECT * FROM `users`');
		$result = $query->getResult();
		if(count($result)>0)
		{
			return $result;
		}
		
	}
}