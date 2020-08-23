<?php
$storeData = \dash\data::store_store_data();
$factorDetail = \dash\data::factorDetail();
$factor_detail = [];
if(isset($factorDetail['factor_detail']) && is_array($factorDetail['factor_detail']))
{
  $factor_detail = $factorDetail['factor_detail'];
}
?>

<div class="printArea" data-size='A4.landscape'>
  <div class="invoice" data-theme="1">
    <header class="row align-center">
      <div class="c-3">
<?php if(isset($storeData['logo']) && $storeData['logo']) {?>
        <div class="logo">
         <img src="<?php echo $storeData['logo']; ?>" alt="<?php echo \dash\get::index($storeData,'title'); ?>">
        </div>
<?php } //endif ?>

      </div>
      <div class="c-6 txtC">
        <h1><?php echo T_("Invoice"); ?></h1>
      </div>
      <div class="c-3 txtRa">
        <div>
          <span class="compact pRa5"><?php echo T_("Serial Number"); ?></span>
          <span class="printEmptyBox"></span>
        </div>
        <div>
          <span class="compact pRa5"><?php echo T_("Date"); ?></span>
          <span class="printEmptyBox"><?php echo \dash\fit::date('now'); ?></span>
        </div>
      </div>
    </header>

<?php require('oneSide-seller.php'); ?>
<?php require('oneSide-buyer.php'); ?>

    <table class="tbl2 v1">
     <thead>
      <tr class="fs07">
       <th class="collapsing">#</th>
       <th><?php echo T_("Explanation"); ?></th>
       <th class="collapsing txtR"><?php echo T_("Qty"); ?></th>
       <th class="collapsing"><?php echo T_("Unit"); ?></th>
       <th class="txtR"><?php echo T_("Unit price"); ?></th>
       <th class="txtR"><?php echo T_("Total price"); ?></th>
       <th class="txtR"><?php echo T_("Total discount"); ?></th>
       <th class="txtR"><?php echo T_("Total price after discount"); ?></th>
       <th class="txtR"><?php echo T_("Total VAT"); ?></th>
       <th class="txtR"><?php echo T_("Final Price"); ?></th>
      </tr>
     </thead>
     <tbody>
<?php $tableTotal =
[
 'totalPrice'              => 0,
 'totalDiscount'           => 0,
 'totalPriceAfterDiscount' => 0,
 'totalVAT'                => 0,
 'FinalPrice'              => 0,
];
?>
<?php foreach ($factor_detail as $key => $datarow) {?>
<?php
$totalPrice = \dash\get::index($datarow, 'price') * \dash\get::index($datarow, 'count');
$totalDiscount = \dash\get::index($datarow, 'discount') * \dash\get::index($datarow, 'count');
$totalPriceAfterDiscount = $totalPrice - $totalDiscount;
$totalVAT = \dash\get::index($datarow, 'vat');
$FinalPrice = \dash\get::index($datarow, 'sum');

$tableTotal['totalPrice'] += $totalPrice;
$tableTotal['totalDiscount'] += $totalDiscount;
$tableTotal['totalPriceAfterDiscount'] += $totalPriceAfterDiscount;
$tableTotal['totalVAT'] += $totalVAT;
$tableTotal['FinalPrice'] += $FinalPrice;
?>
      <tr>
       <td><?php echo \dash\fit::number($key + 1); ?></td>
       <td class="txtLa productTitle"><?php echo \dash\get::index($datarow, 'title');?></td>
       <td class="ltr txtR"><?php echo \dash\fit::price(\dash\get::index($datarow, 'count')); ?></td>
       <td><?php echo \dash\get::index($datarow, 'unit'); ?></td>
       <td class="ltr txtR"><?php echo \dash\fit::price(\dash\get::index($datarow, 'price')); ?></td>
       <td class="ltr txtR"><?php echo \dash\fit::price($totalPrice); ?></td>
       <td class="ltr txtR"><?php echo \dash\fit::price($totalDiscount); ?></td>
       <td class="ltr txtR"><?php echo \dash\fit::price($totalPriceAfterDiscount); ?></td>
       <td class="ltr txtR"><?php echo \dash\fit::price($totalVAT); ?></td>
       <td class="ltr txtR lastCol"><?php echo \dash\fit::price($FinalPrice); ?></td>
      </tr>
<?php } //endfor ?>
     </tbody>
     <tfoot>
      <tr>
       <td colspan="2" class="txtLa"><?php echo T_("Sum Total"); ?></td>
       <td></td>
       <td></td>
       <td></td>
       <td class="ltr txtR"><?php echo \dash\fit::price($tableTotal['totalPrice']); ?></td>
       <td class="ltr txtR"><?php echo \dash\fit::price($tableTotal['totalDiscount']); ?></td>
       <td class="ltr txtR"><?php echo \dash\fit::price($tableTotal['totalPriceAfterDiscount']); ?></td>
       <td class="ltr txtR"><?php echo \dash\fit::price($tableTotal['totalVAT']); ?></td>
       <td class="ltr txtR"><?php echo \dash\fit::price($tableTotal['FinalPrice']); ?></td>
      </tr>
     </tfoot>
    </table>

    <div class="msg priceTxt"></div>


  </div>

<div class="barcodeBox">
  <svg class="barcodePrev wide" data-val="#barcode" data-height=20 data-hideValue></svg>
</div>




</div>

