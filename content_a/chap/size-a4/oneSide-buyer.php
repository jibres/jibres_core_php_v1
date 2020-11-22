<?php $customerLegal = \dash\get::index($factorDetail, 'factor', 'customer_legal'); ?>

    <div id="sellerDetails" class="oneSide">
      <div class="row">
        <div class="c-1"><h2 class="txtC"><?php echo T_("Buyer Details"); ?></h2></div>
        <div class="c-11">
          <div class="row padMore">
            <div class="c-6 title"><?php echo \dash\get::index($customerLegal, 'companyname'); ?></div>
            <div class="c-3">
              <span><?php echo T_("VAT Number"); ?></span>
              <code><?php echo \dash\get::index($customerLegal, 'companyeconomiccode') ?></code>
            </div>
            <div class="c-3">
              <span><?php echo T_("Company ID Number"); ?></span>
              <code><?php echo \dash\get::index($customerLegal, 'companynationalid') ?></code>
            </div>
          </div>
          <div class="row padMore">
            <div class="c-6"><?php
$country = \dash\get::index($customerLegal,'country_name');
if($country)
{
  echo '<span>';
  echo $country;
  echo '</span>';
}

$province = \dash\get::index($customerLegal, 'province_name');
if($province)
{
  echo T_(', ');
  echo '<span>';
  echo T_("Province"). ' ';
  echo $province;
  echo '</span>';
}

$city = \dash\get::index($customerLegal,'city_name');
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
              <code><?php echo \dash\get::index($customerLegal, 'postcode'); ?></code>
            </div>
            <div class="c-3">
              <span><?php echo T_("Company Registration Number"); ?></span>
              <code><?php echo \dash\get::index($customerLegal, 'companyregisternumber') ?></code>
            </div>
          </div>

          <div class="row padMore">
            <div class="c-6"><?php
$address = \dash\get::index($customerLegal, 'address');
if($address)
{
  // echo '<span>'. T_('Address'). '</span>'. ' ';
  // echo '<span>';
  echo $address;
  // echo '</span>';
}
?></div>
            <div class="c-3"><?php
$phone = \dash\get::index($customerLegal, 'phone');
$fax = \dash\get::index($customerLegal, 'fax');
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
  echo \dash\get::index($customerLegal, 'url');
  echo '</span>';
}
?></div>
          </div>

        </div>
      </div>
    </div>
