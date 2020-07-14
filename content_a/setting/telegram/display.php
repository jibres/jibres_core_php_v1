
<section class="f" data-option='telegram-setting-bot-apikey'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set Telegram Bot APIKEY");?></h3>
      <div class="body">
        <p><?php echo T_("To connect your business to Telegram Bot you must set the Bot APIKEY");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12" >
      <div class="action">
      	<?php if(\dash\data::telegramSettingSaved_apikey()) {?>
        	<a class="btn success" href="<?php echo \dash\url::that(). '/bot' ?>"><?php echo T_("Change Telegram Bot APIKEY") ?></a>
      	<?php }else{ ?>
        	<a class="btn primary" href="<?php echo \dash\url::that(). '/bot' ?>"><?php echo T_("Set Telegram Bot APIKEY") ?></a>
      	<?php } // endif ?>
      </div>
  </div>
</section>

<section class="f" data-option='telegram-setting-channel-apikey'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set Telegram Channel");?></h3>
      <div class="body">
        <p><?php echo T_("To connect your business to Telegram Channel you must set the Channel");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12" >
      <div class="action">
      	<?php if(\dash\data::telegramSettingSaved_channel()) {?>
        	<a class="btn success" href="<?php echo \dash\url::that(). '/channel' ?>"><?php echo T_("Change Telegram Channel") ?></a>
      	<?php }else{ ?>
        	<a class="btn primary" href="<?php echo \dash\url::that(). '/channel' ?>"><?php echo T_("Set Telegram Channel") ?></a>
      	<?php } // endif ?>
      </div>
  </div>
</section>

<section class="f" data-option='telegram-setting-text-apikey'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set Telegram Share Text");?></h3>
      <div class="body">
        <p><?php echo T_("To connect your business to Telegram Channel you must set the Channel");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12" >
      <div class="action">
        <?php if(\dash\data::telegramSettingSaved_text()) {?>
          <a class="btn success" href="<?php echo \dash\url::that(). '/text' ?>"><?php echo T_("Change Telegram Text") ?></a>
        <?php }else{ ?>
          <a class="btn primary" href="<?php echo \dash\url::that(). '/text' ?>"><?php echo T_("Set Telegram Text") ?></a>
        <?php } // endif ?>
      </div>
  </div>
</section>