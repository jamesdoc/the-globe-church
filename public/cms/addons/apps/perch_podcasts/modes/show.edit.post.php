<?php    
    # Side panel
    echo $HTML->side_panel_start();

    echo $HTML->side_panel_end();
    
    
    # Main panel
    echo $HTML->main_panel_start();
    include('_subnav.php');

    if (is_object($Show)) {
        echo $HTML->heading1('Editing options for show ‘%s’', $Show->showTitle());
    }else{
        echo $HTML->heading1('Creating a new show');
    }

    


    if ($message) echo $message; 

    if (is_object($Show)) {
    ?>
        <ul class="smartbar">
            <li><a href="<?php echo PerchUtil::html($API->app_path().'/show/?id='.$Show->id()); ?>"><?php echo $HTML->encode($Show->showTitle()); ?></a></li>
            <li class="selected"><a href="<?php echo PerchUtil::html($API->app_path().'/edit/?id='.$Show->id()); ?>"><?php echo $Lang->get('Show Options'); ?></a></li>
            <li class="fin"><a class="icon download" href="<?php echo PerchUtil::html($API->app_path()); ?>/show/import/?id=<?php echo $Show->id(); ?>"><?php echo $Lang->get('Import'); ?></a></li>
        </ul>

    <?php       
    }



    echo $HTML->heading2('Show details');

    $template_help_html = $Template->find_help();
    if ($template_help_html) {
        echo $HTML->heading2('Help');
        echo '<div id="template-help">' . $template_help_html . '</div>';
    }
    
    
    echo $Form->form_start();
    
        echo $Form->text_field('showTitle', 'Title', isset($details['showTitle'])?$details['showTitle']:false, 'xl', 255, !isset($details['showTitle'])?' data-urlify="showSlug" ':'');
        echo $Form->text_field('showSlug', 'Slug', isset($details['showSlug'])?$details['showSlug']:false, 'xl');
                
        echo $Form->fields_from_template($Template, $details, $Shows->static_fields);

        $opts = array();
        $opts[] = array('label'=>$Lang->get('Uploaded to this website'), 'value'=>'local');
        $opts[] = array('label'=>$Lang->get('Stored remotely (e.g. Amazon S3 or other file hosting service)'), 'value'=>'remote');
        echo $Form->select_field('fileLocation', 'Files for this show are', $opts, isset($options['fileLocation'])?$options['fileLocation']:false);
        
        echo $Form->hint('For files uploaded to this website');
        echo $Form->text_field('fileResourceBucket', 'Resource bucket', isset($options['fileResourceBucket'])?$options['fileResourceBucket']:'default', 'm');

        echo $Form->hint('For files stored remotely');
        echo $Form->text_field('fileDefaultPath', 'Default file location', isset($options['fileDefaultPath'])?$options['fileDefaultPath']:'https://s3.amazonaws.com/bucket/podcast-{episodeNumber}.mp3', 'xl');


        $default = '';
        if (strpos($Settings->get('siteURL')->val(), ':')) {
            $default = $Settings->get('siteURL')->val();
        }else{
            $default = 'http://'.$_SERVER['HTTP_HOST'].'/';
        }

        $default .= 'podcasts/play/{showSlug}/{episodeNumber}.mp3';

        echo $Form->hint('Use the full http:// address');
        echo $Form->text_field('statsURL', 'Default tracked URL', isset($options['statsURL'])?$options['statsURL']:$default, 'xl');


        echo $Form->submit_field('btnSubmit', 'Save', $API->app_path());

    
    echo $Form->form_end();
    
    
    
    echo $HTML->main_panel_end();


?>