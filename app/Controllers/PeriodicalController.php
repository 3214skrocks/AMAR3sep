<?php

namespace App\Controllers;

use App\Models\ViewPeriodicalModel;

/**
 * Class PeriodicalController
 *
 * This controller is responsible for handling the display of periodical data.
 * It retrieves periodical information from the model and passes it to the views.
 */
class PeriodicalController extends BaseController
{
    /**
     * Displays a list of all periodicals.
     *
     * @return string The view that displays all periodicals.
     */
    public function index()
    {
        $viewperiodicals = new ViewPeriodicalModel();
        $data['periodicals_data'] = $viewperiodicals->getAllPeriodicalsData();
        return view('partials/periodical_view', $data);
    }

    /**
     * Displays the full details of a specific periodical.
     *
     * @param int $per_id The ID of the periodical to display.
     * @return string The view that displays the full details of a periodical.
     */
    public function viewFullPeriodicalDetails($per_id)
    {
        $periodicaldetails = new ViewPeriodicalModel();
        $data['per_data'] = $periodicaldetails->getPeriodicalDetails($per_id);
        return view('partials/periodical_full_details', $data);
    }
}
