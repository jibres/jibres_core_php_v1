<?php if(!\dash\data::appQueue_status()) { ?>
<div class="msg info2 fs16"><?php echo T_("Please set general detail about your app, then let us create your android application."); ?></div>

<div class="setupGuide">
 <header><?php echo T_("Setup Progress"); ?></header>
 <section>
  <div class="f">
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_logo()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/logo"><?php echo T_('App Logo');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_title()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/title"><?php echo T_('General Settings');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_splash()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/splash"><?php echo T_('App Splash');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_intro()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/intro"><?php echo T_('App Intro');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_apk()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/review"><?php echo T_('Review Your App');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_download()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/download"><?php echo T_('App Download Page');?></a></div>
  </div>
 </section>
</div>

<div class="welcome">
  <p><?php echo T_("Easily Create your store application"); ?></p>
  <h2><?php echo T_("Create a custom app for your store"); ?></h2>

  <div class="buildBtn">
    <a class="btn xl master" href="<?php echo \dash\url::this(); ?>/logo?setup=wizard"><?php echo T_("Build it now"); ?></a>
  </div>
</div>
<?php } //endif ?>
