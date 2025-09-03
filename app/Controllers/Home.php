<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('partials/home_view');
    }
	
	public function about_us()
    {
        echo view('partials/about_us_view');
    }

    public function contact_us()
    {
        echo view('partials/contact_us_view');
    }
	
	
	/*public function search()
    {
        echo view('partials/search_view');
    }*/
}
