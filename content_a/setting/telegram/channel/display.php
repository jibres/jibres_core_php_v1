<form method="post" autocomplete="off">

<div class="avand-md">

  <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Set Telegram Channel");?></h2></header>
      <div class="body">
        <p><?php echo T_("You can easily share products in your Telegram channel. To do this, introduce your Telegram channel ID to us.");?></p>
        <div class="c4 s12" method="post" autocomplete="off">
          <div class="action f">
            <div class="c12 mB5">
              <label for="channel"><?php echo T_("Channel"); ?></label>
              <div class="input ltr">
                <input type="text" name="channel" id="channel" maxlength="50" value="<?php echo \dash\data::telegramSettingSaved_channel(); ?>">
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="txtRa">
        <button  class="btn success" ><?php echo T_("Save"); ?></button>
      </footer>
  </div>
</div>

</form>