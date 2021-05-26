<?php
$propertyList       = \dash\data::propertyList();
$storData           = \dash\data::store_store_data();
$productDataRow     = \dash\data::productDataRow();
$have_variant_child = \dash\data::productDataRow_variant_child();
$child_list         = \dash\data::productDataRow_child();

require_once(root. 'content_a/products/productName.php');
?>


<form method="post" autocomplete="off" id="form1">
  <div class="avand-md">


  <div class="box">
    <header><h2><?php echo T_("Advance") ?></h2></header>
    <div class="pad">
      <?php if(\dash\data::productDataRow_parent() || $have_variant_child) { /* Show the unit and type*/}else{ /*Hide the unit and type*/ ?>
      <div class="row mB5">
        <div class="c">
          <div class="radio3">
            <input type="radio" name="type" value="product" id="typeProduct" <?php if(!\dash\data::productDataRow() || \dash\data::productDataRow_type() === 'product') {echo 'checked';} ?> >
            <label for="typeProduct"><?php echo T_("Product"); ?></label>
          </div>
        </div>
        <div class="c">
          <div class="radio3">
            <input type="radio" name="type" value="service" id="typeService" <?php if(\dash\data::productDataRow_type() == 'service') { echo 'checked'; } if($have_variant_child || \dash\data::productDataRow_parent()) { echo ' disabled ';} ?>  >
            <label for="typeService"><?php echo T_("Service"); ?></label>
          </div>
        </div>


        <div class="c">
          <div class="radio3">
            <input type="radio" name="type" value="file" id="typeFile" <?php if(\dash\data::productDataRow_type() == 'file') { echo 'checked'; } if($have_variant_child || \dash\data::productDataRow_parent()) { echo ' disabled ';} ?>>
            <label for="typeFile"><?php echo T_("File"); ?></label>
          </div>
        </div>

      </div>
    <?php } //endif ?>

  <?php if(!$have_variant_child) {?>

          <div data-response='type' data-response-where='file' <?php if(\dash\data::productDataRow_type() == 'file'){}else{echo 'data-response-hide';} ?>>
            <label for="iFileSize"><?php echo T_("File Size"); ?></label>
            <div class="input">
              <input type="text" name="filesize" id="iFileSize" value="<?php echo a($productDataRow,'filesize'); ?>"  autocomplete="off" maxlength="11" data-format='number'>
              <div class="addon"><?php echo T_("MB"); ?></div>
            </div>
            <label for="iFileAddress"><?php echo T_("File Address"); ?></label>
            <div class="input">
              <input type="url" name="fileaddress" id="iFileAddress" value="<?php echo a($productDataRow,'fileaddress'); ?>"   maxlength="500">
            </div>
          </div>
          <div class="f">
            <div class="c s12 pRa5">
              <label for='minsale'><?php echo T_("Min quantity per order"); ?></label>
              <div class="input">
                <input type="text" name="minsale" id="minsale" data-format='number' value="<?php echo a($productDataRow,'minsale'); ?>" maxlength="7">
              </div>
            </div>
            <div class="c s12">
              <label for='maxsale'><?php echo T_("Max quantity per order"); ?></label>
              <div class="input">
                <input type="text" name="maxsale" id="maxsale" data-format='number' value="<?php echo a($productDataRow,'maxsale'); ?>" maxlength="7">
              </div>
            </div>
          </div>
          <label for='salestep'><?php echo T_("Step quantity"); ?></label>
          <div class="input">
            <input type="text" name="salestep" id="salestep" data-format='number' value="<?php echo a($productDataRow,'salestep'); ?>" maxlength="7">
          </div>

        </div>
      </section>
    <?php } //endif ?>

  </div>

</form>