<form method="post" id='shippingForm' autocomplete="new-password">
  <div class="avand shippingPage">
    <div class="row">
      <div class="c-xs-12 c-sm-12 c-lg-8">
        <?php if(\dash\user::login()) {?>
          <?php if(\dash\data::addressDataTable()) {?>
            <div class="box">
                <h2><?php echo T_("Please choose your address"); ?></h2>
                <div class="row padLess">

                <?php foreach (\dash\data::addressDataTable() as $key => $value) {?>
                 <div class="c-xs-12 c-sm-6 c-md-4 c-xl-3">
                  <div class="radio4">
                    <input  id="address<?php echo $key; ?>" type="radio" name="address_id" value="<?php echo \dash\get::index($value, 'id'); ?>" <?php if(count(\dash\data::addressDataTable()) === 1) {echo 'checked';} ?>>
                    <label for="address<?php echo $key; ?>">
                      <address>
                        <div class="title"><?php echo \dash\get::index($value, 'name'); ?></div>
                        <?php if(\dash\get::index($value, 'mobile')) {?>
                          <div class="mobile"><?php echo T_("Mobile") ?> <b><?php echo \dash\fit::mobile(\dash\get::index($value, 'mobile')); ?></b></div>
                        <?php } //endif ?>
                        <div class="addr"><?php echo \dash\get::index($value, 'address'); ?></div>
                        <?php if(\dash\get::index($value, 'postcode')) {?>
                          <div class="postalcode"><?php echo T_("Postalcode") ?> <b><?php echo \dash\fit::text(\dash\get::index($value, 'postcode')); ?></b></div>
                        <?php } //endif ?>
                        <?php if(\dash\get::index($value, 'phone')) {?>
                          <div class="phone"><?php echo T_("Phone") ?> <b><?php echo \dash\fit::text(\dash\get::index($value, 'phone')); ?></b></div>
                        <?php } //endif ?>
                      </address>
                    </label>
                  </div>
                 </div>
                <?php } //endfor ?>
                 <div class="c-xs-12 c-sm-6 c-md-4 c-xl-3">
                  <div class="radio4">
                    <input  id="address_new" type="radio" name="address_id" value="new_address" >
                    <label for="address_new"><?php echo T_("Add new address"); ?></label>
                  </div>
                 </div>
                </div>
            </div>
          <?php } // endif ?>
        <?php } //endif ?>
        <?php addNewAddress(\dash\data::addressDataTable()); ?>

        <div class="box">
          <input type="hidden" name="payway" value="online">
          <?php if(false) {?>
            <?php if(\dash\data::paymentWay()) {?>
              <?php foreach (\dash\data::paymentWay() as $key => $value) {?>
                <?php var_dump($value); ?>
                <div class="radio3 mB10">
                  <input  id="payway<?php echo $key; ?>" type="radio" name="payway" value="<?php echo \dash\get::index($value, 'key'); ?>" <?php if($key === 'online') { echo 'checked';} ?>>
                  <label for="payway<?php echo $key; ?>"><?php echo \dash\get::index($value, 'title'); ?></label>
                </div>
              <?php } //endfor ?>
            <?php } // endif ?>
            <?php } // endif ?>
            <label for="desc"><?php echo T_("Order descripion"); ?></label>
            <textarea class="txt" name="desc" maxlength='300' rows="2" placeholder="<?php echo T_("If you have note about this order enter it here") ?>"></textarea>
        </div>
        <?php if(\dash\data::shippingSettingSaved_page_text()) {?><p class="msg fs14 <?php echo \dash\data::shippingSettingSaved_color_class() ?>"><?php echo \dash\data::shippingSettingSaved_page_text(); ?></p><?php } //endif ?>
      </div>
      <?php if(\dash\data::cartSummary()) {?>
        <div class="c-xs-12 c-sm-12 c-lg-4">
          <?php require_once(root. '/content_business/cart/cartSummary.php') ?>
          <?php if(\dash\data::myCart()) {?>
               <nav class="items long">
                 <ul>
                  <?php foreach (\dash\data::myCart() as $key => $value) {?>
                   <li>
                    <a class="f" href="<?php echo \dash\get::index($value, 'url'); ?>">
                      <img src="<?php echo \dash\get::index($value, 'thumb'); ?>" alt="<?php echo \dash\get::index($value, 'title');?>">
                      <div class="key"><?php echo \dash\get::index($value, 'title');?></div>
                      <div class="value"><?php echo \dash\fit::number(\dash\get::index($value, 'count')). ' '. \dash\get::index($value, 'unit'); ?></div>
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






<?php function addNewAddress($_have_old_address) {?>
<?php if($_have_old_address) {?>
  <div data-response='address_id' data-response-hide data-response-where='new_address' data-response-effect='slide'>
<?php } //endif ?>
<div class="box">
      <div class="row padLess">
        <div class="c-6 c-xs-12">
            <label for="xnm"><?php echo T_("Name"); ?></label>
            <div class="input">
              <input type="text" name="xnm" id="xnm" value="<?php if(\dash\data::dataRowAddress_name()) { echo \dash\data::dataRowAddress_name(); }elseif(\dash\data::dataRowMember()) { echo \dash\data::dataRowMember_displayname(); }elseif(!\dash\data::dataRowAddress()) { echo \dash\user::detail('displayname');}?>" maxlength='40' minlength="1">
            </div>
        </div>

        <div class="c-6 c-xs-12">
          <label for="xmd"><?php echo T_("Mobile"); ?> <small class="fc-red"><?php echo T_("Require"); ?></small></label>
          <div class="input">
            <input type="tel" name="xmd" id="xmd" value="<?php if(\dash\data::dataRowAddress_mobile()) { echo \dash\data::dataRowAddress_mobile(); }elseif(\dash\data::dataRowMember_mobile()){ echo \dash\data::dataRowMember_mobile();}elseif(!\dash\data::dataRowAddress()){ echo \dash\user::detail('mobile');} ?>" data-format="tel">
          </div>
        </div>
      </div>


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

      <label for="xad"><?php echo T_("Address"); ?> <small class="fc-red"><?php echo T_("Require"); ?></small></label>
      <textarea class="txt mB10 pB25" name="xad"  maxlength='300' rows="2"><?php echo \dash\data::dataRowAddress_address(); ?></textarea>


      <div class="row padLess">
        <div class="c-6 c-xs-12">
           <label for="xpc"><?php echo T_("Post code"); ?></label>
            <div class="input ltr">
              <input type="text" name="xpc" id="xpc" value="<?php echo \dash\data::dataRowAddress_postcode(); ?>" data-format="postalCode" >
            </div>
        </div>
        <div class="c-6 c-xs-12">
          <label for="ixph"><?php echo T_("Phone"); ?></label>
          <div class="input">
            <input type="text" name="xph" id="ixph" value="<?php echo \dash\data::dataRowAddress_phone(); ?>" data-format="tel">
          </div>
        </div>
      </div>

</div>
<?php if($_have_old_address) {?>
  </div>
<?php } //endif ?>
<?php } //endif ?>