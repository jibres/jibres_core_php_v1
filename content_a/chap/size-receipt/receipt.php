<?php
$storeData = \dash\data::store_store_data();
$factorDetail = \dash\data::factorDetail();
$factor_detail = [];
if(isset($factorDetail['factor_detail']) && is_array($factorDetail['factor_detail']))
{
  $factor_detail = $factorDetail['factor_detail'];
}
?>

<div class="factor printArea" data-size='receipt8'>


  <?php if(isset($storeData['logo']) && $storeData['logo']) {?>

  <div class="logo txtC midSize">
   <img src="<?php echo $storeData['logo']; ?>" alt="<?php echo \dash\get::index($storeData,'title'); ?>">
  </div>
<?php } //endif ?>

 <div class="f storeDetail fs12 txtC">
  <div class="c">
   <h1><?php echo \dash\get::index($storeData,'title'); ?></h1>
   <address>
    <div class="address"><?php echo \dash\get::index($storeData,'address'); ?></div>
    <div class="f">
     <div class="phone"><?php echo \dash\fit::text(\dash\get::index($storeData,'phone')); ?></div>
     <div class="website"><?php echo \dash\get::index($storeData,'website'); ?></div>
    </div>
   </address>
   <div class="desc mB5"><?php echo \dash\get::index($storeData,'desc'); ?></div>
  </div>
 </div>



<?php if(isset($storeData['factorheader']) && $storeData['factorheader']) {?>

<hr>
<p class="factorHeader fs12 txtC">
<?php echo \dash\get::index($storeData,'factorheader'); ?>
</p>

<?php } //endif ?>





