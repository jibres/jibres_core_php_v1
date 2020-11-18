   <div class="box orderSummary">
    <h3><?php echo T_("Order Summary"); ?></h3>
    <div>
     <dl class="subtotal">
      <dt><?php echo T_("Subtotal"); ?></dt>
      <dd><?php echo \dash\fit::number(\dash\data::cartSummary_subtotal()); ?> <?php echo \lib\store::currency(); ?> </dd>
     </dl>

     <?php if(\dash\data::cartSummary_discount()) {?>
     <dl class="discount">
      <dt><?php echo T_("Discount"); ?></dt>
      <dd><?php echo \dash\fit::number(\dash\data::cartSummary_discount()); ?> <?php echo \lib\store::currency(); ?> </dd>
     </dl>
   <?php } //endif ?>

     <?php if(\dash\data::cartSummary_subvat()) {?>
     <dl class="subvat">
      <dt><?php echo T_("Vat"); ?></dt>
      <dd><?php echo \dash\fit::number(\dash\data::cartSummary_subvat()); ?> <?php echo \lib\store::currency(); ?> </dd>
     </dl>
   <?php } //endif ?>

     <dl class="shipping">
      <dt><?php echo T_("Shipping"); ?></dt>
        <?php if(\dash\data::cartSummary_shipping()) {?>
      <dd><?php echo \dash\fit::number(\dash\data::cartSummary_shipping()); ?> <?php echo \lib\store::currency(); ?> </dd>
      <?php }else{ ?>
        <dd class="fc-green"><span class="txtB" ><?php echo T_("Free") ?></span> <i class="sf-gift"></i></dd>
      <?php }//endif ?>
     </dl>

     <dl class="total">
      <dt><?php echo T_("Total"); ?></dt>
      <dd><?php echo \dash\fit::number(\dash\data::cartSummary_total()); ?> <?php echo \lib\store::currency(); ?> </dd>
     </dl>
    </div>
    <?php if(\dash\url::module() === 'shipping') {?>
      <button type="submit" class="btn danger lg block " ><?php echo T_("Pay"). ' ( '. \dash\fit::number(\lib\website::cart_total(true)). ' )'; ?></button>
    <?php }else{ ?>
      <a class="btn danger lg block " href="<?php echo \dash\url::here() . '/shipping' ?>"><?php echo T_("BUY"). ' ( '. \dash\fit::number(\lib\website::cart_count()). ' )'; ?></a>
    <?php } //endif ?>
   </div>