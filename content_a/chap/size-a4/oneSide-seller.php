    <div id="sellerDetails" class="oneSide">
      <div class="row">
        <div class="c-1"><h2 class="txtC"><?php echo T_("Seller Details"); ?></h2></div>
        <div class="c-11">
          <div class="row padMore">
            <div class="c-6 title"><?php if(isset($storeData['companyname']) && $storeData['companyname']) { echo $storeData['companyname'];}else{ echo a($storeData,'title');} ?></div>
            <div class="c-3">
              <span><?php echo a($storeData, 'companyeconomiccode') ? T_("VAT Number") : null ; ?></span>
              <code><?php echo a($storeData, 'companyeconomiccode') ?></code>
            </div>
            <div class="c-3">
              <span><?php echo a($storeData, 'companynationalid') ? T_("Company ID Number") : null; ?></span>
              <code><?php echo a($storeData, 'companynationalid') ?></code>
            </div>
          </div>
          <div class="row padMore">
            <div class="c-6"><?php
$country = a($storeData,'country_detail', 'name');
if($country)
{
  echo '<span>';
  echo $country;
  echo '</span>';
}

$province = a($storeData,'province_detail', 'name');
if($province)
{
  echo T_(', ');
  echo '<span>';
  echo T_("Province"). ' ';
  echo $province;
  echo '</span>';
}

$city = a($storeData,'city_detail', 'name');
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
              <span><?php echo a($storeData, 'postcode') ? T_("Postal Code") : null ; ?></span>
              <code><?php echo a($storeData, 'postcode'); ?></code>
            </div>
            <div class="c-3">
              <span><?php echo a($storeData, 'companyregisternumber') ? T_("Company Registration Number") : null; ?></span>
              <code><?php echo a($storeData, 'companyregisternumber') ?></code>
            </div>
          </div>

          <div class="row padMore">
            <div class="c-6"><?php
$address = a($storeData,'address');
if($address)
{
  // echo '<span>'. T_('Address'). '</span>'. ' ';
  // echo '<span>';
  echo $address;
  // echo '</span>';
}
?></div>
            <div class="c-3"><?php
$phone = a($storeData,'phone');
$fax = a($storeData,'fax');
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
  if(isset($storeData['local_website']) && $storeData['local_website'])
  {
    echo $storeData['local_website'];
  }
  else
  {
    echo \lib\store::url();
  }
  echo '</span>';
}
?></div>
          </div>

        </div>
      </div>
    </div>
