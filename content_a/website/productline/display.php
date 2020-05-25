
<div class="avand-lg">


  <form method="post" class="box" autocomplete="off" >

    <div class="body">



      <label for="title"><?php echo T_("Line title"); ?></label>
      <div class="input">
        <input type="text" name="title" id="title" value="<?php if(!\dash\get::index(\dash\data::lineSetting(), 'title') && \dash\get::index(\dash\data::lineSetting(), 'title') !== '0'){ echo \dash\data::productlineNameSuggestion(); }else{ echo \dash\get::index(\dash\data::lineSetting(), 'title'); } ?>"  maxlength="200"  >
      </div>



      <label for="type"><?php echo T_("Type"); ?></label>
      <div>
        <select class="select22" name="type">
          <option value=""><?php echo \dash\data::defaultProductLineType(); ?></option>
          <option value="latestproduct" <?php if(\dash\get::index(\dash\data::lineSetting_productline(), 'type') === 'latestproduct') {echo 'selected';} ?>><?php echo T_("Latest product") ?></option>
          <option value="randomproduct" <?php if(\dash\get::index(\dash\data::lineSetting_productline(), 'type') === 'randomproduct') {echo 'selected';} ?>><?php echo T_("Random product") ?></option>
          <option value="bestselling" <?php if(\dash\get::index(\dash\data::lineSetting_productline(), 'type') === 'bestselling') {echo 'selected';} ?>><?php echo T_("Best-selling product") ?></option>
        </select>
      </div>

      <div class="mB10">
        <label for='cat'><?php echo T_("Special category"); ?> <small><a href="<?php echo \dash\url::here(); ?>/category"><?php echo T_("Add"); ?></a></small></label>
        <select name="cat_id" id="cat" class="select22"  data-placeholder='<?php echo T_("Select or add new category"); ?>' >
          <option></option>

          <?php foreach (\dash\data::listCategory() as $key => $value) {?>

            <option value="<?php echo \dash\get::index($value, 'id'); ?>" <?php if(\dash\get::index(\dash\data::lineSetting(), 'productline', 'cat_id') == $value['id']) { echo 'selected'; } ?> ><?php echo \dash\get::index($value, 'full_title'); ?></option>

          <?php } //endfor ?>

        </select>
      </div>

    </div>

    <footer class="txtRa">
      <?php if (\dash\data::productlineID()) { ?>
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