<?php
    # Side panel
    echo $HTML->side_panel_start();

    echo $HTML->para('This page lists your shows.');

    echo $HTML->side_panel_end();
    
    
    # Main panel
    echo $HTML->main_panel_start();
	
	include('_subnav.php');


    if ($CurrentUser->has_priv('perch_podcasts.shows.create')) echo '<a class="add button" href="'.$HTML->encode($API->app_path().'/edit/').'">'.$Lang->get('Add Show').'</a>';

	# Title panel
    echo $HTML->heading1('Listing Shows');
    
    if (isset($message)) echo $message;
?>

    <?php
    /* ----------------------------------------- SMART BAR ----------------------------------------- */
    if (PerchUtil::count($shows)) {
    ?>
    <ul class="smartbar">
        <li class="selected"><a href="<?php echo PerchUtil::html($API->app_path()); ?>"><?php echo $Lang->get('All'); ?></a></li>
    </ul>

    <?php
        }else{
            $Alert->set('notice', $Lang->get('There are no shows yet.'));
        }

        echo $Alert->output(); 

    /* ----------------------------------------- /SMART BAR ----------------------------------------- */


    if (PerchUtil::count($shows)) {
?>
    <table class="d">
        <thead>
            <tr>
                <th class="first"><?php echo $Lang->get('Show'); ?></th>
                <th><?php echo $Lang->get('Slug'); ?></th>
                <th><?php echo $Lang->get('Episodes'); ?></th>
                <th class="action last"></th>
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
                <td><?php echo $HTML->encode($Show->showSlug()); ?></td>
                <td><?php echo $HTML->encode($Show->showEpisodeCount()); ?></td>
                <td><a href="<?php echo $HTML->encode($API->app_path()); ?>/delete/?id=<?php echo $HTML->encode(urlencode($Show->id())); ?>" class="delete inline-delete" data-msg="<?php echo $Lang->get('Delete this show?'); ?>"><?php echo $Lang->get('Delete'); ?></a></td>
            </tr>

<?php   
    }
?>
        </tbody>
    </table>
<?php      
    } // if shows
    
    echo $HTML->main_panel_end();
?>