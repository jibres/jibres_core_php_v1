
<?php if(\dash\data::gitHaveChange() && !\dash\url::isLocal()) {?>

<a href="<?php echo \dash\url::here(); ?>/gitstatus" class=" msg danger fs18 block txtC"><?php echo T_("Some code was changed!!!"); ?></a>

<?php } //endif ?>

<div class="cbox pA0">
    <div class="chart x310" id='usageChart' data-abc='su/live_monitor'></div>
</div>
<div class="hide">
  <div id="hereurl"><?php echo \dash\url::here() ?></div>
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

<div class="row">

  <div class="c-xs-12 c-sm-12 c-md-4">

    <nav class="items">
     <ul>
      <li>
          <a class="f" href="<?php echo \dash\url::here(); ?>/update">
            <div class="key"><?php echo T_('Update');?></div>
            <div class="go"></div>
          </a>
       </li>

       <li>
          <a class="f" href="<?php echo \dash\url::here(); ?>/backup">
            <div class="key"><?php echo T_('Backup');?></div>
            <div class="go"></div>
          </a>
       </li>
       <li>
          <a class="f" href="<?php echo \dash\url::here();?>/dbtables">
            <div class="key"><?php echo T_('Raw table');?></div>
            <div class="go"></div>
          </a>
       </li>
       <li>
          <a class="f" href="<?php echo \dash\url::here();?>/info">
            <div class="key"><?php echo T_('Server information');?></div>
            <div class="go"></div>
          </a>
       </li>
       <li>
          <a class="f" href="<?php echo \dash\url::here();?>/cronjob">
            <div class="key"><?php echo T_('Cronjob');?></div>
            <div class="go"></div>
          </a>
       </li>
       <li>
          <a class="f" href="<?php echo \dash\url::here();?>/server">
            <div class="key"><?php echo T_('Server');?></div>
            <div class="go"></div>
          </a>
       </li>
     </ul>
   </nav>

  </div>

  <div class="c-xs-12 c-sm-12 c-md-4">


    <nav class="items">
     <ul>
       <li>

          <a class="f" href="<?php echo \dash\url::here(); ?>/ip">
            <div class="key"><?php echo T_('IP');?></div>
            <div class="go"></div>
          </a>
       </li>
       <li>
          <a class="f" href="<?php echo \dash\url::here();?>/gitstatus">
            <div class="key"><?php echo T_('Git status');?></div>
            <div class="go"></div>
          </a>
       </li>
       <li>
          <a class="f" href="<?php echo \dash\url::here();?>/nano">
            <div class="key"><?php echo T_('Nano');?></div>
            <div class="go"></div>
          </a>
       </li>
       <li>
          <a class="f" href="<?php echo \dash\url::here();?>/log">
            <div class="key"><?php echo T_('Log');?></div>
            <div class="go"></div>
          </a>
       </li>
       <li>
          <a class="f" href="<?php echo \dash\url::here();?>/session">
            <div class="key"><?php echo T_('Session');?></div>
            <div class="go"></div>
          </a>
       </li>
       <li>
          <a class="f" href="<?php echo \dash\url::here();?>/shorturl">
            <div class="key"><?php echo T_('Short url');?></div>
            <div class="go"></div>
          </a>
       </li>
     </ul>
   </nav>


  </div>

  <div class="c-xs-12 c-sm-12 c-md-4">



    <nav class="items">
     <ul>
       <li>

          <a class="f" href="<?php echo \dash\url::here(); ?>/tempfile">
            <div class="key"><?php echo T_('Temp file');?></div>
            <div class="go"></div>
          </a>
       </li>
       <li>
          <a class="f" href="<?php echo \dash\url::here();?>/apilog">
            <div class="key"><?php echo T_('Api Log');?></div>
            <div class="go"></div>
          </a>
       </li>
       <li>
          <a class="f" href="<?php echo \dash\url::here();?>/smsclient">
            <div class="key"><?php echo T_('Sms client');?></div>
            <div class="go"></div>
          </a>
       </li>
       <?php if(\dash\url::isLocal()) {?>
       <li>
          <a class="f" href="<?php echo \dash\url::here();?>/permission">
            <div class="key"><?php echo T_('Permission');?></div>
            <div class="go"></div>
          </a>
       </li>
      <?php } //endif ?>

       <li>
          <a class="f" href="<?php echo \dash\url::here();?>/tg">
            <div class="key"><?php echo T_('Telegram');?></div>
            <div class="go"></div>
          </a>
       </li>

        <li>
          <a class="f" href="<?php echo \dash\url::here();?>/processlist">
            <div class="key"><?php echo T_('Show mysql process list');?></div>
            <div class="go"></div>
          </a>
       </li>


     </ul>
   </nav>

  </div>
</div>
