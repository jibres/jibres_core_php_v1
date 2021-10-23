<?php $urlHere = \dash\url::here(); ?>
<div class="avand">

      <nav class="items">
        <ul>
          <li><a class="f" href="<?php echo $urlHere; ?>/pricehistory"><div class="key"><?php echo T_("Price history"); ?></div><div class="go"></div></a></li>
        </ul>
      </nav>

  <nav class="items">
    <ul>
      <li><a class="f" href="<?php echo $urlHere; ?>/products"><div class="key"><?php echo T_("Total products"); ?></div><div class="value"><?php echo \dash\fit::stats(\lib\app\report\product\get::count_all());?></div><div class="go"></div></a></li>
      <li><a class="f" href="<?php echo $urlHere; ?>/products"><div class="key"><?php echo T_("Average price"); ?></div><div class="value"><?php echo \dash\fit::number(\lib\app\report\product\get::average_finalprice());?></div><div class="go"></div></a></li>


      <?php $expensive = \lib\app\report\product\get::expensive(); if($expensive) {?>
        <li><a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. a($expensive, 'id') ?>"><div class="key"><?php echo T_("Expensive product");?> :: <?php echo a($expensive, 'title'); ?></div><div class="value"><?php echo \dash\fit::number(a($expensive, 'finalprice'));?></div><div class="go"></div></a></li>
      <?php } // endif ?>



      <?php $inexpensive = \lib\app\report\product\get::inexpensive(); if($inexpensive) {?>
        <li><a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. a($inexpensive, 'id') ?>"><div class="key"><?php echo T_("Inexpensive product");?> :: <?php echo a($inexpensive, 'title'); ?></div><div class="value"><?php echo \dash\fit::number(a($inexpensive, 'finalprice'));?></div><div class="go"></div></a></li>
      <?php } // endif ?>


      <?php $maxsale = \lib\app\report\product\get::maxsale(); if($maxsale) {?>
        <li><a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. a($maxsale, 'id') ?>"><div class="key"><?php echo T_("Max sale count");?> :: <?php echo a($maxsale, 'title'); ?></div><div class="value"><?php echo \dash\fit::number(a($maxsale, 'sold_count'));?> <small><?php echo T_("Item") ?></small></div><div class="go"></div></a></li>
      <?php } // endif ?>


      <?php $max_price_change_count = \lib\app\report\product\get::max_price_change_count(); if($max_price_change_count) {?>
        <li><a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. a($max_price_change_count, 'id') ?>"><div class="key"><?php echo T_("Max price change count");?> :: <?php echo a($max_price_change_count, 'title'); ?></div><div class="value"><?php echo \dash\fit::number(a($max_price_change_count, 'count'));?></div><div class="go"></div></a></li>
      <?php } // endif ?>


      <?php $maxsaleprice = \lib\app\report\product\get::maxsaleprice(); if($maxsaleprice) { ?>
        <li><a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. a($maxsaleprice, 'id') ?>"><div class="key"><?php echo T_("Max sale price");?> :: <?php echo a($maxsaleprice, 'title'); ?></div><div class="value"><?php echo \dash\fit::number(a($maxsaleprice, 'sold_price'));?> <small><?php echo \lib\store::currency(); ?></small></div><div class="go"></div></a></li>
      <?php } // endif ?>



      <?php $maxstock = \lib\app\report\product\get::maxstock(); if($maxstock) { ?>
        <li><a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. a($maxstock, 'id') ?>"><div class="key"><?php echo T_("Max stock");?> :: <?php echo a($maxstock, 'title'); ?></div><div class="value"><?php echo \dash\fit::number(a($maxstock, 'stock'));?></div><div class="go"></div></a></li>
      <?php } // endif ?>

      <?php $count_have_variants = \lib\app\report\product\get::count_have_variants(); if($count_have_variants) { ?>
        <li><a class="f" href="<?php echo \dash\url::here(). '/products?havevariants=1'; ?>"><div class="key"><?php echo T_("Product have variants");?></div><div class="value"><?php echo \dash\fit::number($count_have_variants);?></div><div class="go"></div></a></li>
      <?php } // endif ?>



      <?php $total_fund = \lib\app\report\product\get::total_fund(); if($total_fund) { ?>
        <li><a class="f" href="<?php echo \dash\url::here(). '/products'; ?>"><div class="key"><?php echo T_("Total finalprice of all products");?></div><div class="value"><?php echo \dash\fit::number(a($total_fund, 'total_finalprice'));?></div><div class="go"></div></a></li>

        <li><a class="f" href="<?php echo \dash\url::here(). '/products'; ?>"><div class="key"><?php echo T_("Total price of all products");?></div><div class="value"><?php echo \dash\fit::number(a($total_fund, 'total_price'));?></div><div class="go"></div></a></li>

        <li><a class="f" href="<?php echo \dash\url::here(). '/products'; ?>"><div class="key"><?php echo T_("Total profit of all products");?></div><div class="value"><?php echo \dash\fit::number(a($total_fund, 'total_profit'));?></div><div class="go"></div></a></li>
      <?php } // endif ?>




      <?php $total_pricechange = \lib\app\report\product\get::total_pricechange(); if($total_pricechange) {?>
        <li><a class="f" href="<?php echo \dash\url::here(). '/products' ?>"><div class="key"><?php echo T_("Total price change");?></div><div class="value"><?php echo \dash\fit::number($total_pricechange);?></div><div class="go"></div></a></li>
      <?php } // endif ?>

      <?php $bestselling = \lib\app\report\product\get::bestselling(); if($bestselling) {?>
        <li><a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. a($bestselling, 'id') ?>"><div class="key"><?php echo T_("Bestselling product");?> :: <?php echo a($bestselling, 'title'); ?></div><div class="value"><?php echo \dash\fit::number(a($bestselling, 'sold_count'));?></div><div class="go"></div></a></li>
      <?php } // endif ?>




    </ul>
  </nav>




   <nav class="items">
    <ul>
      <?php $most_product_in_cart = \lib\app\report\product\get::most_product_in_cart(); if($most_product_in_cart) {?>
        <li><a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. a($most_product_in_cart, 'id') ?>"><div class="key"><?php echo T_("Most items in the cart");?> :: <?php echo a($most_product_in_cart, 'title'); ?></div><div class="value"><?php echo \dash\fit::number(a($most_product_in_cart, 'count'));?></div><div class="go"></div></a></li>
      <?php } // endif ?>



    </ul>
  </nav>

   <nav class="items">
    <ul>


       <?php $category_count = \lib\app\report\product\get::category_count(); if($category_count) {?>
        <li><a class="f" href="<?php echo \dash\url::here(). '/category'; ?>"><div class="key"><?php echo T_("Product category");?></div><div class="value"><?php echo \dash\fit::number($category_count);?></div><div class="go"></div></a></li>
      <?php } // endif ?>

      <?php $unit_count = \lib\app\report\product\get::unit_count(); if($unit_count) {?>
        <li><a class="f" href="<?php echo \dash\url::here(). '/units'; ?>"><div class="key"><?php echo T_("Product units");?></div><div class="value"><?php echo \dash\fit::number($unit_count);?></div><div class="go"></div></a></li>
      <?php } // endif ?>

    </ul>
  </nav>

