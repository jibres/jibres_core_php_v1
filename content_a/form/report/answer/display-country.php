
    <div id="chartdivcountry" class="box chart x600 notActive" data-abc='a/form_mapcountry'></div>

<?php require_once('display-table.php') ?>

<div class="hide">

  <div id="charttitle"><?php echo T_("Answer"); ?></div>
  <div id="chartitemtitle"></div>
  <div id="chartdata"><?php echo \dash\data::reportDetail_chart(); ?></div>
</div>
