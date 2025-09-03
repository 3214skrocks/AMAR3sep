<?php

namespace App\Models;

use CodeIgniter\Model;

class ViewPeriodicalModel extends Model
{
    public function getAllPeriodicalsData()
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
		$query = $db->query('SELECT * FROM `periodicals_m` limit 30;');
		$result = $query->getResult();
		if(count($result)>0)
		{
			return $result;
		}
		else{
			return false;
		}
	}
	
	
	
	public function getPeriodicalDetails($per_id)
	{
		
		$db = \Config\Database::connect();
		$query = $db->query("SELECT * FROM periodicals_m where per_id='$per_id';");
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