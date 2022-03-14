
  <div class="text">
   <p><?php echo T_("Do you know you can connect your account with our Telegram bot"); ?></p>
   <div class="ltr">
    <a href="https://t.me/<?php echo \dash\data::tbBot() ?>?start=sync" target="_blank">@<?php echo \dash\data::tbBot() ?></a>
   </div>
   <p><?php echo T_("Just need to start bot in Telegram and sync your account via /sync."); ?></p>
  </div>

<?php if(\dash\engine\store::inStore()) {?>
  <form method="post" autocomplete="off">
    <input type="hidden" name="ididit" value="yes">
    <div class='flex' id='ego'>
      <button type="submit"><?php echo T_("I did it"); ?></button>
    </div>
  </form>
<?php } // endif ?>

<footer class='f'>
  <a class="link cauto" href="<?php echo \dash\url::here(); ?>/verify"><?php echo T_("Ok"); ?></a>
</footer>
