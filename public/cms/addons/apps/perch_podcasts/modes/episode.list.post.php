<?php
    # Side panel
    echo $HTML->side_panel_start();

    $show = $Show->to_array();

    if ($show) {
        /* Don't copy this, it's a nasty hack. I'll add something proper to the API. DM. */
        $Template = new PerchTemplate('', 'podcasts');
        $Template->load('<perch:if exists="image">
                            <img src="<perch:podcasts id="image" type="image" label="Artwork" />" width="100%" />
                        </perch:if>');
        echo $Template->render($show);
    }

    echo $HTML->para('This page lists your episodes for this show.');

    echo $HTML->side_panel_end();
    
    
    # Main panel
    echo $HTML->main_panel_start();
	
	include('_subnav.php');


    if ($CurrentUser->has_priv('perch_podcasts.shows.create')) echo '<a class="add button" href="'.$HTML->encode($API->app_path().'/show/episode/?show='.$Show->id()).'">'.$Lang->get('Add Episode').'</a>';

	# Title panel
    echo $HTML->heading1('Listing Episodes for ‘%s’', $Show->showTitle());
    
    if (isset($message)) echo $message;
?>

    <?php
    /* ----------------------------------------- SMART BAR ----------------------------------------- */
    
    ?>
    <ul class="smartbar">
        <li class="selected"><a href="<?php echo PerchUtil::html($API->app_path().'/show/?id='.$Show->id()); ?>"><?php echo $HTML->encode($Show->showTitle()); ?></a></li>
        <li><a href="<?php echo PerchUtil::html($API->app_path().'/edit/?id='.$Show->id()); ?>"><?php echo $Lang->get('Show Options'); ?></a></li>
        <li class="fin"><a class="icon download" href="<?php echo PerchUtil::html($API->app_path()); ?>/show/import/?id=<?php echo $Show->id(); ?>"><?php echo $Lang->get('Import'); ?></a></li>
    </ul>

    <?php
        if (!PerchUtil::count($episodes)) {
            $Alert->set('notice', $Lang->get('There are no episodes yet.'));
        }

        echo $Alert->output(); 

    /* ----------------------------------------- /SMART BAR ----------------------------------------- */

    if (PerchUtil::count($episodes)) {
?>
    <table class="d">
        <thead>
            <tr>
                <th><?php echo $Lang->get('Episode'); ?></th>
                <th><?php echo $Lang->get('Title'); ?></th>
                <th><?php echo $Lang->get('Duration'); ?></th>
                <th><?php echo $Lang->get('Status'); ?></th>
                <th><?php echo $Lang->get('Date'); ?></th>
                <th class="action last"></th>
            </tr>
        </thead>
        <tbody>
<?php
    foreach($episodes as $Episode) {
?>
            <tr>
                <td class="primary">
                    <a href="<?php echo $HTML->encode($API->app_path()); ?>/show/episode/?id=<?php echo $HTML->encode(urlencode($Episode->id())); ?>">
                    <?php echo $HTML->encode($Episode->episodeNumber()); ?></a>
                </td>
                <td class="primary">
                    <a href="<?php echo $HTML->encode($API->app_path()); ?>/show/episode/?id=<?php echo $HTML->encode(urlencode($Episode->id())); ?>">
                    <?php echo $HTML->encode($Episode->episodeTitle()); ?></a>
                </td>
                <td><?php echo $HTML->encode($Episode->duration_hms()); ?></td>
                <td>
                <?php 
                    if (strtotime($Episode->episodeDate()) > time() && $Episode->episodeStatus()=='Published') {
                        echo $Lang->get('Will publish on date');
                    }else{
                        if ($Episode->episodeStatus()=='Draft') {
                            echo '<span class="special">'.$HTML->encode($Episode->episodeStatus()).'</span>';
                        }else{
                            echo $HTML->encode($Episode->episodeStatus()); 
                        }
                        
                    }
                ?>
                </td>
                <td><?php echo $HTML->encode(strftime('%d %B %Y', strtotime($Episode->episodeDate()))); ?></td>
                <td><a href="<?php echo $HTML->encode($API->app_path()); ?>/show/delete/?id=<?php echo $HTML->encode(urlencode($Episode->id())); ?>" class="delete inline-delete" data-msg="<?php echo $Lang->get('Delete this episode?'); ?>"><?php echo $Lang->get('Delete'); ?></a></td>
            </tr>

<?php   
    }
?>
        </tbody>
    </table>
<?php      

if ($Paging->enabled()) {
            echo $HTML->paging($Paging);
        }
    } // if episodes
    
    echo $HTML->main_panel_end();

