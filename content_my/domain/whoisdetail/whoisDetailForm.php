
<?php if(\dash\language::current() == 'fa') {?>
	<div class="msg danger2 rtl">
		<li>حتما تمامی اطلاعات را با کاراکتر‌های لاتین وارد کنید.</li>
		<li>حتما از یک ایمیل معتبر برای ثبت دامنه استفاده کنید. بعد از فرایند ثبت دامنه شما باید از طریق ایمیلی که به شما ارسال شده است فرایند را تایید کنید.</li>
		<li>با توجه به تحریم بودن ایران امکان انتخاب این کشور در لیست وجود ندارد. لذا از نام‌های معروف ایرانی برای نام شهر و استان استفاده نکنید.</li>
	</div>
<?php } //endif ?>
<div class="f">
	<div class="c6 s12 pLa5">
		<label for="fullname">Full name <small class="fc-red">* Required</small></label>
		<div class="input ltr">
			<input type="text" name="fullname" value="<?php echo \dash\data::userSettingDataRow_fullname(); ?>" placeholder2="<?php echo T_("Full name"); ?>" id="fullname" maxlength="60">
		</div>
	</div>
	<div class="c6 s12">
		<label for="org">Organization <small class="fc-red">* Required</small></label>
		<div class="input ltr">
			<input type="text" name="org" value="<?php echo \dash\data::userSettingDataRow_company(); ?>" placeholder2="<?php echo T_("Organization"); ?>" id="org" maxlength="60">
		</div>
	</div>
</div>
<?php

