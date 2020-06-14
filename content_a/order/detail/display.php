<?php $orderDetail = \dash\data::orderDetail(); ?>
<div class="avand">
  <div class="cbox">
    <form method="post" autocomplete="off">
      <?php if (\dash\get::index($orderDetail, 'factor', 'customer')) {?>
        <?php if(\dash\data::customerAddress()) {?>
          <h3><?php echo T_("Customer address") ?></h3>
          <?php foreach (\dash\data::customerAddress() as $key => $value) {?>
            <div class="radio3 mB10">
              <input type="radio" name="address" value="<?php echo \dash\get::index($value, 'id'); ?>" id="address_<?php echo \dash\get::index($value, 'id'); ?>">
              <label for="address_<?php echo \dash\get::index($value, 'id'); ?>"><?php echo \dash\get::index($value, 'address'); ?></label>
            </div>
          <?php } // endfor ?>
        <?php } // endif ?>
      <?php }else{ ?>
        <div class="msg">Customer not set</div>
      <?php } // endif ?>
    </form>
  </div>
</div>