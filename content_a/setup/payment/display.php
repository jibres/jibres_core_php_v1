

<div id="get_started_card">
  <div class="body">
    <div class="pad">
      <h1><?php echo \dash\face::title(); ?></h1>
      <p><?php echo T_("You need at least one payment method to collect payment from your customers."); ?></p>
      <form method="post" autocomplete="off">

        <div class="switch1 fs12">
         <input type="checkbox" name="payment_online" id="payment_online" <?php if(\dash\data::dataRow_payment_online()) { echo 'checked';}  ?> >
         <label for="payment_online"></label>
         <label for="payment_online"><?php echo T_("Online payment"); ?></label>
        </div>
        <p class="fc-mute"><?php echo T_("Such as Credit card, PayPal and Stripe."); ?></p>

        <div class="switch1 fs12">
         <input type="checkbox" name="payment_check" id="payment_check" <?php if(\dash\data::dataRow_payment_check()) { echo 'checked';}  ?> >
         <label for="payment_check"></label>
         <label for="payment_check"><?php echo T_("Check Payments"); ?></label>
        </div>
        <p class="fc-mute"><?php echo T_("Check Payments is a payment gateway that doesn't require payment to be made online."); ?></p>

        <div class="switch1 fs12">
         <input type="checkbox" name="payment_bank" id="payment_bank" <?php if(\dash\data::dataRow_payment_bank()) { echo 'checked';}  ?> >
         <label for="payment_bank"></label>
         <label for="payment_bank"><?php echo T_("Direct Bank Transfer"); ?></label>
        </div>
        <p class="fc-mute"><?php echo T_("Direct Bank Transfer, or Bank Account Clearing System (BACS), is a gateway that require no payment be made online."); ?></p>


        <div class="switch1 fs12">
         <input type="checkbox" name="payment_on_deliver" id="payment_on_deliver" <?php if(\dash\data::dataRow_payment_on_deliver()) { echo 'checked';}  ?> >
         <label for="payment_on_deliver"></label>
         <label for="payment_on_deliver"><?php echo T_("Cash on delivery"); ?></label>
        </div>
        <p class="fc-mute"><?php echo T_("Cash on Delivery (COD) is a payment gateway that required no payment be made online."); ?> <?php echo T_("Orders using Cash on Delivery are set to Processing until payment is made upon delivery of the order by you or your shipping method."); ?></p>



        <div class="f align-center mB10">
          <div class="c fc-mute"><?php echo \dash\data::stepDesc(); ?></div>
          <div class="cauto os"><button class="btn primary"><?php echo T_("Save"); ?></button></div>
        </div>

      </form>
    </div>
  </div>
</div>

