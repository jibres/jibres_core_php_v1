<?php require_once(root. 'content_a/android/setupGuide.php'); ?>

<div class="f">
  <div class="c8 x9 s12 pRa10">
    <div class="f">
      <div class="c pRa5">
        <a href="" class="stat">
          <h3><?php echo T_("Total Download");?></h3>
          <div class="val"><?php echo \dash\fit::number(5000);?></div>
        </a>
      </div>
      <div class="c pRa5">
        <div class="stat">
          <h3><?php echo T_("Total Install");?></h3>
          <div class="val"><?php echo \dash\fit::number(3600);?></div>
        </div>
      </div>
      <div class="c">
        <div class="stat">
          <h3><?php echo T_("Active Install");?></h3>
          <div class="val"><?php echo \dash\fit::number(1200);?></div>
        </div>
      </div>
    </div>


    <div class="dcard x3 pA0">
     <div id="chartdiv" class="chart" ></div>
    </div>
  </div>

  <div class="c4 x3 s12">

   <nav class="pwaItems">
     <ul>
       <li>
        <a class="f align-center" href="<?php echo \dash\url::this(); ?>/domain">
         <div class="key"><?php echo T_("Domain Center"); ?></div>
         <div class="go"></div>
        </a>
       </li>

       <li>
        <a class="f align-center" href="<?php echo \dash\url::this(); ?>/store">
         <div class="key"><?php echo T_("Stores"); ?></div>
         <div class="go"></div>
        </a>
       </li>

       <li><a class="f <?php if(\dash\data::setupGuide_logo()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/logo"><div class="key"><?php echo T_('App Logo');?></div><div class="go"></div></a></li>
       <li><a class="f <?php if(\dash\data::setupGuide_setting()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/setting"><div class="key"><?php echo T_('General Settings');?></div><div class="go"></div></a></li>
       <li><a class="f <?php if(\dash\data::setupGuide_splash()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/splash"><div class="key"><?php echo T_('App Splash');?></div><div class="go"></div></a></li>
       <li><a class="f <?php if(\dash\data::setupGuide_intro()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/intro"><div class="key"><?php echo T_('App Intro');?></div><div class="go"></div></a></li>
       <li><a class="f <?php if(\dash\data::setupGuide_apk()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/review"><div class="key"><?php echo T_('Review Your App');?></div><div class="go"></div></a></li>
       <li><a class="f <?php if(\dash\data::setupGuide_download()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/download"><div class="key"><?php echo T_('App Download Page');?></div><div class="go"></div></a></li>
       <li><a class="f <?php if(\dash\data::setupGuide_download()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/apk"><div class="key"><?php echo T_('Download your App');?></div><div class="go"></div></a></li>
     </ul>
   </nav>
  </div>
</div>

