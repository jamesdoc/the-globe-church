<?php
	echo $HTML->subnav($CurrentUser, array(
		array('page'=>array(
					'perch_podcasts',
					'perch_podcasts/delete',
					'perch_podcasts/edit',
					'perch_podcasts/show',
					'perch_podcasts/show/import',
					'perch_podcasts/show/episode',
			), 'label'=>'Shows'),
		array('page'=>array(
					'perch_podcasts/stats',
			), 'label'=>'Stats'),
		
	));
?>