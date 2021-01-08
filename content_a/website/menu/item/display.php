<?php $editMode = \dash\data::editMode(); ?>

<div class="avand-md">
  <form method="post" class="box" autocomplete="off">
    <header><h2><?php if($editMode){ echo T_("Edit item");}else{ echo T_("Add item to menu"). ' '. \dash\data::menuDetail_title();} ?></h2></header>
      <div class="body">
        <label for="title"><?php echo T_("Title"); ?></label>
        <div class="input">
          <input type="text" name="title" id="title" value="<?php echo \dash\data::dataRow_title() ?>" maxlength="50" required <?php \dash\layout\autofocus::html() ?>>
        </div>
        <label for="url"><?php echo T_("Url"); ?></label>
        <div class="input ltr">
          <input type="text" name="url" id="url" value="<?php echo \dash\data::dataRow_url(); ?>"  required>
        </div>
        <div class="switch1 mB5">
          <input type="checkbox" name="target" id="target" <?php if(\dash\data::dataRow_target()) { echo 'checked';} ?>>
          <label for="target"></label>
          <label for="target"><?php echo T_("Open in New tab"); ?><small></small></label>
        </div>
    </div>
    <footer class="txtRa">
      <button class="btn <?php if($editMode) { echo 'primary'; }else{ echo 'success';} ?>"><?php if($editMode) { echo T_("Edit");}else{ echo T_("Add");} ?></button>
    </footer>
  </form>
</div>