<?php
$sortLink  = \dash\data::sortLink();
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}

$have_user = false;
?>


<div class="row p0">
  <div class="c-xs-12 c-sm-3">
    <?php require_once(root. '/content_a/order/links.php'); ?>
  </div>
  <div class="c-xs-12 c-sm-9">

<?php if(\dash\data::userDetail()) { $have_user = true; ?>
  <div class="msg">
    <div class="f fs14">
      <div class="cauto"><img class="avatar" src="<?php echo \dash\data::userDetail_avatar() ?>"></div>
      <div class="c"><?php echo \dash\data::userDetail_displayname(); ?></div>
      <div class="c"><?php echo \dash\fit::mobile(\dash\data::userDetail_mobile()); ?></div>
    </div>
  </div>
<?php } //endif ?>


    <form method="post" autocomplete="off" data-refresh>
      <div class="box">
        <div class="pad">
          <p><?php echo T_("Search in product and add to order") ?></p>
          <div class="mB10">

            <select name="product_id" class="select22" id="productSearch"  data-model='html' <?php \dash\layout\autofocus::html() ?>  data-ajax--delay="250" data-ajax--url='<?php echo \dash\url::here(). '/products/api'; ?>?json=true' data-shortkey-search data-placeholder='<?php echo T_("Search in list to add product"); ?> +'>
            </select>
          </div>

          <label for="count"><?php echo T_("Count") ?></label>
          <div class="input mB20-f">
            <input type="number" name="count" placeholder="<?php echo T_("Count"); ?>" value="1" id="count">
          </div>

        </div>

        <footer class="txtRa">
          <button class="btn success"><?php echo T_("Add"); ?></button>
        </footer>
      </div>

    </form>


<?php if($dataTable) {?>
  <div class="box cartPage">
    <div class="pad">


      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
        <div class="cartItem">
          <div class="row align-center">
            <div class="c-auto">
              <img src="<?php echo \dash\get::index($value, 'thumb') ?>" alt="<?php echo \dash\get::index($value, 'title') ?>">
            </div>
            <div class="c">
              <h3 class="title"><a href="<?php echo \dash\get::index($value, 'edit_url'); ?>"><?php echo \dash\get::index($value, 'title') ?></a></h3>

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
                <span class="unit"><?php echo \lib\store::currency(); ?></span>
              </div>
              <span class="compact ltr fc-mute font-12"><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?></span>
            </div>


            <div class="c-auto c-xs-12">
              <?php if(!\dash\get::index($value, 'allow_shop')) {?>
                <div class="availability" data-red data-type='view'><?php echo T_("This product was removed from your cart"); ?></div>
              <?php }else{ ?>
                <div class="itemOperation">
                  <div class="productCount">
                    <div class="input">
                      <?php

                      $json =
                      [
                        'product_id' => \dash\get::index($value, 'product_id'),
                        'type'       => null,
                        'count'      => 1,
                        'user'       => \dash\request::get('user'),
                        'guestid'    => \dash\request::get('guestid'),
                      ];

                      $plus  = json_encode(array_merge($json, ['type' => 'plus_count']));
                      $minus = json_encode(array_merge($json, ['type' => 'minus_count']));

                      ?>
                      <label class="addon btn light" data-ajaxify data-method="post" data-data='<?php echo $plus ?>'>+</label>
                      <input type="number" name="count" value="<?php echo \dash\get::index($value, 'count'); ?>" readonly>
                      <label class="addon btn light" data-ajaxify data-method="post" data-data='<?php echo $minus ?>'>-</label>
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
  </div>



<?php }else{ ?>
  <div class="msg info2 fs14 txtB"><?php echo T_("This order is empty") ?></div>
<?php } ?>

</div>