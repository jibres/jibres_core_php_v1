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
   <div class="w-28 mx-auto mb-1 mRa5">
    <img class="rounded-lg" src="<?php echo \dash\url::icon(); /*$storeData['logo'];*/ ?>" alt="<?php echo a($storeData,'title'); ?>" style="filter: grayscale(100%);">
   </div>
<?php } //endif ?>
   <div class="flex-grow">
    <h1 class="leading-7 font-black"><?php echo a($storeData,'title'); ?></h1>
    <h2 class="leading-7 text-2xs"><?php echo a($storeData,'desc'); ?></h2>
   </div>
  </div>


  <address class="not-italic text-xs leading-7 py-1 border-t border-b border-black">
    <div class="address"><?php echo a($storeData,'address'); ?></div>
    <div class="flex">
     <div class="w-1/2 website text-left"><?php echo a($storeData,'website'); ?></div>
     <div class="w-1/2 phone text-left font-bold"><?php echo \dash\fit::text(a($storeData,'phone')); ?></div>
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
<div class="customerDetail text-sm text-center">
  <div class="fs14"><?php echo T_("Customer Detail"); ?></div>

  <div class="pA10"><span class="txtB"><?php echo a($factorDetail, 'factor', 'customer_detail', 'displayname'); ?></span></div>


<?php if(isset($address['address']) && $address['address']) {?>
  <div class="pA10">
    <?php echo T_("Address"); ?>
  <?php if(isset($address['location_string']) && $address['location_string']) {?>
    <span class="txtB"><?php echo $address['location_string']; ?></span>
  <?php } //endif ?>

  <?php if(isset($address['address']) && $address['address']) {?>
    <span class="txtB"><?php echo $address['address']; ?></span>
  <?php } //endif ?>


  </div>
<?php } //endif address ?>

<?php if(isset($address['phone']) && $address['phone']) {?>
  <div class="pA10"><?php echo T_("Tel"); ?> <span class="txtB ltr compact"><?php echo \dash\fit::text($address['phone']); ?></span></div>
<?php } //endif ?>

<?php if(isset($address['mobile']) && $address['mobile']) {?>
  <div class="pA10"><?php echo T_("Mobile"); ?> <span class="txtB ltr compact"><?php echo \dash\fit::mobile($address['mobile']); ?></span></div>
<?php } //endif ?>


</div>
<?php } //endif ?>


 <div class="factorDetail text-sm leading-7 my-1 flex">
   <div class="w-1/2 date"><?php echo \dash\fit::date(a($factorDetail, 'factor', 'date'), true); ?></div>
   <div class="w-1/2 time text-left"><?php echo \dash\fit::time(a($factorDetail, 'factor', 'date'), true); ?></div>
 </div>


 <table class="tbl1 v1 text-sm mb-2">
  <thead>
   <tr class="text-xs">
    <th><?php echo T_("Name"); ?></th>
    <th><?php echo T_("Qty"); ?></th>
    <th><?php echo T_("Price"); ?><?php if(isset($factorDetail['factor']['subdiscount']) && $factorDetail['factor']['subdiscount']) {?><br><?php echo T_("For you"); ?><?php }//endif ?></th>
    <th><?php echo T_("Sum"); ?></th>
   </tr>
  </thead>
  <tbody class="text-sm">
  <?php foreach ($factor_detail as $key => $dataRow) {?>


  <tr>
   <td class="txtLa productTitle"><?php if(isset($dataRow['vat']) && $dataRow['vat']) {echo ' * ';} echo ' '. a($dataRow, 'title');?></td>
   <td><?php echo \dash\fit::text(a($dataRow, 'count')); ?> <small><?php echo a($dataRow, 'unit'); ?></small></td>
   <td><?php
if(isset($dataRow['discount']) && $dataRow['discount'])
{
  echo '<del>'. \dash\fit::number(a($dataRow, 'price')). '</del>';
  echo '<br>'. \dash\fit::number(a($dataRow, 'finalprice'));
  // echo '<br>'. \dash\fit::number($dataRow['discount']);
}
else
{
  echo \dash\fit::number(a($dataRow, 'price'));
}
?></td>
   <td><?php echo \dash\fit::number(a($dataRow, 'sum')); ?></td>
  </tr>
 <?php } //endfor ?>
  </tbody>



 </table>




 <table class="tbl fs14 factorResult mb-2 w-full">
  <tbody>
    <?php if((isset($factorDetail['factor']['subdiscount']) && $factorDetail['factor']['subdiscount']) || (isset($factorDetail['factor']['subvat']) && $factorDetail['factor']['subvat'])) {?>

   <tr>
     <th class="txtRa fs08"><?php echo T_("Invoice amount"); ?></th>
     <td class="collapsing txtLa"><?php echo \dash\fit::number(a($factorDetail, 'factor', 'subprice')); ?></td>
   </tr>
   <?php if(isset($factorDetail['factor']['subdiscount']) && $factorDetail['factor']['subdiscount']) {?>

   <tr>
     <th class="txtRa fs08"><?php echo T_("Your total discount and profits"); ?></th>
     <td class="collapsing txtLa"><?php echo \dash\fit::number(a($factorDetail, 'factor', 'subdiscount')); ?></td>
   </tr>
   <?php } //endif ?>

   <?php if(isset($factorDetail['factor']['subvat']) && $factorDetail['factor']['subvat']) {?>

   <tr>
     <th class="txtRa fs08">* <?php echo T_("VAT"); ?></th>
     <td class="collapsing txtLa"><?php echo \dash\fit::number(a($factorDetail, 'factor', 'subvat')); ?></td>
   </tr>
   <?php } //endif ?>
   <?php if(isset($factorDetail['factor']['shipping']) && $factorDetail['factor']['shipping']) {?>
   <tr>
     <th class="txtRa fs08"><?php echo T_("Shipping"); ?></th>
     <td class="collapsing txtLa"><?php echo \dash\fit::number(a($factorDetail, 'factor', 'shipping')); ?></td>
   </tr>
   <?php } //endif ?>


  <?php if(isset($factorDetail['factor']['discount2']) && $factorDetail['factor']['discount2']) {?>
   <tr>
     <th class="txtRa fs08"><?php echo T_("Discount code"); ?></th>
     <td class="collapsing txtLa"><?php echo \dash\fit::number(a($factorDetail, 'factor', 'discount2')); ?></td>
   </tr>
   <?php } //endif ?>

<?php } //endif ?>
   <tr class="bg-blue-100 rounded-lg p-2 block factorSum">
     <th class="txtRa fs08"><?php echo T_("Total payable"); ?></th>
     <td class="collapsing txtLa"><?php echo \dash\fit::number(a($factorDetail, 'factor', 'total')); ?> <small class="fs05"><?php echo \lib\currency::unit(); ?></small></td>
   </tr>
  </tbody>

 </table>


<div class="barcodeBox">
  <svg class="barcodePrev wide w-48 mx-auto" data-val="#barcode" data-height=20 data-hideValue></svg>
   <div class="text-center text-xs"><?php echo T_("Factor"); ?> <code class="hidden" id='barcode' data-val='<?php echo a($factorDetail, 'factor', 'id_code'); ?>'><?php echo a($factorDetail, 'factor', 'id_code'); ?></code></div>
</div>

<?php if(isset($storeData['factorfooter']) && $storeData['factorfooter']) {?>

<hr>
<p class="factorFooter fs14 text-center">
<?php echo a($storeData,'factorfooter'); ?>
</p>
<?php } //endif ?>





</div>

