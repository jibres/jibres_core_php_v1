<section class="avand cartPage">
<?php if(\dash\data::dataTable()) {?>
 <h1><?php echo \dash\face::titlePWA() ?></h1>
 <div class="row">
  <div class="c-xs-12 c-sm-12 c-lg-8">
   <div class="box">

<?php foreach (\dash\data::dataTable() as $key => $value) {?>
    <div class="cartItem">
     <div class="row padLess align-center">
      <div class="c-auto">
       <img src="<?php echo \dash\get::index($value, 'thumb') ?>" alt="<?php echo \dash\get::index($value, 'title') ?>">
      </div>
      <div class="c">
       <h3 class="title"><a href="<?php echo \dash\get::index($value, 'url'); ?>"><?php echo \dash\get::index($value, 'title') ?></a></h3>

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

         <div class="priceShow" data-cart>
          <span class="price"><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?></span>
          <span class="unit"><?php echo \lib\currency::unit(); ?></span>
         </div>
      </div>
      <div class="c-auto c-xs-12">
        <?php if(!\dash\get::index($value, 'allow_shop')) {?>
          <div class="availability" data-red data-type='view'><?php echo T_("This product was removed from your cart"); ?></div>
        <?php }else{ ?>
         <div class="itemOperation">
          <div class="productCount">
           <div class="input">
            <label class="addon btn light" data-ajaxify data-method="post" data-data='{"type": "plus_cart", "product_id": "<?php echo \dash\get::index($value, 'product_id') ?>"}'>+</label>
            <input type="number" name="count" value="<?php echo \dash\get::index($value, 'count'); ?>" readonly>
            <label class="addon btn light" data-ajaxify data-method="post" data-data='{"type": "minus_cart", "product_id": "<?php echo \dash\get::index($value, 'product_id') ?>"}'>-</label>
           </div>

          </div>

           <div class="productDel" data-confirm data-data='{"type": "remove", "product_id": "<?php echo \dash\get::index($value, 'product_id') ?>"}' title='<?php echo T_("Delete") ?>'><i class="sf-trash-o"></i></div>

         </div>
        <?php } // endif ?>

      </div>
     </div>
    </div>
<?php } //endfor ?>


   </div>
<?php if(\dash\data::cartSettingSaved_page_text()) {?><p class="fs14 msg <?php echo \dash\data::cartSettingSaved_color_class() ?>"><?php echo \dash\data::cartSettingSaved_page_text(); ?></p><?php } //endif ?>
  </div>
  <?php if(\dash\data::cartSummary()) {?>
  <div class="c-xs-12 c-sm-12 c-lg-4">
    <?php require_once('cartSummary.php'); ?>

  </div>
<?php } //endif ?>

 </div>

<?php } else { // no product in cart ?>
<div class="box cartEmpty">
 <img src="<?php echo \dash\url::cdn(); ?>/img/business/store/cart-empty-basket.png" alt="jibres empty basket">
 <h2><?php echo T_("Your Shopping Cart is empty"); ?></h2>
 <p><?php
 if(\dash\user::login())
 {
    echo T_("Don't miss out on great deals! :start to view products added.",
     [
      'start' => "<a href='". \dash\url::kingdom() ."'>". T_('Start shopping'). "</a>",
     ]
    );
 }
 else
 {
    echo T_("Don't miss out on great deals! :start or :login to view products added.",
     [
      'start' => "<a href='". \dash\url::kingdom() ."'>". T_('Start shopping'). "</a>",
      'login' => "<a href='". \dash\url::kingdom() ."/enter'>". T_('login'). "</a>",
     ]
    );
 }
?></p>
 <div class="msg txtC"><?php echo T_("The Cart is a temporary place to store a list of your items and reflects each item's most recent price."); ?></div>
</div>
<?php } //endif ?>

</section>