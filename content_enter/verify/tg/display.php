
  <div class="text">
   <p><?php echo T_("Do you know you can connect your account with our Telegram bot"); ?></p>
   <a href="https://t.me/<?php echo \dash\data::tbBot() ?>?start=sync" target="_blank">@<?php echo \dash\data::tbBot() ?></a>
   <p><?php echo T_("Just need to start bot in Telegram and sync your account via /sync."); ?></p>
  </div>

<footer class='f'>
  <a class="link cauto" href="<?php echo \dash\url::here(); ?>/verify"><?php echo T_("Ok"); ?></a>
</footer>
