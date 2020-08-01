<form method="post" autocomplete="off" >
  <div class="avand-lg">
    <section class="box">
      <header><h2><?php echo T_("General property"); ?></h2></header>
      <div class="body">
        <p>
          <?php echo T_("If the products in this category have similar attributes, you can enter the group and title of the attributes here to enter only the values ​​of each one when completing the product specifications faster."); ?>
          <br>
          <?php echo T_("Here you just enter the group name and key of property. And you can set value of this property on product property edit page for each product contain this category."); ?>
        </p>
        <div class="row">
          <div class="c-md-6 c-xs-12 c-sm-12">
            <?php if(!\dash\data::catList()) {?>
              <div class="input">
                <input type="text" name="cat" placeholder="<?php echo T_("Group"); ?>" id="title" maxlength="100" value="<?php echo \dash\get::index(\dash\data::dataRow(), 'cat'); ?>">
              </div>
            <?php }else{ ?>
              <div>
                <select name="cat" class="select22" data-model='tag' data-placeholder="<?php echo T_("Group"); ?>" >
                  <option></option>
                  <?php foreach (\dash\data::catList() as $key => $value) {?>
                    <option value="<?php echo $value; ?>" <?php if($value == \dash\get::index(\dash\data::dataRow(), 'cat')) { echo 'selected'; } ?> ><?php echo $value; ?></option>
                  <?php } //endfor ?>
                </select>
              </div>
            <?php } //endif ?>
          </div>
          <div class="c-md-6 c-xs-12 c-sm-12">
            <?php if(!\dash\data::keyList()) {?>
              <div class="input ">
                <input type="text" name="key" placeholder="<?php echo T_("Type"); ?>" id="title" maxlength="100" value="<?php echo \dash\get::index(\dash\data::dataRow(), 'key'); ?>">
              </div>
            <?php }else{ ?>
              <div class="">
                <select name="key" class="select22" data-model='tag' data-placeholder="<?php echo T_("Type"); ?>" >
                  <option></option>
                  <?php foreach (\dash\data::keyList() as $key => $value) {?>
                    <option value="<?php echo $value; ?>" <?php if($value == \dash\get::index(\dash\data::dataRow(), 'key')) { echo 'selected'; } ?> ><?php echo $value; ?></option>
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

  <?php if(\dash\data::propertyGroup() && is_array(\dash\data::propertyGroup())) {?>
    <div class="box">
      <div class="body">
        <?php foreach (\dash\data::propertyGroup() as $key => $value) {?>
          <div class="msg">
            <div class="txtB fs12"><?php echo $key ?></div>
            <?php foreach ($value as $k => $v) {?>
              <div class="ibtn mA5"><?php echo $v ?> <i data-confirm data-data='{"remove":"remove", "index": "<?php echo $k; ?>"}' class="sf-trash fc-red fs14"></i></div>
            <?php } //endif ?>
          </div>
        <?php } // endfor ?>
      </div>
    </div>

  <?php } //endif ?>
</div>
</form>
