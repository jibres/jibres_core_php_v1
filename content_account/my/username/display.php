
<div class="f justify-center">
  <div class="c6 m8 x5 s12">
    <div class="cbox">
      <div class="msg">
        <div><?php echo T_("You can choose a username"); ?></div>
        <div><?php echo T_("You can use a-z, 0-9 and underscores."); ?></div>
        <div><?php echo T_("Minimum length is 5 characters."); ?></div>
      </div>
      <form method="post" autocomplete="off">

        <?php \dash\csrf::html(); ?>
        <label for="username"><?php echo T_("Username"); ?></label>
        <div class="input ltr">
          <input type="text" name="username" id="username" placeholder='<?php echo T_("Username"); ?>' value="<?php echo \dash\data::dataRow_username(); ?>" maxlength='40' minlength="5"  autofocus>
        </div>

        <div class="txtRa">
          <button class="btn success"><?php echo T_("Save"); ?></button>
        </div>

      </form>
    </div>
  </div>
</div>
