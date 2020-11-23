<?php $orderDetail = \dash\data::orderDetail(); ?>

<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-3">
    <?php require_once(root. '/content_a/order/links.php'); ?>
  </div>
  <div class="c-xs-12 c-sm-12 c-md-9">



    <form method="post" autocomplete="off">

      <input type="hidden" name="updateshipping" value="updateshipping">

      <div class="box">
        <div class="pad">

          <?php require_once(root. '/content_a/order/summary.php'); ?>

          <label for='idiscount'><?php echo T_("Discount") ?></label>
          <div class="input">
            <input type="tel" data-format='price' name="discount" value="<?php echo \dash\get::index($orderDetail, 'factor', 'discount') ?>">
          </div>

          <label for='ishipping'><?php echo T_("Shipping") ?></label>
          <div class="input">
            <input type="tel" data-format='price' name="shipping" value="<?php echo \dash\get::index($orderDetail, 'factor', 'shipping') ?>">
          </div>

        </div>
        <footer class="txtRa">
          <button class="btn master"><?php echo T_("Save") ?></button>
        </footer>
      </div>
    </form>




  </div>
</div>