<?php
if(\dash\data::customer())
{
?>
    <div id="sellerDetails" class="oneSide bg-gray-100 border border-gray-400 rounded overflow-hidden mb-1">
      <div class="flex">
        <div class="flex-none w-20 bg-gray-200 flex justify-center">
          <h2 class="flex self-center font-bold"><?php echo T_("Buyer"); ?></h2>
        </div>
        <div class="flex-grow px-2 text-xs leading-7">
          <div class="flex">
            <div class="flex-grow font-black"><?php echo \dash\data::customer_displayname(); ?></div>
            <div class="w-3/12 flex px-2">
              <?php if(\dash\data::customer_companyeconomiccode()) {?>
              <div class="flex-grow"><?php echo T_("VAT Number"); ?></div>
              <code class="font-bold tracking-widest"><?php echo \dash\data::customer_companyeconomiccode() ?></code>
            <?php } //endif ?>
            </div>
            <div class="w-3/12 flex px-2">
              <?php if(\dash\data::customer_companynationalid()) {?>
              <div class="flex-grow"><?php echo T_("Company ID Number"); ?></div>
              <code class="font-bold tracking-widest"><?php echo \dash\data::customer_companynationalid() ?></code>
            <?php  }//endif ?>
            </div>
          </div>
          <div class="flex">
            <div class="flex-grow"><?php
$country = a(\dash\data::address(),'country_name');
if($country)
{
  echo '<span>';
  echo $country;
  echo '</span>';
}

$province = a(\dash\data::address(), 'province_name');
if($province)
{
  echo T_(', ');
  echo '<span>';
  echo T_("Province"). ' ';
  echo $province;
  echo '</span>';
}

$city = a(\dash\data::address(),'city_name');
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
              <?php if(a(\dash\data::address(), 'postcode')) {?>
              <div class="flex-grow"><?php echo T_("Postal Code"); ?></div>
              <code class="font-bold tracking-widest"><?php echo \dash\data::address_postcode(); ?></code>
            <?php } //endif ?>
            </div>
            <div class="w-3/12 flex px-2">
              <?php if(\dash\data::customer_companyregisternumber()) {?>
              <div class="flex-grow"><?php echo T_("Company Registration Number"); ?></div>
              <code class="font-bold tracking-widest"><?php echo \dash\data::customer_companyregisternumber() ?></code>
            <?php } //endif ?>
            </div>
          </div>

          <div class="flex">
            <div class="flex-grow"><?php
$address = \dash\data::address_address();
if($address)
{
  // echo '<span>'. T_('Address'). '</span>'. ' ';
  // echo '<span>';
  echo $address;
  // echo '</span>';
}
?></div>
            <div class="w-3/12 flex px-2"><?php
$phone = \dash\data::address_phone();
$fax = \dash\data::address_fax();
if($phone)
{
  echo '<span class="flex-grow">'. T_('Phone'). '</span>'. ' ';
  echo '<code class="font-bold tracking-widest">';
  // echo $phone;
  echo $phone;
  echo '</code>';
}
else if($fax)
{
  echo '<span class="flex-grow">'. T_('Fax'). '</span>'. ' ';
  echo '<code class="font-bold tracking-widest">';
  // echo $fax;
  echo $fax;
  echo '</code>';
}
?></div>
            <div class="w-3/12 flex px-2"><?php
{
  echo '<div dir="ltr" class="text-left truncate">';
  echo \dash\data::customer_url();
  echo '</div>';
}
?></div>
          </div>

        </div>
      </div>
    </div>
<?php } ?>