<div class="avand-sm">

    <form method="post" class="box" autocomplete="off" >

        <input type="hidden" name="edit_line" value="setting">
        <input type="hidden" name="id" value="<?php echo \dash\request::get('id'); ?>">

        <div class="body">

          <label for="title"><?php echo T_("Line title"); ?></label>
          <div class="input">
            <input type="text" name="title" id="title" value="<?php if(!\dash\get::index(\dash\data::lineSetting(), 'title') && \dash\get::index(\dash\data::lineSetting(), 'title') !== '0'){ echo \dash\data::quoteNameSuggestion(); }else{ echo \dash\get::index(\dash\data::lineSetting(), 'title'); } ?>"  maxlength="200" >
          </div>


            <label for="style"><?php echo T_("Style mode"); ?></label>
            <div>
            <select class="select22" name="style">
              <option value="0"><?php echo \dash\data::defaultStyleQuote(); ?></option>
              <option value="simple" <?php if(\dash\data::lineSetting_style() === 'simple') {echo 'selected';} ?>><?php echo T_("Simple") ?></option>
              <option value="professional" <?php if(\dash\data::lineSetting_style() === 'professional') {echo 'selected';} ?>><?php echo T_("Professional") ?></option>
            </select>
            </div>


        </div>

        <footer class="txtRa">
          <div class="f">
            <div class="cauto">
              <?php if (\dash\request::get('id')) {?>
                <div data-confirm data-data='{"remove": "line", "edit_line" : "setting", "id": "<?php echo \dash\request::get('id'); ?>"}' class="btn outline danger"><?php echo T_("Remove"); ?></div>
              <?php } // endif ?>
            </div>
            <div class="c"></div>
            <div class="cauto">
              <?php if (\dash\request::get('id')) {?>
                <button class="btn primary"><?php echo T_("Update"); ?></button>
              <?php }else{ ?>
                <button class="btn primary"><?php echo T_("Save"); ?></button>
              <?php } // endif ?>
            </div>
          </div>
        </footer>

    </form>

</div>