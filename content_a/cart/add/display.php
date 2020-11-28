<?php
$sortLink  = \dash\data::sortLink();
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}

$have_user = false;
?>

<form method="post" class="hide" id="make_order">
  <input type="hidden" name="make_order" value="make_order">
</form>

<?php if(\dash\data::userDetail()) { $have_user = true; ?>
  <div class="msg">
    <div class="f fs14">
      <div class="cauto"><img class="avatar" src="<?php echo \dash\data::userDetail_avatar() ?>"></div>
      <div class="c"><?php echo \dash\data::userDetail_displayname(); ?></div>
      <div class="c"><?php echo \dash\fit::mobile(\dash\data::userDetail_mobile()); ?></div>
    </div>
  </div>
<?php } //endif ?>

<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8">

    <form method="post" autocomplete="off" data-refresh>
      <div class="box">
        <div class="pad">
          <p><?php echo T_("Search in product and add to user cart") ?></p>
          <div class="mB10">

            <select name="product_id" class="select22" id="productSearch"  data-model='html' <?php \dash\layout\autofocus::html() ?>  data-ajax--delay="250" data-ajax--url='<?php echo \dash\url::here(). '/products/api'; ?>?json=true' data-shortkey-search data-placeholder='<?php echo T_("Search in list to add product"); ?> +'>
            </select>
          </div>

          <label for="count"><?php echo T_("Count") ?></label>
          <div class="input mB20-f">
            <input type="number" name="count" placeholder="<?php echo T_("Count"); ?>" value="1" id="count">
          </div>


          <?php if(!$have_user && $dataTable) {?>
            <div class="fc-mute pA10"><?php echo T_("This shopping cart is not assigned to the customer and the customer has added the shopping cart without logging in. Click here if you want to dedicate this shopping cart to a specific customer") ?> <span data-kerkere='.assignUser' class="btn link"><?php echo T_("Assign to customer") ?></span></div>
          <?php } //endif ?>

        </div>

        <footer class="f">
          <div class="cauto"><div class="btn linkDel" data-confirm data-data='{"removeall": "removeall"}'><?php echo T_("Remove All") ?></div></div>
          <div class="c"></div>
          <div class="cauto"><button class="btn success"><?php echo T_("Add"); ?></button></div>

        </footer>
      </div>

    </form>
    <?php if(!$have_user && $dataTable) {?>
      <form method="post" autocomplete="off" data-refresh data-kerkere-content='hide' class="assignUser">
        <input type="hidden" name="assing" value="assing">
      <div class="box">
        <header><h2><?php echo T_("Assign cart to customer") ?></h2></header>
        <div class="pad">
            <p><?php echo T_("To assign this shopping cart to a specific customer, select a customer or register a new customer") ?></p>

              <div class="f">
                <div class="c">

                  <select name="customer" class="select22"  data-model='html'  data-ajax--url='<?php echo \dash\url::kingdom(); ?>/crm/api?type=sale&json=true&list=customer' data-shortkey-search data-placeholder='<?php echo T_("Choose customer"); ?>'>
                  </select>
                </div>
                <div class="cauto"><i data-kerkere='.addNewCustomer' class="sf-plus btn outline mLa5 pLR10"></i></div>
              </div>
              <div class="addNewCustomer" data-kerkere-content='hide'>
                <div class="msg info2 mT10 mB0 pTB5"><?php echo T_("Quickly add customer"); ?></div>
                <div class="input mTB5">
                  <input type="tel" name="memberTl" id="memberTl" placeholder='<?php echo T_("Mobile"); ?> <?php echo T_("Like"); ?> <?php echo \dash\fit::mobile('09120123456'); ?>'  maxlength='30' data-response-realtime>
                </div>

                <select name="memberGender" id="memberGender" class="select22 mT5">
                  <option value="" disabled><?php echo T_("Gender"); ?></option>
                  <option value="0">-</option>
                  <option value="male"><?php echo T_("Mr"); ?></option>
                  <option value="female"><?php echo T_("Mrs"); ?></option>
                </select>

                <div class="input mT5">
                  <input type="text" name="memberN" id="memberN" placeholder='<?php echo T_("Customer Name"); ?>'  maxlength='70' minlength="1">
                </div>
              </div>


        </div>

        <footer class="txtRa">
          <button class="btn primary"><?php echo T_("Assign cart to user"); ?></button>
        </footer>
      </div>

    </form>
  <?php } //endif ?>


  </div>

  <div class="c-xs-12 c-sm-12 c-md-4">
    <div class="box orderSummary">
      <div class="pad">

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

      </div>
    </div>

  </div>
</div>


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
                      <input type="number" step="0.001" name="count" value="<?php echo floatval(\dash\get::index($value, 'count')); ?>" readonly data-format='price'>
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
  <div class="msg info2 fs14 txtB"><?php echo T_("This cart is empty") ?></div>
<?php } ?>