$country_list =
[
	"AU" => "Australia","AF" => "Afghanistan","AL" => "Albania","DZ" => "Algeria","AS" => "American Samoa","AD" => "Andorra","AO" => "Angola","AI" => "Anguilla","AQ" => "Antarctica","AG" => "Antigua and Barbuda","AR" => "Argentina","AM" => "Armenia","AW" => "Aruba","AT" => "Austria","AZ" => "Azerbaidjan","BS" => "Bahamas","BH" => "Bahrain","BD" => "Bangladesh","BB" => "Barbados","BY" => "Belarus","BE" => "Belgium","BZ" => "Belize","BJ" => "Benin","BM" => "Bermuda","BO" => "Bolivia","BA" => "Bosnia-Herzegovina","BW" => "Botswana","BV" => "Bouvet Island","BR" => "Brazil","IO" => "British Indian Ocean","BN" => "Brunei Darussalam","BG" => "Bulgaria","BF" => "Burkina Faso","BI" => "Burundi","BT" => "Buthan","KH" => "Cambodia","CM" => "Cameroon","CA" => "Canada","CV" => "Cape Verde","KY" => "Cayman Islands","CF" => "Central African Rep.","TD" => "Chad","CL" => "Chile","CN" => "China","CX" => "Christmas Island","CC" => "Cocos (Keeling) Islands","CO" => "Colombia","KM" => "Comoros","CG" => "Congo","CK" => "Cook Islands","CR" => "Costa Rica","HR" => "Croatia","CY" => "Cyprus","CZ" => "Czech Republic","DK" => "Denmark","DJ" => "Djibouti","DM" => "Dominica","DO" => "Dominican Republic","TP" => "East Timor","EC" => "Ecuador","EG" => "Egypt","SV" => "El Salvador","GQ" => "Equatorial Guinea","EE" => "Estonia","ET" => "Ethiopia","FK" => "Falkland Islands","FO" => "Faroe Islands","FJ" => "Fiji","FI" => "Finland","SU" => "Former USSR","FX" => "France (European Territories)","FR" => "France","TF" => "French Southern Territories","GA" => "Gabon","GM" => "Gambia","GE" => "Georgia","DE" => "Germany","GH" => "Ghana","GI" => "Gibraltar","GB" => "United Kingdom","GR" => "Greece","GL" => "Greenland","GD" => "Grenada","GP" => "Guadeloupe (French)","GU" => "Guam (USA)","GT" => "Guatemala","GW" => "Guinea Bissau","GN" => "Guinea","GF" => "Guyana (Fr.)","GY" => "French Guyana","HT" => "Haiti","HM" => "Heard and McDonald Islands","HN" => "Honduras","HK" => "Hong Kong","HU" => "Hungary","IS" => "Iceland","IN" => "India","ID" => "Indonesia","IQ" => "Iraq","IE" => "Ireland","IL" => "Israel","IT" => "Italy","CI" => "Ivory Coast (Cote D'I)","JM" => "Jamaica","JP" => "Japan","JO" => "Jordan","JF" => "Jothan Frakes Islands","KZ" => "Kazachstan","KE" => "Kenya","KG" => "Kyrgyzstan","KI" => "Kiribati","KR" => "South Korea","KW" => "Kuwait","LA" => "Laos","LV" => "Latvia","LB" => "Lebanon","LS" => "Lesotho","LR" => "Liberia","LY" => "Libya","LI" => "Liechtenstein","LT" => "Lithuania","LU" => "Luxembourg","MO" => "Macau","MK" => "Macedonia","MG" => "Madagascar","MW" => "Malawi","MY" => "Malaysia","MV" => "Maldives","ML" => "Mali","MT" => "Malta","MH" => "Marshall Islands","MQ" => "Martinique (French)","MR" => "Mauritania","MU" => "Mauritius","YT" => "Mayotte","MX" => "Mexico","FM" => "Micronesia","MD" => "Moldavia","MC" => "Monaco","MN" => "Mongolia","ME" => "Montenegro","MS" => "Montserrat","MA" => "Morocco","MZ" => "Mozambique","MM" => "Myanmar","NA" => "Namibia","NR" => "Nauru","NP" => "Nepal","AN" => "Netherland Antilles","NL" => "Netherlands","NC" => "New Caledonia (French)","NZ" => "New Zealand","NI" => "Nicaragua","NE" => "Niger","NG" => "Nigeria","NU" => "Niue","NF" => "Norfolk Island","MP" => "Northern Mariana Isl.","NO" => "Norway","EM" => "Office for Harmonization in the","OM" => "Oman","PK" => "Pakistan","PW" => "Palau","PA" => "Panama","PG" => "Papua New Guinea","PY" => "Paraguay","PE" => "Peru","PH" => "Philippines","PN" => "Pitcairn Island","PL" => "Poland","PF" => "Polynesia (Fr.)","PT" => "Portugal","ZN" => "Prince Nizam Zambri Isle","PR" => "Puerto Rico (US)","QA" => "Qatar","RE" => "Reunion (Fr.)","RO" => "Romania","RU" => "Russian Federation","RW" => "Rwanda","GS" => "S. Georgia & S. Sandwich Islands","LC" => "Saint Lucia","WS" => "Samoa","SM" => "San Marino","SA" => "Saudi Arabia","SN" => "Senegal","SC" => "Seychelles","SL" => "Sierra Leone","SG" => "Singapore","SK" => "Slovak Republic","SI" => "Slovenia","SB" => "Solomon Islands","SO" => "Somalia","ZA" => "South Africa","ES" => "Spain","LK" => "Sri Lanka","SH" => "Saint Helena","PM" => "Saint Pierre and Miqu","ST" => "Saint Tome (Sao Tome)","KN" => "Saint Kitts & Nevis","VC" => "Saint Vincent & Grena","RS" => "Serbia","SR" => "Suriname","SJ" => "Svalbard & Jan Mayen Is","SZ" => "Swaziland","SE" => "Sweden","CH" => "Switzerland","TJ" => "Tajikistan","TW" => "Chinese Taipei","TZ" => "Tanzania","TH" => "Thailand","TG" => "Togo","TK" => "Tokelau","TO" => "Tonga","TT" => "Trinidad & Tobago","TN" => "Tunisia","TR" => "Turkey","TM" => "Turkmenistan","TC" => "Turks & Caicos Islands","TV" => "Tuvalu","UM" => "USA Minor Outlying Isands","UG" => "Uganda","UA" => "Ukraine","AE" => "United Arab Emirates","US" => "United States","UY" => "Uruguay","UZ" => "Uzbekistan","VU" => "Vanuatu","VA" => "Vatican City State","VE" => "Venezuela","VN" => "Vietnam","VG" => "Virgin Islands (British)","VI" => "Virgin Islands (USA)","WF" => "Wallis & Futuna Islands","EH" => "Western Sahara","YE" => "Yemen","YU" => "Yugoslavia","ZM" => "Zambia","ZW" => "Zimbabwe","ZR" => "Zaire",
];
?>

