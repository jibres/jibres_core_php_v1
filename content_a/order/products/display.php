<?php
$sortLink  = \dash\data::sortLink();
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}

$have_user = false;
?>
<?php $orderDetail = \dash\data::orderDetail(); ?>


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

          <div data-kerkere='.showAdvanceOrder' class="btn link"><?php echo T_("Advance") ?></div>
          <div class="showAdvanceOrder" data-kerkere-content='hide'>
            <label for="price"><?php echo T_("Price") ?> <small class="fc-mute"><?php echo T_("Leave null to get from product price") ?></small></label>
            <div class="input mB20-f">
              <input type="number" name="price" placeholder="<?php echo T_("Price"); ?>"  id="price">
            </div>

            <label for="discount"><?php echo T_("Discount") ?> <small class="fc-mute"><?php echo T_("Leave null to get from product discount") ?></small></label>
            <div class="input mB20-f">
              <input type="number" name="discount" placeholder="<?php echo T_("Discount"); ?>"  id="discount">
            </div>

            <div class="switch1">
              <input type="checkbox" name="addanother" id="addanother">
              <label for="addanother"></label>
              <label for="addanother"><?php echo T_("Add another record") ?></label>
            </div>

          </div>
        </div>

        <footer class="txtRa">
          <button class="btn success"><?php echo T_("Add"); ?></button>
        </footer>
      </div>

    </form>



<?php if(\dash\get::index($orderDetail, 'factor_detail')) {?>
  <div class="box cartPage">
    <div class="pad">
      <?php foreach (\dash\get::index($orderDetail, 'factor_detail') as $key => $value) {?>
        <div class="cartItem">
          <div class="row align-center">
            <div class="c-auto">
              <img src="<?php echo \dash\get::index($value, 'thumb') ?>" alt="<?php echo \dash\get::index($value, 'title') ?>">
            </div>
            <div class="c">
              <h3 class="title"><a href="<?php echo \dash\get::index($value, 'edit_url') ?>"><?php echo \dash\get::index($value, 'title') ?></a></h3>
              <div class="priceShow" data-cart>
                <span class="price"><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?></span>
                <span class="unit"><?php echo \lib\store::currency(); ?></span>
              </div>
              <span class="compact ltr fc-mute font-12"><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?></span>
            </div>
            <div class="c-auto c-xs-12">
               <div class="itemOperation">
                  <div class="productCount">
                    <div class="input">
                      <?php

                      $json =
                      [
                        'product_id'       => \dash\get::index($value, 'product_id'),
                        'type'             => null,
                        'count'            => 1,
                        'factor_detail_id' => \dash\get::index($value, 'id'),
                      ];

                      $plus   = json_encode(array_merge($json, ['type' => 'plus_count']));
                      $minus  = json_encode(array_merge($json, ['type' => 'minus_count']));
                      $remove = json_encode(array_merge($json, ['type' => 'remove']));

                      ?>
                      <label class="addon btn light" data-ajaxify data-method="post" data-data='<?php echo $plus ?>'>+</label>
                      <input type="number" name="count" value="<?php echo \dash\get::index($value, 'count'); ?>" readonly>
                      <label class="addon btn light" data-ajaxify data-method="post" data-data='<?php echo $minus ?>'>-</label>
                    </div>

                  </div>

                  <div class="productDel" data-confirm data-data='<?php echo $remove ?>' title='<?php echo T_("Delete") ?>'><i class="sf-trash-o"></i></div>

                </div>
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