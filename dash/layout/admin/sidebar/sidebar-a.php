<?php
$urlHere = \dash\url::here();
?>
  <li><a href="<?php echo $urlHere; ?>"><i class='sf-gauge'></i> <span><?php echo T_("Dashboard"); ?></span></a></li>
  <li>
  <?php if(\dash\permission::check('productList')) {?><a href="<?php echo $urlHere; ?>/products"><i class="sf-box"></i><?php echo T_("Products"); ?></a><?php } //endif ?>

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
