<?php

namespace App\Controllers;

use App\Models\ViewManuscriptModel;

/**
 * Class ManuscriptController
 *
 * This controller handles the display of manuscript data.
 */
class ManuscriptController extends BaseController
{
    /**
     * Displays the main manuscript view with a list of all manuscripts and system details.
     *
     * @return string The manuscript view.
     */
    public function index()
    {
        $viewmanuscript = new ViewManuscriptModel();
        $data['manuscript_data'] = $viewmanuscript->getManuscriptFullData();
        $data['system_details'] = $this->getAllSystemDetails();

        return view('partials/manuscript_view', $data);
    }

    /**
     * Displays the full details of a specific manuscript.
     *
     * @param int $mssid The ID of the manuscript.
     * @return string The manuscript full details view.
     */
    public function viewFullManuscriptDetails($mssid)
    {
        $manuscriptdetails = new ViewManuscriptModel();
        $data['mss_data'] = $manuscriptdetails->getManuscriptDetails($mssid);
        return view('partials/manuscript_full_details', $data);
    }

    /**
     * Gathers statistics about manuscripts based on their system/topic.
     *
     * @return array An array containing the count of manuscripts for each system.
     */
    public function getAllSystemDetails()
    {
        $viewallsystems = new ViewManuscriptModel();
        $allsystems = $viewallsystems->getallManuscriptSystemData();

        $sysdata = [];
        foreach ($allsystems as $systems) {
            switch ($systems->topic_id) {
                case 1:
                    $sysdata['sys_id_ayu'] = $systems->topic_id;
                    $sysdata['sys_count_ayurveda'] = $systems->count;
                    break;
                case 2:
                    $sysdata['sys_id_yoga'] = $systems->topic_id;
                    $sysdata['sys_count_yoga'] = $systems->count;
                    break;
                case 4:
                    $sysdata['sys_id_unani'] = $systems->topic_id;
                    $sysdata['sys_count_unani'] = $systems->count;
                    break;
                case 5:
                    $sysdata['sys_id_siddha'] = $systems->topic_id;
                    $sysdata['sys_count_siddha'] = $systems->count;
                    break;
                case 7:
                    $sysdata['sys_id_others'] = $systems->topic_id;
                    $sysdata['sys_count_others'] = $systems->count;
                    break;
            }
        }
        return $sysdata;
    }

    /**
     * Displays manuscripts belonging to a specific system/topic.
     *
     * @param int $msssysid The ID of the system/topic.
     * @return string The manuscript view filtered by system.
     */
    public function getAllSystemManuscripts($msssysid)
    {
        $manuscriptdetails = new ViewManuscriptModel();
        $selsysdata['mss_system_data'] = $manuscriptdetails->getManuscriptSystemDetails($msssysid);
        return view('partials/manuscript_view', $selsysdata);
    }
}