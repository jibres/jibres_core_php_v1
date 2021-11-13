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
    <header class="flex align-center">
      <div class="w-3/12">
<?php if(isset($storeData['logo']) && $storeData['logo']) {?>
        <div class="logo">
         <img class="h-16 max-w-xs" src="<?php echo \dash\fit::img($storeData['logo'], 120); ?>" alt="<?php echo a($storeData,'title'); ?>">
        </div>
<?php } //endif ?>

      </div>
      <div class="w-6/12 txtC">
        <?php $country = a($storeData,'country'); if($country === 'IR') {?>
        <h1 class="text-xl text-blue-800 font-black"><?php echo T_("Sale Invoice"); ?></h1>
        <?php }else{ ?>
        <h1 class="text-xl text-blue-800 font-black"><?php echo T_("Invoice"); ?></h1>
        <?php } //endif ?>
      </div>
      <div class="w-3/12 txtRa">
        <div class="flex align-center">
          <span class="compact pRa5 text-2xs w-20"><?php echo T_("Serial Number"); ?></span>
          <span class="flex-grow border border-gray-500 text-red-500 text-center text-lg leading-6 mb-1 printEmptyBox rounded tracking-widest" id="factorid" data-val="<?php echo a($factorDetail, 'factor', 'id') ?>"><?php echo \dash\fit::text(a($factorDetail, 'factor', 'id')) ?></span>
        </div>
        <div class="flex align-center">
          <span class="compact pRa5 text-2xs w-20"><?php echo T_("Date"); ?></span>
          <span class="flex-grow border border-gray-500 text-red-500 text-center text-lg leading-6 mb-1 printEmptyBox rounded tracking-widest"><?php echo \dash\fit::date(a($factorDetail, 'factor', 'date')); ?></span>
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
       <th class="collapsing text-right"><?php echo T_("Qty"); ?></th>
       <th class="collapsing"><?php echo T_("Unit"); ?></th>
       <th class="text-right"><?php echo T_("Unit price"); ?></th>
       <th class="text-right"><?php echo T_("Total price"); ?></th>
       <th class="text-right"><?php echo T_("Total discount"); ?></th>
       <th class="text-right"><?php echo T_("Total price after discount"); ?></th>
       <th class="text-right"><?php echo T_("Total VAT"); ?></th>
       <th class="text-right"><?php echo T_("Final Price"); ?> <small class="text-xs px-1"><?php echo \lib\store::currency(); ?></small></th>
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
$totalPrice = a($dataRow, 'price') * a($dataRow, 'count');
$totalDiscount = a($dataRow, 'discount') * a($dataRow, 'count');
$totalPriceAfterDiscount = $totalPrice - $totalDiscount;
$totalVAT = a($dataRow, 'vat');
$FinalPrice = a($dataRow, 'sum');

$tableTotal['totalPrice'] += $totalPrice;
$tableTotal['totalDiscount'] += $totalDiscount;
$tableTotal['totalPriceAfterDiscount'] += $totalPriceAfterDiscount;
$tableTotal['totalVAT'] += $totalVAT;
$tableTotal['FinalPrice'] += $FinalPrice;
?>
      <tr>
       <td><?php echo \dash\fit::number($key + 1); ?></td>
       <td class="txtLa productTitle"><?php echo a($dataRow, 'title');?></td>
       <td class="valPrice"><?php echo \dash\fit::price(a($dataRow, 'count')); ?></td>
       <td><?php echo a($dataRow, 'unit'); ?></td>
       <td class="valPrice"><?php echo \dash\fit::price(a($dataRow, 'price')); ?></td>
       <td class="valPrice"><?php echo \dash\fit::price($totalPrice); ?></td>
       <td class="valPrice"><?php echo \dash\fit::price($totalDiscount); ?></td>
       <td class="valPrice"><?php echo \dash\fit::price($totalPriceAfterDiscount); ?></td>
       <td class="valPrice"><?php echo \dash\fit::price($totalVAT); ?></td>
       <td class="valPrice lastCol"><?php echo \dash\fit::price($FinalPrice); ?></td>
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
       <td class="valPrice"><?php echo \dash\fit::price($tableTotal['FinalPrice']); ?><small class="text-xs px-1"><?php echo \lib\store::currency(); ?></small></td>
      </tr>


     </tfoot>
    </table>
    <div class="msg priceTxt"></div>
  </div>

<div class="f">
  <div class="c">
    <?php if(a($factorDetail, 'factor', 'desc')) {?>
      <p class="msg font-14"><?php echo nl2br(a($factorDetail, 'factor', 'desc')) ?></p>
    <?php } //endif ?>
  </div>
  <?php if(floatval(a($factorDetail, 'factor', 'total')) !== floatval($tableTotal['FinalPrice'])) {?>
  <div class="c3">

    <div class="tblBox">
      <table class="tbl1 v4">
        <tbody>
        <?php if(a($factorDetail, 'factor', 'subprice')) {?>
          </tr>
            <td><?php echo T_("Total") ?></td>
            <td><small class="text-xs floatL"><?php echo \lib\store::currency(); ?></small> <?php echo \dash\fit::price(a($factorDetail, 'factor', 'subprice')) ?></td>
          <tr>
        <?php } //endif ?>
        <?php if(a($factorDetail, 'factor', 'shipping')) {?>
          </tr>
            <td><?php echo T_("Shipping") ?></td>
            <td><small class="text-xs floatL"><?php echo \lib\store::currency(); ?></small> <?php echo \dash\fit::price(a($factorDetail, 'factor', 'shipping')) ?></td>
          <tr>
        <?php } //endif ?>

        <?php if(a($factorDetail, 'factor', 'discount2')) {?>
          </tr>
            <td><?php echo T_("Discount code") ?></td>
            <td><small class="text-xs floatL"><?php echo \lib\store::currency(); ?></small> <?php echo \dash\fit::price(a($factorDetail, 'factor', 'discount2')) ?></td>
          <tr>
        <?php } //endif ?>

        <?php if(a($factorDetail, 'factor', 'total')) {?>
          </tr>
            <td><?php echo T_("Total payable") ?></td>
            <td><small class="text-xs floatL"><?php echo \lib\store::currency(); ?></small> <?php echo \dash\fit::price(a($factorDetail, 'factor', 'total')) ?></td>
          <tr>
        <?php } //endif ?>
        </tbody>
      </table>
    </div>

  </div>
<?php } //endif ?>
</div>


<div class="txtC">
  <div class="barcodeBox">
    <svg class="barcodePrev wide mx-auto" data-val="#factorid" data-height=20 data-hideValue></svg>
  </div>
</div>




</div>

