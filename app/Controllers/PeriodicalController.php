<?php

namespace App\Controllers;
// include models
use App\Models\ViewPeriodicalModel;

class PeriodicalController extends BaseController
{
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
		
		$viewperiodicals = new ViewPeriodicalModel();
		$data['periodicals_data']= $viewperiodicals->getAllPeriodicalsData();
		//print_r($data['catalogue_data']);
		return view('partials/periodical_view',$data);
		// echo view('partials/periodical_view');
		
    }
	
	public function viewFullPeriodicalDetails($per_id)
    {
		
		//$data['lht_id']= $rb_id;
		//exit();
		$periodicaldetails = new ViewPeriodicalModel();
		$data['per_data']= $periodicaldetails->getPeriodicalDetails($per_id);
		//print_r($data['per_data']);
		//exit();
		return view('partials/periodical_full_details',$data);
		// echo view('partials/manuscript_view');
		
    }
	
	
}