</div>

<div class="avand">


  <div class="row">
    <?php $expensive_list = \lib\app\report\product\get::expensive_list(10); if($expensive_list) {?>
      <div class="c-xs-12 s-sm-12 c-md-6">
        <h4><?php echo T_("Expensive list") ?></h4>
        <nav class="items">
          <ul>
            <?php foreach ($expensive_list as $key => $value) {?>
              <li>
                <a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. a($value, 'id'); ?>">
                  <div class="key"><?php echo a($value, 'title'); ?></div>
                  <div class="value"><?php echo \dash\fit::number(a($value, 'finalprice')); ?></div>
                  <div class="go"></div>
                </a>
              </li>
            <?php } //endfor ?>
          </ul>
        </nav>
      </div>
    <?php } //endif ?>

    <?php $inexpensive_list = \lib\app\report\product\get::inexpensive_list(10); if($inexpensive_list) {?>
      <div class="c-xs-12 s-sm-12 c-md-6">
        <h4><?php echo T_("Inexpensive list") ?></h4>
        <nav class="items">
          <ul>
            <?php foreach ($inexpensive_list as $key => $value) {?>
              <li>
                <a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. a($value, 'id'); ?>">
                  <div class="key"><?php echo a($value, 'title'); ?></div>
                  <div class="value"><?php echo \dash\fit::number(a($value, 'finalprice')); ?></div>
                  <div class="go"></div>
                </a>
              </li>
            <?php } //endfor ?>
          </ul>
        </nav>
      </div>
    <?php } //endif ?>


    <?php $maxsale_list = \lib\app\report\product\get::maxsale_list(10); if($maxsale_list) {?>
      <div class="c-xs-12 s-sm-12 c-md-6">
        <h4><?php echo T_("Max sold products") ?></h4>
        <nav class="items">
          <ul>
            <?php foreach ($maxsale_list as $key => $value) {?>
              <li>
                <a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. a($value, 'id'); ?>">
                  <div class="key"><?php echo a($value, 'title'); ?></div>
                  <div class="value"><?php echo \dash\fit::number(a($value, 'sold_count')); ?></div>
                  <div class="go"></div>
                </a>
              </li>
            <?php } //endfor ?>
          </ul>
        </nav>
      </div>
    <?php } //endif ?>



    <?php $maxsaleprice_list = \lib\app\report\product\get::maxsaleprice_list(10); if($maxsaleprice_list) {?>
      <div class="c-xs-12 s-sm-12 c-md-6">
        <h4><?php echo T_("Max sold price") ?></h4>
        <nav class="items">
          <ul>
            <?php foreach ($maxsaleprice_list as $key => $value) {?>
              <li>
                <a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. a($value, 'id'); ?>">
                  <div class="key"><?php echo a($value, 'title'); ?></div>
                  <div class="value"><?php echo \dash\fit::number(a($value, 'sold_price')); ?></div>
                  <div class="go"></div>
                </a>
              </li>
            <?php } //endfor ?>
          </ul>
        </nav>
      </div>
    <?php } //endif ?>



    <?php $maxstock_list = \lib\app\report\product\get::maxstock_list(10); if($maxstock_list) { ?>
      <div class="c-xs-12 s-sm-12 c-md-6">
        <h4><?php echo T_("Max stock") ?></h4>
        <nav class="items">
          <ul>
            <?php foreach ($maxstock_list as $key => $value) {?>
              <li>
                <a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. a($value, 'id'); ?>">
                  <div class="key"><?php echo a($value, 'title'); ?></div>
                  <div class="value"><?php echo \dash\fit::number(a($value, 'stock')); ?></div>
                  <div class="go"></div>
                </a>
              </li>
            <?php } //endfor ?>
          </ul>
        </nav>
      </div>
    <?php } //endif ?>



    <?php $last_product_in_cart = \lib\app\report\product\get::last_product_in_cart(10); if($last_product_in_cart) { ?>
      <div class="c-xs-12 s-sm-12 c-md-6">
        <h4><?php echo T_("Last product in cart") ?></h4>
        <nav class="items">
          <ul>
            <?php foreach ($last_product_in_cart as $key => $value) {?>
              <li>
                <a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. a($value, 'id'); ?>">
                  <div class="key"><?php echo a($value, 'title'); ?></div>
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
