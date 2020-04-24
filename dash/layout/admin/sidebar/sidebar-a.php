<?php
$urlHere = \dash\url::here();
?>
  <li><a href="<?php echo $urlHere; ?>"><i class='sf-gauge'></i> <span><?php echo T_("Dashboard"); ?></span></a></li>
  <li>
  <?php if(\dash\permission::check('productList')) {?><a href="<?php echo $urlHere; ?>/products"><i class="sf-box"></i><?php echo T_("Products"); ?></a><?php } //endif ?>
  <?php if(in_array(\dash\url::module(), ['products', 'category', 'units', 'company', 'pricehistory'])) {?>
    <ul>
        <?php if(\dash\permission::check('productListPrice')) {?><li><a href="<?php echo $urlHere; ?>/products/price"><i class="floatRa mRa10 fc-mute sf-dollar"></i><?php echo T_("Product price"); ?></a></li><?php } //endif ?>
        <?php if(\dash\permission::check('productAdd')) {?><li><a href="<?php echo $urlHere; ?>/products/add"><i class="floatRa mRa10 fc-mute sf-plus"></i><?php echo T_("Add new Product"); ?></a></li><?php } //endif ?>
        <?php if(\dash\permission::check('productCategoryListView')) {?><li><a href="<?php echo $urlHere; ?>/category"><i class="floatRa mRa10 fc-mute sf-grid-1"></i><?php echo T_("Categories of Product"); ?></a></li><?php } //endif ?>
        <?php if(\dash\permission::check('productUnitListView')) {?><li><a href="<?php echo $urlHere; ?>/units"><i class="floatRa mRa10 fc-mute sf-eye-galsses"></i><?php echo T_("Product Units"); ?></a></li><?php } //endif ?>
        <?php if(\dash\permission::check('productCompanyListView')) {?><li><a href="<?php echo $urlHere; ?>/company"><i class="floatRa mRa10 fc-mute sf-industry"></i><?php echo T_("Product Compnay"); ?></a></li><?php } //endif ?>
        <?php if(\dash\permission::check('productPriceHistoryView')) {?><li><a href="<?php echo $urlHere; ?>/pricehistory"><i class="floatRa mRa10 fc-mute sf-chart-line"></i><?php echo T_("Price history"); ?></a></li><?php } //endif ?>
        <?php if(\dash\permission::check('productTagView')) {?><li><a href="<?php echo $urlHere; ?>/products/tag"><i class="floatRa mRa10 fc-mute sf-tags"></i><?php echo T_("Product tag"); ?></a></li><?php } //endif ?>
    </ul>
  <?php } //endif ?>
  </li>
  <li>
    <?php if(\dash\permission::check('factorAccess')) {?><a href="<?php echo $urlHere; ?>/factor"><i class="sf-print"></i><?php echo T_("Factor"); ?></a><?php } //endif ?>
    <ul>
      <?php if(\dash\permission::check('factorSaleAdd')) {?><li><a href="<?php echo $urlHere; ?>/sale"><i class="floatRa mRa10 fc-mute sf-cart-plus"></i><?php echo T_("register new sale factor"); ?> <kbd class="light">F2</kbd> </a></li><?php } //endif ?>
  <?php if(in_array(\dash\url::module(), ['factor', 'sale', 'buy'])) {?>

      <?php if(\dash\permission::check('factorSaleList')) {?><li><a href="<?php echo $urlHere; ?>/factor?type=sale"><i class="floatRa mRa10 fc-mute sf-basket"></i><?php echo T_("List of sales"); ?></a></li><?php } //endif ?>
      <?php if(\dash\permission::check('factorBuyList')) {?><li><a href="<?php echo $urlHere; ?>/factor?type=buy"><i class="floatRa mRa10 fc-mute sf-bag"></i><?php echo T_("List of purchases"); ?></a></li><?php } //endif ?>
      <?php if(\dash\permission::check('factorAccess')) {?><li><a href="<?php echo $urlHere; ?>/factor"><i class="floatRa mRa10 fc-mute sf-list"></i><?php echo T_("List of all factors"); ?></a></li><?php } //endif ?>
<?php } //endif ?>
    </ul>
  </li>
  <li><?php if(\dash\permission::check('settingView')) {?><a href="<?php echo $urlHere; ?>/setting"><i class="sf-cogs"></i><?php echo T_("Setting"); ?></a><?php } //endif ?></li>
