
<?php if(\dash\data::myProductList()) {?>

 <div class="avand">
    <div class="f">

      <?php foreach (\dash\data::myProductList() as $key => $value) { ?>
        <div class="c3 s12 pRa10">
          <a class="jProduct1" href="<?php echo a($value, 'url'); ?>">
            <img src="<?php echo a($value, 'thumb') ?>" alt="<?php echo a($value, 'title') ?>">
            <footer>
              <div class="title"><?php echo a($value, 'title') ?></div>
              <div class="price"><span><?php echo \dash\fit::number(a($value, 'price')); ?></span> <span class="unit"><?php echo a($value, 'currency'); ?></span></div>
            </footer>
          </a>
        </div>
      <?php } //endfor ?>
    </div>
  </div>


  <?php } //endif ?>