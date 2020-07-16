<form method="post" autocomplete="off">
  <div class="avand">
    <div class="row">
      <div class="c-8">
        <?php if(\dash\user::login()) {?>
          <?php if(\dash\data::addressDataTable()) {?>
            <div class="box">
              <header><h2><?php echo T_("Choose address"); ?></h2></header>
              <div class="body">
                <?php foreach (\dash\data::addressDataTable() as $key => $value) {?>
                  <div class="radio3 mB10">
                    <input  id="address<?php echo $key; ?>" type="radio" name="address_id" value="<?php echo \dash\get::index($value, 'id'); ?>" <?php if(count(\dash\data::addressDataTable()) === 1) {echo 'checked';} ?>>
                    <label for="address<?php echo $key; ?>"><?php echo \dash\get::index($value, 'address'); ?></label>
                  </div>
                <?php } //endfor ?>
              </div>
            </div>
          <?php } // endif ?>
        <?php } // endif ?>
        <div class="box">
          <header><h2 data-kerkere='.addNewAddress' data-kerkere-icon><?php echo T_("Add new address") ?></h2></header>
          <div class="addNewAddress fs08" <?php if(\dash\data::addressDataTable()) {?> data-kerkere-content='hide' <?php } // endif ?>>
            <div class="body">

              <div class="row">
                <div class="c-6">
                    <label for="name"><?php echo T_("Name"); ?></label>
                    <div class="input">
                      <input type="text" name="name" id="name" value="<?php if(\dash\data::dataRowAddress_name()) { echo \dash\data::dataRowAddress_name(); }elseif(\dash\data::dataRowMember()) { echo \dash\data::dataRowMember_displayname(); }elseif(!\dash\data::dataRowAddress()) { echo \dash\user::detail('displayname');}?>" maxlength='40' minlength="1" placeholder='<?php echo T_("Name of person in this address"); ?>'>
                    </div>
                </div>

                <div class="c-6">
                  <label for="iMobile"><?php echo T_("Mobile"); ?></label>
                  <div class="input">
                    <input type="tel" name="mobile" id="iMobile" value="<?php if(\dash\data::dataRowAddress_mobile()) { echo \dash\data::dataRowAddress_mobile(); }elseif(\dash\data::dataRowMember_mobile()){ echo \dash\data::dataRowMember_mobile();}elseif(!\dash\data::dataRowAddress()){ echo \dash\user::detail('mobile');} ?>" data-format="tel">
                  </div>
                </div>
              </div>


