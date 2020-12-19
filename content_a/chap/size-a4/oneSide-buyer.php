<?php

$customerDetail = a($factorDetail, 'factor', 'customer_detail');
$addressDetail = a($factorDetail, 'address');


?>

    <div id="sellerDetails" class="oneSide">
      <div class="row">
        <div class="c-1"><h2 class="txtC"><?php echo T_("Buyer Details"); ?></h2></div>
        <div class="c-11">
          <div class="row padMore">
            <div class="c-6 title"><?php echo a($customerDetail, 'displayname'); ?></div>
            <div class="c-3">
              <?php if(a($customerDetail, 'companyeconomiccode')) {?>
              <span><?php echo T_("VAT Number"); ?></span>
              <code><?php echo a($customerDetail, 'companyeconomiccode') ?></code>
            <?php } //endif ?>
            </div>
            <div class="c-3">
              <?php if(a($customerDetail, 'companynationalid')) {?>
              <span><?php echo T_("Company ID Number"); ?></span>
              <code><?php echo a($customerDetail, 'companynationalid') ?></code>
            <?php  }//endif ?>
            </div>
          </div>
          <div class="row padMore">
            <div class="c-6"><?php
$country = a($addressDetail,'country_name');
if($country)
{
  echo '<span>';
  echo $country;
  echo '</span>';
}

$province = a($addressDetail, 'province_name');
if($province)
{
  echo T_(', ');
  echo '<span>';
  echo T_("Province"). ' ';
  echo $province;
  echo '</span>';
}

$city = a($addressDetail,'city_name');
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
              <?php if(a($addressDetail, 'postcode')) {?>
              <span><?php echo T_("Postal Code"); ?></span>
              <code><?php echo a($addressDetail, 'postcode'); ?></code>
            <?php } //endif ?>
            </div>
            <div class="c-3">
              <?php if(a($customerDetail, 'companyregisternumber')) {?>
              <span><?php echo T_("Company Registration Number"); ?></span>
              <code><?php echo a($customerDetail, 'companyregisternumber') ?></code>
            <?php } //endif ?>
            </div>
          </div>

          <div class="row padMore">
            <div class="c-6"><?php
$address = a($addressDetail, 'address');
if($address)
{
  // echo '<span>'. T_('Address'). '</span>'. ' ';
  // echo '<span>';
  echo $address;
  // echo '</span>';
}
?></div>
            <div class="c-3"><?php
$phone = a($addressDetail, 'phone');
$fax = a($addressDetail, 'fax');
if($phone)
{
  echo '<span>'. T_('Phone'). '</span>'. ' ';
  echo '<code>';
  // echo $phone;
  echo $phone;
  echo '</code>';
}
else if($fax)
{
  echo '<span>'. T_('Fax'). '</span>'. ' ';
  echo '<code>';
  // echo $fax;
  echo $fax;
  echo '</code>';
}
?></div>
            <div class="c-3"><?php
{
  echo '<span class="block ltr txtL pLR5">';
  echo a($customerDetail, 'url');
  echo '</span>';
}
?></div>
          </div>

        </div>
      </div>
    </div>
