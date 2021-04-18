<?php

$specialslider_ratio = round(a(\dash\data::lineSetting(), 'ratio_detail', 'ratio'), 2);
$lineSetting         = \dash\data::lineSetting();
$images = a($lineSetting, 'detail', 'list');
if(!is_array($images))
{
  $images = [];
}

?>
<form class="row" data-sortable method="post">
    <?php foreach ($images as $key => $value) {?>
    <div class="c-3 c-xs-12 mB20">
      <div class="card">
        <input type="hidden" class="hide" name="sort[]" value="<?php echo $key; ?>">
        <div class="img" data-handle><img src="<?php echo a($value, 'imageurl') ?>" alt="<?php echo a($value, 'alt') ?>"></div>
        <div class="body">
          <header>
            <div class="mB10 font-12"><?php echo a($value, 'alt'); ?></div>
          </header>
          <div class="desc ltr font-10"><?php echo a($value, 'url'); ?> <span><?php if(a($value, 'target')) {?><i class="sf-external-link"></i><?php }// endif ?></span></div>

          <?php if(a($value, 'image_ratio') && $specialslider_ratio && round(a($value, 'image_ratio'), 2) != $specialslider_ratio) {?>
            <div class="fc-orange">
              <i class="sf-exclamation-triangle fc-orange"></i> <?php echo T_("This image ratio is not match by special slider ratio!") ?>
              <?php if(a($value, 'image_ratio_title')) { ?><span class="txtB"><?php echo T_("Image ratio :val", ['val' => \dash\fit::text(a($value, 'image_ratio_title'))]); ?></span><?php } // endif ?>

            </div>
          <?php } // endif ?>
        </div>
        <footer class="zeroPad font-14">
          <a href="<?php echo \dash\url::that(). '/edit'. \dash\request::full_get(['index' => $key]); ?>" class="btn  block"><?php echo T_("Edit"); ?></a>
        </footer>
      </div>
    </div>
    <?php } // endfor ?>
</form>
