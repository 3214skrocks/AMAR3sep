<?php

namespace App\Models;

use CodeIgniter\Model;

class ViewCatalogueModel extends Model
{
    public function getAllCataloguesData()
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
		$query = $db->query('SELECT * FROM `catalogue_m` limit 30;');
		$result = $query->getResult();
		if(count($result)>0)
		{
			return $result;
		}
		else{
			return false;
		}
	}
	
	
	
	public function getCatalogueDetails($cat_id)
	{
		
		$db = \Config\Database::connect();
		$query = $db->query("SELECT * FROM catalogue_m where cat_id='$cat_id';");
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