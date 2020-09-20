
<section class="f">
  <div class="c pRa10">
    <a href="<?php echo \dash\url::that(). '/filter?'. \dash\request::fix_get(); ?>" class="stat x70 <?php if(\dash\url::subchild() === 'filter') { echo 'active'; } ?>">
      <h3><?php echo T_("Filter list");?></h3>
      <div class="val"><i class="sf-filter"></i></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="<?php echo \dash\url::that(). '/addcondition?'. \dash\request::fix_get() ?>" class="stat x70 <?php if(\dash\url::subchild() === 'addcondition') { echo 'active'; } ?>">
      <h3><?php echo T_("Manage filter");?></h3>
      <div class="val"><i class="sf-cogs"></i></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="<?php echo \dash\url::that(). '/table?'. \dash\request::fix_get() ?>" class="stat x70 <?php if(\dash\url::subchild() === 'table') { echo 'active'; } ?>">
      <h3><?php echo T_("Show records");?></h3>
      <div class="val"><i class="sf-table"></i></div>
    </a>
  </div>
  <div class="c">
    <a href="<?php echo \dash\url::that(). '/chart?'. \dash\request::fix_get(); ?>" class="stat x70 <?php if(\dash\url::subchild() === 'chart') { echo 'active'; } ?>">
      <h3><?php echo T_("Chart");?></h3>
      <div class="val"><i class="sf-chart"></i></div>
    </a>
  </div>


</section>