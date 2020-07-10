<?php $orderDetail = \dash\data::orderDetail(); ?>

<div class="avand">
  <div class="box">
    <header><h2><?php echo T_("Order detail") ?></h2></header>
    <div class="body">

      <div class="row">
        <div class="c-md-6">

          <?php if (\dash\get::index($orderDetail, 'factor', 'customer')) {?>

            <div class="msg">
              <?php echo \dash\get::index($orderDetail, 'factor', 'customer_displayname'); ?>
              <span class="ltr compact"><?php echo \dash\fit::mobile(\dash\get::index($orderDetail, 'factor', 'customer_mobile')); ?></span>
              <a class="link btn" href="<?php echo \dash\url::kingdom(). '/crm/member/glance?id='. $orderDetail['factor']['customer']; ?>"><?php echo T_("View profile") ?></a>
            </div>

          <?php }else{ ?>
            <div class="msg"><?php echo T_("This order not set to any customer") ?></div>
          <?php } // endif ?>
        </div>
        <div class="c-md-6">
          <div class="btn mB10 info"><?php echo T_("Status"). ' '. \dash\get::index($orderDetail, 'factor', 'status'); ?></div>
          <div class="btn mB10"><?php echo T_("Last modified"). ' '. \dash\fit::date_human(\dash\get::index($orderDetail, 'factor', 'datemodified')); ?></div>
        </div>
      </div>


      <div class="msg"><?php echo T_("Total"); ?><span class="txtB"><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'total')); ?></span></div>
      <div class="msg"><?php echo T_("Discount"); ?><span class="txtB"><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'didscount')); ?></span></div>
      <?php if(\dash\get::index($orderDetail, 'factor', 'desc')) {?><div class="msg"><?php echo T_("Description"); ?><span class="txtB"><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'desc')); ?></span></div><?php }// endif ?>
    </div>

  </div>

  <?php $address = \dash\get::index(\dash\data::orderDetail(), 'address'); ?>
  <div class="box">
    <header><h2><?php echo T_("Order Address") ?></h2></header>
    <div class="body">

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
    <footer>
      <div class="txtRa">
        <a class="btn link" href="<?php echo \dash\url::this(). '/editaddress?id='. \dash\request::get('id'); ?>"><?php echo T_("Edit address") ?></a>
      </div>
    </footer>


  </div>



  <div class="box">
    <header><h2><?php echo T_("Order items") ?></h2></header>
    <div class="body">

      <table class="tbl1 v4">
        <thead>
          <tr>
            <th class="collapsing">#</th>
            <th><?php echo T_("Title"); ?></th>
            <th><?php echo T_("Count"); ?></th>
            <th><?php echo T_("Price"); ?></th>
            <th><?php echo T_("Sum"); ?></th>
          </tr>
        </thead>
        <tbody>

          <?php foreach (\dash\get::index($orderDetail, 'factor_detail') as $key => $value) {?>
            <tr>
              <td class="collapsing"><?php echo \dash\fit::number($key + 1); ?></td>
              <td><?php echo \dash\get::index($value, 'title'); ?></td>
              <td><?php echo \dash\fit::number(\dash\get::index($value, 'count')); ?></td>
              <td><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?></td>
              <td><?php echo \dash\fit::number(\dash\get::index($value, 'sum')); ?></td>
            </tr>
          <?php } //endfor ?>
        </tbody>
      </table>

    </div>
    <footer>
      <div class="txtRa">
        <a class="btn link" href="<?php echo \dash\url::this(). '/edit?id='. \dash\request::get('id'); ?>"><?php echo T_("Edit items") ?></a>
      </div>
    </footer>

  </div>
</div>