


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
    <a class="link btn" href="<?php echo \dash\url::this(). '/thirdparty' ?>"><?php echo T_("Manage Online payment config") ?></a>
  </footer>
</section>

<div data-response='payment_online' <?php if(\lib\store::detail('payment_online')){ /*nothing*/ }else{ echo 'data-response-hide';} ?> data-response-effect='slide'>

<section class="f" data-option='setting-order-payment-default' id="setting-order-payment-default">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Default payment"); ?></h3>
      <div class="body">
        <p><?php echo T_("Default payment"); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_default_payment" value="1">
    <div class="action">
      <select class="select22" name="default_payment">
        <option value=""><?php echo T_("Without Default") ?></option>
        <?php foreach (\dash\utility\pay\get::active_payment() as $key => $value) {?>
          <option value="<?php echo a($value, 'key') ?>" <?php if(\lib\store::detail('default_payment') === a($value, 'key')) { echo 'selected';} ?>><?php echo a($value, 'title') ?></option>
        <?php }//endif ?>

      </select>
    </div>
  </form>
  <footer class="txtRa">
    <a class="link btn" href="<?php echo \dash\url::this(). '/thirdparty' ?>"><?php echo T_("Manage Online payment config") ?></a>
  </footer>
</section>
</div>


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
