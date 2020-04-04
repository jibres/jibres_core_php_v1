<?php require_once(root. 'content_a/android/setupGuide.php'); ?>

<?php if(\dash\data::appQueue_status()) { ?>

<div class="f">
  <div class="c8 x9 s12 pRa10">
    <div class="f">
      <div class="c pRa10">
        <a href="" class="stat">
          <h3><?php echo T_("Total Download");?></h3>
          <div class="val"><?php echo \dash\fit::number(\dash\data::stat_totalDownload());?></div>
        </a>
      </div>
      <div class="c pRa10">
        <div class="stat">
          <h3><?php echo T_("Total Install");?></h3>
          <div class="val"><?php echo \dash\fit::number('-');?></div>
        </div>
      </div>
      <div class="c">
        <div class="stat">
          <h3><?php echo T_("Active Install");?></h3>
          <div class="val"><?php echo \dash\fit::number('-');?></div>
        </div>
      </div>
    </div>

    <div id="chartdiv" class="box chart x240"></div>
  </div>

  <div class="c4 x3 s12">
   <nav class="items">
     <ul>
       <li>
        <a class="f <?php if(\dash\data::setupGuide_apk()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/apk">
          <div class="key"><?php echo T_('Download your App');?></div>
          <div class="go"></div></a>
       </li>
       <li>
        <a class="f <?php if(\dash\data::setupGuide_download()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/download">
          <div class="key"><?php echo T_('App Download Page');?></div>
          <div class="go"></div></a>
       </li>
       <li>
        <a class="f <?php if(\dash\data::setupGuide_logo()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/logo">
          <div class="key"><?php echo T_('App Logo');?></div>
          <div class="go"></div></a>
       </li>
       <li>
        <a class="f <?php if(\dash\data::setupGuide_title()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/title">
          <div class="key"><?php echo T_('App Title');?></div>
          <div class="go"></div></a>
       </li>
       <li>
        <a class="f <?php if(\dash\data::setupGuide_splash()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/splash">
          <div class="key"><?php echo T_('App Splash');?></div>
          <div class="go"></div></a>
       </li>
       <li>
        <a class="f <?php if(\dash\data::setupGuide_intro()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/intro">
          <div class="key"><?php echo T_('App Intro');?></div>
          <div class="go"></div></a>
       </li>
       <li>
        <a class="f <?php if(\dash\data::setupGuide_review()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/review">
          <div class="key"><?php echo T_('Review Your App');?></div>
          <div class="go"></div></a>
       </li>
     </ul>
   </nav>
  </div>
</div>

<div class="f">
  <div class="c pRa10">
    <a href="" class="stat">
      <h3><?php echo T_("Download last week");?></h3>
      <div class="val"><?php echo \dash\fit::number(\dash\data::stat_totalDownloadLastWeek());?></div>
    </a>
  </div>
  <div class="c pRa10">
    <div class="stat">
      <h3><?php echo T_("Download last month");?></h3>
      <div class="val"><?php echo \dash\fit::number(\dash\data::stat_totalDownloadLastMonth());?></div>
    </div>
  </div>
  <div class="c pRa10">
    <div class="stat">
      <h3><?php echo T_("Download last year");?></h3>
      <div class="val"><?php echo \dash\fit::number(\dash\data::stat_totalDownloadLastYear());?></div>
    </div>
  </div>

  <div class="c pRa10">
    <div class="stat">
      <h3><?php echo T_("Install last week");?></h3>
      <div class="val"><?php echo \dash\fit::number('-');?></div>
    </div>
  </div>

  <div class="c">
    <div class="stat">
      <h3><?php echo T_("Install last month");?></h3>
      <div class="val"><?php echo \dash\fit::number('-');?></div>
    </div>
  </div>
</div>

<div class="box chart x350" id="charttotaldownload"></div>

<?php } //endif ?>


<div class="hide">
  <div id="chart1title"><?php echo T_("Total new download application per day"); ?></div>
  <div id="chart1category"><?php echo \dash\get::index(\dash\data::dashboardData(), 'categories'); ?></div>
  <div id="charttitlecount"><?php echo T_("Count"); ?></div>
  <div id="chart1count"><?php echo \dash\get::index(\dash\data::dashboardData(), 'count'); ?></div>

  <div id="chart2title"><?php echo T_("Total Download application per day"); ?></div>
  <div id="chart2category"><?php echo \dash\get::index(\dash\data::dashboardData(), 'categories'); ?></div>
  <div id="chart2countall"><?php echo \dash\get::index(\dash\data::dashboardData(), 'count_all'); ?></div>
</div>

