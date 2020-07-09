
<?php
$productline = \lib\app\product\get::website_last_product();


if($productline && is_array($productline))
{
?>

<?php if(isset($line_detail['value']['title'])) {?>
<div class="fit">
  <h2 class="jTitle1"><?php echo $line_detail['value']['title']; ?></h2>
</div>
<?php } //endif ?>

  <div class="avand">
    <div class="row padLess">

      <?php foreach ($productline as $key => $value) { ?>
        <div class="c-xs-6 c-sm-6 c-md-4 c-lg-3 c-xl-2">
          <a class="jProduct1" href="<?php echo \dash\get::index($value, 'url'); ?>">
            <img src="<?php echo \dash\get::index($value, 'thumb') ?>" alt="<?php echo \dash\get::index($value, 'title') ?>">
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