<?php

namespace App\Controllers;

/**
 * Class Home
 *
 * This controller handles the main public-facing pages of the website.
 */
class Home extends BaseController
{
    /**
     * Displays the home page.
     *
     * @return string The home page view.
     */
    public function index(): string
    {
        return view('partials/home_view');
    }

    /**
     * Displays the "About Us" page.
     *
     * @return string The about us page view.
     */
    public function about_us()
    {
        return view('partials/about_us_view');
    }

    /**
     * Displays the "Contact Us" page.
     *
     * @return string The contact us page view.
     */
    public function contact_us()
    {
        return view('partials/contact_us_view');
    }
}
