<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="pad">
        <label for="title"><?php echo T_("Permission Title") ?> <small class="fc-red">* <?php echo T_("Required") ?></small></label>
        <div class="input">
          <input type="text" name="title" id="title" required value="<?php echo \dash\data::dataRow_key(); ?>">
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Edit") ?></button>
      </footer>
    </div>
  </form>

  <div class="box">
      <div class="body">
        <p><?php echo T_("Remove Permission") ?></p>
        <?php if(\dash\data::dataRow_user_count()) {?>
          sdfdfs
        <?php }else{ ?>
          <?php echo T_("You can remove this permission") ?>
        <?php } //endif ?>
      </div>
      <footer class="txtRa">
        <div class="btn linkDel" data-confirm data-data='{"remove": "remove"}'><?php echo T_("Remove") ?></div>
      </footer>
    </div>
</div>