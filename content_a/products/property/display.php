<?php
$propertyList   = \dash\data::propertyList();
$storData       = \dash\data::store_store_data();
$productDataRow = \dash\data::productDataRow();

?>

<form method="post" autocomplete="off" id="form1">
  <div class="avand-xl">

      <section class="box">
        <header><h2><?php echo T_("Property"); ?></h2></header>
        <div class="body">



          <p class="msg"><?php echo T_("Set product property"); ?></p>

            <div class="row">
              <div class="c-4">
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
              <div class="c-4">
                <?php if(!\dash\data::keyList()) {?>
                  <div class="input">
                    <input type="text" name="key" placeholder="<?php echo T_("Type"); ?>" id="title" maxlength="100" value="<?php echo \dash\get::index(\dash\data::dataRow(), 'key'); ?>">
                  </div>
                <?php }else{ ?>
                  <div>
                    <select name="key" class="select22" data-model='tag' data-placeholder="<?php echo T_("Type"); ?>" >
                      <option></option>
                      <?php foreach (\dash\data::keyList() as $key => $value) {?>
                        <option value="<?php echo $value; ?>" <?php if($value == \dash\get::index(\dash\data::dataRow(), 'key')) { echo 'selected'; } ?> ><?php echo $value; ?></option>
                      <?php } //endfor ?>
                    </select>
                  </div>
                <?php } //endif ?>
              </div>
              <div class="c-4">
                <?php if(!\dash\data::valueList()) {?>
                  <div class="input">
                    <input type="text" name="value" placeholder="<?php echo T_("Value"); ?>" id="title" maxlength="100" value="<?php echo \dash\get::index(\dash\data::dataRow(), 'value'); ?>">
                  </div>
                <?php }else{ ?>
                  <div>
                    <select name="value" class="select22" data-model='tag' data-placeholder="<?php echo T_("Value"); ?>" >
                      <option></option>
                      <?php foreach (\dash\data::valueList() as $key => $value) {?>
                        <option value="<?php echo $value; ?>" <?php if($value == \dash\get::index(\dash\data::dataRow(), 'value')) { echo 'selected'; } ?> ><?php echo $value; ?></option>
                      <?php } //endfor ?>
                    </select>
                  </div>
                <?php } //endif ?>
              </div>
            </div>
        </div>
        <footer class="txtRa">
          <button class="master btn"><?php echo T_("Add") ?></button>
        </footer>


      </section>



        <?php if(\dash\data::propertyList()) { ?>
  <div class="productInfo box">
    <div class="body">

<?php foreach (\dash\data::propertyList() as $property => $cat) {?>
      <div class="msg info2 mB0-f "><?php echo $cat['title']; ?></div>
    <table class="tbl1 responsive v5">
<?php foreach ($cat['list'] as $key => $value) {?>
      <tr>
        <th><?php echo $value['key']; ?></th>
        <td>
          <?php if(\dash\get::index($value, 'link')) {?>
            <a href="<?php echo \dash\get::index($value, 'link') ?>"><?php echo $value['value']; ?></a>
          <?php }else{ ?>
          <?php echo $value['value']; ?>
          <?php } //endif ?>
        </td>
      </tr>
<?php     } ?>
    </table>
<?php   } ?>
    </div>
  </div>
<?php } ?>

  </div>

</form>