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
</div>