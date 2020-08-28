<?php if(\dash\data::noChart()) {?>
  <div class="msg warn txtC txtB fs14"><?php echo T_("Can not drow chart for this item!") ?></div>
<?php }else{ ?>


<div id="chartdivpie" class="box chart x400" data-abc='a/form_pie'></div>





<div class="hide">

  <div id="charttitle"><?php echo T_("Answer"); ?></div>
  <div id="chartitemtitle"><?php echo \dash\data::itemDetail_title(); ?></div>
  <div id="chartdata"><?php echo \dash\data::chartdata(); ?></div>
</div>

<?php } //endif ?>