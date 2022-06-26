<?php $urlHere = \dash\url::here(); ?>





    <?php $maxsaleprice_list = \lib\app\product\report\statistics::maxsaleprice_list(10); if($maxsaleprice_list) {?>
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
