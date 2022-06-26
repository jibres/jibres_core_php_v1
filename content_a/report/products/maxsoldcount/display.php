<?php $urlHere = \dash\url::here(); ?>



    <?php $maxsale_list = \lib\app\product\report\statistics::maxsale_list(10); if($maxsale_list) {?>
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
