
<div class="invoice printArea" data-size='receipt8'>

 <div class="storeDetail border-black">
  <div class="flex align-center">
<?php if(\dash\data::storeData_logo()) {?>
   <div class="w-32 mx-auto mb-1 mRa5">
    <img class="rounded" src="<?php echo \dash\fit::img(\dash\data::storeData_logo(), 120); ?>" alt="<?php echo \dash\data::storeData_title(); ?>" style="filter: grayscale(100%);">
   </div>
<?php } //endif ?>
   <div class="flex-grow">
    <h1 class="leading-relaxed text-lg font-black"><?php echo \dash\data::storeData_title(); ?></h1>
    <h2 class="leading-relaxed text-2xs"><?php echo \dash\data::storeData_desc(); ?></h2>
   </div>
  </div>


  <address class="not-italic py-1 border-t border-b border-black">
    <div class="address text-2xs leading-7"><?php echo \dash\data::sellerAddress_address(); ?></div>
    <div class="flex text-xs leading-6">
     <div class="w-1/2 website text-left"><?php echo \dash\data::storeData_website(); ?></div>
     <div class="w-1/2 phone text-left"><?php echo \dash\fit::text(\dash\data::sellerAddresss_phone()); ?></div>
    </div>
  </address>
 </div>



<?php if(\dash\data::storeData_factorheader()) {?>
<p class="factorHeader text-sm text-center">
<?php echo \dash\data::storeData_factorheader(); ?>
</p>

<?php } //endif ?>

<?php if(\dash\data::customer_displayname()) {?>
<div class="text-xs leading-relaxed flex">
  <span class="grow self-center"><?php echo T_("Buyer"); ?></span>
  <span class="font-black"><?php echo \dash\data::customer_displayname(); ?></span>
</div>
<?php } //endif ?>

<?php if(a(\dash\data::customerDebt(), 'debt_until_order')) {?>
<div class="text-xs leading-relaxed flex">
  <span class="grow self-center"><?php echo T_("Debt unti this order") ?></span>
  <span class="font-black"><?php echo \dash\fit::number(a(\dash\data::customerDebt(), 'debt_until_order')); ?> <small><?php echo \lib\store::currency() ?></small></span>
</div>
<?php } //endif ?>
<?php if(a(\dash\data::customerDebt(), 'debt_with_order')) {?>
<div class="text-xs leading-relaxed flex">
  <span class="grow self-center"><?php echo T_("Debt whit this order") ?></span>
  <span class="font-black ltr inline-block"><?php echo \dash\fit::number(a(\dash\data::customerDebt(), 'debt_with_order')); ?> <small><?php echo \lib\store::currency() ?></small></span>
</div>
<?php } //endif ?>

<?php if(a(\dash\data::customerDebt(), 'current_debt') && a(\dash\data::customerDebt(), 'current_debt') != a(\dash\data::customerDebt(), 'debt_with_order')) {?>
<div class="text-xs leading-relaxed flex">
  <span class="grow self-center"><?php echo T_("Current debt") ?></span>
  <span class="font-black ltr inline-block"><?php echo \dash\fit::number(a(\dash\data::customerDebt(), 'current_debt')); ?> <small><?php echo \lib\store::currency() ?></small></span>
</div>
<?php } //endif ?>



