<?php
    # include the API
    include('../../../../../core/inc/api.php');
    
    $API  = new PerchAPI(1.0, 'perch_podcasts');
    $Lang = $API->get('Lang');

    # include your class files
    include('../../PerchPodcasts_Shows.class.php');
    include('../../PerchPodcasts_Show.class.php');
	include('../../PerchPodcasts_Episodes.class.php');
	include('../../PerchPodcasts_Episode.class.php');

    # Set the page title
    $Perch->page_title = $Lang->get('Show episodes');


    # Do anything you want to do before output is started
    include('../../modes/episode.import.pre.php');
    
    
    # Top layout
    include(PERCH_CORE . '/inc/top.php');

    
    # Display your page
    include('../../modes/episode.import.post.php');
    
    
    # Bottom layout
    include(PERCH_CORE . '/inc/btm.php');
?>