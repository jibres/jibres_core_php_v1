<?php $orderDetail = \dash\data::orderDetail(); ?>

<div class="row p0">
  <div class="c-xs-12 c-sm-3">
    <?php require_once(root. '/content_a/order/links.php'); ?>
  </div>
  <div class="c-xs-12 c-sm-9">

    <div class="box">
      <div class="body">
        <table class="tbl1 v4">
          <tbody>
            <tr>
              <td><?php echo T_("Customer") ?></td>
              <td>
                <?php if (\dash\get::index($orderDetail, 'factor', 'customer')) {?>
                  <?php echo \dash\get::index($orderDetail, 'factor', 'customer_displayname'); ?>
                  <span class="ltr compact"><?php echo \dash\fit::mobile(\dash\get::index($orderDetail, 'factor', 'customer_mobile')); ?></span>
                  <a class="link btn" href="<?php echo \dash\url::kingdom(). '/crm/member/glance?id='. $orderDetail['factor']['customer']; ?>"><?php echo T_("View profile") ?></a>
                <?php }else{ ?>
                  <?php echo T_("The user is not logged in to save their details!") ?>
                <?php } // endif ?>
              </td>
            </tr>
            <tr>
              <td><?php echo T_("Status") ?></td>
              <td><?php echo \dash\get::index($orderDetail, 'factor', 't_status'); ?></td>
            </tr>
            <tr>
              <td><?php echo T_("Order date") ?></td>
              <td><?php echo \dash\fit::date_time(\dash\get::index($orderDetail, 'factor', 'datecreated')); ?> <small class="fc-mute mLa20"><?php echo \dash\fit::date_human(\dash\get::index($orderDetail, 'factor', 'datecreated')) ?></small></td>
            </tr>

            <?php if(\dash\get::index($orderDetail, 'factor', 'discount')) {?>
              <tr>
                <td><?php echo T_("Discount") ?></td>
                <td><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'discount')). ' '. \lib\store::currency(); ?></td>
              </tr>
            <?php } //endif ?>
            <?php if(\dash\get::index($orderDetail, 'factor', 'shipping')) {?>
              <tr>
                <td><?php echo T_("Shipping") ?></td>
                <td><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'shipping')). ' '. \lib\store::currency(); ?></td>
              </tr>
            <?php } //endif ?>

            <tr>
              <td><?php echo T_("Total") ?></td>
              <td><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'total')). ' '. \lib\store::currency(); ?></td>
            </tr>
            <tr class="warning">
              <td><?php echo T_("Description") ?> <a href="<?php echo \dash\url::this(). '/edit?id='. \dash\request::get('id') ?>" class="btn link"><?php echo T_("Edit") ?></a></td>
              <td><?php echo \dash\get::index($orderDetail, 'factor', 'desc'); ?></td>
            </tr>

            <tr>
              <td><?php echo T_("Address") ?></td>
              <td>
                <?php $address = \dash\get::index(\dash\data::orderDetail(), 'address'); ?>
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
            <tr class="<?php if (\dash\get::index($orderDetail, 'factor', 'pay')) { echo 'positive'; }else{ echo 'negative';}?>">
              <td><?php echo T_("Pay status") ?></td>
              <td>
                <?php if (\dash\get::index($orderDetail, 'factor', 'pay')) {?>
                  <i class="sf-check-circle fc-green mRa10 fs14"></i><?php echo T_("Factor is payed") ?>
                <?php }else{ ?>
                  <i class="sf-times-circle fc-red mRa10 fs14"></i><?php echo T_("Factor is not payed") ?>
                  <p><?php echo T_("If you get the amount of this factor Set order as paid by click below link") ?></p>
                  <div class="link btn" data-confirm data-data='{"setaction": "pay_successfull"}' ><?php echo T_("Amount received") ?></div>
                <?php } //endif ?>
              </td>
            </tr>
            <tr class="disabled">
              <td><?php echo T_("Remove order") ?></td>
              <td>
                <div data-confirm data-data='{"removeorder": "removeorder"}' class=""><i class="sf-trash fc-red fs12"></i></div>
              </td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>

    <h3><?php echo T_("Order products") ?></h3>
    <nav class="items">
      <ul>
        <?php foreach (\dash\get::index($orderDetail, 'factor_detail') as $key => $value) {?>
          <li>
            <a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='.\dash\get::index($value, 'product_id'); ?>">
              <div class="key"><?php echo \dash\get::index($value, 'title');?></div>
              <div class="value"><?php echo \dash\fit::number(\dash\get::index($value, 'count')). ' '. \dash\get::index($value, 'unit'); ?></div>
            </a>
          </li>
        <?php } //endfor ?>
      </ul>
    </nav>

  </div>
</div>
