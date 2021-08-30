<form method="post" autocomplete="off" action="<?php echo \dash\request::get('callback'); ?>">
  <?php foreach (\dash\request::get() as $key => $value) {?>
    <input type="hidden" name="<?php echo $key ?>" value="<?php echo $value ?>">
  <?php } //endif ?>
  <div class="box">
    <div class="pad">
      <div class="input">
        <input type="url" name="fileaddr" value="" placeholder="<?php echo T_("Your file addr") ?>">
      </div>
    </div>
    <footer class="txtRa">
      <button class="btn master"><?php echo T_("Save") ?></button>
    </footer>
  </div>
</form>