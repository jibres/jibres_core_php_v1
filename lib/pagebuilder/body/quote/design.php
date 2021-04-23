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
    <div class="c-3 c-xs-12">
      <div class="card">
        <div class="img"><img class="avatar" src="<?php echo a($value, 'imageurl') ?>" alt="<?php echo a($value, 'displayname') ?>"></div>
        <div class="body">
          <header>
            <div class="mB10 font-12"><?php echo a($value, 'displayname'); ?> <small><?php echo a($value, 'job'); ?></small></div>
          </header>
          <div class="desc font-12 mB10"><?php echo a($value, 'text'); ?></div>
          <div class="desc ltr"><?php if(a($value, 'star')) { echo str_repeat('⭐️', a($value, 'star')); } ?></div>

        </div>
        <footer class="zeroPad font-14">
          <a href="<?php echo \dash\url::current(). '/edit'. \dash\request::full_get(['index' => $key]); ?>" class="btn  block"><?php echo T_("Edit"); ?></a>
        </footer>
      </div>
    </div>
    <?php } // endfor ?>
</form>
