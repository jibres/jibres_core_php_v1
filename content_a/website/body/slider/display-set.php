<div class="avand-sm">

  <?php if(\dash\request::get('id')) {?>
    <form method="post" class="box" autocomplete="off" >

      <header><h2><?php echo T_("Manage this line") ?></h2></header>


        <input type="hidden" name="edit_line" value="setting">
        <input type="hidden" name="id" value="<?php echo \dash\request::get('id'); ?>">

        <div class="body">

          <label for="title"><?php echo T_("Line title"); ?></label>
          <div class="input">
            <input type="text" name="title" id="title" value="<?php echo \dash\get::index(\dash\data::lineSetting(), 'title') ?>"  >
          </div>


            <label for="ratio"><?php echo T_("Ratio"); ?></label>
            <div>
            <select class="select22" name="ratio">
              <option value="0"><?php echo T_("Please select one item") ?></option>
              <option value="16:9" <?php if(\dash\data::lineSetting_ratio() === '16:9') {echo 'selected';} ?>><?php echo \dash\fit::text("16:9") ?></option>
              <option value="16:10" <?php if(\dash\data::lineSetting_ratio() === '16:10') {echo 'selected';} ?>><?php echo \dash\fit::text("16:10") ?></option>
              <option value="19:10" <?php if(\dash\data::lineSetting_ratio() === '19:10') {echo 'selected';} ?>><?php echo \dash\fit::text("19:10") ?></option>
              <option value="32:9" <?php if(\dash\data::lineSetting_ratio() === '32:9') {echo 'selected';} ?>><?php echo \dash\fit::text("32:9") ?></option>
              <option value="64:27" <?php if(\dash\data::lineSetting_ratio() === '64:27') {echo 'selected';} ?>><?php echo \dash\fit::text("64:27") ?></option>
              <option value="5:3" <?php if(\dash\data::lineSetting_ratio() === '5:3') {echo 'selected';} ?>><?php echo \dash\fit::text("5:3") ?></option>
            </select>
            </div>


        </div>

        <footer class="txtRa">
          <div class="f">
            <div class="cauto">
              <div data-confirm data-data='{"remove": "line", "edit_line" : "setting", "id": "<?php echo \dash\request::get('id'); ?>"}' class="btn outline danger"><?php echo T_("Remove"); ?></div>
            </div>
            <div class="c"></div>
            <div class="cauto">
              <button class="btn primary"><?php echo T_("Update"); ?></button>
            </div>
          </div>
        </footer>

    </form>
  <?php }else{ ?>

    <form method="post" class="box" autocomplete="off" >

      <header><h2><?php echo T_("Add new slider") ?></h2></header>
      <input type="hidden" name="edit_line" value="setting">
      <input type="hidden" name="id" value="<?php echo \dash\request::get('id'); ?>">

      <div class="body">
        <label for="title"><?php echo T_("Slider title"); ?></label>
        <div class="input">
          <input type="text" name="title" id="title" value="<?php echo \dash\get::index(\dash\data::lineSetting(), 'title') ?>"  >
        </div>

        <label for="ratio"><?php echo T_("Ratio"); ?></label>
        <div>
          <select class="select22" name="ratio">
            <option value="0"><?php echo T_("Please select one item") ?></option>
            <option value="16:9" <?php if(\dash\data::lineSetting_ratio() === '16:9') {echo 'selected';} ?>><?php echo \dash\fit::text("16:9") ?></option>
            <option value="16:10" <?php if(\dash\data::lineSetting_ratio() === '16:10') {echo 'selected';} ?>><?php echo \dash\fit::text("16:10") ?></option>
            <option value="19:10" <?php if(\dash\data::lineSetting_ratio() === '19:10') {echo 'selected';} ?>><?php echo \dash\fit::text("19:10") ?></option>
            <option value="32:9" <?php if(\dash\data::lineSetting_ratio() === '32:9') {echo 'selected';} ?>><?php echo \dash\fit::text("32:9") ?></option>
            <option value="64:27" <?php if(\dash\data::lineSetting_ratio() === '64:27') {echo 'selected';} ?>><?php echo \dash\fit::text("64:27") ?></option>
            <option value="5:3" <?php if(\dash\data::lineSetting_ratio() === '5:3') {echo 'selected';} ?>><?php echo \dash\fit::text("5:3") ?></option>
          </select>
        </div>
      </div>

      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Add"); ?></button>
      </footer>

    </form>
  <?php } //endif ?>
</div>