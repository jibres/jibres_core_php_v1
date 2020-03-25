

<div id="get_started_card">
  <div class="body">
    <div class="pad">
      <h1><?php echo \dash\face::title(); ?></h1>
      <p><?php echo T_("Manage how your store calculates and shows tax on your store."); ?></p>
      <form method="post" autocomplete="off">

        <div class="switch1 fs12">
         <input type="checkbox" name="tax_status" id="tax-status" <?php if(\dash\data::dataRow_tax_status()) { echo 'checked'; } ?>>
         <label for="tax-status"></label>
         <label for="tax-status"><?php echo T_("Do you want to calc tax?"); ?></label>
        </div>
        <p class="fc-mute"><?php echo T_("If tax is enable, we are add in products and factors based on antoher settings."); ?> <?php echo T_("If you turn it off, we are totally hide tax options from everywhere!"); ?></p>

        <div data-response='tax-status' <?php if(\dash\data::dataRow_tax_status()) {}else{ echo 'data-response-hide'; } ?>>

          <hr>
          <div class="switch1 fs12">
           <input type="checkbox" name="tax_calc" id="tax-calc" <?php if(\dash\data::dataRow_tax_calc()) { echo 'checked'; } ?>>
           <label for="tax-calc"></label>
           <label for="tax-calc"><?php echo T_("VAT default value for new product"); ?></label>
          </div>
          <p class="fc-mute"><?php echo T_("You can change default value for VAT on add new product."); ?></p>


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

        </div>


        <div class="f align-center mB10">
          <div class="c fc-mute"><?php echo \dash\data::stepDesc(); ?></div>
          <div class="cauto os"><button class="btn primary"><?php echo T_("Save"); ?></button></div>
        </div>

      </form>
    </div>
  </div>
</div>
