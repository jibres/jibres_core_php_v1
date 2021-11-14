    <div id="sellerDetails" class="oneSide bg-gray-100 border border-gray-400 rounded overflow-hidden mb-1">
      <div class="flex">
        <div class="flex-none w-20 bg-gray-200 flex justify-center">
          <h2 class="flex self-center font-bold"><?php echo T_("Seller"); ?></h2>
        </div>
        <div class="flex-grow px-2 text-xs leading-7">
          <div class="flex">
            <div class="flex-grow font-black"><?php if(\dash\data::storeData_companyname()) { echo \dash\data::storeData_companyname();}else{ echo \dash\data::storeData_title();} ?></div>
            <div class="w-3/12 flex px-2">
              <div class="flex-grow"><?php echo \dash\data::storeData_companyeconomiccode() ? T_("VAT Number") : null ; ?></div>
              <code class="font-bold tracking-widest"><?php echo \dash\data::storeData_companyeconomiccode() ?></code>
            </div>
            <div class="w-3/12 flex px-2">
              <div class="flex-grow"><?php echo \dash\data::storeData_companynationalid() ? T_("Company ID Number") : null; ?></div>
              <code class="font-bold tracking-widest"><?php echo \dash\data::storeData_companynationalid() ?></code>
            </div>
          </div>
          <div class="flex">
            <div class="flex-grow"><?php
$country = a(\dash\data::storeData(),'country_detail', 'name');
if($country)
{
  echo '<span>';
  echo $country;
  echo '</span>';
}

$province = a(\dash\data::storeData(),'province_detail', 'name');
if($province)
{
  echo T_(', ');
  echo '<span>';
  echo T_("Province"). ' ';
  echo $province;
  echo '</span>';
}

$city = a(\dash\data::storeData(),'city_detail', 'name');
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
              <div class="flex-grow"><?php echo \dash\data::storeData_postcode() ? T_("Postal Code") : null ; ?></div>
              <code class="font-bold tracking-widest"><?php echo \dash\data::storeData_postcode(); ?></code>
            </div>
            <div class="w-3/12 flex px-2">
              <div class="flex-grow"><?php echo \dash\data::storeData_companyregisternumber() ? T_("Company Registration Number") : null; ?></div>
              <code class="font-bold tracking-widest"><?php echo \dash\data::storeData_companyregisternumber() ?></code>
            </div>
          </div>

          <div class="flex">
            <div class="flex-grow"><?php
$address = \dash\data::storeData_address();
if($address)
{
  // echo '<span>'. T_('Address'). '</span>'. ' ';
  // echo '<span>';
  echo $address;
  // echo '</span>';
}
?></div>
            <div class="w-3/12 flex px-2"><?php
$phone = \dash\data::storeData_phone();
$fax = \dash\data::storeData_fax();
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
  if(a(\dash\data::storeData(), 'local_website'))
  {
    echo a(\dash\data::storeData(), 'local_website');
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
