<?php
$storeData = \dash\data::store_store_data();

?>

<section class="f" data-option='product-setting-default-list'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("The price list is displayed by default");?></h3>
      <div class="body">
        <p><?php echo T_("The list section includes the product price, discount, buyprice and somethig else. You can see this list of products on the first page of product list");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <form class="c4 s12" method="post" autocomplete="off">
      <div class="action">

        <div class="switch1">
          <input type="checkbox" name="defaultpricelist" id="defaultpricelist" <?php if(\dash\get::index(\dash\data::productSettingSaved(), 'default_pirce_list')) { echo 'checked'; } ?>>
          <label for="defaultpricelist" data-on="<?php echo T_("Yes"); ?>" data-off="<?php echo T_("No") ?>"></label>
        </div>
      </div>

    </form>
  </form>
</section>



<section class="f" data-option='product-setting-variant'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Variant of product");?></h3>
      <div class="body">
        <p><?php echo T_("Enable variant product");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <form class="c4 s12" method="post" autocomplete="off">
      <div class="action">

        <div class="switch1">
          <input type="checkbox" name="variant_product" id="variant_product" <?php if(\dash\get::index(\dash\data::productSettingSaved(), 'variant_product')) { echo 'checked'; } ?>>
          <label for="variant_product" data-on="<?php echo T_("Yes"); ?>" data-off="<?php echo T_("No") ?>"></label>
        </div>
      </div>

    </form>
  </form>
</section>
