<?php $currency = \lib\store::currency(); ?>
   <div class="box orderSummary">
    <h3><?php echo T_("Order Summary"); ?></h3>
    <div>
     <dl class="subtotal">
      <dt><?php echo T_("Subtotal"); ?></dt>
      <dd><?php echo \dash\fit::number(\dash\data::cartSummary_subtotal()); ?> <?php echo $currency; ?> </dd>
     </dl>

     <?php if(\dash\data::cartSummary_discount()) {?>
     <dl class="discount">
      <dt><?php echo T_("Discount"); ?></dt>
      <dd><?php echo \dash\fit::number(\dash\data::cartSummary_discount()); ?> <?php echo $currency; ?> </dd>
     </dl>
   <?php } //endif ?>

     <?php if(\dash\data::cartSummary_subvat()) {?>
     <dl class="subvat">
      <dt><?php echo T_("Vat"); ?></dt>
      <dd><?php echo \dash\fit::number(\dash\data::cartSummary_subvat()); ?> <?php echo $currency; ?> </dd>
     </dl>
   <?php } //endif ?>

    <?php if(is_numeric(\dash\data::cartSummary_shipping())){ ?>
     <dl class="shipping">
      <dt><?php echo T_("Shipping"); ?></dt>
        <?php if(\dash\data::cartSummary_shipping()) {?>
      <dd><?php echo \dash\fit::number(\dash\data::cartSummary_shipping()); ?> <?php echo $currency; ?> </dd>
      <?php }elseif(is_numeric(\dash\data::cartSummary_shipping())){ ?>
        <dd class="fc-green"><span class="txtB" ><?php echo T_("Free") ?></span> <i class="sf-gift"></i></dd>
      <?php }//endif ?>
     </dl>
    <?php }//endif ?>

     <dl class="total">
      <dt><?php echo T_("Total"); ?></dt>
      <dd><?php echo \dash\fit::number(\dash\data::cartSummary_total()); ?> <?php echo $currency; ?> </dd>
     </dl>
    </div>
    <?php
     $cart_setting = \dash\data::myCart_setting();
    if(isset($cart_setting['minimumorderamount']) && $cart_setting['minimumorderamount'] && is_numeric($cart_setting['minimumorderamount']))
    {
      $total = \dash\data::cartSummary_total();

      if(floatval($total) < floatval($cart_setting['minimumorderamount']))
      {
        $minimumorderamount_html = T_("Minimum order amount is :val :currency", ['val' => \dash\fit::number($cart_setting['minimumorderamount']), 'currency' => $currency]);
        $minimumorderamount_html .= '<br>';
        $minimumorderamount_html .= T_("You must add :val :currency to your cart", ['val' => \dash\fit::number((floatval($cart_setting['minimumorderamount']) - floatval($total))), 'currency' => $currency]);
        echo '<div class="msg danger2">'. $minimumorderamount_html. '</div>';
      }
    }

    if(\dash\url::module() === 'shipping')
    {


    ?>

      <button type="submit" class="btn-danger lg block " ><?php echo T_("Pay"). ' ( '. \dash\fit::number(\dash\data::cartSummary_total()). ' )'; ?></button>
    <?php }else{ ?>
      <a class="btn-danger lg block " href="<?php echo \dash\url::here() . '/shipping' ?>"><?php echo T_("BUY"). ' ( '. \dash\fit::number(\dash\data::myCart_count()). ' )'; ?></a>
    <?php } //endif ?>
   </div>