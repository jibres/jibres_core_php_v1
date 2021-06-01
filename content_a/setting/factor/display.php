
<section class="f" data-option='setting-factor-seller-detail' id="setting-factor-seller-detail">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Seller detail"); ?></h3>
      <div class="body">
        <p><?php echo T_("Seller information displayed on the invoice"); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <a class="btn primary" href="<?php echo \dash\url::that(); ?>/seller"><?php echo T_("Edit seller detail") ?></a>
    </div>
  </form>
</section>


<section class="f" data-option='setting-factor-address' id="setting-factor-address">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Address"); ?></h3>
      <div class="body">
        <p><?php echo T_("Address information displayed on the invoice"); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <a class="btn primary" href="<?php echo \dash\url::that(); ?>/address"><?php echo T_("Edit address") ?></a>
    </div>
  </form>
</section>


<section class="f" data-option='setting-factor-vat' id="setting-factor-vat">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Do you want to calc tax?"); ?></h3>
      <div class="body">
      	<p><?php echo T_("If tax is enable, we are add in products and factors based on antoher settings."); ?> <?php echo T_("If you turn it off, we are totally hide tax options from everywhere!"); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_tax_status" value="1">
    <div class="action">
      <div class="switch1">
        <input type="checkbox" name="tax_status" id="tax-status" <?php if(\dash\data::dataRow_tax_status()) { echo 'checked'; } ?>>
         <label for="tax-status" data-on='<?php echo T_("Yes") ?>' data-off="<?php echo T_("No") ?>"></label>
      </div>
    </div>
  </form>
</section>


<div data-response='tax-status' <?php if(\dash\data::dataRow_tax_status()) {}else{ echo 'data-response-hide'; } ?>>


<section class="f" data-option='setting-factor-vat-default' id="setting-factor-vat-default">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("VAT default value for new product"); ?></h3>
      <div class="body">
      	<p><?php echo T_("You can change default value for VAT on add new product."); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_tax_calc" value="1">
    <div class="action">
      <div class="switch1">
        <input type="checkbox" name="tax_calc" id="tax-calc" <?php if(\dash\data::dataRow_tax_calc()) { echo 'checked'; } ?>>
        <label for="tax-calc" data-on='<?php echo T_("Yes") ?>' data-off="<?php echo T_("No") ?>"></label>
      </div>
    </div>
  </form>
</section>

</div>

<?php if(false) {?>

<!-- Need to check later -->

          <hr>
          <div class="switch1 fs12">
           <input type="checkbox" name="tax_calc_all_price" id="tax-calc-all-price" <?php if(\dash\data::dataRow_tax_calc_all_price()) { echo 'checked'; } ?>>
           <label for="tax-calc-all-price"></label>
           <label for="tax-calc-all-price"><?php echo T_("Show all prices with tax included"); ?></label>
          </div>
          <p class="fc-mute"><?php echo T_("If taxes are charged on shipping rates, then taxes are included in the shipping price."); ?></p>


          <hr>
          <div class="switch1 fs12">
           <input type="checkbox" name="tax_shipping" id="tax-shipping" <?php if(\dash\data::dataRow_tax_shipping()) { echo 'checked'; } ?>>
           <label for="tax-shipping"></label>
           <label for="tax-shipping"><?php echo T_("Charge tax on shipping rates"); ?></label>
          </div>
          <p class="fc-mute"><?php echo T_("Include shipping rates in the tax calculation."); ?></p>
<?php } //endif ?>