<?php if(false) {?>
    'share_text'           => string 'asdsadasdsasadasd' (length=17)
    'color'                => string 'green' (length=5)
    'page_text'            => string 'متن ثابت صفحه سفارشات' (length=39)
    'deliverinstoreplace'  => string '1' (length=1)
    'shipping_status'      => string '1' (length=1)
    'sendbycourier'        => string '1' (length=1)
    'sendbycourierprice'   => string '1' (length=1)
    'sendbypost'           => string '1' (length=1)
    'sendbypostprice'      => string '2' (length=1)
    'sendoutcity'          => string '1' (length=1)
    'sendoutcityprice'     => string '3' (length=1)
    'sendoutprovince'      => string '1' (length=1)
    'sendoutprovinceprice' => string '4' (length=1)
    'sendoutcountry'       => string '1' (length=1)
    'sendoutcountryprice'  => string '5' (length=1)
    'color_class'          => string 'success2' (length=8
<?php } //endif ?>


              <div class="mB10 <?php if(\dash\data::shippingSettingSaved_sendoutcountry()) {}else{ echo 'hide'; \dash\data::dataRowAddress_country('ir'); }?>">
                <label for='country'><?php echo T_("Country"); ?></label>
                <select class="select22" name="country" id="country" data-model='country' data-next='#province' data-next-default='<?php echo \dash\data::dataRowAddress_province(); ?>'>
                  <option value=""><?php echo T_("Choose your country"); ?></option>
                  <?php foreach (\dash\data::countryList() as $key => $value) {?>
                    <option value="<?php echo $key; ?>" <?php if(\dash\data::dataRowAddress_country() == $key) { echo 'selected';} ?>><?php echo ucfirst($value['name']); if(\dash\language::current() != 'en') { echo ' - '. T_(ucfirst($value['name']));} ?></option>
                  <?php } //endif ?>
                </select>
              </div>


              <div class="mB10 <?php if(\dash\data::shippingSettingSaved_sendoutprovince()) {}else{ echo 'hide';}?>" data-status='<?php if(\dash\data::shippingSettingSaved_sendoutcountry()) {echo 'hide';}?>'>
                <label for='province'><?php echo T_("Province"); ?></label>
                <select name="province" id="province" class="select22" data-next='#city' data-next-default='<?php echo \dash\data::dataRowAddress_city(); ?>'>
                  <option value="0"><?php echo T_("Please choose country"); ?></option>
                  <option value="<?php echo \dash\data::dataRowAddress_province(); ?>" selected><?php echo \dash\data::dataRowAddress_province(); ?></option>
                </select>
              </div>

              <div class="mB10 <?php if(\dash\data::shippingSettingSaved_sendoutcity()) {}else{ echo 'hide';}?>" data-status='<?php if(\dash\data::shippingSettingSaved_sendoutprovince()) {echo 'hide';}?>'>
                <label for='city'><?php echo T_("City"); ?></label>
                <select name="city" id="city" class="select22">
                  <option value=""><?php echo T_("Please choose province"); ?></option>
                </select>
              </div>

              <label for="address"><?php echo T_("Address"); ?> <small class="fc-red"><?php echo T_("Require"); ?></small></label>
              <textarea class="txt mB10 pB25" name="address"  maxlength='300' rows="2"><?php echo \dash\data::dataRowAddress_address(); ?></textarea>


              <div class="row">
                <div class="c-6">
                  <label for="iphone"><?php echo T_("Phone"); ?></label>
                  <div class="input">
                    <input type="text" name="phone" id="iphone" value="<?php echo \dash\data::dataRowAddress_phone(); ?>" data-format="tel">
                  </div>
                </div>
                <div class="c-6">
                   <label for="postcode"><?php echo T_("Post code"); ?></label>
                    <div class="input ltr">
                      <input type="text" name="postcode" id="postcode" value="<?php echo \dash\data::dataRowAddress_postcode(); ?>" data-format="postalCode" >
                    </div>
                </div>
              </div>
            </div>
            <?php if(\dash\user::login()) {?>
              <footer class="txtRa">
               <button class="btn master" name="save_address" value="new_address"><?php echo T_("Save address"); ?></button>
              </footer>
            <?php } //endif ?>
          </div>
        </div>
        <div class="box">
          <header><h2><?php echo T_("Payment") ?></h2></header>
          <div class="body">
            <?php if(\dash\data::paymentWay()) {?>
              <?php foreach (\dash\data::paymentWay() as $key => $value) {?>
                <div class="radio3 mB10">
                  <input  id="payway<?php echo $key; ?>" type="radio" name="payway" value="<?php echo \dash\get::index($value, 'key'); ?>" <?php if($key === 'online') { echo 'checked';} ?>>
                  <label for="payway<?php echo $key; ?>"><?php echo \dash\get::index($value, 'title'); ?></label>
                </div>
              <?php } //endfor ?>
            <?php } // endif ?>
            <label for="desc"><?php echo T_("Order descripion"); ?></label>
            <textarea class="txt mB10 pB25" name="desc"  maxlength='300' rows="2"></textarea>

          </div>
          <footer class="txtRa">
            <button class="btn master" type="submit" name="button" value="saveorder"><?php echo T_("Pay"); ?></button>
          </footer>
        </div>
        <?php if(\dash\data::shippingSettingSaved_page_text()) {?><p class="msg fs14 <?php echo \dash\data::shippingSettingSaved_color_class() ?>"><?php echo \dash\data::shippingSettingSaved_page_text(); ?></p><?php } //endif ?>
      </div>
      <?php if(\dash\data::cartSummary()) {?>
        <div class="c-4">
          <div class="cartPage">
            <div class="box orderSummary">
              <h3><?php echo T_("Order Summary"); ?></h3>
              <div>
                <dl class="subtotal">
                  <dt><?php echo T_("Subtotal"); ?></dt>
                  <dd><?php echo \lib\currency::unit(); ?> <?php echo \dash\fit::number(\dash\data::cartSummary_subtotal()); ?></dd>
                </dl>
                <dl class="discount">
                  <dt><?php echo T_("Discount"); ?></dt>
                  <dd><?php echo \lib\currency::unit(); ?> <?php echo \dash\fit::number(\dash\data::cartSummary_discount()); ?></dd>
                </dl>
                <dl class="shipping">
                  <dt><?php echo T_("Shipping"); ?></dt>
                  <dd><?php echo \lib\currency::unit(); ?> <?php echo \dash\fit::number(\dash\data::cartSummary_shipping()); ?></dd>
                </dl>

                <dl class="total">
                  <dt><?php echo T_("Total"); ?></dt>
                  <dd><?php echo \lib\currency::unit(); ?> <?php echo \dash\fit::number(\dash\data::cartSummary_total()); ?></dd>
                </dl>
              </div>

            </div>
          </div>
          <?php if(\dash\data::myCart()) {?>
               <nav class="items">
                 <ul>
                  <?php foreach (\dash\data::myCart() as $key => $value) {?>
                   <li>
                    <a class="f" href="<?php echo \dash\get::index($value, 'url'); ?>">
                      <img src="<?php echo \dash\get::index($value, 'thumb'); ?>" alt="<?php echo \dash\get::index($value, 'title');?>">
                      <div class="key"><?php echo \dash\get::index($value, 'title');?></div>
                      <div class="go"><?php echo \dash\fit::number(\dash\get::index($value, 'count')); ?></div>
                    </a>
                   </li>
                 <?php } //endfor ?>
                 </ul>
               </nav>
          <?php }else{ // no product in cart ?>
            <div class="msg warn2 txtC txtB fs14"><?php echo T_("No product in your cart") ?></div>
          <?php } //endif ?>
        </div>
      <?php } //endif ?>
    </div>
  </div>
</form>