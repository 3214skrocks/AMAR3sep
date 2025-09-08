<?php

namespace App\Controllers;

use App\Models\ViewCatalogueModel;

/**
 * Class CatalogueController
 *
 * This controller is responsible for handling the display of catalogue data.
 * It retrieves catalogue information from the model and passes it to the views.
 */
class CatalogueController extends BaseController
{
    /**
     * Displays a list of all catalogues.
     *
     * @return string The view that displays all catalogues.
     */
    public function index()
    {
        $viewcatalogue = new ViewCatalogueModel();
        $data['catalogue_data'] = $viewcatalogue->getAllCataloguesData();
        return view('partials/catalogue_view', $data);
    }

    /**
     * Displays the full details of a specific catalogue.
     *
     * @param int $cat_id The ID of the catalogue to display.
     * @return string The view that displays the full details of a catalogue.
     */
    public function viewFullCatalogueDetails($cat_id)
    {
        $cataloguedetails = new ViewCatalogueModel();
        $data['cat_data'] = $cataloguedetails->getCatalogueDetails($cat_id);
        return view('partials/catalogue_full_details', $data);
    }
}