<?php if(isset($factorDetail['factor']['customer']) && $factorDetail['factor']['customer']) {?>
<hr>
<div class="customerDetail fs12 txtC">
  <div class="fs14"><?php echo T_("Customer Detail"); ?></div>
<?php if(isset($factorDetail['factor']['customer_displayname']) && $factorDetail['factor']['customer_displayname']) {?>
  <div class="pA10"><span class="txtB"><?php echo $factorDetail['factor']['customer_displayname']; ?></span></div>
<?php } //endif ?>

<?php if(isset($factorDetail['factor']['customer_address']) && $factorDetail['factor']['customer_address']) {?>
  <div class="pA10">
    <?php echo T_("Address"); ?>

  <?php if(isset($factorDetail['factor']['customer_address']['location_string']) && $factorDetail['factor']['customer_address']['location_string']) {?>
    <span class="txtB"><?php echo $factorDetail['factor']['customer_address']['location_string']; ?></span>
  <?php } //endif ?>

  <?php if(isset($factorDetail['factor']['customer_address']['address']) && $factorDetail['factor']['customer_address']['address']) {?>
    <span class="txtB"><?php echo $factorDetail['factor']['customer_address']['address']; ?></span>
  <?php } //endif ?>


  </div>
<?php } //endif address ?>

<?php if(isset($factorDetail['factor']['customer_phone']) && $factorDetail['factor']['customer_phone']) {?>
  <div class="pA10"><?php echo T_("Tel"); ?> <span class="txtB ltr compact"><?php echo \dash\fit::text($factorDetail['factor']['customer_phone']); ?></span></div>
<?php } //endif ?>

<?php if(isset($factorDetail['factor']['customer_mobile']) && $factorDetail['factor']['customer_mobile']) {?>
  <div class="pA10"><?php echo T_("Mobile"); ?> <span class="txtB ltr compact"><?php echo \dash\fit::mobile($factorDetail['factor']['customer_mobile']); ?></span></div>
<?php } //endif ?>


</div>
<?php } //endif ?>




 <div class="f factorDetail fs12 mB10 txtC">
  <div class="c12">
   <div class="datetime"><?php echo \dash\fit::date(\dash\get::index($factorDetail, 'factor', 'date')); ?></div>
   <div><?php echo T_("Sale Invoice"); ?> <code id='barcode' data-val='<?php echo \dash\get::index($factorDetail, 'factor', 'id_code'); ?>'><?php echo \dash\get::index($factorDetail, 'factor', 'id_code'); ?></code></div>
  </div>
 </div>




 <table class="tbl1 v1 fs12 txtC">
  <thead>
   <tr class="fs07">
    <th><?php echo T_("Name"); ?></th>
    <th><?php echo T_("Qty"); ?></th>
    <th><?php echo T_("Price"); ?><?php if(isset($factorDetail['factor']['subdiscount']) && $factorDetail['factor']['subdiscount']) {?><br><?php echo T_("Discount"); ?><?php }//endif ?></th>
    <th><?php echo T_("Sum"); ?></th>
   </tr>
  </thead>
  <tbody>
  <?php foreach ($factor_detail as $key => $datarow) {?>


  <tr>
   <td class="txtLa productTitle"><?php if(isset($datarow['vat']) && $datarow['vat']) {echo ' * ';} echo ' '. \dash\get::index($datarow, 'title');?></td>
   <td><?php echo \dash\fit::text(\dash\get::index($datarow, 'count')); ?> <small><?php echo \dash\get::index($datarow, 'unit'); ?></small></td>
   <td><?php echo \dash\fit::number(\dash\get::index($datarow, 'price')); ?><?php if(isset($datarow['discount']) && $datarow['discount']) {?><br><?php echo \dash\fit::number($datarow['discount']); } //endif?></td>
   <td><?php echo \dash\fit::number(\dash\get::index($datarow, 'sum')); ?></td>
  </tr>
 <?php } //endfor ?>
  </tbody>



 </table>




 <table class="tbl fs14 factorResult mB10">
  <tbody>
    <?php if((isset($factorDetail['factor']['subdiscount']) && $factorDetail['factor']['subdiscount']) || (isset($factorDetail['factor']['subvat']) && $factorDetail['factor']['subvat'])) {?>

   <tr>
     <th class="txtRa fs08"><?php echo T_("Invoice amount"); ?></th>
     <td class="collapsing txtLa"><?php echo \dash\fit::number(\dash\get::index($factorDetail, 'factor', 'subprice')); ?></td>
   </tr>
   <?php if(isset($factorDetail['factor']['subdiscount']) && $factorDetail['factor']['subdiscount']) {?>

   <tr>
     <th class="txtRa fs08"><?php echo T_("Your total discount and profits"); ?></th>
     <td class="collapsing txtLa"><?php echo \dash\fit::number(\dash\get::index($factorDetail, 'factor', 'subdiscount')); ?></td>
   </tr>
   <?php } //endif ?>

   <?php if(isset($factorDetail['factor']['subvat']) && $factorDetail['factor']['subvat']) {?>

   <tr>
     <th class="txtRa fs08">* <?php echo T_("VAT"); ?></th>
     <td class="collapsing txtLa"><?php echo \dash\fit::number(\dash\get::index($factorDetail, 'factor', 'subvat')); ?></td>
   </tr>
   <?php } //endif ?>

<?php } //endif ?>
   <tr class="msg info2 factorSum">
     <th class="txtRa fs08"><?php echo T_("Total payable"); ?></th>
     <td class="collapsing txtLa"><?php echo \dash\fit::number(\dash\get::index($factorDetail, 'factor', 'total')); ?> <small class="fs05"><?php echo T_("Toman"); ?></small></td>
   </tr>
  </tbody>

 </table>


<div class="barcodeBox">
  <svg class="barcodePrev wide" data-val="#barcode" data-height=20 data-hideValue></svg>
</div>

<?php if(isset($storeData['factorfooter']) && $storeData['factorfooter']) {?>

<hr>
<p class="factorFooter fs14 txtC">
<?php echo \dash\get::index($storeData,'factorfooter'); ?>
</p>
<?php } //endif ?>





</div>

