<?php if (\dash\detect\device::detectPWA()) { ?>
<nav class="items pwaMultiLine">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f" href="<?php echo \dash\url::that(); ?>/edit?id=<?php echo a($value, 'id'); ?>">
        <img src="<?php echo \dash\fit::img(a($value, 'thumb')); ?>" alt="<?php echo a($value, 'title'); ?>">
        <div class="key">
          <div class="line1"><?php echo a($value, 'title'); ?></div>
          <div class="line2 f">
          <?php if(isset($value['variants_detail']['stock'])) {?>
            <div class="cauto stockCount"><b><?php echo \dash\fit::number($value['variants_detail']['stock']); ?></b> <?php echo T_("in stock"); ?></div>
          <?php } //endif ?>

          <?php if(isset($value['variants_detail']['count'])) {?>
            <div class="c variantCount"><?php echo T_("For"); ?> <b><?php echo \dash\fit::number($value['variants_detail']['count']); ?></b> <?php echo T_("variants"); ?></div>
          <?php } //endif ?>
          <div class="cauto os"><?php echo a($value, 'variant_price'); ?></div>
          </div>
        </div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php } else { ?>
<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f" href="<?php echo \dash\url::that(); ?>/edit?id=<?php echo a($value, 'id'); ?>">
        <img src="<?php echo \dash\fit::img(a($value, 'thumb')); ?>" alt="<?php echo a($value, 'title'); ?>">
        <div class="key"><?php echo a($value, 'title'); ?></div>

            <?php if(isset($value['variants_detail']['stock'])) {?>
              <div class="key"><b><?php echo \dash\fit::number($value['variants_detail']['stock']); ?></b> <?php echo T_("in stock"); ?></div>
            <?php }elseif(a($value, 'stock')){ ?>
              <div class="key"><b><?php echo \dash\fit::number($value['stock']); ?></b> <?php echo T_("in stock"); ?></div>
            <?php } //endif ?>

            <?php if(isset($value['variants_detail']['count'])) {?>
              <div class="key cauto"><?php echo T_("For"); ?> <b><?php echo \dash\fit::number($value['variants_detail']['count']); ?></b> <?php echo T_("variants"); ?></div>
            <?php } //endif ?>

        <div class="value"><?php echo a($value, 'variant_price'); ?></div>
        <div class="go"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php } ?>

<?php \dash\utility\pagination::html(); ?>