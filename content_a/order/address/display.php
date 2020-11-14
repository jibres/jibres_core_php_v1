<?php $orderDetail = \dash\data::orderDetail(); ?>

<div class="row p0">

  <div class="c-xs-12 c-sm-3">
    <?php require_once(root. '/content_a/order/links.php'); ?>
  </div>

  <div class="c-xs-12 c-sm-9">

    <?php if(\dash\get::index($orderDetail, 'factor', 'customer')) {?>
      <div class="box">
        <div class="body">
          <div class="row">
            <div class="c-xs-6 c-sm-3">
              <div>
                <span class="fc-mute"><?php echo T_("Customer") ?></span>
                <span class="txtB"><?php echo \dash\get::index($orderDetail, 'factor', 'customer_displayname') ?></span>
              </div>
            </div>
            <div class="c-xs-6 c-sm-3">
              <div>
                <span class="fc-mute"><?php echo T_("Mobile") ?></span>
                <span class="txtB ltr compact"><?php echo \dash\fit::mobile(\dash\get::index($orderDetail, 'factor', 'customer_mobile')) ?></span>
              </div>
            </div>
            <div class="c-xs-6 c-sm-3">

            </div>
            <div class="c-xs-6 c-sm-3">
              <div class="link" data-kerkere='.changecustomerForm'><?php echo T_("Change customer") ?></div>
            </div>
          </div>

        </div>
      </div>
    <?php } //endif ?>

    <form method="post" autocomplete="off" class="changecustomerForm" <?php if(\dash\get::index($orderDetail, 'factor', 'customer')) { echo 'data-kerkere-content="hide"'; }?>>
      <input type="hidden" name="changecustomer" value="changecustomer">
      <div class="box">
        <div class="body">
          <p>
            <?php echo T_("Choose exists customer or click on '+' button and Add new customer Quickly") ?>
          </p>
          <div class="f">
            <div class="c">
              <select name="customer" class="select22"  data-model='html'  data-ajax--url='<?php echo \dash\url::kingdom(); ?>/crm/api?type=sale&json=true&list=customer' data-shortkey-search data-placeholder='<?php echo T_("Choose customer"); ?>'>
              </select>
            </div>
            <div class="cauto"><i data-kerkere='.addNewCustomer' class="sf-plus btn outline mLa5 pLR10"></i></div>
          </div>
          <div class="addNewCustomer" data-kerkere-content='hide'>
            <div class="msg info2 mT10 mB0 pTB5"><?php echo T_("Quickly add customer"); ?></div>
            <div class="input mTB5">
              <input type="tel" name="memberTl" id="memberTl" placeholder='<?php echo T_("Mobile"); ?> <?php echo T_("Like"); ?> <?php echo \dash\fit::mobile('09120123456'); ?>' <?php \dash\layout\autofocus::html() ?>  maxlength='30' data-response-realtime>
            </div>

            <select name="memberGender" id="memberGender" class="select22 mT5">
              <option value="" disabled><?php echo T_("Gender"); ?></option>
              <option value="0">-</option>
              <option value="male"><?php echo T_("Mr"); ?></option>
              <option value="female"><?php echo T_("Mrs"); ?></option>
            </select>

            <div class="input mT5">
              <input type="text" name="memberN" id="memberN" placeholder='<?php echo T_("Customer Name"); ?>'  maxlength='40' minlength="1">
            </div>
          </div>

        </div>

        <footer class="f">
          <div class="cauto"><?php if(\dash\get::index($orderDetail, 'factor', 'customer')) { ?><div data-confirm data-data='{"removecustomer": "removecustomer"}' class="btn linkDel"><?php echo T_("Remove customer") ?></div><?php } // endif ?></div>
          <div class="c"></div>
          <div class="cauto"><button class="btn primary"><?php echo T_("Save"); ?></button></div>

        </footer>

      </div>
    </form>

    <form method="post" autocomplete="off">

      <?php
      $address = \dash\get::index(\dash\data::orderDetail(), 'address');
      \dash\data::dataRowAddress($address);
      ?>

      <div class="box">
        <header><h2><?php echo T_("Edit Order Address") ?></h2></header>
        <div class="body">
          <?php if(\dash\get::index($address, 'address')) {?>
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
          <?php } //endif ?>

          <label for="name"><?php echo T_("Name"); ?></label>
          <div class="input">
            <input type="text" name="name" id="name" value="<?php  echo \dash\data::dataRowAddress_name(); ?>" maxlength='40' minlength="1" placeholder='<?php echo T_("Name of person in this address"); ?>'>
          </div>

          <?php \dash\utility\location::pack(\dash\data::dataRowAddress_country(), \dash\data::dataRowAddress_province(), \dash\data::dataRowAddress_city()); ?>

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
                <input type="tel" name="mobile" id="iMobile" value="<?php if(\dash\data::dataRowAddress_mobile()) { echo \dash\data::dataRowAddress_mobile(); } ?>" data-format="tel">
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
    </form>
  </div>
</div>