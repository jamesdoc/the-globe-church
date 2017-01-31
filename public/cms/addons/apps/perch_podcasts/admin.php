<?php
	if ($CurrentUser->logged_in() && $CurrentUser->has_priv('perch_podcasts')) {
	    $this->register_app('perch_podcasts', 'Podcasts', 2, 'Podcast management', '1.2');
	    $this->require_version('perch_podcasts', '2.8.18');
	    $this->add_create_page('perch_podcasts', 'edit');
	}
