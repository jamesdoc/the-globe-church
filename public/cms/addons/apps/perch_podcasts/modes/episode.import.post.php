<?php 
    # Side panel
    echo $HTML->side_panel_start();

    
    echo $HTML->side_panel_end();
    
    
    # Main panel
    echo $HTML->main_panel_start();

	include ('_subnav.php');

	# Title panel
    echo $HTML->heading1('Importing Episodes');
    
?>
    <ul class="smartbar">
        <li><a href="<?php echo PerchUtil::html($API->app_path().'/show/?id='.$Show->id()); ?>"><?php echo $HTML->encode($Show->showTitle()); ?></a></li>
        <li><a href="<?php echo PerchUtil::html($API->app_path().'/edit/?id='.$Show->id()); ?>"><?php echo $Lang->get('Show Options'); ?></a></li>
        <li class="selected fin"><a class="icon download" href="<?php echo PerchUtil::html($API->app_path()); ?>/show/import/?id=<?php echo $Show->id(); ?>"><?php echo $Lang->get('Import'); ?></a></li>
    </ul>



<?php



    if (!$importing) {

        echo $Form->form_start('import', 'magnetic-save-bar');

        echo $Form->text_field('url', 'RSS URL', '', 'xl', false, ' placeholder="http://" ');


        echo $Form->submit_field('btnSubmit', 'Import', $API->app_path());


        echo $Form->form_end();



    }


    
     
    echo $HTML->main_panel_end();


?>