<?php $address = \dash\data::address() ?>
<?php if($address) {?>
<div class="customerDetail border-b border-black">
  <div class="text-base bg-black text-white text-center leading-7"><?php echo T_("Customer"); ?></div>
  <div class="font-bold leading-8 text-sm"><?php echo \dash\data::customer_displayname(); ?></div>

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


 <div class="factorDetail text-xs leading-relaxed my-1">
  <div class="flex">
   <div class="w-1/2 date"><?php echo \dash\fit::date(\dash\data::invoice_date(), true); ?></div>
   <div class="w-1/2 time text-left"><?php echo \dash\fit::time(\dash\data::invoice_date(), true); ?></div>
  </div>

<?php if(strtotime(\dash\data::invoice_date()) < strtotime('-1 day')) {?>
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
    <th class="border-b border-black"><?php echo T_("Price"); ?></th>
    <th class="border-b border-black"><?php echo T_("Qty"); ?></th>
    <th class="border-b border-black"><?php echo T_("Sum"); ?></th>
   </tr>
  </thead>
  <tbody class="text-sm leading-7">
  <?php foreach (\dash\data::invoiceDetail() as $key => $dataRow) {?>
  <tr class="border-b border-black border-dashed">
   <td class="txtLa productTitle px-0.5 text-xs font-bold leading-6 break-word"><?php if(isset($dataRow['vat']) && $dataRow['vat']) {echo ' * ';} echo ' '. a($dataRow, 'title');?></td>
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
    <?php if(\dash\data::invoice_subdiscount() || \dash\data::invoice_subvat()) {?>

   <tr class="bg-gray-300">
     <th class="txtLa text-xs px-1"><?php echo T_("Invoice amount"); ?></th>
     <td class="txtLa px-1"><?php echo \dash\fit::number_en(\dash\data::invoice_subprice()); ?></td>
   </tr>
   <?php if(\dash\data::invoice_subdiscount()) {?>

   <tr class="bg-gray-300">
     <th class="txtLa text-xs px-1"><?php echo T_("Your total discount and profits"); ?></th>
     <td class="txtLa px-1"><?php echo \dash\fit::number_en(\dash\data::invoice_subdiscount()); ?></td>
   </tr>
   <?php } //endif ?>

   <?php if(\dash\data::invoice_subvat()) {?>

   <tr class="bg-gray-300">
     <th class="txtLa text-xs px-1">* <?php echo T_("VAT"); ?></th>
     <td class="txtLa px-1"><?php echo \dash\fit::number_en(\dash\data::invoice_subvat()); ?></td>
   </tr>
   <?php } //endif ?>
   <?php if(\dash\data::invoice_shipping()) {?>
   <tr class="bg-gray-300">
     <th class="txtLa text-xs px-1"><?php echo T_("Shipping"); ?></th>
     <td class="txtLa px-1"><?php echo \dash\fit::number_en(\dash\data::invoice_shipping()); ?></td>
   </tr>
   <?php } //endif ?>


  <?php if(\dash\data::invoice_discount2()) {?>
   <tr class="bg-gray-300">
     <th class="txtLa text-xs px-1"><?php echo T_("Discount code"); ?></th>
     <td class="txtLa px-1"><?php echo \dash\fit::number_en(\dash\data::invoice_discount2()); ?></td>
   </tr>
   <?php } //endif ?>

<?php } //endif ?>
   <tr class="bg-black text-white factorSum">
     <th class="txtLa w-full text-xs px-1"><?php echo T_("Total payable"); ?> <small class="text-sm">( <?php echo \lib\store::currency(); ?> )</small></th>
     <td class="txtLa px-1 font-bold"><?php echo \dash\fit::number_en(\dash\data::invoice_total()); ?></td>
   </tr>
  </tbody>

 </table>


<div class="barcodeBox mb-1">
  <svg class="barcodePrev wide w-full mx-auto" data-val="#barcode" data-height=20 data-hideValue></svg>
   <div class="text-center text-xs"><code class="hidden" id='barcode' data-val='<?php echo a(\dash\data::invoice(), 'id_code'); ?>'><?php echo a(\dash\data::invoice(), 'id_code'); ?></code></div>
</div>

<?php if(\dash\data::storeData_factorfooter()) {?>
<p class="factorFooter text-center border-t border-black">
<?php echo \dash\data::storeData_factorfooter(); ?>
</p>
<?php } //endif ?>

</div>
<!-- force portrait for receipt print-->
<style type="text/css">@page {size: portrait;}</style>
