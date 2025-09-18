<?php

/**
 * Visitor Helper
 *
 * This helper file contains functions related to tracking website visitors.
 */

if (!function_exists('incrementVisitorCount')) {
    /**
     * Increments and returns the website visitor count.
     *
     * The count is stored in a text file in the writable directory.
     * If the file doesn't exist, it's created with an initial value.
     *
     * @return int The updated visitor count.
     */
    function incrementVisitorCount()
    {
        $countFile = WRITEPATH . 'visitor_count.txt';

        if (!file_exists($countFile)) {
            // Initialize the count file if it doesn't exist.
            file_put_contents($countFile, '1');
            return 1;
        }

        $count = (int) file_get_contents($countFile);
        $count++;
        file_put_contents($countFile, (string) $count);

        return $count;
    }
}