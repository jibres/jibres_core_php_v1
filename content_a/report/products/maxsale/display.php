<?php $urlHere = \dash\url::here(); ?>
<div class="">
  <nav class="items">
    <ul>
      <?php $maxsale = \lib\app\product\report\statistics::maxsale(); if($maxsale) {?>
        <li><a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='. a($maxsale, 'id') ?>"><div class="key"><?php echo T_("Max sale count");?> :: <?php echo a($maxsale, 'title'); ?></div><div class="value"><?php echo \dash\fit::number(a($maxsale, 'sold_count'));?> <small><?php echo T_("Item") ?></small></div><div class="go"></div></a></li>
      <?php } // endif ?>
    </ul>
  </div>
</div>
