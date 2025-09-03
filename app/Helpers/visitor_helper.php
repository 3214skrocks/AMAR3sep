<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('incrementVisitorCount')) {
    function incrementVisitorCount() {
        $countFile = 'visitor_count.txt';
        if (!file_exists($countFile)) {
            if (!file_put_contents($countFile, 1000)) {
                echo "Failed to create count file.";
                exit();
            }
        }
        $count = (int)file_get_contents($countFile);
        if ($count === false) {
            echo "Failed to read count file.";
            exit();
        }
        $count++;
        if (!file_put_contents($countFile, $count)) {
            echo "Failed to update count file.";
            exit();
        }
        return $count;
    }
}

// if(!function_exists('upload_url')){
//     function upload_url(){
//         return WRITEPATH.'uploads';
//     }
// }