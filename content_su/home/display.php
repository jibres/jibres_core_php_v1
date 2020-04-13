
<?php if(\dash\data::gitHaveChange()) {?>

<a href="<?php echo \dash\url::here(); ?>/gitstatus" class=" msg danger fs18 block txtC"><?php echo T_("Some code was changed!!!"); ?></a>

<?php } //endif ?>

<div class="cbox pA0">
    <div class="chart x400" id='usageChart'></div>
</div>

<div class="f">
 <div class="c8 s12">
 	<div class="f">
		 <div class="c12">

      <div class="dcard x1">
       <div class="statistic sm olive">
        <div class="value mB10"><i class="mRa5 sf-heart"></i> <?php echo T_("Uptime"); ?></div>
        <div class="label ltr"><?php echo \dash\data::su_uptime(); ?></div>
       </div>
      </div>

     </div>
		 <div class="c6">


      <div class="dcard x1">
       <div class="statistic sm">
        <div class="value mB10"><?php echo \dash\data::su_disk(); ?></div>
        <div class="label"><i class="mRa5 sf-battery-full"></i> <?php echo T_("Disk space"); ?></div>
       </div>
      </div>

     </div>
		 <div class="c6">

      <div class="dcard x1">
       <div class="statistic sm">
        <div class="value mB10"><?php echo \dash\data::su_diskFree(); ?></div>
        <div class="label"><i class="mRa5 sf-battery-half"></i> <?php echo T_("Disk Free space"); ?></div>
       </div>
      </div>

     </div>
 	</div>
 </div>
 <div class="c4 s12">

   <a class="dcard x2" href="<?php echo \dash\url::here(); ?>/update">
    <div class="statistic blue">
      <div class="value"><span><?php echo \dash\fit::date_human(\dash\data::su_lastUpdate()); ?></span></div>
      <div class="label"><?php echo T_("Last update"); ?></div>
    </div>
  </a>


 </div>

</div>



<script>
  <?php require_once (root. 'content_su/home/chart.js'); ?>
</script>


