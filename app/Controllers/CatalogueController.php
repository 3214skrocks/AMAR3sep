<?php

namespace App\Controllers;
// include models
use App\Models\ViewCatalogueModel;

class CatalogueController extends BaseController
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
		
		$viewcatalogue = new ViewCatalogueModel();
		$data['catalogue_data']= $viewcatalogue->getAllCataloguesData();
		//print_r($data['catalogue_data']);
		return view('partials/catalogue_view',$data);
		
		// echo view('partials/manuscript_view');
		
    }
	
	public function viewFullCatalogueDetails($cat_id)
    {
		
		//$data['lht_id']= $rb_id;
		//exit();
		$cataloguedetails = new ViewCatalogueModel();
		$data['cat_data']= $cataloguedetails->getCatalogueDetails($cat_id);
		//print_r($data['mss_data']);
		return view('partials/catalogue_full_details',$data);
		// echo view('partials/manuscript_view');
		
    }
	
	
}
