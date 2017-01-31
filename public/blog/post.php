<?php include($_SERVER['DOCUMENT_ROOT'] . '/cms/runtime.php'); ?>

<?php perch_layout('global.top'); ?>

<?php perch_layout('global.nav'); ?>

  <main class="main main--page">

    <article class="blog-post">

      <?php perch_blog_post(perch_get('s')); ?>

      <!--
      <?php perch_blog_author_for_post(perch_get('s')); ?>

      <div class="meta">
        <div class="cats">
            <?php perch_blog_post_categories(perch_get('s')); ?>
        </div>
        <div class="tags">
            <?php perch_blog_post_tags(perch_get('s')); ?>
        </div>
      </div>-->

    </article>

  </main>

<?php perch_layout('global.bottom'); ?>

