<?php

namespace App\Controllers;

use App\Models\SearchModel;

/**
 * Class SearchController
 *
 * This controller handles the search functionality for the website.
 */
class SearchController extends BaseController
{
    /**
     * Displays the main search page with initial data.
     *
     * @return string The search view.
     */
    public function index()
    {
        $usrsearch = new SearchModel();
        $data['lht_data'] = $usrsearch->getData();
        return view('partials/search_view', $data);
    }

    /**
     * Displays the full details for a specific search result.
     *
     * @param int $num The ID of the item to display details for.
     * @return string The full details view.
     */
    public function viewalldata($num)
    {
        $usrsearch = new SearchModel();
        $data['lht_details'] = $usrsearch->getFullData($num);
        return view('partials/full_details_view', $data);
    }
}
