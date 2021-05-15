<?php require_once(root. 'content_a/tag/tagName.php') ?>
<div class="avand-lg">
<form method="post" autocomplete="off" >
    <section class="box">
      <header><h2><?php echo T_("General property"); ?></h2></header>
      <div class="body">

        <p>
          <?php echo T_("If the products in this tag have similar attributes, you can enter the group and title of the attributes here to enter only the values ​​of each one when completing the product specifications faster."); ?>
          <br>
          <?php echo T_("Here you just enter the group name and key of property. And you can set value of this property on product property edit page for each product contain this tag."); ?>
          <br>
        <?php echo T_("Also you can copy all property from another tag here") ?>
        <a href="<?php echo \dash\url::this(). '/clone'. \dash\request::full_get() ?>" class="link"><?php echo T_("Copy from other tag") ?></a>
        </p>
        <div class="row">
          <div class="c-md-6 c-xs-12 c-sm-12">
            <?php if(!\dash\data::catList()) {?>
              <div class="input">
                <input type="text" name="cat" placeholder="<?php echo T_("Group"); ?>" id="title" maxlength="100" value="<?php echo a(\dash\data::dataRow(), 'cat'); ?>">
              </div>
            <?php }else{ ?>
              <div>
                <select name="cat" class="select22" data-model='tag' data-placeholder="<?php echo T_("Group"); ?>" >
                  <option></option>
                  <?php if(\dash\data::fillCategoryProperty() && !in_array(\dash\data::fillCategoryProperty(), \dash\data::catList())) {?>
                    <option value="<?php echo \dash\data::fillCategoryProperty() ?>" selected><?php echo \dash\data::fillCategoryProperty(); ?></option>
                  <?php } //endif ?>
                  <?php foreach (\dash\data::catList() as $key => $value) {?>
                    <option value="<?php echo $value; ?>" <?php if($value == a(\dash\data::dataRow(), 'cat') || $value === \dash\data::fillCategoryProperty()) { echo 'selected'; } ?> ><?php echo $value; ?></option>
                  <?php } //endfor ?>
                </select>
              </div>
            <?php } //endif ?>
          </div>
          <div class="c-md-6 c-xs-12 c-sm-12">
            <?php if(!\dash\data::keyList()) {?>
              <div class="input ">
                <input type="text" name="key" placeholder="<?php echo T_("Type"); ?>" id="title" maxlength="100" value="<?php echo a(\dash\data::dataRow(), 'key'); ?>">
              </div>
            <?php }else{ ?>
              <div class="">
                <select name="key" class="select22" data-model='tag' data-placeholder="<?php echo T_("Type"); ?>" >
                  <option></option>
                  <?php foreach (\dash\data::keyList() as $key => $value) {?>
                    <option value="<?php echo $value; ?>" <?php if($value == a(\dash\data::dataRow(), 'key')) { echo 'selected'; } ?> ><?php echo $value; ?></option>
                  <?php } //endfor ?>
                </select>
              </div>
            <?php } //endif ?>
          </div>
        </div>
    </div>
    <footer class="txtRa">
      <button class="btn master" name="save_default_property" value="save_default_property"><?php echo T_("Add") ?></button>
    </footer>
  </section>
</form>

  <?php if(\dash\data::propertyGroup() && is_array(\dash\data::propertyGroup())) {?>
    <form method="post" data-patch>
      <input type="hidden" name="itemsort" value="itemsort">
        <?php foreach (\dash\data::propertyGroup() as $key => $value) {?>
          <p class="txtB mB0-f font-16"><?php echo $key ?> <a class="font-11" href="<?php echo \dash\url::this(). '/editgroup'. \dash\request::full_get(['group' => $key]); ?>"><?php echo T_("Edit") ?></a></p>
          <nav class="items long">
            <ul class="sortable" data-sortable>
            <?php foreach ($value as $k => $v) {?>
              <li class="">
                <div class="item f" >
                  <input type="hidden" class="hide" name="sortgroup[]" value="<?php echo $key ?>">
                  <input type="hidden" class="hide" name="sortkey[]" value="<?php echo $v ?>">
                  <div class="f">
                    <div data-handle class="cauto handle"><i class="sf-sort"></i></div>
                    <div class="c mLa10"><?php echo $v?></div>
                  </div>

                  <div class="value" data-ajaxify data-data='{"remove":"remove", "index": "<?php echo $k; ?>"}'><i class="sf-trash fc-red"></i></div>
                </div>
              </li>
            <?php } //endif ?>
            </ul>
          </nav>
        <?php } // endfor ?>
    </form>


  <?php } //endif ?>
</div>
