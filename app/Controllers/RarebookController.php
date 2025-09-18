<?php

namespace App\Controllers;

use App\Models\ViewRarebookModel;

/**
 * Class RarebookController
 *
 * This controller is responsible for handling the display of rare book data.
 * It retrieves rare book information from the model and passes it to the views.
 */
class RarebookController extends BaseController
{
    /**
     * Displays a list of all rare books.
     *
     * @return string The view that displays all rare books.
     */
    public function index()
    {
        $viewrarebook = new ViewRarebookModel();
        $data['rarebook_data'] = $viewrarebook->getAllRarebooksData();
        return view('partials/rarebook_view', $data);
    }

    /**
     * Displays the full details of a specific rare book.
     *
     * @param int $rb_id The ID of the rare book to display.
     * @return string The view that displays the full details of a rare book.
     */
    public function viewFullRarebookDetails($rb_id)
    {
        $rarebookdetails = new ViewRarebookModel();
        $data['rb_data'] = $rarebookdetails->getRarebookDetails($rb_id);
        return view('partials/rarebook_full_details', $data);
    }
}
