<section class="avand cartPage">
<?php if(\dash\data::dataTable()) {?>
 <h1><?php echo T_("Shopping Cart"); ?></h1>
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
       <div class="title"><a href="<?php echo \dash\get::index($value, 'url'); ?>"><?php echo \dash\get::index($value, 'title') ?></a></div>
       <div class="availability" data-type='stock'>In Stock</div>

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
  </div>
  <div class="c-4">

   <div class="priceBox" style="">
    <h3>جزئیات قیمت فاکتور</h3>
    <div class="final" title="جمع مبلغ قابل پرداخت"><span data-val="6039000">۶,۰۳۹,۰۰۰</span><abbr>تومان</abbr></div>
    <div class="desc"> شش  میلیون  و  سی  و  نه  هزار  تومان</div>
    <div class="detail item"><abbr>تعداد اقلام</abbr> <span data-val="1">۱</span></div>
    <div class="detail count" style="display: block;"><abbr>جمع تعداد</abbr> <span data-val="1100">۱,۱۰۰</span></div>
    <div class="detail sum"><abbr>مبلغ فاکتور</abbr> <span data-val="6050000">۶,۰۵۰,۰۰۰</span></div>
    <div class="detail discountPercent" style="display: block;"><abbr>درصد تخفیف</abbr> <span data-val="0.18">۰.۱۸%</span></div>
    <div class="detail discount" title="دکمه f7 را بفشارید با برای تغییر وضعیت کلیک کنید" style="display: block;"><abbr>جمع تخفیف </abbr> <span data-val="11000">۱۱,۰۰۰</span></div>
   </div>

  </div>
 </div>

<?php } else { // no product in cart ?>
<div class="box cartEmpty">
 <img src="<?php echo \dash\url::cdn(); ?>/img/business/store/cart-empty-basket.png" alt="jibres empty basket">
 <h2><?php echo T_("Your Shopping Cart is empty"); ?></h2>
 <p><?php
echo T_("Don't miss out on great deals! :start or :login to view products added.",
 [
  'start' => "<a href='". \dash\url::kingdom() ."'>". T_('Start shopping'). "</a>",
  'login' => "<a href='". \dash\url::kingdom() ."/enter'>". T_('log in'). "</a>",
 ]
);
?></p>
 <div class="msg txtC"><?php echo T_("The Cart is a temporary place to store a list of your items and reflects each item's most recent price."); ?></div>
</div>
<?php } //endif ?>

</section>