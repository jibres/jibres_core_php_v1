<?php if(!\dash\user::detail('verifymobile'))  {?>
  <a href="<?php echo \dash\url::kingdom(). '/enter/verify'; ?>" target="_blank" class="msg warn txtC txtB fs14 block"><?php echo T_("Your account is not verify! Please verify your mobile number."); ?></a>
<?php }//endif ?>

<div class="setupGuide">
 <header><?php echo T_("Setup Progress"); ?></header>
 <section>
  <div class="f">
   <div class="c"><a class="item <?php if(\dash\data::profileDetail()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/setup/profile"><?php echo T_('Complete profile');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::profileDetail_nationalpic()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/setup/upload"><?php echo T_('Upload Document');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::ibanDetail()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/setup/iban"><?php echo T_('IBAN');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::gatewayDetail()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/setup/gateway"><?php echo T_('Gateway detail');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_splash()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/setup/verify"><?php echo T_('Verify');?></a></div>

  </div>
 </section>
</div>
<?php if(!\dash\data::profileDetail()) {?>
<div class="welcome">
  <p><?php echo T_("Easily Create your IPG"); ?></p>
  <h2><?php echo T_("Create a custom internet gateway payment"); ?></h2>

  <div class="buildBtn">
    <a class="btn xl master" href="<?php echo \dash\url::this(); ?>/setup/profile?setup=wizard"><?php echo T_("Let's go"); ?></a>
  </div>
</div>
<?php }//endif ?>
