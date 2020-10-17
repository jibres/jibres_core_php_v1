
<?php require_once ('filter.php'); ?>


<?php
if(\dash\data::dataTable())
{
  if(\dash\data::isFiltered())
  {

    htmlSearchBox();
    htmlTable();
    htmlFilter();

  }
  else
  {
    htmlSearchBox();
    htmlTable();
  }
}
else
{
  if(\dash\data::isFiltered())
  {

    htmlSearchBox();
    htmlFilter();



  }
  else
  {
    htmlStartAddNew();

  }

}
?>








<?php function htmlTable() {?>

<?php

if(\dash\get::index(\dash\data::productSettingSaved(), 'default_pirce_list'))
{
  htmlTablePrice();
  return;
}
?>

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
      <a class="f" href="<?php echo \dash\url::that(); ?>/edit?id=<?php echo \dash\get::index($value, 'id'); ?>">
        <img src="<?php echo \dash\get::index($value, 'thumb'); ?>" alt="<?php echo \dash\get::index($value, 'title'); ?>">
        <div class="key"><?php echo \dash\get::index($value, 'title'); ?></div>

            <?php if(isset($value['variants_detail']['stock'])) {?>
              <div class="key"><b><?php echo \dash\fit::number($value['variants_detail']['stock']); ?></b> <?php echo T_("in stock"); ?></div>
            <?php }elseif(\dash\get::index($value, 'stock')){ ?>
              <div class="key"><b><?php echo \dash\fit::number($value['stock']); ?></b> <?php echo T_("in stock"); ?></div>
            <?php } //endif ?>

            <?php if(isset($value['variants_detail']['count'])) {?>
              <div class="key cauto"><?php echo T_("For"); ?> <b><?php echo \dash\fit::number($value['variants_detail']['count']); ?></b> <?php echo T_("variants"); ?></div>
            <?php } //endif ?>

        <div class="value"><?php echo \dash\get::index($value, 'variant_price'); ?></div>
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


<?php } //endfunction ?>





<?php function htmlTablePrice() {?>

  <table class="tbl1 v1 cbox fs12">
    <thead>
      <tr class="fs08">
        <th class="collapsing"></th>
        <th class="collapsing"><?php echo T_("Title"); ?></th>
      <th><?php echo T_("Buy price"); ?></th>
        <th><?php echo T_("Price"); ?></th>
        <th><?php echo T_("Discount"); ?></th>
        <th><?php echo T_("Discount percent"); ?></th>
        <th><?php echo T_("Final price"); ?></th>
        <th><?php echo T_("Stock"); ?></th>
      </tr>
    </thead>

    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>


      <tr>
        <td class="collapsing"><img src="<?php echo \dash\get::index($value, 'thumb'); ?>" class="avatar fs14"></td>
        <td class="collapsing">
          <div><a href="<?php echo \dash\url::this(); ?>/edit?id=<?php echo \dash\get::index($value, 'id'); ?>"><i class="sf-edit mRa10"></i><?php echo \dash\get::index($value, 'title'); ?></a></div>
          <?php if(isset($value['optionvalue1']) && $value['optionvalue1']) {?>
            <div><?php echo \dash\get::index($value, 'optionname1'); ?> <b><?php echo \dash\get::index($value, 'optionvalue1'); ?></b></div>
          <?php } //endif ?>

          <?php if(isset($value['optionvalue2']) && $value['optionvalue2']) {?>
            <div><?php echo \dash\get::index($value, 'optionname2'); ?> <b><?php echo \dash\get::index($value, 'optionvalue2'); ?></b></div>
          <?php } //endif ?>

          <?php if(isset($value['optionvalue3']) && $value['optionvalue3']) {?>
            <div><?php echo \dash\get::index($value, 'optionname3'); ?> <b><?php echo \dash\get::index($value, 'optionvalue3'); ?></b></div>
          <?php } //endif ?>
        </td>

        <td><?php echo \dash\fit::number(\dash\get::index($value, 'buyprice')); ?></td>
        <td><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?></td>
        <td><?php echo \dash\fit::number(\dash\get::index($value, 'discount')); ?></td>
        <td><?php echo \dash\fit::number(\dash\get::index($value, 'discountpercent')); ?></td>
        <td><?php echo \dash\fit::number(\dash\get::index($value, 'finalprice')); ?></td>
        <td><?php echo \dash\fit::number(\dash\get::index($value, 'stock')); ?></td>

      </tr>
      <?php } //endfor ?>
    </tbody>
  </table>

<?php \dash\utility\pagination::html(); ?>

<?php } //endfunction ?>






<?php function htmlFilter() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo \dash\data::filterBox(); ?></span>

  <?php if(\dash\data::barcodeScaned()) {?>

    <a class="c" href="<?php echo \dash\url::this(); ?>/add<?php echo \dash\data::barcodeScaned(); ?>" data-shortkey="118"><?php echo T_("Add new product"); ?> <kbd>f7</kbd></a>

  <?php } //endif ?>

  <a class="cauto" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>

<?php } //endfunction ?>




<?php function htmlStartAddNew() {?>

<div class="fs14 msg info2 pTB20">
  <p><?php echo T_("Hi!"); ?></p>
  <p><?php echo T_("First step to set up your online store is add products."); ?> <?php echo T_("After add products, you can sell them to your customers."); ?></p>
  <p><a href="<?php echo \dash\url::that(); ?>/add"><?php echo T_("Try to start with add new product!"); ?></a></p>

</div>

<img class="banner" src="<?php echo \dash\url::cdn(); ?>/img/product/camera1.png" align='<?php echo T_("add new product"); ?>'>


<?php } //endfunction ?>

