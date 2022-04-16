<?php
$urlHere = \dash\url::here();
?>
  <li><a href="<?php echo $urlHere; ?>" <?php if(\dash\url::content() === 'a') {?> class="activeContent"<?php }//endif ?>><i class='sf-gauge'></i> <span><?php echo T_("Dashboard"); ?></span></a></li>
  <li>
  <?php if(\dash\permission::check('_group_products')) {?><a href="<?php echo $urlHere; ?>/products"><i class="sf-box"></i><?php echo T_("Products"); ?></a><?php } //endif ?>

  </li>
  <li>
    <?php if(\dash\permission::check('_group_orders')) {?><a href="<?php echo $urlHere; ?>/order"><i class="sf-print"></i><?php echo T_("Factor"); ?></a><?php } //endif ?>
    <ul>
      <?php if(\dash\permission::check('factorSaleAdd')) {?><li><a href="<?php echo $urlHere; ?>/sale"><i class="floatRa mRa10 text-gray-400 sf-cart-plus"></i><?php echo T_("register new sale factor"); ?> <kbd class="light">F2</kbd> </a></li><?php } //endif ?>
  <?php if(in_array(\dash\url::module(), ['order', 'sale', 'buy'])) {?>

      <?php if(\dash\permission::check('_group_orders')) {?><li><a href="<?php echo $urlHere; ?>/order?type=sale"><i class="floatRa mRa10 text-gray-400 sf-basket"></i><?php echo T_("List of sales"); ?></a></li><?php } //endif ?>
      <?php if(\dash\permission::check('_group_orders')) {?><li><a href="<?php echo $urlHere; ?>/order?type=buy"><i class="floatRa mRa10 text-gray-400 sf-bag"></i><?php echo T_("List of purchases"); ?></a></li><?php } //endif ?>
      <?php if(\dash\permission::check('_group_orders')) {?><li><a href="<?php echo $urlHere; ?>/order"><i class="floatRa mRa10 text-gray-400 sf-list-ul"></i><?php echo T_("List of all factors"); ?></a></li><?php } //endif ?>
<?php } //endif ?>
    </ul>
  </li>
  <li><?php if(\dash\permission::check('_group_setting')) {?><a href="<?php echo $urlHere; ?>/setting"><i class="sf-cogs"></i><?php echo T_("Setting"); ?></a><?php } //endif ?></li>
