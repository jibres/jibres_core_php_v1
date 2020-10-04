<?php $urlHere = \dash\url::here(); ?>

<div class="avand">
  <div class="row">
    <div class="c-xs-12 c-sm-12 c-md-4">
      <nav class="items">
      <ul>
          <li><a class="f" href="<?php echo $urlHere; ?>/products"><div class="key"><?php echo T_("Product list"); ?></div><div class="go"></div></a></li>
          <?php if(\dash\permission::check('productAdd')) {?><li><a class="f" href="<?php echo $urlHere; ?>/products/add"><div class="key"><?php echo T_("Add new Product"); ?></div><div class="go"></div></a></li><?php } //endif ?>
        </ul>
      </nav>
      <nav class="items">
        <ul>

          <?php if(\dash\permission::check('productCategoryListView')) {?><li><a class="f" href="<?php echo $urlHere; ?>/category"><div class="key"><?php echo T_("Categories of Product"); ?></div><div class="go"></div></a></li><?php } //endif ?>
          <?php if(\dash\permission::check('productUnitListView')) {?><li><a class="f" href="<?php echo $urlHere; ?>/units"><div class="key"><?php echo T_("Product Units"); ?></div><div class="go"></div></a></li><?php } //endif ?>
          <?php if(\dash\permission::check('productCompanyListView')) {?><li><a class="f" href="<?php echo $urlHere; ?>/company"><div class="key"><?php echo T_("Product Compnay"); ?></div><div class="go"></div></a></li><?php } //endif ?>

          <?php if(\dash\permission::check('productTagView')) {?><li><a class="f" href="<?php echo $urlHere; ?>/products/tag"><div class="key"><?php echo T_("Product tag"); ?></div><div class="go"></div></a></li><?php } //endif ?>

        </ul>
      </nav>

      <?php if(\dash\permission::check('productPriceHistoryView')) {?>
      <nav class="items">
        <ul>
          <li><a class="f" href="<?php echo $urlHere; ?>/pricehistory"><div class="key"><?php echo T_("Price history"); ?></div><div class="go"></div></a></li>
        </ul>
      </nav>
      <?php } //endif ?>

      <nav class="items">
        <ul>
          <li><a class="f" href="<?php echo $urlHere; ?>/report/products"><div class="key"><?php echo T_("Reports"); ?></div><div class="go"></div></a></li>
          <li><a class="f" href="<?php echo $urlHere; ?>/report/productvalue"><div class="key"><?php echo T_("Products value"); ?></div><div class="go"></div></a></li>
        </ul>
      </nav>

      <nav class="items">
        <ul>
          <li><a class="f" href="<?php echo \dash\url::this(); ?>/units"><div class="key"><?php echo T_("Store Units"); ?></div><div class="go"></div></a></li>
        </ul>
      </nav>

      <nav class="items">
        <ul>
          <li><a class="f" href="<?php echo \dash\url::that(); ?>/text"><div class="key"><?php echo T_("Product Default share text"); ?></div><div class="go"></div></a></li>
          <li><a class="f" href="<?php echo \dash\url::that(); ?>/viewtext"><div class="key"><?php echo T_("Product Default view text"); ?></div><div class="go"></div></a></li>
          <li><a class="f" href="<?php echo \dash\url::that(); ?>/tag"><div class="key"><?php echo T_("Add tag to all product"); ?></div><div class="go"></div></a></li>
        </ul>
      </nav>

      <nav class="items">
        <ul>
          <li><a class="f" href="<?php echo \dash\url::that(); ?>/setting"><div class="key"><?php echo T_("Product setting"); ?></div><div class="go"></div></a></li>
        </ul>
      </nav>

    </div>



  </div>
</div>
