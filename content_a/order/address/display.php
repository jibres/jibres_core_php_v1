<?php $orderDetail = \dash\data::orderDetail(); ?>
<form method="post" autocomplete="off">

<div class="avand">

<?php
$address = \dash\get::index(\dash\data::orderDetail(), 'address');
\dash\data::dataRowAddress($address);
?>

  <div class="box">
    <header><h2><?php echo T_("Edit Order Address") ?></h2></header>
    <div class="body">
      <div class="msg">

      <?php if(isset($address['company']) && $address['company']) {?>
        <i class="fs16 mRa5 sf-building"></i>
      <?php }else{ ?>
        <i class="fs16 mRa5 sf-pin"></i>
      <?php } // endif ?>
      <?php if(isset($address['country']) && $address['country']) {?><i class="flag <?php echo mb_strtolower($address['country']); ?>"></i><?php } //endif ?>

      <span ><?php echo \dash\get::index($address, 'location_string'); ?></span>

      <span><?php echo \dash\get::index($address, 'address'); ?></span>

      <?php if(isset($address['postcode']) && $address['postcode']) {?>

        <span title='<?php echo T_("Postal code"); ?>' class="compact"><?php echo \dash\fit::text($address['postcode']); ?><i class="sf-crosshairs mRL5"></i></span>

      <?php }//endif ?>
      <?php echo \dash\get::index($address, 'name'); ?></td>


      <?php if(isset($address['phone']) && $address['phone']) {?>

        <div title='<?php echo T_("Phone"); ?>'><i class="sf-phone"></i> <?php echo \dash\fit::text($address['phone']); ?></div>
      <?php } //endif ?>

      <?php if(isset($address['mobile']) && $address['mobile']) {?>

        <div title='<?php echo T_("Mobile"); ?>' class="mT5"><i class="sf-mobile"></i> <?php echo \dash\fit::mobile($address['mobile']); ?></div>
      <?php } //endif ?>


      </div>

      <label for="name"><?php echo T_("Name"); ?></label>
      <div class="input">
        <input type="text" name="name" id="name" value="<?php  echo \dash\data::dataRowAddress_name(); ?>" maxlength='40' minlength="1" placeholder='<?php echo T_("Name of person in this address"); ?>'>
      </div>


      <div class="mB10">
        <label for='country'><?php echo T_("Country"); ?></label>
        <select class="select22" name="country" id="country" data-model='country' data-next='#province' data-next-default='<?php echo \dash\data::dataRowAddress_province(); ?>'>
          <option value=""><?php echo T_("Choose your country"); ?></option>
          <?php foreach (\dash\data::countryList() as $key => $value) {?>

            <option value="<?php echo $key; ?>" <?php if(\dash\data::dataRowAddress_country() == $key) { echo 'selected';} ?>><?php echo ucfirst($value['name']); if(\dash\language::current() != 'en') { echo ' - '. T_(ucfirst($value['name']));} ?></option>

          <?php } //endif ?>
        </select>
      </div>


      <div class="mB10" data-status='hide'>
        <label for='province'><?php echo T_("Province"); ?></label>
        <select name="province" id="province" class="select22" data-next='#city' data-next-default='<?php echo \dash\data::dataRowAddress_city(); ?>'>
          <option value="0"><?php echo T_("Please choose country"); ?></option>
          <option value="<?php echo \dash\data::dataRowAddress_province(); ?>" selected><?php echo \dash\data::dataRowAddress_province(); ?></option>
        </select>
      </div>


      <div class="mB10" data-status='hide'>
        <label for='city'><?php echo T_("City"); ?></label>
        <select name="city" id="city" class="select22">
          <option value=""><?php echo T_("Please choose province"); ?></option>
        </select>
      </div>


      <label for="address"><?php echo T_("Address"); ?> <small class="fc-red"><?php echo T_("Require"); ?></small></label>
      <textarea class="txt mB10 pB25" name="address"  maxlength='300' rows="2"><?php echo \dash\data::dataRowAddress_address(); ?></textarea>

      <label for="postcode"><?php echo T_("Post code"); ?></label>
      <div class="input ltr">
        <input type="text" name="postcode" id="postcode" value="<?php echo \dash\data::dataRowAddress_postcode(); ?>" data-format="postalCode" >
      </div>

      <div class="f">
        <div class="c pRa5">



          <label for="iphone"><?php echo T_("Phone"); ?></label>
          <div class="input">
            <input type="text" name="phone" id="iphone" value="<?php echo \dash\data::dataRowAddress_phone(); ?>" data-format="tel">
          </div>

        </div>
        <div class="c">

          <label for="iMobile"><?php echo T_("Mobile"); ?></label>
          <div class="input">
            <input type="tel" name="mobile" id="iMobile" value="<?php if(\dash\data::dataRowAddress_mobile()) { echo \dash\data::dataRowAddress_mobile(); }elseif(\dash\data::dataRowMember_mobile()){ echo \dash\data::dataRowMember_mobile();}elseif(!\dash\data::dataRowAddress()){ echo \dash\user::detail('mobile');} ?>" data-format="tel">
          </div>


        </div>
      </div>

      <div class="switch1 mB20 mT20">
        <input type="checkbox" name="company" id="company" <?php if(\dash\data::dataRowAddress_company())  { echo 'checked'; } ?>>
        <label for="company" data-on='<?php echo T_("Yes"); ?>' data-off='<?php echo T_("No"); ?>'></label>
        <label for="company" ><?php echo T_("Is this a company's address?"); ?></label>
      </div>

    </div>

    <footer>
      <div class="txtRa">
        <button class="btn master" name="save_address" value="new_address"><?php echo T_("Save address"); ?></button>
      </div>
    </footer>


  </div>

</div>
</form>