<?php include($_SERVER['DOCUMENT_ROOT'] . '/cms/runtime.php'); ?>

<?php

    $domain = 'http://'.$_SERVER['HTTP_HOST'];
    PerchSystem::set_var('domain', $domain);
    PerchSystem::set_var('PERCH_EMAIL_FROM', PERCH_EMAIL_FROM);
    PerchSystem::set_var('PERCH_EMAIL_FROM_NAME', PERCH_EMAIL_FROM_NAME);


    header('Content-Type: application/rss+xml');

    echo '<'.'?xml version="1.0" encoding="UTF-8"'.'?>';
?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
<channel>
	<?php
		perch_podcasts_show(perch_get('s'), array('template'=>'rss_channel.html'));
		perch_podcasts_episodes(perch_get('s'), array('template'=>'rss_items.html'));
	?>
</channel>
</rss>
