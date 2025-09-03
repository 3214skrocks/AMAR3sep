<?php

namespace App\Models;

use CodeIgniter\Model;

class SearchModel extends Model
{
    public function getData()
	{
		/*
			$subjects = [
				['subject' => 'HTML', 'abbr' => 'Hyper Text Markup Language'],
				['subject' => 'CSS', 'abbr' => 'ascading Style Sheet'],
				['subject' => 'PHP', 'abbr' => 'Preprocessor Hyper Text'],
			];
			return $subjects;
		*/
		
		$db = \Config\Database::connect();
		$query = $db->query('SELECT * FROM lht_details');
		$result = $query->getResult();
		if(count($result)>0)
		{
			return $result;
		}
		else{
			return false;
		}
	}
	
	public function getFullData($num)
	{
		
		$db = \Config\Database::connect();
		$query = $db->query("SELECT * FROM lht_details  where lht_id='$num';");
		$result = $query->getResult();
		if(count($result)>0)
		{
			return $result;
		}
		else{
			return false;
		}
	}
	
	
}