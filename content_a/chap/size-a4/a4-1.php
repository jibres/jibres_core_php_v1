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
      <div class="c-3 txtL">
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

    <table class="tbl1 v6 txtC">
     <thead>
      <tr class="fs07">
       <th class="collapsing">#</th>
       <th><?php echo T_("Explanation"); ?></th>
       <th class="collapsing"><?php echo T_("Qty"); ?></th>
       <th class="collapsing"><?php echo T_("Unit"); ?></th>
       <th><?php echo T_("Unit price"); ?></th>
       <th><?php echo T_("Total price"); ?></th>
       <th><?php echo T_("Total discount"); ?></th>
       <th><?php echo T_("Total price after discount"); ?></th>
       <th><?php echo T_("Total VAT"); ?></th>
       <th><?php echo T_("Final Price"); ?></th>
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
       <td><?php echo \dash\fit::text(\dash\get::index($datarow, 'count')); ?></td>
       <td><?php echo \dash\get::index($datarow, 'unit'); ?></td>
       <td><?php echo \dash\fit::number(\dash\get::index($datarow, 'price')); ?></td>
       <td><?php echo \dash\fit::number($totalPrice); ?></td>
       <td><?php echo \dash\fit::number($totalDiscount); ?></td>
       <td><?php echo \dash\fit::number($totalPriceAfterDiscount); ?></td>
       <td><?php echo \dash\fit::number($totalVAT); ?></td>
       <td><?php echo \dash\fit::number($FinalPrice); ?></td>
      </tr>
<?php } //endfor ?>
     </tbody>
     <tfoot>
      <tr>
       <td colspan="2" class="txtLa"><?php echo T_("Sum Total"); ?></td>
       <td></td>
       <td></td>
       <td></td>
       <td><?php echo $tableTotal['totalPrice']; ?></td>
       <td><?php echo $tableTotal['totalDiscount']; ?></td>
       <td><?php echo $tableTotal['totalPriceAfterDiscount']; ?></td>
       <td><?php echo $tableTotal['totalVAT']; ?></td>
       <td><?php echo $tableTotal['FinalPrice']; ?></td>
      </tr>
     </tfoot>
    </table>


  </div>

<div class="barcodeBox">
  <svg class="barcodePrev wide" data-val="#barcode" data-height=20 data-hideValue></svg>
</div>




</div>

