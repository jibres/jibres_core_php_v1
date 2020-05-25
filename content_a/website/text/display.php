
<div class="avand-lg">


  <form method="post" class="box" autocomplete="off" >

    <div class="body">



        <label for="title"><?php echo T_("Line title"); ?></label>
        <div class="input">
          <input type="text" name="title" id="title" value="<?php if(!\dash\get::index(\dash\data::lineSetting(), 'title') && \dash\get::index(\dash\data::lineSetting(), 'title') !== '0'){ echo \dash\data::textNameSuggestion(); }else{ echo \dash\get::index(\dash\data::lineSetting(), 'title'); } ?>"  maxlength="200"  >
        </div>


      <textarea class="txt" data-editor rows="10" name="text" placeholder="<?php echo T_("Type here...") ?>" id="text"><?php echo \dash\data::dataRow_text(); ?></textarea>

    </div>

    <footer class="txtRa">
      <?php if (\dash\data::textID()) { ?>
        <div class="f">
          <div class="cauto">
            <div data-confirm data-data='{"remove": "line", "edit_line" : "setting", "id": "<?php echo \dash\request::get('id'); ?>"}' class="btn outline danger"><?php echo T_("Remove"); ?></div>
          </div>
          <div class="c"></div>
          <div class="cauto">
            <button class="btn primary"><?php echo T_("Update"); ?></button>
          </div>
        </div>
      <?php }else{ ?>
        <button class="btn primary"><?php echo T_("Save"); ?></button>
      <?php } //endif ?>
    </footer>

  </form>

</div>