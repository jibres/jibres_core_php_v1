<div class="avand">
  <div class="row">
    <div class="c-xs-0 c-sm-0 c-lg-4 d-lg-block c-xl-3">
      <?php require_once(root. 'content_business/profile/display-menu.php'); ?>
    </div>
    <div class="c-xs-12 c-sm-12 c-lg-8 c-xl-9">

      <div class="box">
        <div class="body">
          <div class="row">
            <div class="c-auto">
              <div class="badge pA10-f mB10 fs09 light"><?php echo T_("Order number") ?> <code class="link"><?php echo a(\dash\data::dataRow_order(), 'id'); ?></code></div>
            </div>
            <div class="c-auto">
              <div class="badge pA10-f mB10 fs09 light"><?php echo T_("Order status") ?> <span class="link"><?php echo a(\dash\data::dataRow_order(), 't_status'); ?></span></div>
            </div>

            <div class="c-auto">
              <div class="badge pA10-f mB10 fs09 light"><?php echo T_("Order date") ?> <span class="link"><?php echo \dash\fit::date_time(a(\dash\data::dataRow_order(), 'date')); ?></span></div>
            </div>

          </div>

          <div class="msg">

            <span class=" link"><?php echo T_("Address") ?></span>
            <?php $address = a(\dash\data::dataRow(), 'address'); ?>
            <?php if(isset($address['country']) && $address['country']) {?><i class="flag <?php echo mb_strtolower($address['country']); ?>"></i><?php } //endif ?>
            <span ><?php echo a($address, 'location_string'); ?></span>
            <span><?php echo a($address, 'address'); ?></span>
            <?php if(isset($address['postcode']) && $address['postcode']) {?>
              <span title='<?php echo T_("Postal code"); ?>' class="compact"><?php echo \dash\fit::text($address['postcode']); ?><i class="sf-crosshairs mRL5"></i></span>
            <?php }//endif ?>
            <?php echo a($address, 'name'); ?>
            <?php if(isset($address['phone']) && $address['phone']) {?>
              <div title='<?php echo T_("Phone"); ?>'><i class="sf-phone"></i> <?php echo \dash\fit::text($address['phone']); ?></div>
            <?php } //endif ?>
            <?php if(isset($address['mobile']) && $address['mobile']) {?>
              <div title='<?php echo T_("Mobile"); ?>' class="mT5"><i class="sf-mobile"></i> <?php echo \dash\fit::mobile($address['mobile']); ?></div>
            <?php } //endif ?>

          </div>

        </div>

        <?php if(!a(\dash\data::dataRow_order(), 'pay') && a(\dash\data::dataRow_order(), 'status') !== 'cancel') {?>
          <footer class="txtRa">
            <div class="btn warn" data-confirm data-data='{"set_status": "cancel"}'><?php echo T_("Cancel order") ?></div>
          </footer>
        <?php } //endif ?>
      </div>


      <?php \lib\website::product_list(\dash\data::dataRow_products(), 2); ?>
    </div>
  </div>
</div>
