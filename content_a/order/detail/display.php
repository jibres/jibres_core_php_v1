<?php $orderDetail = \dash\data::orderDetail(); ?>

<div class="row p0">
  <div class="c-xs-12 c-sm-3">
    <?php require_once(root. '/content_a/order/links.php'); ?>
  </div>
  <div class="c-xs-12 c-sm-9">

    <div class="box">
      <div class="pad">
        <table class="tbl1 v4">
          <tbody>
            <?php if (\dash\get::index($orderDetail, 'factor', 'customer')) {?>
            <tr>
              <td class="collapsing"><?php echo T_("Customer") ?></td>
              <td>
                  <?php echo \dash\get::index($orderDetail, 'factor', 'customer_displayname'); ?>
                  <span class="ltr compact"><?php echo \dash\fit::mobile(\dash\get::index($orderDetail, 'factor', 'customer_mobile')); ?></span>
              </td>
            </tr>
            <?php } // endif ?>
            <tr>
              <td class="collapsing"><?php echo T_("Order Type") ?></td>
              <td><?php echo \dash\get::index($orderDetail, 'factor', 't_type'); ?></td>
            </tr>
            <?php if(\dash\get::index($orderDetail, 'factor', 'status') !== 'draft') {?>
            <tr>
              <td class="collapsing"><?php echo T_("Status") ?></td>
              <td><?php echo \dash\get::index($orderDetail, 'factor', 't_status'); ?></td>
            </tr>
          <?php } //endif ?>
            <tr>
              <td class="collapsing"><?php echo T_("Order date") ?></td>
              <td><?php echo \dash\fit::date_time(\dash\get::index($orderDetail, 'factor', 'datecreated')); ?> <small class="fc-mute mLa20"><?php echo \dash\fit::date_human(\dash\get::index($orderDetail, 'factor', 'datecreated')) ?></small></td>
            </tr>

            <tr class="">
              <td class="collapsing"><?php echo T_("Subtotal") ?></td>
              <td class=""><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'subtotal')). ' '. \lib\store::currency(); ?></td>
            </tr>

            <?php if(\dash\get::index($orderDetail, 'factor', 'subdiscount')) {?>
            <tr class="">
              <td class="collapsing"><?php echo T_("Subdiscount") ?></td>
              <td class=""><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'subdiscount')). ' '. \lib\store::currency(); ?></td>
            </tr>
          <?php } //endif ?>


          <?php if(\dash\get::index($orderDetail, 'factor', 'subvat')) {?>
            <tr class="">
              <td class="collapsing"><?php echo T_("Vat") ?></td>
              <td class=""><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'subvat')). ' '. \lib\store::currency(); ?></td>
            </tr>
          <?php } //endif ?>

            <?php if(\dash\get::index($orderDetail, 'factor', 'discount')) {?>
              <tr>
                <td class="collapsing"><?php echo T_("Discount") ?></td>
                <td><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'discount')). ' '. \lib\store::currency(); ?></td>
              </tr>
            <?php } //endif ?>
            <?php if(\dash\get::index($orderDetail, 'factor', 'shipping')) {?>
              <tr>
                <td class="collapsing"><?php echo T_("Shipping") ?></td>
                <td><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'shipping')). ' '. \lib\store::currency(); ?></td>
              </tr>
            <?php } //endif ?>




            <tr class="active">
              <td class="collapsing"><?php echo T_("Total") ?></td>
              <td class="txtB font-16"><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'total')). ' '. \lib\store::currency(); ?></td>
            </tr>


            <?php $address = \dash\get::index(\dash\data::orderDetail(), 'address'); ?>
            <?php if($address) {?>
            <tr>
              <td class="collapsing"><?php echo T_("Address") ?></td>
              <td>

                <address>
                  <div class="title"><?php echo \dash\get::index($address, 'name'); ?></div>
                  <?php if(\dash\get::index($address, 'mobile')) {?>
                    <div class="mobile"><?php echo T_("Mobile") ?> <b><?php echo \dash\fit::mobile(\dash\get::index($address, 'mobile')); ?></b></div>
                  <?php } //endif ?>
                  <div class="addr"><?php echo \dash\get::index($address, 'address'); ?></div>
                  <?php if(\dash\get::index($address, 'postcode')) {?>
                    <div class="postalcode"><?php echo T_("Postalcode") ?> <b><?php echo \dash\fit::text(\dash\get::index($address, 'postcode')); ?></b></div>
                  <?php } //endif ?>
                  <?php if(\dash\get::index($address, 'phone')) {?>
                    <div class="phone"><?php echo T_("Phone") ?> <b><?php echo \dash\fit::text(\dash\get::index($address, 'phone')); ?></b></div>
                  <?php } //endif ?>
                </address>
              </td>
            </tr>
          <?php } //endif ?>
          <?php if(\dash\get::index($orderDetail, 'factor', 'desc')) {?>
            <tr class="warning">
              <td class="collapsing"><?php echo T_("Description") ?></td>
              <td><?php echo \dash\get::index($orderDetail, 'factor', 'desc'); ?></td>
            </tr>
          <?php } //endif ?>
            <tr class="<?php if (\dash\get::index($orderDetail, 'factor', 'pay')) { echo 'positive'; }else{ echo 'negative';}?>">
              <td class="collapsing"><?php echo T_("Pay status") ?></td>
              <td>
                <?php if (\dash\get::index($orderDetail, 'factor', 'pay')) {?>
                  <i class="sf-check-circle fc-green mRa10 fs14"></i><?php echo T_("Factor is payed") ?>
                <?php }else{ ?>
                  <i class="sf-times-circle fc-red mRa10 fs14"></i><?php echo T_("Factor is not payed") ?>
                  <!-- <p><?php echo T_("If you get the amount of this factor Set order as paid by click below link") ?></p>
                  <div class="link btn" data-confirm data-data='{"setaction": "pay_successfull"}' ><?php echo T_("Amount received") ?></div> -->
                <?php } //endif ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <?php require_once(root. 'content_a/order/productList.php') ?>

  </div>
</div>