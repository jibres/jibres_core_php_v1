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


<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-3">
    <?php require_once(root. '/content_a/order/links.php'); ?>
  </div>
  <div class="c-xs-12 c-sm-12 c-md-9">

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
            <input type="number" name="count" placeholder="<?php echo T_("Count"); ?>" value="1" step="0.001" id="count">
          </div>

          <div data-kerkere='.showAdvanceOrder' class="mB10 link"><?php echo T_("Special price and discount") ?></div>
          <div class="showAdvanceOrder" data-kerkere-content='hide'>
            <div class="row">
              <div class="c-xs-12 c-sm-6">
                <label for="price"><?php echo T_("Price") ?> <small class="fc-mute"><?php echo T_("Leave null to get from product price") ?></small></label>
                <div class="input mB20-f">
                  <input type="number" name="price" placeholder="<?php echo T_("Price"); ?>"  id="price">
                </div>
              </div>
              <div class="c-xs-12 c-sm-6">
                <label for="discount"><?php echo T_("Discount") ?> <small class="fc-mute"><?php echo T_("Leave null to get from product discount") ?></small></label>
                <div class="input mB20-f">
                  <input type="number" name="discount" placeholder="<?php echo T_("Discount"); ?>"  id="discount">
                </div>
              </div>
            </div>
          </div>
        </div>

        <footer class="txtRa">
          <button class="btn success"><?php echo T_("Add"); ?></button>
        </footer>
      </div>

    </form>

    <?php require_once(root. 'content_a/order/productList.php') ?>

</div>