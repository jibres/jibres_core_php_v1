
    <div id="sellerDetails" class="oneSide">
      <div class="row">
        <div class="c-1"><h2 class="txtC"><?php echo T_("Seller Details"); ?></h2></div>
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
  echo '025-36505281';
  echo '</code>';
}
else if($fax || 1)
{
  echo '<span>'. T_('Fax'). '</span>'. ' ';
  echo '<code>';
  // echo $fax;
  echo '025-36505281';
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
