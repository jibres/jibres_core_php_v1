<?php $urlHere = \dash\url::here(); ?>
<div class="">
  <nav class="items">
    <ul>
      <?php $maxsaleprice = \lib\app\product\report\statistics::maxsaleprice(); if($maxsaleprice) { ?>
        <li><a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. a($maxsaleprice, 'id') ?>"><div class="key"><?php echo T_("Max sale price");?> :: <?php echo a($maxsaleprice, 'title'); ?></div><div class="value"><?php echo \dash\fit::number(a($maxsaleprice, 'sold_price'));?> <small><?php echo \lib\store::currency(); ?></small></div><div class="go"></div></a></li>
      <?php } // endif ?>

    </ul>
  </div>
</div>
