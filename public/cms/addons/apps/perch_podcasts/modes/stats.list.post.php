<?php
    # Side panel
    echo $HTML->side_panel_start();

    echo $HTML->para('This page lists your show listener stats.');

    echo $HTML->side_panel_end();
    
    
    # Main panel
    echo $HTML->main_panel_start();
	
	include('_subnav.php');


	# Title panel
    echo $HTML->heading1('Listing Show Statistics');
    
    if (isset($message)) echo $message;

    if (PerchUtil::count($shows)) {
        echo '<script src="'.$API->app_path().'/js/sparkline.js"></script>';
?>
    <table class="d">
        <thead>
            <tr>
                <th class="first"><?php echo $Lang->get('Show'); ?></th>
                <th><?php echo $Lang->get('Trend'); ?></th>
                <th><?php echo $Lang->get('Episodes'); ?></th>
                <th><?php echo $Lang->get('Total plays'); ?></th>
                <th><?php echo $Lang->get('Average per episode'); ?></th>
                
                
            </tr>
        </thead>
        <tbody>
<?php
    foreach($shows as $Show) {
?>
            <tr>
                <td class="primary">
                    <a href="<?php echo $HTML->encode($API->app_path()); ?>/show/?id=<?php echo $HTML->encode(urlencode($Show->id())); ?>">
                    <?php echo $HTML->encode($Show->showTitle()); ?></a>
                </td>
                <td><?php 
                    echo '<canvas id="sparkshow'.$Show->id().'" width="90" height="18"></canvas>';
                    $points = $Show->report_on('play_spark'); 
                    echo '<script>sparkline(\'sparkshow'.$Show->id().'\', ['.implode(', ', $points).'], true);</script>';
                ?></td>
                <td><?php echo $HTML->encode($Show->showEpisodeCount()); ?></td>
                <td><?php echo $HTML->encode($Show->report_on('total_plays')); ?></td>
                <td><?php echo $HTML->encode($Show->report_on('average_plays')); ?></td>

                
            </tr>

<?php   
    }
?>
        </tbody>
    </table>
<?php      
    foreach($shows as $Show) {
        echo '<h2>'.$HTML->encode($Show->showTitle()) .'</h2>';
        $episodes = $Episodes->get_by('showID', $Show->id());
        if (PerchUtil::count($episodes)) {    ?>
            <table class="d">
                <thead>
                    <tr>
                        <th class="first action"><?php echo $Lang->get('Episode'); ?></th>
                        <th><?php echo $Lang->get('Title'); ?></th>
                        <th class=""><?php echo $Lang->get('Trend'); ?></th>
                        <th class=""><?php echo $Lang->get('Plays'); ?></th>
                    </tr>
                </thead>
                <tbody>
        <?php
            $first = true;
            foreach($episodes as $Episode) {
        ?>
                    <tr>
                        <td class="primary"><?php echo $HTML->encode($Episode->episodeNumber()); ?></td>
                        <td><?php echo $HTML->encode($Episode->episodeTitle()); ?></td>
                        <td><?php 
                            echo '<canvas id="sparkep'.$Episode->id().'" width="90" height="18"></canvas>';
                            $points = $Episode->report_on('play_spark', array('latest'=>$first)); 
                            if ($first) {
                                echo '<script>sparkline(\'sparkep'.$Episode->id().'\', ['.implode(', ', $points).'], true, "#000000");</script>';
                            }else{
                                echo '<script>sparkline(\'sparkep'.$Episode->id().'\', ['.implode(', ', $points).'], true);</script>';    
                            }
                            
                        ?></td>
                        <td><?php echo $HTML->encode($Episode->report_on('total_plays')); ?></td>
                    </tr>
        <?php   
                $first = false;
            }
        ?>
                </tbody>
            </table>
        <?php    


        }

    }


    } // if shows
    
    echo $HTML->main_panel_end();
?>