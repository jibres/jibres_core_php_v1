<?php $lineSetting = \dash\data::lineSetting(); ?>
<?php require_once(root. 'content_a/website/display-title.php') ?>

<section class="f" data-option='website-line-news-filter'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set filter");?></h3>
      <div class="body">
        <p><?php echo T_("You can extract your favorite posts with different filters");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
      <div class="action">
        <a class="btn master" href="<?php echo \dash\url::that(). '/filter'. \dash\request::full_get(); ?>"><?php echo T_("Set filter") ?></a>
      </div>
  </div>
</section>

<section class="f" data-option='website-line-design'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Setup design");?></h3>
      <div class="body">

      </div>
    </div>
  </div>
  <div class="c4 s12">
      <div class="action">
        <a class="btn master" href="<?php echo \dash\url::that(). '/design'. \dash\request::full_get(); ?>"><?php echo T_("Setup design") ?></a>
      </div>
  </div>
</section>


<?php require_once(root. 'content_a/website/display-limit.php') ?>


<section class="f" data-option='website-line-news-remove'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Remove news line");?></h3>
      <div class="body">
        <p><?php echo T_("Are you sure to remove this news line?");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
      <div class="action">
        <div data-confirm data-data='{"remove": "line", "edit_line" : "setting", "id": "<?php echo \dash\request::get('id'); ?>"}' class="btn danger"><?php echo T_("Remove"); ?></div>
      </div>
  </div>
</section>