<?php    
    # Side panel
    echo $HTML->side_panel_start();

    echo $HTML->side_panel_end();
    
    
    # Main panel
    echo $HTML->main_panel_start();
    include('_subnav.php');

    if (is_object($Episode)) {
        echo $HTML->heading1('Editing episode ‘%s’', $Episode->episodeTitle());
    }else{
        echo $HTML->heading1('Creating a new episode for show ‘%s’', $Show->showTitle());
    }

    


    if ($message) echo $message; 

    if (is_object($Show)) {
    ?>
        <ul class="smartbar">
            <li class="selected">
                <span class="set">
                    <a class="sub" href="<?php echo PerchUtil::html($API->app_path().'/show/?id='.$Show->id()); ?>"><?php echo $HTML->encode($Show->showTitle()); ?></a>
                    <span class="sep icon"></span>
                        <?php 
                            if (is_object($Episode)) {
                                echo '<a href="'. PerchUtil::html($API->app_path().'/show/episode/?id='.$Episode->id()).'">';
                                echo $HTML->encode($Lang->get('Episode %s', $Episode->episodeNumber())); 
                                echo '</a>';
                            }else{
                                echo '<a href="'. PerchUtil::html($API->app_path().'/show/episode/?show='.$Show->id()).'">';
                                echo $Lang->get('New episode');
                                echo '</a>';
                            }
                            ?>
                    
                </span>
            </li>
            <li><a href="<?php echo PerchUtil::html($API->app_path().'/edit/?id='.$Show->id()); ?>"><?php echo $Lang->get('Show Options'); ?></a></li>
            <li class="fin"><a class="icon download" href="<?php echo PerchUtil::html($API->app_path()); ?>/show/import/?id=<?php echo $Show->id(); ?>"><?php echo $Lang->get('Import'); ?></a></li>
        </ul>

    <?php       
    }



    echo $HTML->heading2('Episode details');

    $template_help_html = $Template->find_help();
    if ($template_help_html) {
        echo $HTML->heading2('Help');
        echo '<div id="template-help">' . $template_help_html . '</div>';
    }
    
    
    echo $Form->form_start();
    
        echo $Form->text_field('episodeTitle', 'Title', isset($details['episodeTitle'])?$details['episodeTitle']:false, 'xl');
        echo $Form->date_field('episodeDate', 'Date', isset($details['episodeDate'])?$details['episodeDate']:false, 'xl');
                        
        echo $Form->fields_from_template($Template, $details, array('episodeTitle', 'episodeSlug', 'episodeDynamicFields', 'episodeDuration', 'episodeFileSize', 'episodeTrackedURL', 'episodeDate'));

        $opts = array();
        $opts[] = array('label'=>'Draft', 'value'=>'Draft');
        $opts[] = array('label'=>'Published', 'value'=>'Published');
        echo $Form->select_field('episodeStatus', 'Status', $opts, isset($details['episodeStatus'])?$details['episodeStatus']:'Published');


        echo $HTML->heading2('Audio file');


        

        if ($Show->get_option('fileLocation')=='local') {
            echo $Form->image_field('upload', 'File', false);
            echo $Form->hidden('episodeFile', isset($details['episodeFile'])?$details['episodeFile']:'');
        }else{
            $default = false;
            $default_path = $Show->get_option('fileDefaultPath');
            if ($default_path) {
                $default = preg_replace_callback('/{([A-Za-z0-9_\-]+)}/', function($matches) use ($details, $show){
                    if (isset($details[$matches[1]])){
                        return $details[$matches[1]];
                    }
                    if (isset($show[$matches[1]])){
                        return $show[$matches[1]];
                    }
                }, $default_path);
            }
        
            echo $Form->text_field('episodeFile', 'File', isset($details['episodeFile'])?$details['episodeFile']:$default, 'xl');
        }

        $default = false;
        $default_url = $Show->get_option('statsURL');
        if ($default_url) {
            $default = preg_replace_callback('/{([A-Za-z0-9_\-]+)}/', function($matches) use ($details, $show){
                if (isset($details[$matches[1]])){
                    return $details[$matches[1]];
                }

                if (isset($show[$matches[1]])){
                    return $show[$matches[1]];
                }
            }, $default_url);
        }
    
        if (isset($details['episodeTrackedURL']) && $details['episodeTrackedURL']!=''){
            $default = $details['episodeTrackedURL']; 
        }

        echo $Form->text_field('episodeTrackedURL', 'Tracked URL', $default, 'xl');



        
        echo $Form->hint('hh:mm:ss - leave blank to auto-detect');
        echo $Form->text_field('episodeDuration', 'Duration', isset($details['episodeDuration'])?$Episode->duration_hms():false, 'm');



        echo $Form->hint('bytes - leave blank to auto-detect');
        echo $Form->text_field('episodeFileSize', 'File size', isset($details['episodeFileSize'])?$details['episodeFileSize']:false, 'm');






        if (is_object($Episode) && isset($details['episodeFile'])) {
            echo '<div class="field">';
            echo $Form->label('xplayer', 'Listen');
            echo $Episode->html5AudioTag();
            echo '</div>';
        }

        echo $Form->submit_field('btnSubmit', 'Save', $API->app_path());

    
    echo $Form->form_end();
    
    
    
    echo $HTML->main_panel_end();


?>