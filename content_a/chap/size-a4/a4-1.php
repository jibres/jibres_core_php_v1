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
        <h1><?php echo T_("Invoice "); ?></h1>
      </div>
      <div class="c-3 txtL">
        <div>
          <span class="compact"><?php echo T_("Serial Number"); ?></span>
          <span class="printEmptyBox size150"></span>
        </div>
        <div>
          <span class="compact"><?php echo T_("Date"); ?></span>
          <span class="printEmptyBox size150"><?php echo \dash\fit::date('now'); ?></span>
        </div>
      </div>
    </header>

    <div id="sellerDetails" class="oneSide">
      <div class="row">
        <div class="c-1"><h2 class="txtC"><?php echo "Seller Details"; ?></h2></div>
        <div class="c-11">
          <div class="row padMore">
            <div class="c-6 title"><?php echo \dash\get::index($storeData,'title'); ?></div>
            <div class="c-3">
              <span><?php echo T_("VAT Number"); ?></span>
              <code>411492163378</code>
            </div>
            <div class="c-3">
              <span><?php echo T_("Company ID Number"); ?></span>
              <code>14005035554</code>
            </div>
          </div>
          <div class="row padMore">
            <div class="c-6"><?php
$country = \dash\get::index($storeData,'country_detail', 'name');
if($country)
{
  echo '<span>';
  echo $country;
  echo '</span>';
}

$province = \dash\get::index($storeData,'province_detail', 'name');
if($province)
{
  echo T_(', ');
  echo '<span>';
  echo T_("Province"). ' ';
  echo $province;
  echo '</span>';
}

$city = \dash\get::index($storeData,'city_detail', 'name');
if($city)
{
  echo T_(', ');
  echo '<span>';
  echo T_("City"). ' ';
  echo $city;
  echo '</span>';
}
?></div>
            <div class="c-3">
              <span><?php echo T_("Postal Code"); ?></span>
              <code><?php echo \dash\get::index($storeData,'postcode'); ?></code>
            </div>
            <div class="c-3">
              <span><?php echo T_("Company Registration Number"); ?></span>
              <code>13552</code>
            </div>
          </div>

          <div class="row padMore">
            <div class="c-6"><?php
$address = \dash\get::index($storeData,'address');
if($address)
{
  echo '<span>'. T_('Address'). '</span>'. ' ';
  echo '<span>';
  echo $address;
  echo '</span>';
}
?></div>
            <div class="c-3"><?php
$phone = \dash\get::index($storeData,'phone');
if($phone || 1)
{
  echo '<span>'. T_('Phone'). '</span>'. ' ';
  echo '<code>';
  // echo $phone;
  echo '+98-25-36505281';
  echo '</code>';
}
else if($fax || 1)
{
  echo '<span>'. T_('Fax'). '</span>'. ' ';
  echo '<code>';
  // echo $fax;
  echo '+98-25-36505281';
  echo '</code>';
}
?></div>
            <div class="c-3"><?php
{
  echo '<span class="block ltr txtL pLR5">';
  echo \lib\store::url();
  echo '</span>';
}
?></div>
          </div>

        </div>
      </div>






    </div>


<!--  -->

  </div>


<hr>

    <h2><?php echo "Buyer Details"; ?></h2>
    <h2><?php echo "Details of the goods or services being traded"; ?></h2>




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
    <th><?php echo T_("Price"); ?><?php if(isset($factorDetail['factor']['subdiscount']) && $factorDetail['factor']['subdiscount']) {?><br><?php echo T_("For you"); ?><?php }//endif ?></th>
    <th><?php echo T_("Sum"); ?></th>
   </tr>
  </thead>
  <tbody>
  <?php foreach ($factor_detail as $key => $datarow) {?>


  <tr>
   <td class="txtLa productTitle"><?php if(isset($datarow['vat']) && $datarow['vat']) {echo ' * ';} echo ' '. \dash\get::index($datarow, 'title');?></td>
   <td><?php echo \dash\fit::text(\dash\get::index($datarow, 'count')); ?> <small><?php echo \dash\get::index($datarow, 'unit'); ?></small></td>
   <td><?php
if(isset($datarow['discount']) && $datarow['discount'])
{
  echo '<del>'. \dash\fit::number(\dash\get::index($datarow, 'price')). '</del>';
  echo '<br>'. \dash\fit::number(\dash\get::index($datarow, 'finalprice'));
  // echo '<br>'. \dash\fit::number($datarow['discount']);
}
else
{
  echo \dash\fit::number(\dash\get::index($datarow, 'price'));
}
?></td>
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
     <td class="collapsing txtLa"><?php echo \dash\fit::number(\dash\get::index($factorDetail, 'factor', 'total')); ?> <small class="fs05"><?php echo \lib\currency::unit(); ?></small></td>
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

