<?php $orderDetail = \dash\data::orderDetail(); ?>

<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-3">
    <?php require_once(root. '/content_a/order/links.php'); ?>
  </div>
  <div class="c-xs-12 c-sm-12 c-md-9">
    <?php require_once(root. '/content_a/order/detail.php'); ?>
    <form method="post" autocomplete="off">
      <input type="hidden" name="updateshipping" value="updateshipping">
      <div class="box">
        <div class="pad">
          <?php require_once(root. '/content_a/order/summary.php'); ?>

          <label for='ishipping'><?php echo T_("Shipping") ?></label>
          <div class="input">
            <input type="tel" data-format='price' name="shipping" value="<?php echo a($orderDetail, 'factor', 'shipping') ?>">
          </div>
        </div>
        <footer class="txtRa">
          <button class="btn master"><?php echo T_("Save") ?></button>
        </footer>
      </div>
    </form>

    <?php if(a($orderDetail, 'factor', 'discount_id')) {?>

    <?php }else{ ?>
       <form method="post" autocomplete="off">
        <input type="hidden" name="adddiscount" value="adddiscount">
        <div class="box">
          <div class="body">
            <label for="discount_code"><?php echo T_("Discount code") ?></label>
            <div class="input ltr">
              <input type="text" name="discount_code" id="discount_code">
            </div>
          </div>
          <footer class="txtRa">
            <button class="btn master"><?php echo T_("Apply discount code") ?></button>
          </footer>
        </div>
      </form>
    <?php } // endif ?>
  </div>
</div>