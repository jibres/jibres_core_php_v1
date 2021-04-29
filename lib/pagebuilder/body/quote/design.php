<?php

$specialslider_ratio = round(a(\dash\data::lineSetting(), 'ratio_detail', 'ratio'), 2);
$lineSetting         = \dash\data::lineSetting();
$images = a($lineSetting, 'detail', 'list');
if(!is_array($images))
{
  $images = [];
}

?>
<form  method="post">
  <div class="row" data-sortable>

    <?php foreach ($images as $key => $value) {?>
    <div class="c-3 c-xs-12">
      <div class="card">
        <input type="hidden" class="hide" name="sort[]" value="<?php echo $key; ?>">
        <div class="img" data-handle><img class="avatar" src="<?php echo a($value, 'imageurl') ?>" alt="<?php echo a($value, 'displayname') ?>"></div>
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
     <div class="c-3 c-xs-12 mB20">
      <a class="card" href="<?php echo \dash\data::action_link() ?>">
        <div class="img"><img class="" src="<?php echo \dash\url::cdn(); ?>/img/product/camera1.png" align='<?php echo \dash\data::action_text(); ?>'></div>
        <div class="body">
          <header>
            <div class="mB10 fc-mute txtC mT20 font-12"><?php echo T_("Click to add new quote") ?></div>
          </header>
        </div>
        <footer class="zeroPad font-14">
          <div  class="btn success2  block"><i class="sf-plus"></i> <?php echo \dash\data::action_text(); ?></div>
        </footer>
      </a>
    </div>
  </div>
</form>
