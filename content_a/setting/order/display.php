
<section class="f" data-option='setting-order-period' id="setting-order-validity-period">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Validity period of order"); ?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <a class="btn primary" href="<?php echo \dash\url::that(); ?>/validity"><?php echo T_("Set") ?></a>
    </div>
  </form>
</section>


<section class="f" data-option='setting-order-payment-gateway' id="setting-order-payment-gateway">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Online payment"); ?></h3>
      <div class="body">
        <p><?php echo T_("Such as Credit card, PayPal and Stripe."); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_payment_online" value="1">
    <div class="action">
      <div class="switch1">
        <input id="ipayment_online" type="checkbox" name="payment_online" <?php if(\lib\store::detail('payment_online')){ echo 'checked'; } ?>>
        <label for="ipayment_online" data-on="<?php echo T_("Enable"); ?>" data-off="<?php echo T_("Disable") ?>"></label>
      </div>
    </div>
  </form>
  <footer class="txtRa">
    <a class="link btn" href="<?php echo \dash\url::that(). '/onlinepayment' ?>"><?php echo T_("Manage Online payment config") ?></a>
  </footer>
</section>


<section class="f" data-option='setting-order-payment-gateway' id="setting-order-payment-gateway">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Cash on delivery"); ?></h3>
      <div class="body">
        <p><?php echo T_("Cash on Delivery (COD) is a payment gateway that required no payment be made online."); ?> <?php echo T_("Orders using Cash on Delivery are set to Processing until payment is made upon delivery of the order by you or your shipping method."); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_payment_on_deliver" value="1">
    <div class="action">
      <div class="switch1">
        <input id="ipayment_on_deliver" type="checkbox" name="payment_on_deliver" <?php if(\lib\store::detail('payment_on_deliver')){ echo 'checked'; } ?>>
        <label for="ipayment_on_deliver" data-on="<?php echo T_("Enable"); ?>" data-off="<?php echo T_("Disable") ?>"></label>
      </div>
    </div>
  </form>
</section>
