<form method="post" autocomplete="off" class="box impact">
  <header><h2><?php echo T_("Choose menu");?></h2></header>
  <div class="body">

    <?php foreach ($box_detail as $key => $value) {?>
    <label for="idmenu<?php echo \dash\get::index($value, 'name'); ?>"><?php echo \dash\get::index($value, 'title'); ?></label>
    <select name="<?php echo \dash\get::index($value, 'name'); ?>" id="idmenu<?php echo \dash\get::index($value, 'name'); ?>" class="select22">
      <option></option>
      <?php foreach (\dash\data::allMenu() as $key => $value) {?>
        <option value="<?php echo \dash\get::index($value, 'key'); ?>" <?php if(\dash\get::index($header_detail, 'current_detail', \dash\get::index($value, 'name')) == \dash\get::index($value, 'key')) { echo 'selected';}; ?>><?php echo \dash\get::index($value, 'title'); ?></option>
      <?php } //endfor ?>
    </select>
  <?php } //endfor ?>
  </div>
  <footer class="txtRa">
    <button class="btn success"><?php echo T_("Save"); ?></button>
  </footer>
</form>


