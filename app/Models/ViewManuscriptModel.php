<?php
namespace App\Models;

use CodeIgniter\Model;

class ViewManuscriptModel extends Model
{

	protected $table = 'manuscripts_m';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title_phonetic', 'author_phonetic'
    ];

    public function getManuscriptFullData()
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
		$query = $db->query('SELECT * FROM `manuscripts_m` limit 30;');
		$result = $query->getResult();
		if(count($result)>0)
		{
			return $result;
		}
		else{
			return false;
		}
	}
	
	
	
	public function getManuscriptDetails($mssid)
	{
		
		$db = \Config\Database::connect();
		$query = $db->query("SELECT * FROM manuscripts_m where mssid='$mssid';");
		$result = $query->getResult();
		if(count($result)>0)
		{
			return $result;
		}
		else{
			return false;
		}
	}

	public function getallManuscriptSystemData()
	{
		$db = \Config\Database::connect();
		$query = $db->query('SELECT topic_id,topic_name,count(topic_name) as count FROM `manuscripts_m` GROUP by topic_name');
		$result = $query->getResult();
		if(count($result)>0)
		{
			return $result;
		}
		else{
			return false;
		}
	}

	// Search by System/Topic //=========================
	public function getManuscriptSystemDetails($msstopicid)
	{
		
		$db = \Config\Database::connect();
		$query = $db->query("SELECT * FROM manuscripts_m where topic_id='$msstopicid';");
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