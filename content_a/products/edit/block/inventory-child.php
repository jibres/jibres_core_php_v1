<?php
$storData           = \dash\data::store_store_data();
$productDataRow     = \dash\data::productDataRow();
$have_variant_child =\dash\data::productDataRow_variant_child();
?>
<form method="post" autocomplete="off" id="form1">
  <div class="avand-md">
    <section class="box">
      <header><h2><?php echo T_("Inventory"); ?></h2></header>
      <div class="body">
         <div>
        <label for='sku'><?php echo T_("Stock keeping unit - SKU"); ?></label>
        <div class="input">
          <input type="text" name="sku" id="sku" value="<?php echo a($productDataRow,'sku'); ?>" maxlength="16" class="text-center ltr">
        </div>
      </div>
        <div data-response='type' data-response-where='product' <?php if(!$productDataRow || \dash\data::productDataRow_type() === 'product'){}else{ echo 'data-response-hide';}?> >
          <div data-response='itrackquantity' <?php if(\dash\data::productDataRow_trackquantity() || (\dash\url::child() === 'add')){}else{ echo 'data-response-hide';} ?>  >
            <?php if(!$have_variant_child) {?>
              <div class="c s12 pRa10">
                <label for='stock'><?php echo T_("Current Stock Count"); ?> <span class="font-bold pRa10"><?php echo \dash\fit::number(\dash\data::productDataRow_stock()); ?></span>
                </label>
                <div class="input">
                  <input type="tel" name="stock" id="stock" data-format='number' placeholder="<?php echo T_('Current Stock Count'). ' '. \dash\fit::number(\dash\data::productDataRow_stock()); ?>" maxlength="7">
                </div>
                <p class="text-gray-400 text-sm"><?php echo T_("If you want to change the stock enter current stock here") ?></p>
              </div>
            <?php } //endif ?>
            <div class="f">
              <div class="c s12 pRa10">
                <label for='minstock'><?php echo T_("Min stock"); ?></label>
                <div class="input">
                  <input type="tel" name="minstock" id="minstock" data-format='number' value="<?php echo a($productDataRow,'minstock'); ?>" maxlength="7">
                </div>
              </div>
              <div class="c s12">
                <label for='maxstock'><?php echo T_("Max stock"); ?></label>
                <div class="input">
                  <input type="tel" name="maxstock" id="maxstock" data-format='number' value="<?php echo a($productDataRow,'maxstock'); ?>" maxlength="11">
                </div>
              </div>
            </div>
            <p class="text-sm text-gray-400 mB0-f"><?php echo T_("Optimize your inventory decisions."); ?> <?php echo T_("Know which products are the most profitable and which you should re-order when."); ?> <b><?php echo T_("Demand forecasting!"); ?></b> <?php echo T_("Receive recommendations on your products based on your rate of sales."); ?>
          </p>
        </div>
      </div>
    </div>
  </section>
</div>
</form>