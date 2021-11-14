
<div class="printArea" data-size='<?php echo \dash\data::paperSize(); ?>'>
  <div class="invoice<?php if(\dash\data::paperSize() === 'A5') {echo ' text-xs';}?>" data-theme="1">
    <header class="flex align-center">
      <div class="w-3/12">
<?php if(\dash\data::storeData_logo()) {?>
        <div class="logo">
         <img class="h-16 max-w-xs" src="<?php echo \dash\fit::img(\dash\data::storeData_logo(), 120); ?>" alt="<?php echo \dash\data::storeData_title(); ?>">
        </div>
<?php } //endif ?>

      </div>
      <div class="w-6/12 txtC">
        <?php if(\dash\data::storeData_country() === 'IR') {?>
        <h1 class="text-xl1 text-blue-800 font-black"><?php echo T_("Sale Invoice"); ?></h1>
        <?php }else{ ?>
        <h1 class="text-xl1 text-blue-800 font-black"><?php echo T_("Invoice"); ?></h1>
        <?php } //endif ?>
      </div>
      <div class="w-3/12 txtRa">
        <div class="flex align-center">
          <span class="flex-none pRa5 text-2xs w-16"><?php echo T_("Serial Number"); ?></span>
          <span class="flex-grow border border-gray-400 text-red-500 text-center text-lg leading-6 mb-1 printEmptyBox rounded tracking-widest" id="factorid" data-val="<?php echo \dash\data::invoice_id() ?>"><?php echo \dash\fit::text(\dash\data::invoice_id()) ?></span>
        </div>
        <div class="flex align-center">
          <span class="flex-none pRa5 text-2xs w-16"><?php echo T_("Date"); ?></span>
          <span class="flex-grow border border-gray-400 text-red-500 text-center text-lg leading-6 mb-1 printEmptyBox rounded tracking-widest"><?php echo \dash\fit::date(\dash\data::invoice_date()); ?></span>
        </div>
      </div>
    </header>

<?php require('oneSide-seller.php'); ?>
<?php require('oneSide-buyer.php'); ?>

    <table class="w-full table-auto border border-gray-400 rounded mb-1">
     <thead>
      <tr class="bg-blue-100 text-xs leading-10 text-right border-b-2 border-blue-500">
       <th></th>
       <th><?php echo T_("Explanation"); ?></th>
       <th><?php echo T_("Unit price"); ?></th>
       <th><?php echo T_("Qty"); ?></th>
       <th><?php echo T_("Unit"); ?></th>
<?php if(\dash\data::invoice_subdiscount()) {?>
       <th><?php echo T_("Total price"); ?></th>
       <th><?php echo T_("Total discount"); ?></th>
<?php }?>
<?php if(\dash\data::invoice_subvat()) { ?>
       <th><?php echo T_("Total price after discount"); ?></th>
       <th><?php echo T_("Total VAT"); ?></th>
<?php }?>
       <th><?php echo T_("Final Price"); ?> <small class="text-xs px-1">( <?php echo \lib\store::currency(); ?> )</small></th>
      </tr>
     </thead>
     <tbody>
<?php
$tableTotal =
[
 'totalPrice'              => 0,
 'totalDiscount'           => 0,
 'totalPriceAfterDiscount' => 0,
 'totalVAT'                => 0,
 'FinalPrice'              => 0,
];
if(is_array(\dash\data::invoiceDetail()))
{
  foreach (\dash\data::invoiceDetail() as $key => $dataRow)
  {
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
      <tr class="text-sm leading-7 border-b">
       <td class="px-2"><?php echo \dash\fit::number($key + 1); ?></td>
       <td class="productTitle"><?php echo a($dataRow, 'title');?></td>
       <td class="valPrice"><?php echo \dash\fit::price(a($dataRow, 'price')); ?></td>
       <td class="valPrice"><?php echo \dash\fit::price(a($dataRow, 'count')); ?></td>
       <td class="text-xs"><?php echo a($dataRow, 'unit'); ?></td>
<?php if(\dash\data::invoice_subdiscount()) {?>
       <td class="valPrice"><?php echo \dash\fit::price($totalPrice); ?></td>
       <td class="valPrice"><?php echo \dash\fit::price($totalDiscount); ?></td>
<?php }?>
<?php if(\dash\data::invoice_subvat()) { ?>
       <td class="valPrice"><?php echo \dash\fit::price($totalPriceAfterDiscount); ?></td>
       <td class="valPrice"><?php echo \dash\fit::price($totalVAT); ?></td>
<?php }?>
       <td class="valPrice lastCol"><?php echo \dash\fit::price($FinalPrice); ?></td>
      </tr>
<?php } //endfor ?>
<?php } //endif ?>
     </tbody>
     <tfoot>
      <tr class="bg-blue-200 text-sm leading-10 border-t-2 border-blue-500">
       <td colspan="2" class="px-2"><?php echo T_("Sum Total"); ?></td>
       <td></td>
       <td></td>
       <td></td>
