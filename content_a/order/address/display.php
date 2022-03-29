<?php $orderDetail = \dash\data::orderDetail(); ?>

<div class="row">

  <div class="c-xs-12 c-sm-12 c-md-3">
    <?php require_once(root. '/content_a/order/links.php'); ?>
  </div>
  <div class="c-xs-12 c-sm-12 c-md-9">
    <?php require_once(root. '/content_a/order/detail.php'); ?>
    <?php if(a($orderDetail, 'factor', 'customer')) { ?>
      <div class="box">
        <div class="body">
          <div class="f">
            <div class="cauto s12">
              <a class="item f" href="<?php echo \dash\url::kingdom(). '/crm/member/glance?id='. a($orderDetail, 'factor', 'customer') ;?>">
                <div>
                    <span class="fc-mute"><?php echo T_("Customer") ?></span>
                    <span class="font-bold"><?php echo a($orderDetail, 'factor', 'customer_detail', 'displayname') ?></span>
                </div>
              </a>
            </div>
            <div class="c1 mb-2"></div>
            <div class="cauto s12">
              <div>
                <span class="fc-mute"><?php echo T_("Mobile") ?></span>
                <span class="font-bold ltr inline-block"><?php echo \dash\fit::mobile(a($orderDetail, 'factor', 'customer_detail', 'mobile')) ?></span>
              </div>
            </div>
            <div class="c mb-2"></div>
            <div class="cauto s12">
              <div class="link" data-kerkere='.changecustomerForm'><?php echo T_("Change customer") ?></div>
            </div>
          </div>

        </div>
      </div>

    <?php } //endif ?>

    <form method="post" autocomplete="off" class="changecustomerForm" <?php if(a($orderDetail, 'factor', 'customer')) { echo 'data-kerkere-content="hide"'; }?>>
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
            <div class="alert-info mt-2 mb-0 pTB5"><?php echo T_("Quickly add customer"); ?></div>
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
              <input type="text" name="memberN" id="memberN" placeholder='<?php echo T_("Customer Name"); ?>'  maxlength='70' minlength="1">
            </div>
          </div>

        </div>

        <footer class="f">
          <div class="cauto"><?php if(a($orderDetail, 'factor', 'customer')) { ?><div data-confirm data-data='{"removecustomer": "removecustomer"}' class="btn-link-danger"><?php echo T_("Remove customer") ?></div><?php } // endif ?></div>
          <div class="c"></div>
          <div class="cauto"><button class="btn-primary"><?php echo T_("Save"); ?></button></div>

        </footer>

      </div>
    </form>
    <?php if(a($orderDetail, 'factor', 'customer')) {?>

      <div class="box">
        <div class="body">
          <div class="f">
            <div class="cauto s12">
              <div class="font-bold">
                <?php echo T_("Customer legal information") ?>
              </div>
            </div>
            <div class="c"></div>
            <div class="cauto s12">
              <div>
                <div class="link" data-kerkere='.viewCustomerLegalInformation'><?php echo T_("View") ?></div>
              </div>
            </div>
          </div>

          <div class="viewCustomerLegalInformation" data-kerkere-content='hide'>
            <?php $isNotSet = '<small class="fc-mute">'. T_("Not set"). '</small>'; ?>
            <div class="p-2">
              <div class="tblBox">
                <table class="tbl1 v4">
                  <tbody>
                    <tr>
                      <td class="collapsing"><div class="fc-mute"><?php echo T_("Company name") ?></div></td>
                      <td><?php $data = a($orderDetail, 'factor', 'customer_detail', 'companyname'); if($data) { echo '<b>' .$data. '</b>'; }else{ echo $isNotSet; } ?></td>
                    </tr>
                    <tr>
                      <td class="collapsing"><div class="fc-mute"><?php echo T_("Economic code") ?></div></td>
                      <td><?php $data = a($orderDetail, 'factor', 'customer_detail', 'companyeconomiccode'); if($data) { echo '<b>' .$data. '</b>'; }else{ echo $isNotSet; } ?></td>
                    </tr>
                    <tr>
                      <td class="collapsing"><div class="fc-mute"><?php echo T_("Company national id") ?></div></td>
                      <td><?php $data = a($orderDetail, 'factor', 'customer_detail', 'companynationalid'); if($data) { echo '<b>' .$data. '</b>'; }else{ echo $isNotSet; } ?></td>
                    </tr>
                    <tr>
                      <td class="collapsing"><div class="fc-mute"><?php echo T_("Company register number") ?></div></td>
                      <td><?php $data = a($orderDetail, 'factor', 'customer_detail', 'companyregisternumber'); if($data) { echo '<b>' .$data. '</b>'; }else{ echo $isNotSet; } ?></td>
                    </tr>

                    <tr>
                      <td colspan="2"><a href="<?php echo \dash\url::kingdom(). '/crm/member/legal?id='. a($orderDetail, 'factor', 'customer') ?>" class="link"><?php echo T_("Edit legal information") ?></a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    <?php }// endif ?>

    <?php if(\dash\data::customerAddressList()) {?>

      <div class="box">
        <div class="pad">
          <div class="font-bold mb-2"><?php echo T_("Replace order address by customer saved address") ?></div>

              <?php foreach (\dash\data::customerAddressList() as $key => $value) {?>
               <div class="c-xs-12 c-sm-6 c-md-4 c-xl-3" data-confirm data-data='{"updateaddress": "<?php echo a($value, 'id') ?>"}'>
                <div class="radio4">
                  <input  id="address<?php echo $key; ?>" type="radio" name="address_id" value="<?php echo a($value, 'id'); ?>" <?php if(\dash\data::currentCustomerAddressid() == a($value, 'id')) {echo 'checked';} ?>>
                  <label for="address<?php echo $key; ?>">
                    <address>
                      <div class="title"><?php echo a($value, 'name'); ?></div>
                      <?php if(a($value, 'mobile')) {?>
                        <div class="mobile"><?php echo T_("Mobile") ?> <b><?php echo \dash\fit::mobile(a($value, 'mobile')); ?></b></div>
                      <?php } //endif ?>
                      <div class="addr"><?php echo a($value, 'address'); ?></div>
                      <?php if(a($value, 'postcode')) {?>
                        <div class="postalcode"><?php echo T_("Postalcode") ?> <b><?php echo \dash\fit::text(a($value, 'postcode')); ?></b></div>
                      <?php } //endif ?>
                      <?php if(a($value, 'phone')) {?>
                        <div class="phone"><?php echo T_("Phone") ?> <b><?php echo \dash\fit::text(a($value, 'phone')); ?></b></div>
                      <?php } //endif ?>
                    </address>
                  </label>
                </div>
               </div>
              <?php } //endfor ?>
        </div>
      </div>

    <?php } //endif ?>

    <form method="post" autocomplete="off">


      <div class="box">
        <header><h2><?php echo T_("Edit Order Address") ?></h2></header>
        <div class="body">

          <label for="name"><?php echo T_("Name"); ?></label>
          <div class="input">
            <input type="text" name="name" id="name" value="<?php  echo \dash\data::dataRowAddress_name(); ?>" maxlength='40' minlength="1" placeholder='<?php echo T_("Name of person in this address"); ?>'>
          </div>

          <?php echo \dash\utility\location::pack(\dash\data::dataRowAddress_country(), \dash\data::dataRowAddress_province(), \dash\data::dataRowAddress_city()); ?>

          <label for="address"><?php echo T_("Address"); ?> <small class="fc-red"><?php echo T_("Require"); ?></small></label>
          <textarea class="txt mb-2 pB25" name="address"  maxlength='300' rows="2"><?php echo \dash\data::dataRowAddress_address(); ?></textarea>

          <label for="postcode"><?php echo T_("Post code"); ?></label>
          <div class="input ltr">
            <input type="text" name="postcode" id="postcode" value="<?php echo \dash\data::dataRowAddress_postcode(); ?>" data-format="postalCode" >
          </div>

          <div class="f">
            <div class="c s12 pRa5">
              <label for="iphone"><?php echo T_("Phone"); ?></label>
              <div class="input">
                <input type="text" name="phone" id="iphone" value="<?php echo \dash\data::dataRowAddress_phone(); ?>" data-format="tel">
              </div>
            </div>
            <div class="c s12">

              <label for="iMobile"><?php echo T_("Mobile"); ?></label>
              <div class="input">
                <input type="tel" name="mobile" id="iMobile" value="<?php if(\dash\data::dataRowAddress_mobile()) { echo \dash\data::dataRowAddress_mobile(); } ?>" data-format="tel">
              </div>
            </div>
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