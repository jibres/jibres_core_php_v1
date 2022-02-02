
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
      <a class="btn-primary" href="<?php echo \dash\url::that(); ?>/seller"><?php echo T_("Edit seller detail") ?></a>
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
      <a class="btn-primary" href="<?php echo \dash\url::that(); ?>/address"><?php echo T_("Edit address") ?></a>
    </div>
  </form>
</section>

<section class="f" data-option='setting-factor-print-show-vat' id="setting-factor-print-show-vat">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Show VAT in factor?"); ?></h3>
      <div class="body">
        <p><?php echo T_("Should the VAT column be displayed on the invoice under any circumstances?"); ?><br> <?php echo T_("By default, if the invoice has a discount, we will show the discount column, otherwise we will hide it."); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_show_vat_column" value="1">
    <div class="action">
      <div class="switch1">
        <input type="checkbox" name="show_vat_column" id="set_show_vat_column" <?php if(\dash\data::dataRow_show_vat_column()) { echo 'checked'; } ?>>
        <label for="set_show_vat_column" data-on='<?php echo T_("Yes") ?>' data-off="<?php echo T_("No") ?>"></label>
      </div>
    </div>
  </form>
</section>


<section class="f" data-option='setting-factor-print-show-discount' id="setting-factor-print-show-discount">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Show discount in factor?"); ?></h3>
      <div class="body">
        <p><?php echo T_("Should the discount column be displayed on the invoice under any circumstances?"); ?><br> <?php echo T_("By default, if the invoice has a discount, we will show the discount column, otherwise we will hide it."); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_show_discount_column" value="1">
    <div class="action">
      <div class="switch1">
        <input type="checkbox" name="show_discount_column" id="set_show_discount_column" <?php if(\dash\data::dataRow_show_discount_column()) { echo 'checked'; } ?>>
        <label for="set_show_discount_column" data-on='<?php echo T_("Yes") ?>' data-off="<?php echo T_("No") ?>"></label>
      </div>
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



<section class="f" data-option='setting-factor-updateproduct' id="setting-factor-updateproduct">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Update product price when prices change on the sales page?"); ?></h3>
      <div class="body">
        <p><?php echo T_("If this setting is on, when registering a sales order, by changing the price of a product, in addition to recording that price in the current invoice, the original price of the product will also change.
Note that the price of the product will be updated only if your employee is allowed to update the product, otherwise will only change the price of the product in the current order."); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_updatepriceonsalepage" value="1">
    <div class="action">
  <div class="switch1">
        <input type="checkbox" name="updatepriceonsalepage" id="updatepriceonsalepage" <?php if(\dash\data::dataRow_updatepriceonsalepage()) { echo 'checked'; } ?>>
        <label for="updatepriceonsalepage" data-on='<?php echo T_("Yes") ?>' data-off="<?php echo T_("No") ?>"></label>
      </div>
    </div>
  </form>
</section>



<section class="f" data-option='setting-factor-default-pay-status' id="setting-factor-default-pay-status">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Default order in admin set as payed?"); ?></h3>
      <div class="body">

      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_orderdefaultpaystatus" value="1">
    <div class="action">
      <div class="switch1">
        <input type="checkbox" name="orderdefaultpaystatus" id="orderdefaultpaystatus" <?php if(\dash\data::dataRow_orderdefaultpaystatus() !== 'no') { echo 'checked'; } ?>>
        <label for="orderdefaultpaystatus" data-on='<?php echo T_("Yes") ?>' data-off="<?php echo T_("No") ?>"></label>
      </div>
    </div>
  </form>
</section>



<section class="f" data-option='setting-factor-auto-print' id="setting-factor-auto-print">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Load print page automatically?"); ?></h3>
      <div class="body">
        <p>
          <?php echo T_("This option use in quick sale") ?>
        </p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_factorautoprint" value="1">
    <div class="action">
      <div class="switch1">
        <input type="checkbox" name="factorautoprint" id="factorautoprint" <?php if(\dash\data::dataRow_factorautoprint() !== 'no') { echo 'checked'; } ?>>
        <label for="factorautoprint" data-on='<?php echo T_("Yes") ?>' data-off="<?php echo T_("No") ?>"></label>
      </div>
    </div>
  </form>
</section>


<section class="f" data-option='setting-factor-default-print-size' id="setting-factor-default-print-size">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Default print size"); ?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_factordefaultprint" value="1">
    <div class="action">
      <select class="select22" name="factordefaultprint">
        <option value="receipt" <?php if(\dash\data::dataRow_factordefaultprint() === 'receipt') { echo 'selected'; } ?>><?php echo T_("Receipt") ?></option>
        <option value="a4_portrait" <?php if(\dash\data::dataRow_factordefaultprint() === 'a4_portrait') { echo 'selected'; } ?>><?php echo T_("A4 Portrait") ?></option>
        <option value="a4_landscape" <?php if(\dash\data::dataRow_factordefaultprint() === 'a4_landscape') { echo 'selected'; } ?>><?php echo T_("A4 Landscape") ?></option>
        <option value="a5_portrait" <?php if(\dash\data::dataRow_factordefaultprint() === 'a5_portrait') { echo 'selected'; } ?>><?php echo T_("A5 Portrait") ?></option>
        <option value="a5_landscape" <?php if(\dash\data::dataRow_factordefaultprint() === 'a5_landscape') { echo 'selected'; } ?>><?php echo T_("A5 Landscape") ?></option>

      </select>
    </div>
  </form>
</section>

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