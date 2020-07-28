<?php $urlHere = \dash\url::here(); ?>

<div class="avand">


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
          <h3><?php echo T_("Inexpensive product");?> <?php echo \dash\get::index($inexpensive, 'title'); ?></h3>
          <div class="val"><?php echo \dash\fit::number(\dash\get::index($inexpensive, 'finalprice'));?></div>
        </a>
      </div>
    <?php } // endif ?>


    <?php $maxsale = \lib\report\product\get::maxsale(); if($maxsale) {?>
      <div class="c6 s12 pRa10">
        <a href="<?php echo \dash\url::here(). '/products/edit?id='. \dash\get::index($maxsale, 'id') ?>" class="stat">
          <h3><?php echo T_("Max sale count");?> <?php echo \dash\get::index($maxsale, 'title'); ?></h3>
          <div class="val"><?php echo \dash\fit::number(\dash\get::index($maxsale, 'sold_count'));?> <small><?php echo T_("Item") ?></small></div>
        </a>
      </div>
    <?php } // endif ?>

    <?php $maxsaleprice = \lib\report\product\get::maxsaleprice(); if($maxsaleprice) { ?>
      <div class="c6 s12 pRa10">
        <a href="<?php echo \dash\url::here(). '/products/edit?id='. \dash\get::index($maxsaleprice, 'id') ?>" class="stat">
          <h3><?php echo T_("Max sale price");?> <?php echo \dash\get::index($maxsaleprice, 'title'); ?></h3>
          <div class="val"><?php echo \dash\fit::number(\dash\get::index($maxsaleprice, 'sold_price'));?> <small><?php echo \lib\store::currency(); ?></small></div>
        </a>
      </div>
    <?php } // endif ?>




  </section>

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

  </div>
</div>
