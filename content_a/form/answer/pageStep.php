
<section class="f hide">
  <div class="c pRa10">
    <a href="<?php echo \dash\url::that(). '/detail?'. \dash\request::fix_get(); ?>" class="stat x70 <?php if(\dash\url::subchild() === 'detail') { echo 'active'; } ?>">
      <h3><?php echo T_("Show detail");?></h3>
      <div class="val"><i class="sf-list-ul"></i></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="<?php echo \dash\url::that(). '/addcondition?'. \dash\request::fix_get(['field' => null]) ?>" class="stat x70 <?php if(\dash\url::subchild() === 'addcondition') { echo 'active'; } ?>">
      <h3><?php echo T_("Add tag");?></h3>
      <div class="val"><i class="sf-filter"></i></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="<?php echo \dash\url::that(). '/table?'. \dash\request::fix_get(['field' => null]) ?>" class="stat x70 <?php if(\dash\url::subchild() === 'table') { echo 'active'; } ?>">
      <h3><?php echo T_("Show records");?></h3>
      <div class="val"><i class="sf-table"></i></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="<?php echo \dash\url::that(). '/chart?'. \dash\request::fix_get(['field' => null, 'inside' => 1]); ?>" class="stat x70 <?php if(\dash\url::subchild() === 'chart') { echo 'active'; } ?>">
      <h3><?php echo T_("Chart");?></h3>
      <div class="val"><i class="sf-chart"></i></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="<?php echo \dash\url::that(). '/chart?'. \dash\request::fix_get(['field' => null, 'inside' => null]); ?>" class="stat x70 <?php if(\dash\url::subchild() === 'chart') { echo 'active'; } ?>">
      <h3><?php echo T_("Chart inside");?></h3>
      <div class="val"><i class="sf-chart"></i></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="<?php echo \dash\url::that(). '/chart2?'. \dash\request::fix_get(['field' => null, 'inside' => null]); ?>" class="stat x70 <?php if(\dash\url::subchild() === 'chart2') { echo 'active'; } ?>">
      <h3><?php echo T_("Chart");?></h3>
      <div class="val"><i class="sf-chart"></i></div>
    </a>
  </div>

  <div class="c ">
    <a href="<?php echo \dash\url::that(). '/setting?'. \dash\request::fix_get(['field' => null]); ?>" class="stat x70 <?php if(\dash\url::subchild() === 'setting') { echo 'active'; } ?>">
      <h3><?php echo T_("Action");?></h3>
      <div class="val"><i class="sf-cogs"></i></div>
    </a>
  </div>


</section>