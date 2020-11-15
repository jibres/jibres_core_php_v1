<?php $orderDetail = \dash\data::orderDetail(); ?>

<div class="row p0">
  <div class="c-xs-12 c-sm-3">
    <?php require_once(root. '/content_a/order/links.php'); ?>
  </div>
  <div class="c-xs-12 c-sm-9">


    <form method="post" autocomplete="off">

      <input type="hidden" name="updateshipping" value="updateshipping">

      <div class="box">
        <div class="pad">
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


    <form method="post" autocomplete="off">

      <div class="box">
        <div class="pad">


          <div class="msg">

            <?php if (\dash\get::index($orderDetail, 'factor', 'pay')) {?>
              <i class="sf-check-circle fc-green mRa10 fs14"></i><?php echo T_("Factor is payed") ?>
            <?php }else{ ?>
              <i class="sf-times-circle fc-red mRa10 fs14"></i><?php echo T_("Factor is not payed") ?>
              <p><?php echo T_("If you get the amount of this factor Set order as paid by click below link") ?>

              <div class="link" data-confirm data-data='{"setaction": "pay_successfull"}' ><?php echo T_("Amount received") ?></div>
              </p>
            <?php } //endif ?>
          </div>

          <div class="hide">
            <label for='ipaylink'><?php echo T_("Pay link") ?></label>
            <div class="input">
              <div data-copy='<?php echo \dash\url::pwd() ?>' class="addon btn"><?php echo T_("Copy") ?></div>
              <input type="tel" name="paylink" value="<?php echo \dash\url::pwd() ?>">
            </div>
          </div>

        </div>
      </div>
    </form>



  </div>
</div>