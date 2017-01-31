<?php include($_SERVER['DOCUMENT_ROOT'] . '/cms/runtime.php'); ?>

<?php perch_layout('global.top'); ?>

<?php perch_layout('global.nav'); ?>

  <main class="main">

    <div>
      <?php $series = 'series/' . perch_get('s'); ?>
      <?php perch_category($series) ?>
    </div>

    <?php perch_content_custom('yo', array(
      'category' => $series,
      'template' => 'episode.htm',
    )); ?>

    <?php
    perch_podcasts_episodes('preaching', array(
      'paginate' => true,
      'page-links' => true,
      'count' => 3,
      'filter'=> perch_get('s'),
      'template' => 'episodes_list.html',
    ));
    ?>

  </main>

<?php perch_layout('global.bottom'); ?>
