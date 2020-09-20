<?php require_once(root. 'content_a/form/analytics/pageStep.php'); ?>

<div id="chartdiv" class="box chart notActive x600" data-abc='a/form_analyze'></div>


<div class="hide">
  <div id="charttitle"><?php  T_("Filter chart"); ?></div>
  <div id="chartunit"><?php  T_("Count"); ?></div>
  <div id="chartitemtitle"></div>
  <div id="chartdata"><?php echo \dash\data::chartDetail(); ?></div>
</div>
