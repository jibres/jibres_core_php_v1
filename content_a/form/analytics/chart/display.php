<?php require_once(root. 'content_a/form/analytics/pageStep.php'); ?>

<div id="chartdiv" class="box chart notActive x600" data-abc='a/form_analyze'></div>


<div class="hide">
  <div id="charttitle"><?php echo T_("Funnel chart"); ?></div>
  <div id="chartitemtitle"></div>
  <div id="chartdata"><?php echo \dash\data::chartDetail(); ?></div>
</div>