<?php if(\dash\data::invoice_subdiscount()) {?>
       <td class="valPrice"><?php echo \dash\fit::price($tableTotal['totalPrice']); ?></td>
       <td class="valPrice"><?php echo \dash\fit::price($tableTotal['totalDiscount']); ?></td>
<?php }?>
<?php if(\dash\data::invoice_subvat()) { ?>
       <td class="valPrice"><?php echo \dash\fit::price($tableTotal['totalPriceAfterDiscount']); ?></td>
       <td class="valPrice"><?php echo \dash\fit::price($tableTotal['totalVAT']); ?></td>
<?php }?>
       <td class="valPrice font-bold"><?php echo \dash\fit::price($tableTotal['FinalPrice']); ?><small class="text-xs px-1"><?php echo \lib\store::currency(); ?></small></td>
      </tr>


     </tfoot>
    </table>
    <div class="msg priceTxt"></div>
  </div>

<div class="f">
  <div class="c">
    <?php if(\dash\data::invoice_desc()) {?>
      <p class="text-sm bg-gray-50 p-2 mb-1 mt-2 leading-7 text-gray-800"><?php echo nl2br(\dash\data::invoice_desc()) ?></p>
    <?php } //endif ?>
  </div>
  <?php if(floatval(\dash\data::invoice_total()) !== floatval($tableTotal['FinalPrice'])) {?>
  <div class="c3">

    <div class="tblBox">
      <table class="tbl1 v4">
        <tbody>
        <?php if(\dash\data::invoice_subprice()) {?>
          </tr>
            <td><?php echo T_("Total") ?></td>
            <td><small class="text-xs floatL"><?php echo \lib\store::currency(); ?></small> <?php echo \dash\fit::price(\dash\data::invoice_subprice()) ?></td>
          <tr>
        <?php } //endif ?>
        <?php if(\dash\data::invoice_shipping()) {?>
          </tr>
            <td><?php echo T_("Shipping") ?></td>
            <td><small class="text-xs floatL"><?php echo \lib\store::currency(); ?></small> <?php echo \dash\fit::price(\dash\data::invoice_shipping()) ?></td>
          <tr>
        <?php } //endif ?>

        <?php if(\dash\data::invoice_discount2()) {?>
          </tr>
            <td><?php echo T_("Discount code") ?></td>
            <td><small class="text-xs floatL"><?php echo \lib\store::currency(); ?></small> <?php echo \dash\fit::price(\dash\data::invoice_discount2()) ?></td>
          <tr>
        <?php } //endif ?>

        <?php if(\dash\data::invoice_total()) {?>
          </tr>
            <td><?php echo T_("Total payable") ?></td>
            <td><small class="text-xs floatL"><?php echo \lib\store::currency(); ?></small> <?php echo \dash\fit::price(\dash\data::invoice_total()) ?></td>
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
    <svg class="barcodePrev wide mx-auto w-60" data-val="#factorid" data-height=30 data-hideValue></svg>
  </div>
</div>


</div>

<!-- force portrait for receipt print-->
<?php if(\dash\request::get('model') === 'landscape') {?>
<style type="text/css">@page {size: landscape;}</style>
<?php } else {?>
<style type="text/css">@page {size: portrait;}</style>
<?php }?>
