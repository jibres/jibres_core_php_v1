<form method="post" autocomplete="off">

  <div class="avand-md">

    <div  class="box impact mB25-f">
      <header><h2><?php echo T_("Set Telegram Bot APIKEY");?></h2></header>
      <div class="body">
        <p><?php echo T_("It is possible to connect your business to your own custom Telegram robot. To do this, you must first create a telegram robot and provide the connection key to Jibres");?></p>
        <div class="c4 s12" method="post" autocomplete="off">
          <div class="action f">
            <div class="c12 mB5">
              <label for="apikey"><?php echo T_("APIKEY"); ?></label>
              <div class="input ltr">
                <input type="text" name="apikey" id="apikey" maxlength="50" <?php if(\dash\data::telegramSettingSaved_apikey()) { echo 'disabled readonly'; } // endif ?> value="<?php echo \dash\data::telegramSettingSaved_apikey(); ?>">
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="txtRa">
        <?php if(!\dash\data::telegramSettingSaved_apikey()) {?>
          <button  class="btn success" ><?php echo T_("Save"); ?></button>
        <?php }else{ ?>
          <div data-confirm data-data='{"apikey": null}'  class="btn danger" ><?php echo T_("Remove"); ?></div>
        <?php } //endif ?>
      </footer>
    </div>
  </div>

</form>