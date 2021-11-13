<?php
$storeData = \dash\data::store_store_data();
$factorDetail = \dash\data::factorDetail();
$factor_detail = [];
if(isset($factorDetail['factor_detail']) && is_array($factorDetail['factor_detail']))
{
  $factor_detail = $factorDetail['factor_detail'];
}
?>

<div class="invoice printArea" data-size='receipt8'>



 <div class="storeDetail border-black">
  <div class="flex align-center">
<?php if(isset($storeData['logo']) && $storeData['logo']) {?>
   <div class="w-32 mx-auto mb-1 mRa5">
    <img class="rounded" src="<?php echo \dash\fit::img($storeData['logo'], 120); ?>" alt="<?php echo a($storeData,'title'); ?>" style="filter: grayscale(100%);">
   </div>
<?php } //endif ?>
   <div class="flex-grow">
    <h1 class="leading-7 font-black"><?php echo a($storeData,'title'); ?></h1>
    <h2 class="leading-7 text-2xs"><?php echo a($storeData,'desc'); ?></h2>
   </div>
  </div>


  <address class="not-italic py-1 border-t border-b border-black">
    <div class="address text-2xs leading-7"><?php echo a($storeData,'address'); ?></div>
    <div class="flex text-xs leading-6">
     <div class="w-1/2 website text-left"><?php echo a($storeData,'website'); ?></div>
     <div class="w-1/2 phone text-left"><?php echo \dash\fit::text(a($storeData,'phone')); ?></div>
    </div>
  </address>
 </div>



<?php if(isset($storeData['factorheader']) && $storeData['factorheader']) {?>
<p class="factorHeader text-sm text-center">
<?php echo a($storeData,'factorheader'); ?>
</p>

<?php } //endif ?>





<?php if(isset($factorDetail['address']) && $factorDetail['address']) {?>
<?php $address = $factorDetail['address'] ?>
<div class="customerDetail border-b border-black">
  <div class="text-base bg-black text-white text-center leading-7"><?php echo T_("Customer"); ?></div>
  <div class="font-bold leading-8 text-sm"><?php echo a($factorDetail, 'factor', 'customer_detail', 'displayname'); ?></div>

<?php if(isset($address['address']) && $address['address']) {?>
  <div class="flex align-center">
    <div class="flex-grow">
    <?php if(isset($address['location_string']) && $address['location_string']) {?>
      <div class="leading-6 text-xs"><?php echo $address['location_string']; ?></div>
    <?php } //endif ?>

    <?php if(isset($address['address']) && $address['address']) {?>
      <div class="leading-6 text-sm font-bold"><?php echo $address['address']; ?></div>
    <?php } //endif ?>
    </div>
    <div class="bg-gray-600 text-white p-2 flex rounded">
      <?php echo \dash\utility\icon::bootstrap('geo-alt-fill', 'w-10 h-10') ?>
    </div>
  </div>
<?php } //endif address ?>

<div class="flex align-center">
<?php if(isset($address['phone']) && $address['phone']) {?>
  <div class=""><span class="text-2xs"><?php echo T_("Tel"); ?></span> <span dir="ltr" class="text-xs"><?php echo \dash\fit::text($address['phone']); ?></span></div>
<?php } //endif ?>

<?php if(isset($address['mobile']) && $address['mobile']) {?>
  <div class="txtRa flex-grow"><span class="text-2xs"><?php echo T_("Mobile"); ?></span> <span dir="ltr" class="font-bold"><?php echo \dash\fit::mobile($address['mobile']); ?></span></div>
<?php } //endif ?>
</div>


</div>
<?php } //endif ?>


 <div class="factorDetail text-xs leading-7 my-1">
  <div class="flex">
   <div class="w-1/2 date"><?php echo \dash\fit::date(a($factorDetail, 'factor', 'date'), true); ?></div>
   <div class="w-1/2 time text-left"><?php echo \dash\fit::time(a($factorDetail, 'factor', 'date'), true); ?></div>
  </div>