<div class="mB10">
	<label for='country'>Country <small class="fc-red">* Required</small></label>
	<select class="select22 ltr" name="country" id="country" >
		<option value=""><?php echo T_("Choose your country"); ?></option>
		<?php foreach ($country_list as $key => $value) {?><option value="<?php echo $key ?>"<?php if(\dash\data::userSettingDataRow_country() == $key) { echo ' selected '; } ?>><?php echo $value ?></option><?php }//endif ?>
	</select>
</div>

<div class="f">
	<div class="c6 s12 pLa5">
		<label for="province">State/Province <small class="fc-red">* Required</small></label>
		<div class="input ltr">
			<input type="text" name="province" value="<?php echo \dash\data::userSettingDataRow_province(); ?>" placeholder2="<?php echo T_("State/Province"); ?>" id="province" maxlength="50">
		</div>
	</div>
	<div class="c6 s12">
		<label for="city">City <small class="fc-red">* Required</small></label>
		<div class="input ltr">
			<input type="text" name="city" value="<?php echo \dash\data::userSettingDataRow_city(); ?>" placeholder2="<?php echo T_("City"); ?>" id="city" maxlength="50">
		</div>
	</div>
</div>
<div class="f">
	<div class="c6 s12 pLa5">
		<label for="address">Address <small class="fc-red">* Required</small></label>
<div class="input ltr">
	<input type="text" placeholder2="<?php echo T_("Address"); ?>" name="address" value="<?php echo \dash\data::userSettingDataRow_address(); ?>" id="address" maxlength='60'>
</div>
	</div>
	<div class="c6 s12">
		<label for="postcode">Post code <small class="fc-red">* Required</small></label>
		<div class="input">
			<input type="text" placeholder2="<?php echo T_("Post code"); ?>" name="postcode" value="<?php echo \dash\data::userSettingDataRow_postcode(); ?>" id="postcode" data-format="postalCode">
		</div>
	</div>
</div>
<div class="f">
	<div class="c6 s12 pLa5">
		<label for="ifaxcc">Fax <small class="fc-red">* Required</small></label>
		<div class="f">
			<div class="cauto">
				<div class="input ltr">
					<input type="number" name="faxcc" value="<?php echo \dash\data::userSettingDataRow_faxcc(); ?>" placeholder="<?php echo T_("Code"); ?>" id="ifaxcc" max="999" min="1">
				</div>
			</div>
			<div class="c">
				<div class="input ltr">
					<input type="text" data-format='tel' name="fax" value="<?php echo \dash\data::userSettingDataRow_fax(); ?>" placeholder2="<?php echo T_("Fax"); ?>" id="ifax" maxlength="11">
				</div>
			</div>
		</div>

	</div>
	<div class="c6 s12 pLa5">
		<label for="iphonecc">Phone number <small class="fc-red">* Required</small></label>
		<div class="f">
			<div class="cauto">
				<div class="input ltr">
					<input type="number" name="phonecc" value="<?php echo \dash\data::userSettingDataRow_phonecc(); ?>" placeholder="<?php echo T_("Code"); ?>" id="iphonecc" max="999" min="1">
				</div>
			</div>
			<div class="c">
				<div class="input ltr">
					<input type="text" data-format='tel' name="phone" value="<?php echo \dash\data::userSettingDataRow_phone(); ?>" placeholder2="<?php echo T_("Phone"); ?>" id="iphone" maxlength="11">
				</div>
			</div>
		</div>

	</div>
</div>
<div class="msg danger2 mT20">
	<p><?php echo T_("Please enter the email you have access to. After registering any international domain, you must confirm the domain registration process by this image. Please be careful") ?></p>
	<label for="iemail">Email</label>
	<div class="input ltr">
		<input type="email" name="email" value="<?php echo \dash\data::userSettingDataRow_email(); ?>" placeholder2="<?php echo T_("Email"); ?>" id="iemail" maxlength="60">
	</div>

</div>
