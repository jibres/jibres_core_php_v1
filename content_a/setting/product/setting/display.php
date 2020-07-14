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

      <div class="action">
        <input type="hidden" name="runaction_defaultpricelist" value="1">
        <div class="switch1">
          <input type="checkbox" name="defaultpricelist" id="defaultpricelist" <?php if(\dash\get::index(\dash\data::productSettingSaved(), 'default_pirce_list')) { echo 'checked'; } ?>>
          <label for="defaultpricelist" data-on="<?php echo T_("Yes"); ?>" data-off="<?php echo T_("No") ?>"></label>
        </div>
      </div>

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

      <div class="action">
        <input type="hidden" name="runaction_variant_product" value="1">
        <div class="switch1">
          <input type="checkbox" name="variant_product" id="variant_product" <?php if(\dash\get::index(\dash\data::productSettingSaved(), 'variant_product')) { echo 'checked'; } ?>>
          <label for="variant_product" data-on="<?php echo T_("Yes"); ?>" data-off="<?php echo T_("No") ?>"></label>
        </div>
      </div>

  </form>
</section>


<section class="f" data-option='product-setting-default-tracking'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("The tracking option");?></h3>
      <div class="body">
        <p><?php echo T_("When add new product");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>

      <div class="action">
        <input type="hidden" name="runaction_defaulttracking" value="1">
        <div class="switch1">
          <input type="checkbox" name="defaulttracking" id="defaulttracking" <?php if(\dash\get::index(\dash\data::productSettingSaved(), 'defaulttracking')) { echo 'checked'; } ?>>
          <label for="defaulttracking" data-on="<?php echo T_("Yes"); ?>" data-off="<?php echo T_("No") ?>"></label>
        </div>
      </div>

  </form>
</section>





<section class="f" data-option='product-setting-image-ratio'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Image ratio");?></h3>
      <div class="body">
        <p><?php echo T_("Set default image ratio");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>

      <div class="action">
        <input type="hidden" name="runaction_ratio" value="1">

        <select class="select22" name="ratio">
          <option value="0"><?php echo \dash\data::defaultRatioSlider(); ?></option>
          <option value="16:9" <?php if(\dash\data::productSettingSaved_ratio() === '16:9') {echo 'selected';} ?>><?php echo \dash\fit::text("16:9") ?></option>
          <option value="16:10" <?php if(\dash\data::productSettingSaved_ratio() === '16:10') {echo 'selected';} ?>><?php echo \dash\fit::text("16:10") ?></option>
          <option value="19:10" <?php if(\dash\data::productSettingSaved_ratio() === '19:10') {echo 'selected';} ?>><?php echo \dash\fit::text("19:10") ?></option>
          <option value="32:9" <?php if(\dash\data::productSettingSaved_ratio() === '32:9') {echo 'selected';} ?>><?php echo \dash\fit::text("32:9") ?></option>
          <option value="64:27" <?php if(\dash\data::productSettingSaved_ratio() === '64:27') {echo 'selected';} ?>><?php echo \dash\fit::text("64:27") ?></option>
          <option value="5:3" <?php if(\dash\data::productSettingSaved_ratio() === '5:3') {echo 'selected';} ?>><?php echo \dash\fit::text("5:3") ?></option>
        </select>



      </div>

  </form>
</section>
