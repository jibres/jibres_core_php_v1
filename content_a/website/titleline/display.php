
<div class="avand-lg">


  <form method="post" class="box" autocomplete="off" >

    <div class="body">



        <label for="title"><?php echo T_("Line title"); ?></label>
        <div class="input">
          <input type="title" name="titleline" id="title" value="<?php if(!a(\dash\data::lineSetting(), 'title') && a(\dash\data::lineSetting(), 'title') !== '0'){ echo \dash\data::titlelineNameSuggestion(); }else{ echo a(\dash\data::lineSetting(), 'title'); } ?>"  maxlength="200"  >
        </div>




    </div>

    <footer class="txtRa">
      <?php if (\dash\data::titlelineID()) { ?>
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