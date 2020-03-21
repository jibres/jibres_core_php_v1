<?php if(!\dash\data::appQueue()) {?>
<div class="msg info2 fs16"><?php echo T_("Please set general detail about your app, then ley us create your android application."); ?></div>
<?php } //endif ?>


<div class="setupGuide">
 <header><?php echo T_("Setup Progress"); ?></header>
 <section>
  <div class="f">
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_setting()) { echo 'complete'; } ?>" href="<?php echo \dash\url::that();?>/setting"><?php echo T_('General Settings');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_logo()) { echo 'complete'; } ?>" href="<?php echo \dash\url::that();?>/logo"><?php echo T_('App Logo');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_splash()) { echo 'complete'; } ?>" href="<?php echo \dash\url::that();?>/splash"><?php echo T_('App Splash');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_intro()) { echo 'complete'; } ?>" href="<?php echo \dash\url::that();?>/intro"><?php echo T_('App Intro');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_apk()) { echo 'complete'; } ?>" href="<?php echo \dash\url::that();?>/apk"><?php echo T_('Generate Your App');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_download()) { echo 'complete'; } ?>" href="<?php echo \dash\url::that();?>/download"><?php echo T_('App Download Page');?></a></div>
  </div>
 </section>
</div>


<?php if(!\dash\data::appQueue()) {?>
<div class="welcome">
  <p><?php echo T_("Easily Create your store application"); ?></p>
  <h2><?php echo T_("Create a custom app for your store"); ?></h2>

  <div class="buildBtn">
    <a class="btn xl master" href="<?php echo \dash\url::that(); ?>/setting?setup=wizard"><?php echo T_("Build it now"); ?></a>
  </div>
</div>
<?php } //endif ?>