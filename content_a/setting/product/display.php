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

    <div class="c-xs-12 c-sm-12 c-md-8">
     <section class="f">
     <div class="c6 s12 pRa10">
      <a href="<?php echo \dash\url::here(). '/products' ?>" class="stat">
       <h3><?php echo T_("Total products");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\lib\report\product\get::count_all());?></div>
      </a>
     </div>

      <div class="c6 s12 pRa10">
      <a href="<?php echo \dash\url::here(). '/products' ?>" class="stat">
       <h3><?php echo T_("Average price");?></h3>
       <div class="val"><?php echo \dash\fit::number(\lib\report\product\get::average_finalprice());?></div>
      </a>
     </div>


      <?php $expensive = \lib\report\product\get::expensive(); if($expensive) {?>
       <div class="c6 s12 pRa10">
        <a href="<?php echo \dash\url::here(). '/products/edit?id='. \dash\get::index($expensive, 'id') ?>" class="stat">
         <h3><?php echo T_("Expensive product");?> <?php echo \dash\get::index($expensive, 'title'); ?></h3>
         <div class="val"><?php echo \dash\fit::number(\dash\get::index($expensive, 'finalprice'));?></div>
        </a>
       </div>
     <?php } // endif ?>

     <?php $inexpensive = \lib\report\product\get::inexpensive(); if($inexpensive) {?>
       <div class="c6 s12 pRa10">
        <a href="<?php echo \dash\url::here(). '/products/edit?id='. \dash\get::index($inexpensive, 'id') ?>" class="stat">
         <h3><?php echo T_("Expensive product");?> <?php echo \dash\get::index($inexpensive, 'title'); ?></h3>
         <div class="val"><?php echo \dash\fit::number(\dash\get::index($inexpensive, 'finalprice'));?></div>
        </a>
       </div>
     <?php } // endif ?>


   </section>

    <div class="row">
      <?php $expensive_list = \lib\report\product\get::expensive_list(); if($expensive_list) {?>
      <div class="c-xs-12 s-sm-12 c-md-6">
        <h4><?php echo T_("Expensive list") ?></h4>
       <nav class="items">
        <ul>
        <?php foreach ($expensive_list as $key => $value) {?>
          <li>
              <a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. \dash\get::index($value, 'id'); ?>">
                <div class="key"><?php echo \dash\get::index($value, 'title'); ?></div>
                <div class="value"><?php echo \dash\fit::number(\dash\get::index($value, 'finalprice')); ?></div>
                <div class="go"></div>
              </a>
          </li>
        <?php } //endfor ?>
        </ul>
      </nav>
      </div>
      <?php } //endif ?>

      <?php $inexpensive_list = \lib\report\product\get::inexpensive_list(); if($inexpensive_list) {?>
      <div class="c-xs-12 s-sm-12 c-md-6">
        <h4><?php echo T_("Inexpensive list") ?></h4>
       <nav class="items">
        <ul>
        <?php foreach ($inexpensive_list as $key => $value) {?>
          <li>
              <a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. \dash\get::index($value, 'id'); ?>">
                <div class="key"><?php echo \dash\get::index($value, 'title'); ?></div>
                <div class="value"><?php echo \dash\fit::number(\dash\get::index($value, 'finalprice')); ?></div>
                <div class="go"></div>
              </a>
          </li>
        <?php } //endfor ?>
        </ul>
      </nav>
      </div>
      <?php } //endif ?>
    </div>

    </div>

  </div>
</div>
