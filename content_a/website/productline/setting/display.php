<div class="avand-sm">

    <form method="post" class="box" autocomplete="off" >

        <input type="hidden" name="edit_line" value="setting">
        <input type="hidden" name="id" value="<?php echo \dash\request::get('id'); ?>">

        <div class="body">

          <label for="title"><?php echo T_("Line title"); ?></label>
          <div class="input">
            <input type="text" name="title" id="title" value="<?php echo \dash\get::index(\dash\data::lineSetting(), 'title') ?>"  >
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

</div>