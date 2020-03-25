

<div id="get_started_card">
  <div class="body">
    <div class="pad">
      <h1><?php echo \dash\face::title(); ?></h1>
      <p><?php echo T_("Selling physical products? You need to ship them!"); ?></p>
       <form method="post" autocomplete="off">

        <div class="switch1 fs12">
         <input type="checkbox" name="shipping_status" id="shipping-status" <?php if(\dash\data::dataRow_shipping_status()) { echo 'checked'; } ?>>
         <label for="shipping-status"></label>
         <label for="shipping-status"><?php echo T_("Do you have shipping?"); ?></label>
        </div>

        <div data-response='shipping_status'  <?php if(!\dash\data::dataRow_shipping_status()) {echo 'data-response-hide'; }  ?>>

          <br>

          <div class="switch1 fs12">
           <input type="checkbox" name="shipping_current_country" id="shipping_current_country" <?php if(\dash\data::dataRow_shipping_current_country()) { echo 'checked'; } ?>>
           <label for="shipping_current_country"></label>
           <label for="shipping_current_country"><?php echo T_("Ship to"); ?> <?php echo \dash\data::myCountryName(); ?></label>
          </div>


          <div data-response='shipping_current_country'  <?php if(!\dash\data::dataRow_shipping_current_country()) {echo 'data-response-hide'; }  ?>>

            <div class="f mB10">
              <div class="c pRa5">
                  <div class="radio3">
                    <input type="radio" name="shipping_current_country_value_type" value="free" id="shipping_current_country_free" <?php if(\dash\data::dataRow_shipping_current_country_value()) { echo 'checked';} ?> >
                    <label for="shipping_current_country_free"><?php echo T_("Free"); ?></label>
                  </div>
              </div>
              <div class="c">
                  <div class="radio3">
                    <input type="radio" name="shipping_current_country_value_type" value="static" id="shipping_current_country_static"  <?php if(\dash\data::dataRow_shipping_current_country_value()) { echo 'checked';} ?> >
                    <label for="shipping_current_country_static"><?php echo T_("Static price"); ?></label>
                  </div>
              </div>
            </div>
            <div data-response='shipping_current_country_value_type' data-response-where='static' <?php if(!\dash\data::dataRow_shipping_current_country_value()) {echo 'data-response-hide'; }  ?> >
              <div class="input">
                <input type="text" name="shipping_current_country_value" id="iShippingCurrentCountryValue" value="<?php echo \dash\data::dataRow_shipping_current_country_value(); ?>" data-format="price" maxlength="12">
                <label for="iShippingCurrentCountryValue" class="addon"><?php echo \dash\data::storeCurrency_symbol_native(); ?></label>
              </div>
            </div>

          </div>
          <br>

          <div class="switch1 fs12">
           <input type="checkbox" name="shipping_other_country" id="shipping_other_country" <?php if(\dash\data::dataRow_shipping_other_country()) { echo 'checked'; } ?>>
           <label for="shipping_other_country"></label>
           <label for="shipping_other_country"><?php echo T_("Ship to other country"); ?></label>
          </div>


          <div data-response='shipping_other_country'  <?php if(!\dash\data::dataRow_shipping_other_country()) {echo 'data-response-hide'; }  ?>>

            <div class="f mB10">
              <div class="c pRa5">
                  <div class="radio3">
                    <input type="radio" name="shipping_other_country_value_type" value="free" id="shipping_other_country_free" <?php if(\dash\data::dataRow_shipping_other_country_value()) { echo 'checked';} ?> >
                    <label for="shipping_other_country_free"><?php echo T_("Free"); ?></label>
                  </div>
              </div>
              <div class="c">
                  <div class="radio3">
                    <input type="radio" name="shipping_other_country_value_type" value="static" id="shipping_other_country_static"  <?php if(\dash\data::dataRow_shipping_other_country_value()) { echo 'checked';} ?> >
                    <label for="shipping_other_country_static"><?php echo T_("Static price"); ?></label>
                  </div>
              </div>
            </div>
            <div data-response='shipping_other_country_value_type' data-response-where='static' <?php if(!\dash\data::dataRow_shipping_other_country_value()) {echo 'data-response-hide'; }  ?> >
              <div class="input">
                <input type="text" name="shipping_other_country_value" id="iShippingotherCountryValue" value="<?php echo \dash\data::dataRow_shipping_other_country_value(); ?>" data-format="price" maxlength="12">
                <label for="iShippingotherCountryValue" class="addon"><?php echo \dash\data::storeCurrency_symbol_native(); ?></label>
              </div>
            </div>

          </div>




        </div>


        <div class="f align-center mB10">
          <div class="c fc-mute"><?php echo \dash\data::stepDesc(); ?></div>
          <div class="cauto os"><button class="btn primary"><?php echo T_("Save"); ?></button></div>
        </div>

      </form>
    </div>
  </div>
</div>
