<?php
$propertyList   = \dash\data::propertyList();
$storData       = \dash\data::store_store_data();
$productDataRow = \dash\data::productDataRow();
require_once(root. 'content_a/products/productName.php');
?>
<div class="avand-md">
  <section class="box">
    <form method="post" autocomplete="off" id="form1">
      <input type="hidden" name="addmode" value="1">
      <div class="body">

          <div class="mB10">
            <?php if(!\dash\data::catList()) {?>
              <div class="input">
                <input type="text" name="cat" placeholder="<?php echo T_("Group"); ?>" id="title" maxlength="100" value="<?php echo a(\dash\data::dataRow(), 'cat'); ?>">
              </div>
            <?php }else{ ?>
              <div>
                <select name="cat" class="select22" data-model='tag' data-placeholder="<?php echo T_("Group"); ?>" >
                  <option></option>
                  <?php foreach (\dash\data::catList() as $key => $value) {?>
                    <option value="<?php echo $value; ?>" <?php if($value == a(\dash\data::dataRow(), 'cat') || $value === \dash\data::fillProductProperty()) { echo 'selected'; } ?> ><?php echo $value; ?></option>
                  <?php } //endfor ?>
                </select>
              </div>
            <?php } //endif ?>
          </div>
          <div class="mB10">
            <?php if(!\dash\data::keyList()) {?>
              <div class="input">
                <input type="text" name="key" placeholder="<?php echo T_("Type"); ?>" id="title" maxlength="100" value="<?php echo a(\dash\data::dataRow(), 'key'); ?>">
              </div>
            <?php }else{ ?>
              <div>
                <select name="key" class="select22" data-model='tag' data-placeholder="<?php echo T_("Type"); ?>" >
                  <option></option>
                  <?php foreach (\dash\data::keyList() as $key => $value) {?>
                    <option value="<?php echo $value; ?>" <?php if($value == a(\dash\data::dataRow(), 'key')) { echo 'selected'; } ?> ><?php echo $value; ?></option>
                  <?php } //endfor ?>
                </select>
              </div>
            <?php } //endif ?>
          </div>
          <div class="mB10">
            <div class="input">
              <input type="text" name="value" placeholder="<?php echo T_("Value"); ?>" id="title" maxlength="100" value="<?php echo a(\dash\data::dataRow(), 'value'); ?>">
            </div>
          </div>
      </div>
      <footer class="txtRa">
        <?php if(\dash\data::editMode()) {?>
          <div class="f">
            <div class="cauto"><a href="<?php echo \dash\url::that(). '?id='. \dash\request::get('id') ?>" class="secondary outline btn"><?php echo T_("Cancel") ?></a></div>
            <div class="c"></div>
            <div class="cauto"><button class="master btn"><?php echo T_("Edit") ?></button></div>
          </div>

        <?php }else{ ?>
          <button class="master btn"><?php echo T_("Add") ?></button>
        <?php } //endif ?>
      </footer>
    </form>
  </section>


</div>

