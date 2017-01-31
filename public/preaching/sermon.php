<?php include($_SERVER['DOCUMENT_ROOT'] . '/cms/runtime.php'); ?>

<?php perch_layout('global.top'); ?>

<?php perch_layout('global.nav'); ?>

  <main class="main main--page">

    <article class="blog-post">
			<?php perch_podcasts_episode("preaching", perch_get('ep')); ?>
		</article>

	</main>

<?php perch_layout('global.bottom'); ?>
