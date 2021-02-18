
<section class="f" data-option='telegram-setting-bot-apikey'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set Telegram Bot APIKEY");?></h3>
      <div class="body">
        <p><?php echo T_("It is possible to connect your business to your own custom Telegram robot. To do this, you must first create a telegram robot and provide the connection key to Jibres");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12" >
      <div class="action">
      	<?php if(\dash\data::telegramSettingSaved_apikey()) {?>
        	<a class="btn secondary" href="<?php echo \dash\url::that(). '/bot' ?>"><?php echo T_("Change Telegram Bot APIKEY") ?></a>
      	<?php }else{ ?>
        	<a class="btn secondary" href="<?php echo \dash\url::that(). '/bot' ?>"><?php echo T_("Set Telegram Bot APIKEY") ?></a>
      	<?php } // endif ?>
      </div>
  </div>
</section>

<section class="f" data-option='telegram-setting-channel-apikey'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set Telegram Channel");?></h3>
      <div class="body">
        <p><?php echo T_("You can easily share products in your Telegram channel. To do this, introduce your Telegram channel ID to us.");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12" >
      <div class="action">
      	<?php if(\dash\data::telegramSettingSaved_channel()) {?>
        	<a class="btn secondary" href="<?php echo \dash\url::that(). '/channel' ?>"><?php echo T_("Change Telegram Channel") ?></a>
      	<?php }else{ ?>
        	<a class="btn secondary" href="<?php echo \dash\url::that(). '/channel' ?>"><?php echo T_("Set Telegram Channel") ?></a>
      	<?php } // endif ?>
      </div>
  </div>
</section>



<section class="f" data-option='telegram-setting-channel-apikey'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set Telegram Admin username");?></h3>
      <div class="body">
        <p><?php echo T_("Enter the username of your Telegram network manager here so that your customers will be redirected to this ID if they need to contact the channel manager");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12" >
      <div class="action">
        <?php if(\dash\data::telegramSettingSaved_adminusername()) {?>
          <a class="btn secondary" href="<?php echo \dash\url::that(). '/adminusername' ?>"><?php echo T_("Change Telegram Admin username") ?></a>
        <?php }else{ ?>
          <a class="btn secondary" href="<?php echo \dash\url::that(). '/adminusername' ?>"><?php echo T_("Set Telegram Admin username") ?></a>
        <?php } // endif ?>
      </div>
  </div>
</section>


<section class="f" data-option='telegram-setting-text-apikey'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set Telegram Share Text");?></h3>
      <div class="body">
        <p><?php echo T_("You can set a fixed text to be placed under the title and description of each product when you share it via telegram");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12" >
      <div class="action">
        <?php if(\dash\data::telegramSettingSaved_share_text()) {?>
          <a class="btn secondary" href="<?php echo \dash\url::that(). '/text' ?>"><?php echo T_("Change Telegram Text") ?></a>
        <?php }else{ ?>
          <a class="btn secondary" href="<?php echo \dash\url::that(). '/text' ?>"><?php echo T_("Set Telegram Text") ?></a>
        <?php } // endif ?>
      </div>
  </div>
</section>

<section class="f" data-option='telegram-setting-start-text'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set Telegram Bot start Text");?></h3>
      <div class="body">
        <p><?php echo T_("You can set a fixed text to be placed when user start your bot in Telegram");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12" >
      <div class="action">
        <?php if(\dash\data::telegramSettingSaved_start_text()) {?>
          <a class="btn secondary" href="<?php echo \dash\url::that(). '/starttext' ?>"><?php echo T_("Change Telegram start text") ?></a>
        <?php }else{ ?>
          <a class="btn secondary" href="<?php echo \dash\url::that(). '/starttext' ?>"><?php echo T_("Set Telegram start text") ?></a>
        <?php } // endif ?>
      </div>
  </div>
</section>



<section class="f" data-option='telegram-setting-start-text'>
  <div class="c8 s12">
    <div class="data">

      <h3><?php echo T_("Set Telegram post button");?></h3>
      <div class="body">
        <p><?php echo T_("When posting on the Telegram channel, you can put a few buttons below it, each of which is connected to one of your social networks.") ?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12" >
      <div class="action">
          <a class="btn secondary" href="<?php echo \dash\url::that(). '/telegrambtn' ?>"><?php echo T_("Set") ?></a>
      </div>
  </div>
</section>