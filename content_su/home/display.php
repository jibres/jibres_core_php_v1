
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


<nav class="font-12">
    <a class="btn outline mA5" href="<?php echo \dash\url::here(); ?>/backup"><?php echo T_("Backup"); ?></a>
    <a class="btn outline mA5" href="<?php echo \dash\url::here(); ?>/dbtables"><?php echo T_("Raw table"); ?></a>

    <a class="btn outline mA5" href="<?php echo \dash\url::here(); ?>/time"><?php echo T_("Date and time"); ?></a>
    <a class="btn outline mA5" href="<?php echo \dash\url::here(); ?>/info"><?php echo T_("Server information"); ?></a>
    <a class="btn outline mA5" href="<?php echo \dash\url::here(); ?>/cronjob"><?php echo T_("Cronjob"); ?></a>
    <a class="btn outline mA5" href="<?php echo \dash\url::here(); ?>/ip"><?php echo T_("IP"); ?></a>

    <a class="btn outline mA5" href="<?php echo \dash\url::here(); ?>/gitstatus"><?php echo T_("Git status"); ?></a>
    <a class="btn outline mA5" href="<?php echo \dash\url::here(); ?>/nano"><?php echo T_("Nano"); ?></a>
    <a class="btn outline mA5" href="<?php echo \dash\url::here(); ?>/update" data-shortkey="85+80" data-shortkey-timeout='500'><?php echo T_("Update"); ?><kbd class="floatLa mRa10 fs08">up</kbd></a>

    <a class="btn outline mA5" href="<?php echo \dash\url::here(); ?>/log"><?php echo T_("Log"); ?></a>
    <a class="btn outline mA5" href="<?php echo \dash\url::here(); ?>/tempfile"><?php echo T_("Temp file"); ?></a>
    <a class="btn outline mA5" href="<?php echo \dash\url::here(); ?>/apilog"><?php echo T_("Api Log"); ?></a>
    <a class="btn outline mA5" href="<?php echo \dash\url::here(); ?>/smsclient"><?php echo T_("Sms client"); ?></a>

    <?php if(\dash\url::isLocal()) {?>

    <a class="btn outline mA5" href="<?php echo \dash\url::here(); ?>/permission"><?php echo T_("Permission"); ?></a>

    <?php } //endif ?>

    <a class="btn outline mA5" href="<?php echo \dash\url::here(); ?>/tg" data-shortkey="84+71" data-shortkey-timeout='500'><?php echo T_("Telegram"); ?><kbd class="floatLa mRa10 fs08">tg</kbd></a>

</nav>







