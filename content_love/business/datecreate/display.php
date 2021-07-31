<?php $chart = \dash\data::chartDetail(); ?>
<div id="lovechartdivstoreDay" class="box chart notActive x400" data-abc='love/business_datecreate'></div>
<div id="lovechartdivstoreMonth" class="box chart notActive x400" data-abc='love/business_datecreate'></div>
<div id="lovechartdivstoreYear" class="box chart notActive x400" data-abc='love/business_datecreate'></div>

<div class="hide">

  <div id="chartdivstoreDayloveTitle"><?php echo T_("Count created store per day") ?></div>
  <div id="chartdivstoreDayloveCategory"><?php echo a($chart, 'day', 'categories') ?></div>
  <div id="chartdivstoreDayloveData"><?php echo a($chart, 'day', 'data') ?></div>

  <div id="chartdivstoreMonthloveTitle"><?php echo T_("Count created store per month") ?></div>
  <div id="chartdivstoreMonthloveCategory"><?php echo a($chart, 'month', 'categories') ?></div>
  <div id="chartdivstoreMonthloveData"><?php echo a($chart, 'month', 'data') ?></div>

  <div id="chartdivstoreYearloveTitle"><?php echo T_("Count created store per year") ?></div>
  <div id="chartdivstoreYearloveCategory"><?php echo a($chart, 'year', 'categories') ?></div>
  <div id="chartdivstoreYearloveData"><?php echo a($chart, 'year', 'data') ?></div>
</div>