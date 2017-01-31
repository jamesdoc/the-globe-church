<?php include($_SERVER['DOCUMENT_ROOT'] . '/cms/runtime.php'); ?>

<?php perch_layout('global.top'); ?>

<?php perch_layout('global.nav'); ?>

	<main class="main">
		<?php perch_podcasts_show('preaching'); ?>

		<?php perch_podcasts_episodes('preaching'); ?>

	</main>

<?php perch_layout('global.bottom'); ?>
