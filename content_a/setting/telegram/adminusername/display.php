<form method="post" autocomplete="off">

<div class="avand-md">

  <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Set Telegram Channel");?></h2></header>
      <div class="body">
        <p><?php echo T_("Set your admin username in Telegram");?></p>
        <div class="c4 s12" method="post" autocomplete="off">
          <div class="action f">
            <div class="c12 mB5">
              <label for="adminusername"><?php echo T_("Admin username"); ?></label>
              <div class="input ltr">
                <input type="text" name="adminusername" id="adminusername" maxlength="50" value="<?php echo \dash\data::telegramSettingSaved_adminusername(); ?>">
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