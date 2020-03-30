<form method="post" autocomplete="off" class="box impact">
  <footer><h2><?php echo T_("Choose menu");?></h2></footer>
  <div class="body">

    <?php foreach ($box_detail as $boxValue) {?>
    <div>
      <label for="idmenu<?php echo \dash\get::index($boxValue, 'name'); ?>"><?php echo \dash\get::index($boxValue, 'title'); ?></label>
      <select name="<?php echo \dash\get::index($boxValue, 'name'); ?>" id="idmenu<?php echo \dash\get::index($boxValue, 'name'); ?>" class="select22">
        <?php if(\dash\get::index($footer_detail, 'saved', \dash\get::index($boxValue, 'name'))) {?>
          <option value="0"><?php echo T_("Without menu"); ?></option>
        <?php }else{ ?>
          <option></option>
        <?php } //endif ?>
        <?php foreach (\dash\data::allMenu() as $key => $value) {?>
          <option value="<?php echo \dash\get::index($value, 'key'); ?>" <?php if(\dash\get::index($footer_detail, 'saved', \dash\get::index($boxValue, 'name')) == \dash\get::index($value, 'key')) { echo 'selected';} ?>><?php echo \dash\get::index($value, 'title'); ?></option>
        <?php } //endfor ?>
      </select>
    </div>
  <?php } //endfor ?>
  </div>
  <footer class="txtRa">
    <button class="btn success"><?php echo T_("Save"); ?></button>
  </footer>
</form>