<?php if(strtotime(a($factorDetail, 'factor', 'date')) < strtotime('-1 day')) {?>
  <div class="flex">
    <div class="flex-grow"><?php echo T_("Date Printed") ?></div>
   <div dir="ltr" class="w-1/2 time text-left"><?php echo \dash\fit::date_time(true); ?></div>
  </div>
<?php } ?>

 </div>


 <table class="table-auto text mb-2 border border-black rounded w-full">
  <thead>
   <tr class="text-xs leading-8 bg-black text-white">
    <th class="border-b border-black"><?php echo T_("Name"); ?></th>
    <th class="border-b border-black"><?php echo T_("Price"); ?><?php if(isset($factorDetail['factor']['subdiscount']) && $factorDetail['factor']['subdiscount'] && false) {?><br><?php echo T_("For you"); ?><?php }//endif ?></th>
    <th class="border-b border-black"><?php echo T_("Qty"); ?></th>
    <th class="border-b border-black"><?php echo T_("Sum"); ?></th>
   </tr>
  </thead>
  <tbody class="text-sm leading-7">
  <?php foreach ($factor_detail as $key => $dataRow) {?>
  <tr class="border-b border-black border-dashed">
   <td class="txtLa productTitle px-0.5 text-xs font-bold leading-6"><?php if(isset($dataRow['vat']) && $dataRow['vat']) {echo ' * ';} echo ' '. a($dataRow, 'title');?></td>
   <td class="txtLa text-center text-sm"><?php
if(isset($dataRow['discount']) && $dataRow['discount'])
{
  echo '<del>'. \dash\fit::number_en(a($dataRow, 'price')). '</del>';
  echo '<br>'. \dash\fit::number_en(a($dataRow, 'finalprice'));
  // echo '<br>'. \dash\fit::number_en($dataRow['discount']);
}
else
{
  echo \dash\fit::number_en(a($dataRow, 'price'));
}
?></td>
   <td class="text-center leading-4 text-sm"><?php echo \dash\fit::number_en(a($dataRow, 'count'), false); ?><small class="block"><?php echo a($dataRow, 'unit'); ?></small></td>
   <td class="txtLa text-center px-1"><?php echo \dash\fit::number_en(a($dataRow, 'sum')); ?></td>
  </tr>
 <?php } //endfor ?>
  </tbody>

 </table>


 <table class="table-auto border border-black factorResult w-full">
  <tbody>
    <?php if((isset($factorDetail['factor']['subdiscount']) && $factorDetail['factor']['subdiscount']) || (isset($factorDetail['factor']['subvat']) && $factorDetail['factor']['subvat'])) {?>

   <tr class="bg-gray-300">
     <th class="txtLa text-xs px-1"><?php echo T_("Invoice amount"); ?></th>
     <td class="txtLa px-1"><?php echo \dash\fit::number_en(a($factorDetail, 'factor', 'subprice')); ?></td>
   </tr>
   <?php if(isset($factorDetail['factor']['subdiscount']) && $factorDetail['factor']['subdiscount']) {?>

   <tr class="bg-gray-300">
     <th class="txtLa text-xs px-1"><?php echo T_("Your total discount and profits"); ?></th>
     <td class="txtLa px-1"><?php echo \dash\fit::number_en(a($factorDetail, 'factor', 'subdiscount')); ?></td>
   </tr>
   <?php } //endif ?>

   <?php if(isset($factorDetail['factor']['subvat']) && $factorDetail['factor']['subvat']) {?>

   <tr class="bg-gray-300">
     <th class="txtLa text-xs px-1">* <?php echo T_("VAT"); ?></th>
     <td class="txtLa px-1"><?php echo \dash\fit::number_en(a($factorDetail, 'factor', 'subvat')); ?></td>
   </tr>
   <?php } //endif ?>
   <?php if(isset($factorDetail['factor']['shipping']) && $factorDetail['factor']['shipping']) {?>
   <tr class="bg-gray-300">
     <th class="txtLa text-xs px-1"><?php echo T_("Shipping"); ?></th>
     <td class="txtLa px-1"><?php echo \dash\fit::number_en(a($factorDetail, 'factor', 'shipping')); ?></td>
   </tr>
   <?php } //endif ?>


  <?php if(isset($factorDetail['factor']['discount2']) && $factorDetail['factor']['discount2']) {?>
   <tr class="bg-gray-300">
     <th class="txtLa text-xs px-1"><?php echo T_("Discount code"); ?></th>
     <td class="txtLa px-1"><?php echo \dash\fit::number_en(a($factorDetail, 'factor', 'discount2')); ?></td>
   </tr>
   <?php } //endif ?>

<?php } //endif ?>
   <tr class="bg-black text-white factorSum">
     <th class="txtLa w-full text-xs px-1"><?php echo T_("Total payable"); ?> <small class="text-sm">( <?php echo \lib\currency::unit(); ?> )</small></th>
     <td class="txtLa px-1 font-bold"><?php echo \dash\fit::number_en(a($factorDetail, 'factor', 'total')); ?></td>
   </tr>
  </tbody>

 </table>


<div class="barcodeBox mb-1">
  <svg class="barcodePrev wide w-full mx-auto" data-val="#barcode" data-height=20 data-hideValue></svg>
   <div class="text-center text-xs"><code class="hidden" id='barcode' data-val='<?php echo a($factorDetail, 'factor', 'id_code'); ?>'><?php echo a($factorDetail, 'factor', 'id_code'); ?></code></div>
</div>

<?php if(isset($storeData['factorfooter']) && $storeData['factorfooter']) {?>

<p class="factorFooter fs14 text-center">
<?php echo a($storeData,'factorfooter'); ?>
</p>
<?php } //endif ?>





</div>

