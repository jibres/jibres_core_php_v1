<form method="post" autocomplete="off" class="box impact">
  <header><h2><?php echo T_("Choose menu");?></h2></header>
  <div class="body">

    <label for="menu"><?php echo T_("Menu"); ?></label>
    <select name="menu" id="menu" class="select22">
      <option></option>
      <?php foreach (\dash\data::allMenu() as $key => $value) {?>
        <option value="<?php echo \dash\get::index($value, 'key'); ?>"><?php echo \dash\get::index($value, 'title'); ?></option>
      <?php } //endfor ?>
    </select>

  </div>
  <footer class="txtRa">
    <button class="btn success"><?php echo T_("Save"); ?></button>
  </footer>
</form>


