<?php if(!\dash\user::detail('verifymobile'))  {?>
  <a href="<?php echo \dash\url::kingdom(). '/enter/verify'; ?>" target="_blank" class="msg warn txtC txtB fs14 block"><?php echo T_("Your account is not verify! Please verify your mobile number."); ?></a>
<?php }//endif ?>

<div class="setupGuide">
 <header><?php echo T_("Setup Progress"); ?></header>
 <section>
  <div class="f">
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_logo()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/profile"><?php echo T_('Complete profile');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_title()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/title"><?php echo T_('Add your account number');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_splash()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/splash"><?php echo T_('Get API key');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_splash()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/splash"><?php echo T_('Send Documents');?></a></div>

  </div>
 </section>
</div>

<div class="welcome">
  <p><?php echo T_("Easily Create your IPG"); ?></p>
  <h2><?php echo T_("Create a custom internet gateway payment"); ?></h2>

  <div class="buildBtn">
    <a class="btn xl master" href="<?php echo \dash\url::this(); ?>/profile?setup=wizard"><?php echo T_("Let's go"); ?></a>
  </div>
</div>
