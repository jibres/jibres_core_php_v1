<?php if (\dash\detect\device::detectPWA()) { ?>
<nav class="items pwaMultiLine">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f" href="<?php echo \dash\url::that(); ?>/edit?id=<?php echo \dash\get::index($value, 'id'); ?>">
        <img src="<?php echo \dash\get::index($value, 'thumb'); ?>" alt="<?php echo \dash\get::index($value, 'title'); ?>">
        <div class="key">
          <div class="line1"><?php echo \dash\get::index($value, 'title'); ?></div>
          <div class="line2 f">
          <?php if(isset($value['variants_detail']['stock'])) {?>
            <div class="cauto stockCount"><b><?php echo \dash\fit::number($value['variants_detail']['stock']); ?></b> <?php echo T_("in stock"); ?></div>
          <?php } //endif ?>

          <?php if(isset($value['variants_detail']['count'])) {?>
            <div class="c variantCount"><?php echo T_("For"); ?> <b><?php echo \dash\fit::number($value['variants_detail']['count']); ?></b> <?php echo T_("variants"); ?></div>
          <?php } //endif ?>
          <div class="cauto os"><?php echo \dash\get::index($value, 'variant_price'); ?></div>
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
      <a class="f align-center" href="<?php echo \dash\url::that(); ?>/edit?id=<?php echo \dash\get::index($value, 'id'); ?>">
        <img src="<?php echo \dash\get::index($value, 'avatar'); ?>" alt="Avatar - <?php echo \dash\get::index($value, 'displayname'); ?>">
        <div class="key"><?php echo \dash\get::index($value, 'displayname'); ?></div>

        <div class="value txtB"><?php if(isset($value['plus']) && $value['plus']) {?><b>+<?php echo \dash\fit::number($value['plus']); ?></b><?php }?><?php if(isset($value['minus']) && $value['minus']) {?><b>-<?php echo \dash\fit::number($value['minus']); ?></b><?php }?></div>
        <div class="spay-32-<?php echo \dash\get::index($value, 'payment'); ?> key cauto"></div>
        <div class="value"><?php echo \dash\fit::date_time($value['datecreated']); ?></div>

        <div class="go"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php } ?>


<div class="tblBox hide">
  <table class="tbl1 v1 fs12">
    <thead>
      <tr class="fs08">
        <th class="collapsing">&nbsp;</th>
        <th><?php echo T_("Title"); ?></th>
        <th><?php echo T_("Price"); ?></th>
        <th><?php echo T_("Variants"); ?></th>
      </tr>
    </thead>


    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>

      <tr>
        <td class="collapsing"><img src="<?php echo \dash\get::index($value, 'thumb'); ?>" class="avatar" alt="<?php echo \dash\get::index($value, 'title'); ?>"></td>
        <td><a href="<?php echo \dash\url::that(); ?>/edit?id=<?php echo \dash\get::index($value, 'id'); ?>"><i class="sf-edit mRa10"></i><?php echo \dash\get::index($value, 'title'); ?></a></td>
        <td class=""><?php echo \dash\fit::number(\dash\get::index($value, 'variant_price')); ?></td>

        <td>
          <?php if(isset($value['variants_detail']['stock'])) {?>

            <span><b><?php echo \dash\fit::number($value['variants_detail']['stock']); ?></b> <?php echo T_("in stock"); ?></span>

          <?php } //endif ?>

          <?php if(isset($value['variants_detail']['count'])) {?>

            <span> <?php echo T_("For"); ?> <b><?php echo \dash\fit::number($value['variants_detail']['count']); ?></b> <?php echo T_("variants"); ?></span>

          <?php } //endif ?>

        </td>
      </tr>
      <?php } //endfor ?>

    </tbody>
  </table>
</div>

<?php \dash\utility\pagination::html(); ?>
