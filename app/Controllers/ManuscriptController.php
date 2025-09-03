<?php

namespace App\Controllers;
// include models
use App\Models\ViewManuscriptModel;

class ManuscriptController extends BaseController
{
    // Search by manuscripts //=========================
	public function index()
    {
		
		/*
		// Database Connection
		$db = \Config\Database::connect();
		//print_r($db);
		
		$query = $db->query('SELECT * FROM `manuscripts_m` limit 10');
		$result = $query->getResult();
		//echo "<pre>";
		print_r($result);
		*/
		$data = [];
		$viewmanuscript = new ViewManuscriptModel();
		$data['manuscript_data']= $viewmanuscript->getManuscriptFullData();
		$this->getAllSystemDetails();
		
		return view('partials/manuscript_view',$data);
		
    }


	public function demo(){
		$data['demo'] = 'AMAR';
		
	}
	
	public function viewFullManuscriptDetails($mssid)
    {
		
		//$data['lht_id']= $mssid;
		//exit();
		$manuscriptdetails = new ViewManuscriptModel();
		$data['mss_data']= $manuscriptdetails->getManuscriptDetails($mssid);
		//print_r($data['mss_data']);
		return view('partials/manuscript_full_details',$data);
		// echo view('partials/manuscript_view');
		
    }

	public function getAllSystemDetails()
    {
				
		$viewallsystems = new ViewManuscriptModel();
		//$data['manuscript_system_data']= $viewallsystems->getallManuscriptSystemData();
		//print_r($data['manuscript_system_data']);
		
		// Fetch all systems from the model database 
		$allsystems=$viewallsystems->getallManuscriptSystemData();
		// echo '<pre>';
		// print_r($allsystems);
		// die();
		// get systems count for each loop based on their id
        foreach ($allsystems as $systems) {
            if ($systems->topic_id == 1) {
                $sys_id_ayu=$systems->topic_id;
				$ayu_count=$systems->count;
            }
			elseif ($systems->topic_id == 2) {
				$sys_id_yoga=$systems->topic_id;
				$yoga_count=$systems->count;
            }
			//elseif ($systems->topic_id == 3) {
			//	$sys_id_natur=$systems->topic_id;
				//$natr_count=$systems->count;
           // }
			elseif ($systems->topic_id == 4) {
				$sys_id_unani=$systems->topic_id;
				$unani_count=$systems->count;
            }
			elseif ($systems->topic_id == 5) {
				$sys_id_siddha=$systems->topic_id;
				$siddha_count=$systems->count;
            }
			// elseif ($systems->topic_id == 6) {
			// 	$sys_id_homeo=$systems->topic_id;  
			// 	$homeo_count=$systems->count;
            // }
			elseif ($systems->topic_id == 7) {
				$sys_id_others=$systems->topic_id;
				$others_count=$systems->count;
            } 
		}
		
		// store the values in an array
		$sysdata = [
					'sys_id_ayu' => $sys_id_ayu,
					'sys_count_ayurveda' => $ayu_count, 
					'sys_id_yoga' => $sys_id_yoga,'sys_count_yoga' => $yoga_count, 
					//'sys_id_natur' => $sys_id_natur,
					// 'sys_count_naturopathy' => $natr_count,
					'sys_id_unani' => $sys_id_unani,'sys_count_unani' => $unani_count, 
					'sys_id_siddha' => $sys_id_siddha,'sys_count_siddha' => $siddha_count,
					// 'sys_id_homeo' => $sys_id_homeo,
					// 'sys_count_homoeopathy' => $homeo_count, 
					'sys_id_others' => $sys_id_others,'sys_count_others' => $others_count
					];
		//print_r($data);
		//exit();
		// Pass the actions array to the view
		return view('partials/manuscript_view',$sysdata);
	

	}

	// Search by System/Topic //=========================
	
	public function getAllSystemManuscripts($msssysid)
    {
		
		//echo $data['sys_id']= $msssysid;
		//exit();
		$manuscriptdetails = new ViewManuscriptModel();
		$selsysdata['mss_system_data']= $manuscriptdetails->getManuscriptSystemDetails($msssysid);
		//print_r($data['mss_system_data']);
		return view('partials/manuscript_view',$selsysdata);
		// echo view('partials/manuscript_view');
		
    }
}