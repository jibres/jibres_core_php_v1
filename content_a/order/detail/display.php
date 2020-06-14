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
        <a class="btn" href="<?php echo \dash\url::kingdom(). '/crm/member/address?id='. \dash\get::index($orderDetail, 'factor', 'customer') ?>"><?php echo T_("Add new address") ?></a>
      <?php }else{ ?>
        <div class="msg">Customer not set</div>
      <?php } // endif ?>

      <div class="jSlider1 mB10" data-slick>
        <?php foreach (\dash\get::index($orderDetail, 'factor_detail') as $key => $value) {?>
          <a href=""><?php echo \dash\get::index($value, 'title'); ?></a>
        <?php } //endfor ?>
      </div>

      <div class="txtRa">
        <button class="btn success"><?php echo T_("Save order") ?></button>
      </div>

    </form>
  </div>
</div>