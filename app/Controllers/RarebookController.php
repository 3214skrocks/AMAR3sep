<?php

namespace App\Controllers;
// include models
use App\Models\ViewRarebookModel;

class RarebookController extends BaseController
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
		
		$viewrarebook = new ViewRarebookModel();
		$data['rarebook_data']= $viewrarebook->getAllRarebooksData();
		//print_r($data['rarebook_data']);
		return view('partials/rarebook_view',$data);
		
		// echo view('partials/manuscript_view');
		
    }
	
	public function viewFullRarebookDetails($rb_id)
    {
		
		//$data['lht_id']= $rb_id;
		//exit();
		$rarebookdetails = new ViewRarebookModel();
		$data['rb_data']= $rarebookdetails->getRarebookDetails($rb_id);
		//print_r($data['mss_data']);
		return view('partials/rarebook_full_details',$data);
		// echo view('partials/manuscript_view');
		
    }
	
	
}
