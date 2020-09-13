<?php $myData = \dash\data::dashboardDetail(); ?>
<section class="f">
  <div class="c pRa10">
    <a href="<?php echo \dash\url::that(). '/detail?id='. \dash\request::get('id'); ?>" class="stat x70">
      <h3><?php echo T_("Domain Detail");?></h3>
      <div class="val"><?php echo \dash\data::dataRow_domain();?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="<?php echo \dash\url::that(). '/dns?id='. \dash\request::get('id'); ?>" class="stat x70">
      <h3><?php echo T_("DNS Record");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'dns_count'));?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="<?php echo \dash\url::that(). '/log?id='. \dash\request::get('id'); ?>" class="stat x70">
      <h3><?php echo T_("Log");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'log_count'));?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="<?php echo \dash\url::that(). '/setting?id='. \dash\request::get('id'); ?>" class="stat x70">
      <h3><?php echo T_("Setting");?></h3>
      <div class="val"><i class="sf-cogs"></i></div>
    </a>
  </div>

</section>