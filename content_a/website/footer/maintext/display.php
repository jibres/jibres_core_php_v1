
<div class="avand-sm">
  <form method="post" class="box" autocomplete="off">
    <div class="body">



          <label for="text"><?php echo T_("Announcement Text"); ?></label>
          <div class="input">
            <input type="text" name="text" id="text" value="<?php echo \dash\data::toplineSaved_text() ?>" maxlength="100" required>
          </div>

          <label for="url"><?php echo T_("Url"); ?></label>
          <div class="input ltr">
            <input type="text" name="url" id="url" value="<?php echo \dash\data::toplineSaved_url() ?>"  >
          </div>

          <div class="switch1 mB5">
            <input type="checkbox" name="target" id="target" <?php if(\dash\data::toplineSaved_target()) {echo 'checked';} ?>>
            <label for="target"></label>
            <label for="target"><?php echo T_("Open link in new tab"); ?><small></small></label>
          </div>
        </div>

    <footer class="txtRa">
      <button class="btn primary"><?php echo T_("Save"); ?></button>
    </footer>
  </form>

</div>
