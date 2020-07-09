
<?php
$productline = \lib\app\product\get::website_last_product();


if($productline && is_array($productline)) { ?>
<section class="productLine">
  <div class="avand">
<?php if(isset($line_detail['value']['title'])) {?>
    <h2 class="jTitle1"><?php echo $line_detail['value']['title']; ?></h2>
<?php } //endif ?>

    <div class="row padLess <?php if(\dash\detect\device::detectPWA()) {echo "horizontalScroll nowrap";}?>">
      <?php foreach ($productline as $key => $value) { ?>
        <div class="c-xs-6 c-sm-6 c-md-4 c-lg-3 c-xl-2 productBox">
          <a class="jProduct1" href="<?php echo \dash\get::index($value, 'url'); ?>">
            <img src="<?php echo \dash\get::index($value, 'thumb') ?>" alt="<?php echo \dash\get::index($value, 'title') ?>">
            <footer>
              <div class="title"><?php echo \dash\get::index($value, 'title') ?></div>
              <?php if(\dash\permission::supervisor()) {?>
                <?php if(\dash\get::index($value, 'discount')) {?>
                    <u><?php echo \dash\fit::price(\dash\get::index($value, 'price') + \dash\get::index($value, 'discount')); ?></u>
                    <br>
                    <i><?php echo \dash\fit::text(\dash\get::index($value, 'discountpercent')) . ' '. T_("%"); ?></i>
                <?php } //endif ?>
              <?php } //endif ?>
              <div class="price"><span><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?></span> <span class="unit"><?php echo \dash\get::index($value, 'unit'); ?></span></div>
            </footer>
          </a>
        </div>
      <?php } //endfor ?>
    </div>
  </div>
</section>

<?php } //endif ?>