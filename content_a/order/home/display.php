<?php

require_once('filter.php');

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
    htmlFilterNoResult();


  }
  else
  {
    htmlStartAddNew();

  }

}
?>


<?php function htmlTable() {?>

<?php
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}
$andType = \dash\request::get('type') ? '&type='. \dash\request::get('type') : null;
$sortLink = \dash\data::sortLink();
?>

  <table class="tbl1 v6 fs12 txtC">
    <thead>
      <tr class="fs08">
        <th class="s0" data-sort="<?php echo a($sortLink, 'customer', 'order'); ?>"><a href="<?php echo a($sortLink, 'customer', 'link'); ?>"><?php echo T_("Customer"); ?></a></th>
        <th class="s0" data-sort="<?php echo a($sortLink, 'item', 'order'); ?>"><a href="<?php echo a($sortLink, 'item', 'link'); ?>"><?php echo T_("Items"); ?></a></th>
        <th class="s0" data-sort="<?php echo a($sortLink, 'qty', 'order'); ?>"><a href="<?php echo a($sortLink, 'qty', 'link'); ?>"><?php echo T_("Qty"); ?></a></th>
        <th class="s0" data-sort="<?php echo a($sortLink, 'subprice', 'order'); ?>"><a href="<?php echo a($sortLink, 'subprice', 'link'); ?>"><?php echo T_("Price"); ?></a></th>
        <th class="s0" data-sort="<?php echo a($sortLink, 'subdiscount', 'order'); ?>"><a href="<?php echo a($sortLink, 'subdiscount', 'link'); ?>"><?php echo T_("Discount"); ?></a></th>

        <?php if(!\dash\data::hideSubvat()) {?>
          <th class="s0" data-sort="<?php echo a($sortLink, 'subvat', 'order'); ?>"><a href="<?php echo a($sortLink, 'subvat', 'link'); ?>"><?php echo T_("VAT"); ?></a></th>
        <?php } //endif ?>

        <?php if(!\dash\data::hideShipping()) {?>
          <th class="s0" data-sort="<?php echo a($sortLink, 'shipping', 'order'); ?>"><a href="<?php echo a($sortLink, 'shipping', 'link'); ?>"><?php echo T_("Shipping"); ?></a></th>
        <?php } //endif ?>

        <th data-sort="<?php echo a($sortLink, 'subtotal', 'order'); ?>"><a href="<?php echo a($sortLink, 'subtotal', 'link'); ?>"><?php echo T_("Total"); ?></a></th>
        <th data-sort="<?php echo a($sortLink, 'date', 'order'); ?>"><a href="<?php echo a($sortLink, 'date', 'link'); ?>"><?php echo T_("Invoice Date"); ?></a></th>

        <th class=""><?php echo T_("Pay status"); ?></th>
        <?php if(!\dash\request::get('type')) {?>
          <th class="s0" data-sort="<?php echo a($sortLink, 'type', 'order'); ?>"><a href="<?php echo a($sortLink, 'type', 'link'); ?>"><?php echo T_("Type"); ?></a></th>
        <?php } //endif ?>

        <th><?php echo T_("Operation"); ?></th>
      </tr>

    </thead>
    <tbody>
      <?php foreach ($dataTable as $key => $value) {?>
        <tr>
          <td class="s0">
            <?php if(isset($value['customer'])) {?>
            <a href="<?php echo \dash\url::this(); ?>?customer=<?php echo a($value, 'customer'); ?>">
              <?php if(isset($value['avatar'])) {?>
                <img src="<?php echo $value['avatar']; ?>" class="avatar">
              <?php } ?>
              <?php if(isset($value['firstname']) || isset($value['lastname'])) {?>
              <?php echo a($value, 'firstname'); ?> <b><?php echo a($value, 'lastname'); ?></b>
            <?php }elseif(isset($value['displayname'])) { ?>
               <b><?php echo a($value, 'displayname'); ?></b>
            <?php }else{ ?>
              <small><?php echo T_("Without name"); ?></small>
            <?php } // endif ?>
            </a>
          <?php }else{ ?>

            <a href="<?php echo \dash\url::this(); ?>?customer=-quick">
              <small class="disabled"><?php echo T_("Without customer"); ?></small>
            </a>

          <?php } //endif ?>

          </td>
          <td class="s0"><a href="<?php echo \dash\url::this(); ?>?itemequal=<?php echo a($value, 'item'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(a($value, 'item')); ?></a></td>
          <td class="s0"><a href="<?php echo \dash\url::this(); ?>?qtyequal=<?php echo a($value, 'qty'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(a($value, 'qty')); ?></a></td>
          <td class="s0"><a href="<?php echo \dash\url::this(); ?>?subpriceequal=<?php echo a($value, 'subprice'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(a($value, 'subprice')); ?></a></td>
          <td class="s0"><a href="<?php echo \dash\url::this(); ?>?subdiscountequal=<?php echo a($value, 'subdiscount'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(a($value, 'subdiscount')); ?></a></td>

          <?php if(!\dash\data::hideSubvat()) {?>
            <td class="s0"><a href="<?php echo \dash\url::this(); ?>?subpriceequal=<?php echo a($value, 'subvat'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(a($value, 'subvat')); ?></a></td>
          <?php } //endif ?>

          <?php if(!\dash\data::hideShipping()) {?>
            <td class="s0"><a href="<?php echo \dash\url::this(); ?>?shipping=<?php echo a($value, 'shipping'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(a($value, 'shipping')); ?></a></td>
          <?php } //endif ?>
          <td ><a href="<?php echo \dash\url::this(); ?>?total=<?php echo a($value, 'total'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(a($value, 'total')); ?></a></td>
          <td class="collapsing">
            <div class="f">
              <div class="c s0 fs09"><?php echo \dash\fit::date_time(a($value, 'date')); ?></div>
              <div class="cauto os txtB pRa10"><?php echo \dash\fit::date_human(a($value, 'date')); ?></div>

          </td>
          <td><?php echo a($value, 't_paystatus') ?></td>
          <?php if(!\dash\request::get('type')) {?>

          <td class="s0" ><a class="badge" href="<?php echo \dash\url::this(); ?>?type=<?php echo a($value, 'type'); ?>"><?php echo T_(ucfirst(a($value, 'type'))); ?></a></td>
          <?php } //endif ?>
          <td>
            <a href="<?php echo \dash\url::this(); ?>/detail?id=<?php echo a($value, 'id'); ?>" class="btn link"><?php echo T_("View"); ?></a>
          </td>
        </tr>
        <tr>
          <td colspan="<?php if(!\dash\request::get('type')) {echo 11;}else{echo 10;}?>" class="pTB0-f txtLa">

            <?php

            $productInFactor = [];
            if(isset($value['productInFactor']) && $value['productInFactor'] && is_array($value['productInFactor']))
            {
              $productInFactor = $value['productInFactor'];
            }

            $needMore    = false;
            $openKerkere = false;
            $counterI    = 0;

            ?>
            <?php foreach ($productInFactor as $myKey => $myValue) {?>
              <?php $counterI++; ?>
              <?php if($counterI == 7) {?>
                <?php $needMore = true; ?>
                <a data-kerkere='.openDetailFactor_<?php echo a($value, 'id'); ?>' class="badge primary outline"><?php echo T_("More"); ?> ... <span class="mLR5">+<?php echo \dash\fit::number(intval($value['item']) - 6); ?></span></a>
              <?php } //endif ?>
              <?php if($needMore) {?>
                <?php $openKerkere = true;  ?>
                <?php $needMore = false;  ?>
                <div class="openDetailFactor_<?php echo a($value, 'id'); ?>" data-kerkere-content='hide'>
              <?php } //endif ?>
                <a class="badge <?php if(\dash\request::get('product') == $myValue['id'])  {echo 'primary';}else{ echo 'secondary outline';}?> " href="<?php echo \dash\url::this(); ?>?product=<?php echo a($myValue, 'id'); ?>"><?php echo a($myValue, 'title'); ?> <span class="mLR5"><?php echo \dash\fit::number(a($myValue, 'count')); ?></span></a>
            <?php } //endfor ?>
              <?php if($openKerkere) {?>
                </div>
              <?php }//endif ?>
          </td>
        </tr>
      <?php } //endfor ?>
    </tbody>
  </table>
<?php \dash\utility\pagination::html(); ?>
<?php } // endfunction ?>


<?php function htmlFilter() {?>
<p class="f fs14 msg warn2 mT20">
  <span class="c"><?php echo \dash\data::filterBox(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } // endfunction ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } // endfunction ?>


<?php function htmlStartAddNew() {?>
<p class="fs14 msg success2 pTB20"><?php echo T_("Hi!"); ?>
  <?php if(\dash\permission::check('factorSaleAdd')) {?><a href="<?php echo \dash\url::here(); ?>/sale"><?php echo T_("Try to start with add new sale!"); ?></a><?php } // endif ?>
</p>
<?php } // endfunction ?>

