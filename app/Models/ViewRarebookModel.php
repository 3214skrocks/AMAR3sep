<?php

namespace App\Models;

use CodeIgniter\Model;

class ViewRarebookModel extends Model
{
    public function getAllRarebooksData()
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
		$query = $db->query('SELECT * FROM `rarebooks_m` limit 30;');
		$result = $query->getResult();
		if(count($result)>0)
		{
			return $result;
		}
		else{
			return false;
		}
	}
	
	
	
	public function getRarebookDetails($rb_id)
	{
		
		$db = \Config\Database::connect();
		$query = $db->query("SELECT * FROM rarebooks_m where rb_id='$rb_id';");
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