<?php

namespace App\Controllers;
use App\Models\ManuscriptModel;
use App\Models\RareBookModel;
use App\Models\CatalogueModel;
use App\Models\PeriodicalModel;

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
	
    public function catalogue()
    {
        $manuscriptModel = new ManuscriptModel();
        $rareBookModel = new RareBookModel();
        $catalogueModel = new CatalogueModel();
        $periodicalModel = new PeriodicalModel();

        $data['manuscripts'] = $manuscriptModel->getPublishedManuscripts();
        $data['rare_books'] = $rareBookModel->getPublishedRareBooks();
        $data['catalogues'] = $catalogueModel->getPublishedCatalogues();
        $data['periodicals'] = $periodicalModel->getPublishedPeriodicals();

        return view('partials/guest_catalogue_view', $data);
    }
	
	/*public function search()
    {
        echo view('partials/search_view');
    }*/
}
