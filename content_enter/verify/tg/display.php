
  <div class="text">
   <p><?php echo T_("Do you know you can connect your account with our Telegram bot"); ?></p>
   <div class="ltr">
    <a href="https://t.me/<?php echo \dash\data::tbBot() ?>?start=sync" target="_blank">@<?php echo \dash\data::tbBot() ?></a>
   </div>
   <p><?php echo T_("Just need to start bot in Telegram and sync your account via /sync."); ?></p>
  </div>

<?php if(\dash\engine\store::inStore()) {?>
      <div data-ajaxify data-method='post' data-data='{"ididit" : "yes"}' class="btn-primary block" type="submit"><?php echo T_("I did it"); ?></div>
<?php } // endif ?>

  <a class="link block mt-2" href="<?php echo \dash\url::here(); ?>/verify?n=1"><?php echo T_("Ok"); ?></a>



<a class="block link" href="<?php echo \dash\url::kingdom(); ?>/enter"><?php echo T_("Restart with new mobile"); ?></a>