<?php
$storData           = \dash\data::store_store_data();
$productDataRow     = \dash\data::productDataRow();
$have_variant_child = \dash\data::productDataRow_variant_child();

if(!$productDataRow || in_array(\dash\data::productDataRow_type(), ['product', 'service']))
{
?>


    <section class="box">

      <header><h2><?php echo T_("Inventory"); ?></h2></header>
      <div class="body">
          <div class="switch1 mB5">
            <input type="checkbox" name="trackquantity" id="itrackquantity" <?php if(\dash\data::productDataRow_trackquantity() || (\dash\url::child() === 'add')) { echo 'checked';} ?>>
            <label for="itrackquantity"></label>
            <label for="itrackquantity"><?php echo T_("Track quantity"); ?><small></small></label>
          </div>
          <div data-response='itrackquantity' <?php if(\dash\data::productDataRow_trackquantity() || (\dash\url::child() === 'add')){}else{ echo 'data-response-hide';} ?>  >
            <p class="text-sm text-gray-400"><?php echo T_("Inventory tracking can help you avoid selling products that have run out of stock, or let you know when you need to order or make more of your product."); ?></p>

            <div class="switch1">
              <input type="checkbox" name="oversale" id="oversale"  <?php if(\dash\data::productDataRow_oversale()) {echo 'checked';}?> >
              <label for="oversale"></label>
              <label for="oversale"><?php echo T_("Oversale"); ?></label>
            </div>
            <p class="text-gray-400 text-sm"><?php echo T_("Allow to purchase when sold out of stock"); ?></p>
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
            <?php if(\dash\url::child() !== 'add') {?>
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
          <?php } //endif ?>
        </div>
    </div>
  </section>
<?php } //endif ?>
