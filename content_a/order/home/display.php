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
        <th class="s0" data-sort="<?php echo \dash\get::index($sortLink, 'customer', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'customer', 'link'); ?>"><?php echo T_("Customer"); ?></a></th>
        <th class="s0" data-sort="<?php echo \dash\get::index($sortLink, 'item', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'item', 'link'); ?>"><?php echo T_("Items"); ?></a></th>
        <th class="s0" data-sort="<?php echo \dash\get::index($sortLink, 'qty', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'qty', 'link'); ?>"><?php echo T_("Qty"); ?></a></th>
        <th class="s0" data-sort="<?php echo \dash\get::index($sortLink, 'subprice', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'subprice', 'link'); ?>"><?php echo T_("Price"); ?></a></th>
        <th class="s0" data-sort="<?php echo \dash\get::index($sortLink, 'subdiscount', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'subdiscount', 'link'); ?>"><?php echo T_("Discount"); ?></a></th>

        <?php if(!\dash\data::hideSubvat()) {?>
          <th class="s0" data-sort="<?php echo \dash\get::index($sortLink, 'subvat', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'subvat', 'link'); ?>"><?php echo T_("VAT"); ?></a></th>
        <?php } //endif ?>

        <?php if(!\dash\data::hideShipping()) {?>
          <th class="s0" data-sort="<?php echo \dash\get::index($sortLink, 'shipping', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'shipping', 'link'); ?>"><?php echo T_("Shipping"); ?></a></th>
        <?php } //endif ?>

        <th data-sort="<?php echo \dash\get::index($sortLink, 'subtotal', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'subtotal', 'link'); ?>"><?php echo T_("Total"); ?></a></th>
        <th data-sort="<?php echo \dash\get::index($sortLink, 'date', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'date', 'link'); ?>"><?php echo T_("Invoice Date"); ?></a></th>

        <?php if(!\dash\request::get('type')) {?>
          <th class="s0" data-sort="<?php echo \dash\get::index($sortLink, 'type', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'type', 'link'); ?>"><?php echo T_("Type"); ?></a></th>
        <?php } //endif ?>

        <th><?php echo T_("Operation"); ?></th>
      </tr>

    </thead>
    <tbody>
      <?php foreach ($dataTable as $key => $value) {?>
        <tr>
          <td class="s0">
            <?php if(isset($value['customer'])) {?>
            <a href="<?php echo \dash\url::this(); ?>?customer=<?php echo \dash\get::index($value, 'customer'); ?>">
              <?php if(isset($value['avatar'])) {?>
                <img src="<?php echo $value['avatar']; ?>" class="avatar">
              <?php } ?>
              <?php if(isset($value['firstname']) || isset($value['lastname'])) {?>
              <?php echo \dash\get::index($value, 'firstname'); ?> <b><?php echo \dash\get::index($value, 'lastname'); ?></b>
            <?php }elseif(isset($value['displayname'])) { ?>
               <b><?php echo \dash\get::index($value, 'displayname'); ?></b>
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
          <td class="s0"><a href="<?php echo \dash\url::this(); ?>?itemequal=<?php echo \dash\get::index($value, 'item'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'item')); ?></a></td>
          <td class="s0"><a href="<?php echo \dash\url::this(); ?>?qtyequal=<?php echo \dash\get::index($value, 'qty'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'qty')); ?></a></td>
          <td class="s0"><a href="<?php echo \dash\url::this(); ?>?subpriceequal=<?php echo \dash\get::index($value, 'subprice'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'subprice')); ?></a></td>
          <td class="s0"><a href="<?php echo \dash\url::this(); ?>?subdiscountequal=<?php echo \dash\get::index($value, 'subdiscount'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'subdiscount')); ?></a></td>

          <?php if(!\dash\data::hideSubvat()) {?>
            <td class="s0"><a href="<?php echo \dash\url::this(); ?>?subpriceequal=<?php echo \dash\get::index($value, 'subvat'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'subvat')); ?></a></td>
          <?php } //endif ?>

          <?php if(!\dash\data::hideShipping()) {?>
            <td class="s0"><a href="<?php echo \dash\url::this(); ?>?shipping=<?php echo \dash\get::index($value, 'shipping'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'shipping')); ?></a></td>
          <?php } //endif ?>
          <td ><a href="<?php echo \dash\url::this(); ?>?total=<?php echo \dash\get::index($value, 'total'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'total')); ?></a></td>
          <td class="collapsing">
            <div class="f">
              <div class="c fs09"><?php echo \dash\fit::date_time(\dash\get::index($value, 'date')); ?>
              <div class="cauto os txtB pRa10"><?php echo \dash\fit::date_human(\dash\get::index($value, 'date')); ?></div>
            </div>
          </td>
          <?php if(!\dash\request::get('type')) {?>

          <td class="s0" ><a class="badge" href="<?php echo \dash\url::this(); ?>?type=<?php echo \dash\get::index($value, 'type'); ?>"><?php echo T_(ucfirst(\dash\get::index($value, 'type'))); ?></a></td>
          <?php } //endif ?>
          <td>
            <a href="<?php echo \dash\url::this(); ?>/detail?id=<?php echo \dash\get::index($value, 'id'); ?>" class="btn primary outline sm"><?php echo T_("View"); ?></a>
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
                <a data-kerkere='.openDetailFactor_<?php echo \dash\get::index($value, 'id'); ?>' class="badge primary outline"><?php echo T_("More"); ?> ... <span class="mLR5">+<?php echo \dash\fit::number(intval($value['item']) - 6); ?></span></a>
              <?php } //endif ?>
              <?php if($needMore) {?>
                <?php $openKerkere = true;  ?>
                <?php $needMore = false;  ?>
                <div class="openDetailFactor_<?php echo \dash\get::index($value, 'id'); ?>" data-kerkere-content='hide'>
              <?php } //endif ?>
                <a class="badge <?php if(\dash\request::get('product') == $myValue['id'])  {echo 'primary';}else{ echo 'secondary outline';}?> " href="<?php echo \dash\url::this(); ?>?product=<?php echo \dash\get::index($myValue, 'id'); ?>"><?php echo \dash\get::index($myValue, 'title'); ?> <span class="mLR5"><?php echo \dash\fit::number(\dash\get::index($myValue, 'count')); ?></span></a>
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
  <?php if(\dash\permission::check('factorBuyAdd')) {?><a href="<?php echo \dash\url::here(); ?>/buy"><?php echo T_("Try to start with add new buy!"); ?></a><?php } // endif ?>
</p>
<?php } // endfunction ?>

