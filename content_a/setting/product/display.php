<?php $urlHere = \dash\url::here(); ?>

<div class="avand-md">

      <nav class="items">
      <ul>
          <li><a class="f" href="<?php echo $urlHere; ?>/products"><div class="key"><?php echo T_("Product list"); ?></div><div class="go"></div></a></li>
          <?php if(\dash\permission::check('productAdd')) {?><li><a class="f" href="<?php echo $urlHere; ?>/products/add"><div class="key"><?php echo T_("Add new Product"); ?></div><div class="go"></div></a></li><?php } //endif ?>
        </ul>
      </nav>
      <nav class="items">
        <ul>

          <?php if(\dash\permission::check('_group_products')) {?><li><a class="f" href="<?php echo $urlHere; ?>/tag"><div class="key"><?php echo T_("Tag of products"); ?></div><div class="go"></div></a></li><?php } //endif ?>
          <li><a class="f" href="<?php echo \dash\url::that(); ?>/tag"><div class="key"><?php echo T_("Add tag to all product"); ?></div><div class="go"></div></a></li>
          <?php if(\dash\permission::check('_group_products')) {?><li><a class="f" href="<?php echo $urlHere; ?>/units"><div class="key"><?php echo T_("Product Units"); ?></div><div class="go"></div></a></li><?php } //endif ?>
        </ul>
      </nav>


      <nav class="items">
        <ul>
          <li><a class="f" href="<?php echo $urlHere; ?>/pricehistory"><div class="key"><?php echo T_("Price history"); ?></div><div class="go"></div></a></li>
        </ul>
      </nav>


      <nav class="items">
        <ul>
          <li><a class="f" href="<?php echo $urlHere; ?>/report/products"><div class="key"><?php echo T_("Reports"); ?></div><div class="go"></div></a></li>
          <li><a class="f" href="<?php echo $urlHere; ?>/report/productvalue"><div class="key"><?php echo T_("Products value"); ?></div><div class="go"></div></a></li>
        </ul>
      </nav>

      <nav class="items">
        <ul>
          <li><a class="f" href="<?php echo $urlHere; ?>/products/export"><div class="key"><?php echo T_("Export products"); ?></div><div class="go"></div></a></li>
          <li><a class="f" href="<?php echo $urlHere; ?>/products/import"><div class="key"><?php echo T_("Import products"); ?></div><div class="go"></div></a></li>
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
        </ul>
      </nav>

      <nav class="items">
        <ul>
          <li><a class="f" href="<?php echo \dash\url::that(); ?>/setting"><div class="key"><?php echo T_("Product setting"); ?></div><div class="go"></div></a></li>
        </ul>
      </nav>

    </div>



