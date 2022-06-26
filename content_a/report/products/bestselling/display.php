<?php $urlHere = \dash\url::here(); ?>
<div class="">
  <nav class="items">
    <ul>

      <?php $bestselling = \lib\app\product\report\statistics::bestselling(); if($bestselling) {?>
        <li><a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. a($bestselling, 'id') ?>"><div class="key"><?php echo T_("Bestselling product");?> :: <?php echo a($bestselling, 'title'); ?></div><div class="value"><?php echo \dash\fit::number(a($bestselling, 'sold_count'));?></div><div class="go"></div></a></li>
      <?php } // endif ?>

    </ul>
  </div>
</div>
