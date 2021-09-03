<form method="post" autocomplete="off">
  <div class="avand-md">
    <div class="box">
      <div class="body">
        <label for="menutitle"><?php echo T_("Edit menu title"); ?></label>
        <div class="input">
          <input type="text" name="menutitle" id="menutitle" value="<?php echo \dash\data::menuDetail_title() ?>" maxlength="50" required>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Edit") ?></button>
      </footer>
    </div>
  </div>
</form>