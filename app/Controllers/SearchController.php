<?php

namespace App\Controllers;

use App\Models\SearchModel;

class SearchController extends BaseController
{
    public function index()
    {
       /*
		// Database Connection
		$db = \Config\Database::connect();
		//print_r($db);
		
		$query = $db->query('SELECT * FROM lht_details');
		$result = $query->getResult();
		//echo "<pre>";
		print_r($result);
		*/
		
		$usrsearch = new SearchModel();
		$data['lht_data']= $usrsearch->getData();
		//print_r($data['lht_data']);
		return view('partials/search_view',$data);
		
    }
	
	public function viewalldata($num)
    {
		//$data['lht_id']= $num;
		$usrsearch = new SearchModel();
		$data['lht_details']= $usrsearch->getFullData($num);
		
       return view('partials/full_details_view',$data);
    }

}
