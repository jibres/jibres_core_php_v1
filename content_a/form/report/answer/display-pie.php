<div class="row">
  <div class="c-xs-12 c-6">
    <div id="chartdivpie" class="box chart notActive x400" data-abc='a/form_charts'></div>

  </div>
  <div class="c-xs-12 c-6">
    <div id="chartdivbar" class="box chart notActive x400" data-abc='a/form_charts'></div>

  </div>
</div>

<?php require_once('display-table.php') ?>




<div class="hide">

  <div id="charttitle"><?php echo T_("Answer"); ?></div>
  <div id="chartitemtitle"></div>
  <div id="chartdata"><?php echo \dash\data::reportDetail_chart(); ?></div>
</div>
