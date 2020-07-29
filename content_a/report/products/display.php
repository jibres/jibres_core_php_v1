<?php $urlHere = \dash\url::here(); ?>
<div class="avand">
    <nav class="items">
      <ul>
        <li><a class="f" href="<?php echo $urlHere; ?>/products"><div class="key"><?php echo T_("Total products"); ?></div><div class="value"><?php echo \dash\fit::stats(\lib\report\product\get::count_all());?></div><div class="go"></div></a></li>
         <li><a class="f" href="<?php echo $urlHere; ?>/products"><div class="key"><?php echo T_("Average price"); ?></div><div class="value"><?php echo \dash\fit::number(\lib\report\product\get::average_finalprice());?></div><div class="go"></div></a></li>


        <?php $expensive = \lib\report\product\get::expensive(); if($expensive) {?>
          <li><a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. \dash\get::index($expensive, 'id') ?>"><div class="key"><?php echo T_("Expensive product");?> :: <?php echo \dash\get::index($expensive, 'title'); ?></div><div class="value"><?php echo \dash\fit::number(\dash\get::index($expensive, 'finalprice'));?></div><div class="go"></div></a></li>
        <?php } // endif ?>



        <?php $inexpensive = \lib\report\product\get::inexpensive(); if($inexpensive) {?>
            <li><a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. \dash\get::index($inexpensive, 'id') ?>"><div class="key"><?php echo T_("Inexpensive product");?> :: <?php echo \dash\get::index($inexpensive, 'title'); ?></div><div class="value"><?php echo \dash\fit::number(\dash\get::index($inexpensive, 'finalprice'));?></div><div class="go"></div></a></li>
        <?php } // endif ?>


    <?php $maxsale = \lib\report\product\get::maxsale(); if($maxsale) {?>
      <li><a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. \dash\get::index($maxsale, 'id') ?>"><div class="key"><?php echo T_("Max sale count");?> :: <?php echo \dash\get::index($maxsale, 'title'); ?></div><div class="value"><?php echo \dash\fit::number(\dash\get::index($maxsale, 'sold_count'));?> <small><?php echo T_("Item") ?></small></div><div class="go"></div></a></li>
    <?php } // endif ?>


    <?php $maxsaleprice = \lib\report\product\get::maxsaleprice(); if($maxsaleprice) { ?>
      <li><a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. \dash\get::index($maxsaleprice, 'id') ?>"><div class="key"><?php echo T_("Max sale price");?> :: <?php echo \dash\get::index($maxsaleprice, 'title'); ?></div><div class="value"><?php echo \dash\fit::number(\dash\get::index($maxsaleprice, 'sold_price'));?> <small><?php echo \lib\store::currency(); ?></small></div><div class="go"></div></a></li>
    <?php } // endif ?>



    <?php $maxstock = \lib\report\product\get::maxstock(); if($maxstock) { ?>
      <li><a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. \dash\get::index($maxstock, 'id') ?>"><div class="key"><?php echo T_("Max stock");?> :: <?php echo \dash\get::index($maxstock, 'title'); ?></div><div class="value"><?php echo \dash\fit::number(\dash\get::index($maxstock, 'stock'));?></div><div class="go"></div></a></li>
    <?php } // endif ?>

    <?php $count_have_variants = \lib\report\product\get::count_have_variants(); if($count_have_variants) { ?>
      <li><a class="f" href="<?php echo \dash\url::here(). '/products?havevariants=1'; ?>"><div class="key"><?php echo T_("Product have variants");?></div><div class="value"><?php echo \dash\fit::number($count_have_variants);?></div><div class="go"></div></a></li>
    <?php } // endif ?>


      </ul>
    </nav>

</div>

<div class="avand">


  <div class="row">
    <?php $expensive_list = \lib\report\product\get::expensive_list(10); if($expensive_list) {?>
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

    <?php $inexpensive_list = \lib\report\product\get::inexpensive_list(10); if($inexpensive_list) {?>
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


    <?php $maxsale_list = \lib\report\product\get::maxsale_list(10); if($maxsale_list) {?>
      <div class="c-xs-12 s-sm-12 c-md-6">
        <h4><?php echo T_("Max sold products") ?></h4>
        <nav class="items">
          <ul>
            <?php foreach ($maxsale_list as $key => $value) {?>
              <li>
                <a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. \dash\get::index($value, 'id'); ?>">
                  <div class="key"><?php echo \dash\get::index($value, 'title'); ?></div>
                  <div class="value"><?php echo \dash\fit::number(\dash\get::index($value, 'sold_count')); ?></div>
                  <div class="go"></div>
                </a>
              </li>
            <?php } //endfor ?>
          </ul>
        </nav>
      </div>
    <?php } //endif ?>



    <?php $maxsaleprice_list = \lib\report\product\get::maxsaleprice_list(10); if($maxsaleprice_list) {?>
      <div class="c-xs-12 s-sm-12 c-md-6">
        <h4><?php echo T_("Max sold price") ?></h4>
        <nav class="items">
          <ul>
            <?php foreach ($maxsaleprice_list as $key => $value) {?>
              <li>
                <a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. \dash\get::index($value, 'id'); ?>">
                  <div class="key"><?php echo \dash\get::index($value, 'title'); ?></div>
                  <div class="value"><?php echo \dash\fit::number(\dash\get::index($value, 'sold_price')); ?></div>
                  <div class="go"></div>
                </a>
              </li>
            <?php } //endfor ?>
          </ul>
        </nav>
      </div>
    <?php } //endif ?>



    <?php $maxstock_list = \lib\report\product\get::maxstock_list(10); if($maxstock_list) {?>
      <div class="c-xs-12 s-sm-12 c-md-6">
        <h4><?php echo T_("Max sold price") ?></h4>
        <nav class="items">
          <ul>
            <?php foreach ($maxstock_list as $key => $value) {?>
              <li>
                <a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. \dash\get::index($value, 'id'); ?>">
                  <div class="key"><?php echo \dash\get::index($value, 'title'); ?></div>
                  <div class="value"><?php echo \dash\fit::number(\dash\get::index($value, 'stock')); ?></div>
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
