<?php
$productList = \lib\app\product\get::website_last_product();

if($productList && is_array($productList))
{
?>

  <div class="fit">
    <div class="f">

      <?php foreach ($productList as $key => $value) { ?>
        <div class="c3 s12 pRa10">
          <a class="jProduct1" href="<?php echo \dash\get::index($value, 'url'); ?>">
            <img src="<?php echo \dash\get::index($value, 'thumb') ?>">
            <footer>
              <div class="title"><?php echo \dash\get::index($value, 'title') ?></div>
              <div class="price"><span><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?></span> <span class="unit"><?php echo \dash\get::index($value, 'unit'); ?></span></div>
            </footer>
          </a>
        </div>
      <?php } //endfor ?>
    </div>
  </div>

<?php } //endif ?>