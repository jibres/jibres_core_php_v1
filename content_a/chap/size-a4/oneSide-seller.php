    <div id="sellerDetails" class="oneSide bg-gray-100 border border-gray-400 rounded overflow-hidden mb-1">
      <div class="flex">
        <div class="w-20 bg-gray-200 flex justify-center">
          <h2 class="flex self-center font-bold"><?php echo T_("Seller"); ?></h2>
        </div>
        <div class="flex-grow px-2 text-xs leading-7">
          <div class="flex">
            <div class="flex-grow font-black"><?php if(isset($storeData['companyname']) && $storeData['companyname']) { echo $storeData['companyname'];}else{ echo a($storeData,'title');} ?></div>
            <div class="w-3/12 flex px-2">
              <div class="flex-grow"><?php echo a($storeData, 'companyeconomiccode') ? T_("VAT Number") : null ; ?></div>
              <code class="font-bold tracking-widest"><?php echo a($storeData, 'companyeconomiccode') ?></code>
            </div>
            <div class="w-3/12 flex px-2">
              <div class="flex-grow"><?php echo a($storeData, 'companynationalid') ? T_("Company ID Number") : null; ?></div>
              <code class="font-bold tracking-widest"><?php echo a($storeData, 'companynationalid') ?></code>
            </div>
          </div>
          <div class="flex">
            <div class="flex-grow"><?php
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
            <div class="w-3/12 flex px-2">
              <div class="flex-grow"><?php echo a($storeData, 'postcode') ? T_("Postal Code") : null ; ?></div>
              <code class="font-bold tracking-widest"><?php echo a($storeData, 'postcode'); ?></code>
            </div>
            <div class="w-3/12 flex px-2">
              <div class="flex-grow"><?php echo a($storeData, 'companyregisternumber') ? T_("Company Registration Number") : null; ?></div>
              <code class="font-bold tracking-widest"><?php echo a($storeData, 'companyregisternumber') ?></code>
            </div>
          </div>

          <div class="flex">
            <div class="flex-grow"><?php
$address = a($storeData,'address');
if($address)
{
  // echo '<span>'. T_('Address'). '</span>'. ' ';
  // echo '<span>';
  echo $address;
  // echo '</span>';
}
?></div>
            <div class="w-3/12 flex px-2"><?php
$phone = a($storeData,'phone');
$fax = a($storeData,'fax');
if($phone)
{
  echo '<div class="flex-grow">'. T_('Phone'). '</div>'. ' ';
  echo '<code class="font-bold tracking-widest">';
  // echo $phone;
  echo $phone;
  echo '</code>';
}
else if($fax)
{
  echo '<div class="flex-grow">'. T_('Fax'). '</div>'. ' ';
  echo '<code class="font-bold tracking-widest">';
  // echo $fax;
  echo $fax;
  echo '</code>';
}
?></div>
            <div class="w-3/12 flex px-2"><?php
{
  echo '<div dir="ltr" class="text-left truncate">';
  if(isset($storeData['local_website']) && $storeData['local_website'])
  {
    echo $storeData['local_website'];
  }
  else
  {
    echo \lib\store::url();
  }
  echo '</div>';
}
?></div>
          </div>

        </div>
      </div>
    </div>
