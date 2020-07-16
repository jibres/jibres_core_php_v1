<section class="avand cartPage">
<?php if(\dash\data::dataTable()) {?>
 <h1><?php echo T_("Shopping Cart"). ' ('. count(\dash\data::dataTable()). ')' ?></h1>
 <div class="row">
  <div class="c-8">
   <div class="box">

<?php foreach (\dash\data::dataTable() as $key => $value) {?>
    <div class="cartItem">
     <div class="row">
      <div class="c-auto">
       <img src="<?php echo \dash\get::index($value, 'thumb') ?>" alt="<?php echo \dash\get::index($value, 'title') ?>">
      </div>
      <div class="c">
       <div class="title mB10"><a href="<?php echo \dash\get::index($value, 'url'); ?>"><?php echo \dash\get::index($value, 'title') ?></a></div>

        <?php if(!\dash\get::index($value, 'view')) {?>
          <div class="availability" data-green data-type='view'><?php echo T_("This product addet to your cart"); ?></div>
        <?php } // endif ?>

        <?php if(\dash\get::index($value, 'trackquantity')) {?>

        <?php $stock = floatval(\dash\get::index($value, 'stock')); ?>
          <?php if($stock >= 10) {?>
            <div class="availability" data-green data-type='stock'><?php echo T_("In Stock"); ?></div>
          <?php }elseif($stock > 0) {?>
            <div class="availability" data-red data-type='orderSoon'><?php echo T_("Only :val :unit left in stock - order soon.", ['val' => \dash\fit::number($stock), 'unit' => \dash\get::index($value, 'unit')]); ?></div>
          <?php }elseif ($stock <= 0) {?>
            <div class="availability" data-red data-type='outOfStock'><?php echo T_("Temporarily out of stock."); ?></div>
          <?php } // endif ?>
        <?php } //endif ?>

       <div class="row productCountLine">
        <div class="c-auto">
         <div class="input productCount">
          <label class="addon btn" data-ajaxify data-method="post" data-data='{"type": "plus_cart", "product_id": "<?php echo \dash\get::index($value, 'product_id') ?>"}'>+</label>
          <input type="number" name="count" value="<?php echo \dash\get::index($value, 'count'); ?>" readonly>
          <label class="addon btn" data-ajaxify data-method="post" data-data='{"type": "minus_cart", "product_id": "<?php echo \dash\get::index($value, 'product_id') ?>"}'>-</label>
         </div>
        </div>
        <div class="c">
         <div class="productDel" data-confirm data-data='{"type": "remove", "product_id": "<?php echo \dash\get::index($value, 'product_id') ?>"}'><?php echo T_("Delete") ?></div>
        </div>

       </div>
      </div>
      <div class="c-auto">
        <div class="priceLine">
         <div class="priceShow" data-cart>
          <span class="price"><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?></span>
          <span class="unit"><?php echo \dash\get::index($value, 'unit'); ?><?php echo \lib\currency::unit(); ?></span>
         </div>
        </div>
      </div>
     </div>
    </div>
<?php } //endfor ?>


   </div>
<?php if(\dash\data::cartSettingSaved_page_text()) {?><p class="fs14 msg <?php echo \dash\data::cartSettingSaved_color_class() ?>"><?php echo \dash\data::cartSettingSaved_page_text(); ?></p><?php } //endif ?>
  </div>
  <?php if(\dash\data::cartSummary()) {?>
  <div class="c-4">
   <div class="box orderSummary">
    <h3><?php echo T_("Order Summary"); ?></h3>
    <div>
     <dl class="subtotal">
      <dt><?php echo T_("Subtotal"); ?></dt>
      <dd><?php echo \lib\currency::unit(); ?> <?php echo \dash\fit::number(\dash\data::cartSummary_subtotal()); ?></dd>
     </dl>
     <dl class="discount">
      <dt><?php echo T_("Discount"); ?></dt>
      <dd><?php echo \lib\currency::unit(); ?> <?php echo \dash\fit::number(\dash\data::cartSummary_discount()); ?></dd>
     </dl>
     <dl class="shipping">
      <dt><?php echo T_("Shipping"); ?></dt>
      <dd><?php echo \lib\currency::unit(); ?> <?php echo \dash\fit::number(\dash\data::cartSummary_shipping()); ?></dd>
     </dl>

     <dl class="total">
      <dt><?php echo T_("Total"); ?></dt>
      <dd><?php echo \lib\currency::unit(); ?> <?php echo \dash\fit::number(\dash\data::cartSummary_total()); ?></dd>
     </dl>
    </div>

    <a class="btn danger lg block " href="<?php echo \dash\url::here() . '/shipping' ?>"><?php echo T_("BUY") ?></a>
   </div>

  </div>
<?php } //endif ?>

 </div>

<?php } else { // no product in cart ?>
<div class="box cartEmpty">
 <img src="<?php echo \dash\url::cdn(); ?>/img/business/store/cart-empty-basket.png" alt="jibres empty basket">
 <h2><?php echo T_("Your Shopping Cart is empty"); ?></h2>
 <p><?php
echo T_("Don't miss out on great deals! :start or :login to view products added.",
 [
  'start' => "<a href='". \dash\url::kingdom() ."'>". T_('Start shopping'). "</a>",
  'login' => "<a href='". \dash\url::kingdom() ."/enter'>". T_('login'). "</a>",
 ]
);
?></p>
 <div class="msg txtC"><?php echo T_("The Cart is a temporary place to store a list of your items and reflects each item's most recent price."); ?></div>
</div>
<?php } //endif ?>

</section>