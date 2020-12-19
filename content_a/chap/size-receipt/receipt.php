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


  <?php if(isset($storeData['logo']) && $storeData['logo']) {?>

  <div class="logo txtC midSize">
   <img src="<?php echo $storeData['logo']; ?>" alt="<?php echo a($storeData,'title'); ?>">
  </div>
<?php } //endif ?>

 <div class="f storeDetail fs12 txtC">
  <div class="c">
   <h1><?php echo a($storeData,'title'); ?></h1>
   <address>
    <div class="address"><?php echo a($storeData,'address'); ?></div>
    <div class="f">
     <div class="phone"><?php echo \dash\fit::text(a($storeData,'phone')); ?></div>
     <div class="website"><?php echo a($storeData,'website'); ?></div>
    </div>
   </address>
   <div class="desc mB5"><?php echo a($storeData,'desc'); ?></div>
  </div>
 </div>



<?php if(isset($storeData['factorheader']) && $storeData['factorheader']) {?>

<hr>
<p class="factorHeader fs12 txtC">
<?php echo a($storeData,'factorheader'); ?>
</p>

<?php } //endif ?>





<?php if(isset($factorDetail['address']) && $factorDetail['address']) {?>
<?php $address = $factorDetail['address'] ?>
<hr>
<div class="customerDetail fs12 txtC">
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




 <div class="f factorDetail fs12 mB10 txtC">
  <div class="c12">
   <div class="datetime"><?php echo \dash\fit::date(a($factorDetail, 'factor', 'date')); ?></div>
   <div><?php echo T_("Factor Number"); ?> <code id='barcode' data-val='<?php echo a($factorDetail, 'factor', 'id_code'); ?>'><?php echo a($factorDetail, 'factor', 'id_code'); ?></code></div>
  </div>
 </div>




 <table class="tbl1 v1 fs12 txtC">
  <thead>
   <tr class="fs07">
    <th><?php echo T_("Name"); ?></th>
    <th><?php echo T_("Qty"); ?></th>
    <th><?php echo T_("Price"); ?><?php if(isset($factorDetail['factor']['subdiscount']) && $factorDetail['factor']['subdiscount']) {?><br><?php echo T_("For you"); ?><?php }//endif ?></th>
    <th><?php echo T_("Sum"); ?></th>
   </tr>
  </thead>
  <tbody>
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




 <table class="tbl fs14 factorResult mB10">
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

<?php } //endif ?>
   <tr class="msg info2 factorSum">
     <th class="txtRa fs08"><?php echo T_("Total payable"); ?></th>
     <td class="collapsing txtLa"><?php echo \dash\fit::number(a($factorDetail, 'factor', 'total')); ?> <small class="fs05"><?php echo \lib\currency::unit(); ?></small></td>
   </tr>
  </tbody>

 </table>


<div class="barcodeBox">
  <svg class="barcodePrev wide" data-val="#barcode" data-height=20 data-hideValue></svg>
</div>

<?php if(isset($storeData['factorfooter']) && $storeData['factorfooter']) {?>

<hr>
<p class="factorFooter fs14 txtC">
<?php echo a($storeData,'factorfooter'); ?>
</p>
<?php } //endif ?>





</div>

