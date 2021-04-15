<section class="f" data-option='website-line-filter '>
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
        <a class="btn master" href="<?php echo \dash\url::that(). '/filter  '. \dash\request::full_get(); ?>"><?php echo T_("Set filter") ?></a>
      </div>
  </div>
</section>
