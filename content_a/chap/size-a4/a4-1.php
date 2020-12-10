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
        <?php $country = \dash\get::index($storeData,'country'); if($country === 'IR') {?>
        <h1><?php echo T_("Sale Invoice"); ?></h1>
        <?php }else{ ?>
        <h1><?php echo T_("Invoice"); ?></h1>
        <?php } //endif ?>
      </div>
      <div class="c-3 txtRa">
        <div>
          <span class="compact pRa5"><?php echo T_("Serial Number"); ?></span>
          <span class="printEmptyBox" id="factorid" data-val="<?php echo \dash\get::index($factorDetail, 'factor', 'id') ?>"><?php echo \dash\fit::text(\dash\get::index($factorDetail, 'factor', 'id')) ?></span>
        </div>
        <div>
          <span class="compact pRa5"><?php echo T_("Date"); ?></span>
          <span class="printEmptyBox"><?php echo \dash\fit::date(\dash\get::index($factorDetail, 'factor', 'date')); ?></span>
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
<?php foreach ($factor_detail as $key => $dataRow) {?>
<?php
$totalPrice = \dash\get::index($dataRow, 'price') * \dash\get::index($dataRow, 'count');
$totalDiscount = \dash\get::index($dataRow, 'discount') * \dash\get::index($dataRow, 'count');
$totalPriceAfterDiscount = $totalPrice - $totalDiscount;
$totalVAT = \dash\get::index($dataRow, 'vat');
$FinalPrice = \dash\get::index($dataRow, 'sum');

$tableTotal['totalPrice'] += $totalPrice;
$tableTotal['totalDiscount'] += $totalDiscount;
$tableTotal['totalPriceAfterDiscount'] += $totalPriceAfterDiscount;
$tableTotal['totalVAT'] += $totalVAT;
$tableTotal['FinalPrice'] += $FinalPrice;
?>
      <tr>
       <td><?php echo \dash\fit::number($key + 1); ?></td>
       <td class="txtLa productTitle"><?php echo \dash\get::index($dataRow, 'title');?></td>
       <td class="valPrice"><?php echo \dash\fit::price(\dash\get::index($dataRow, 'count')); ?></td>
       <td><?php echo \dash\get::index($dataRow, 'unit'); ?></td>
       <td class="valPrice"><?php echo \dash\fit::price(\dash\get::index($dataRow, 'price')); ?></td>
       <td class="valPrice"><?php echo \dash\fit::price($totalPrice); ?></td>
       <td class="valPrice"><?php echo \dash\fit::price($totalDiscount); ?></td>
       <td class="valPrice"><?php echo \dash\fit::price($totalPriceAfterDiscount); ?></td>
       <td class="valPrice"><?php echo \dash\fit::price($totalVAT); ?></td>
       <td class="valPrice lastCol"><small class="font-10 floatL"><?php echo \lib\store::currency(); ?></small><?php echo \dash\fit::price($FinalPrice); ?></td>
      </tr>
<?php } //endfor ?>
     </tbody>
     <tfoot>
      <tr>
       <td colspan="2" class="txtLa"><?php echo T_("Sum Total"); ?></td>
       <td></td>
       <td></td>
       <td></td>
       <td class="valPrice"><?php echo \dash\fit::price($tableTotal['totalPrice']); ?></td>
       <td class="valPrice"><?php echo \dash\fit::price($tableTotal['totalDiscount']); ?></td>
       <td class="valPrice"><?php echo \dash\fit::price($tableTotal['totalPriceAfterDiscount']); ?></td>
       <td class="valPrice"><?php echo \dash\fit::price($tableTotal['totalVAT']); ?></td>
       <td class="valPrice"><small class="font-10 floatL"><?php echo \lib\store::currency(); ?></small><?php echo \dash\fit::price($tableTotal['FinalPrice']); ?></td>
      </tr>
     </tfoot>
    </table>

    <div class="msg priceTxt"></div>


  </div>

<?php if(\dash\get::index($factorDetail, 'factor', 'desc')) {?>
<p class="msg font-14"><?php echo nl2br(\dash\get::index($factorDetail, 'factor', 'desc')) ?></p>
<?php } //endif ?>
<div class="txtC">
  <div class="barcodeBox">
    <svg class="barcodePrev wide" data-val="#factorid" data-height=20 data-hideValue></svg>
  </div>
</div>




</div>

