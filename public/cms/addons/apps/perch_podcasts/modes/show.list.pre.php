<?php
    
    $HTML = $API->get('HTML');
    $Lang = $API->get('Lang');
    
    // Try to update
    if (file_exists('update.php')) include('update.php');
    
    $Shows = new PerchPodcasts_Shows($API); 

    $shows = $Shows->all();
    
    if ($shows == false) {
        $Shows->attempt_install();
    }


?>