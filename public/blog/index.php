<?php include($_SERVER['DOCUMENT_ROOT'] . '/cms/runtime.php'); ?>

<?php perch_layout('global.top'); ?>

<?php perch_layout('global.nav'); ?>

  <main class="main main--blog-grid">
    <?php

			$posts_per_page  = 5;
			$template 		   = 'post_in_list.html';
			$sort_order		   = 'DESC';
			$sort_by		     = 'postDateTime';

      perch_blog_custom(array(
				'template'   => $template,
				'count'      => $posts_per_page,
				'sort'       => $sort_by,
				'sort-order' => $sort_order,
      ));
    ?>
  </main>

<?php perch_layout('global.bottom'); ?>
