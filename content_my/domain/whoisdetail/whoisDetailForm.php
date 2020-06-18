
<?php if(\dash\language::current() == 'fa') {?>
	<div class="msg danger2 rtl"><?php echo T_("Enter in Latin characters"); ?></div>
<?php } //endif ?>
<div class="f">
	<div class="c6 s12 pLa5">
		<label for="fullname">Full name</label>
		<div class="input ltr">
			<input type="text" name="fullname" value="<?php echo \dash\data::userSettingDataRow_fullname(); ?>" placeholder2="<?php echo T_("Full name"); ?>" id="fullname" maxlength="60">
		</div>
	</div>
	<div class="c6 s12">
		<label for="org">Organization</label>
		<div class="input ltr">
			<input type="text" name="org" value="<?php echo \dash\data::userSettingDataRow_company(); ?>" placeholder2="<?php echo T_("Organization"); ?>" id="org" maxlength="60">
		</div>
	</div>
</div>





<div class="mB10">
	<label for='country'>Country</label>
	<select class="select22 ltr" name="country" id="country" >
		<option value=""><?php echo T_("Choose your country"); ?></option>
		<option value="AU"<?php if(\dash\data::userSettingDataRow_country() == 'AU') { echo ' selected '; } ?>>Australia</option>
		<option value="AF"<?php if(\dash\data::userSettingDataRow_country() == 'AF') { echo ' selected '; } ?>>Afghanistan</option>
		<option value="AL"<?php if(\dash\data::userSettingDataRow_country() == 'AL') { echo ' selected '; } ?>>Albania</option>
		<option value="DZ"<?php if(\dash\data::userSettingDataRow_country() == 'DZ') { echo ' selected '; } ?>>Algeria</option>
		<option value="AS"<?php if(\dash\data::userSettingDataRow_country() == 'AS') { echo ' selected '; } ?>>American Samoa</option>
		<option value="AD"<?php if(\dash\data::userSettingDataRow_country() == 'AD') { echo ' selected '; } ?>>Andorra</option>
		<option value="AO"<?php if(\dash\data::userSettingDataRow_country() == 'AO') { echo ' selected '; } ?>>Angola</option>
		<option value="AI"<?php if(\dash\data::userSettingDataRow_country() == 'AI') { echo ' selected '; } ?>>Anguilla</option>
		<option value="AQ"<?php if(\dash\data::userSettingDataRow_country() == 'AQ') { echo ' selected '; } ?>>Antarctica</option>
		<option value="AG"<?php if(\dash\data::userSettingDataRow_country() == 'AG') { echo ' selected '; } ?>>Antigua and Barbuda</option>
		<option value="AR"<?php if(\dash\data::userSettingDataRow_country() == 'AR') { echo ' selected '; } ?>>Argentina</option>
		<option value="AM"<?php if(\dash\data::userSettingDataRow_country() == 'AM') { echo ' selected '; } ?>>Armenia</option>
		<option value="AW"<?php if(\dash\data::userSettingDataRow_country() == 'AW') { echo ' selected '; } ?>>Aruba</option>
		<option value="AT"<?php if(\dash\data::userSettingDataRow_country() == 'AT') { echo ' selected '; } ?>>Austria</option>
		<option value="AZ"<?php if(\dash\data::userSettingDataRow_country() == 'AZ') { echo ' selected '; } ?>>Azerbaidjan</option>
		<option value="BS"<?php if(\dash\data::userSettingDataRow_country() == 'BS') { echo ' selected '; } ?>>Bahamas</option>
		<option value="BH"<?php if(\dash\data::userSettingDataRow_country() == 'BH') { echo ' selected '; } ?>>Bahrain</option>
		<option value="BD"<?php if(\dash\data::userSettingDataRow_country() == 'BD') { echo ' selected '; } ?>>Bangladesh</option>
		<option value="BB"<?php if(\dash\data::userSettingDataRow_country() == 'BB') { echo ' selected '; } ?>>Barbados</option>
		<option value="BY"<?php if(\dash\data::userSettingDataRow_country() == 'BY') { echo ' selected '; } ?>>Belarus</option>
		<option value="BE"<?php if(\dash\data::userSettingDataRow_country() == 'BE') { echo ' selected '; } ?>>Belgium</option>
		<option value="BZ"<?php if(\dash\data::userSettingDataRow_country() == 'BZ') { echo ' selected '; } ?>>Belize</option>
		<option value="BJ"<?php if(\dash\data::userSettingDataRow_country() == 'BJ') { echo ' selected '; } ?>>Benin</option>
		<option value="BM"<?php if(\dash\data::userSettingDataRow_country() == 'BM') { echo ' selected '; } ?>>Bermuda</option>
		<option value="BO"<?php if(\dash\data::userSettingDataRow_country() == 'BO') { echo ' selected '; } ?>>Bolivia</option>
		<option value="BA"<?php if(\dash\data::userSettingDataRow_country() == 'BA') { echo ' selected '; } ?>>Bosnia-Herzegovina</option>
		<option value="BW"<?php if(\dash\data::userSettingDataRow_country() == 'BW') { echo ' selected '; } ?>>Botswana</option>
		<option value="BV"<?php if(\dash\data::userSettingDataRow_country() == 'BV') { echo ' selected '; } ?>>Bouvet Island</option>
		<option value="BR"<?php if(\dash\data::userSettingDataRow_country() == 'BR') { echo ' selected '; } ?>>Brazil</option>
		<option value="IO"<?php if(\dash\data::userSettingDataRow_country() == 'IO') { echo ' selected '; } ?>>British Indian Ocean</option>
		<option value="BN"<?php if(\dash\data::userSettingDataRow_country() == 'BN') { echo ' selected '; } ?>>Brunei Darussalam</option>
		<option value="BG"<?php if(\dash\data::userSettingDataRow_country() == 'BG') { echo ' selected '; } ?>>Bulgaria</option>
		<option value="BF"<?php if(\dash\data::userSettingDataRow_country() == 'BF') { echo ' selected '; } ?>>Burkina Faso</option>
		<option value="BI"<?php if(\dash\data::userSettingDataRow_country() == 'BI') { echo ' selected '; } ?>>Burundi</option>
		<option value="BT"<?php if(\dash\data::userSettingDataRow_country() == 'BT') { echo ' selected '; } ?>>Buthan</option>
		<option value="KH"<?php if(\dash\data::userSettingDataRow_country() == 'KH') { echo ' selected '; } ?>>Cambodia</option>
		<option value="CM"<?php if(\dash\data::userSettingDataRow_country() == 'CM') { echo ' selected '; } ?>>Cameroon</option>
		<option value="CA"<?php if(\dash\data::userSettingDataRow_country() == 'CA') { echo ' selected '; } ?>>Canada</option>
		<option value="CV"<?php if(\dash\data::userSettingDataRow_country() == 'CV') { echo ' selected '; } ?>>Cape Verde</option>
		<option value="KY"<?php if(\dash\data::userSettingDataRow_country() == 'KY') { echo ' selected '; } ?>>Cayman Islands</option>
		<option value="CF"<?php if(\dash\data::userSettingDataRow_country() == 'CF') { echo ' selected '; } ?>>Central African Rep.</option>
		<option value="TD"<?php if(\dash\data::userSettingDataRow_country() == 'TD') { echo ' selected '; } ?>>Chad</option>
		<option value="CL"<?php if(\dash\data::userSettingDataRow_country() == 'CL') { echo ' selected '; } ?>>Chile</option>
		<option value="CN"<?php if(\dash\data::userSettingDataRow_country() == 'CN') { echo ' selected '; } ?>>China</option>
		<option value="CX"<?php if(\dash\data::userSettingDataRow_country() == 'CX') { echo ' selected '; } ?>>Christmas Island</option>
		<option value="CC"<?php if(\dash\data::userSettingDataRow_country() == 'CC') { echo ' selected '; } ?>>Cocos (Keeling) Islands</option>
		<option value="CO"<?php if(\dash\data::userSettingDataRow_country() == 'CO') { echo ' selected '; } ?>>Colombia</option>
		<option value="KM"<?php if(\dash\data::userSettingDataRow_country() == 'KM') { echo ' selected '; } ?>>Comoros</option>
		<option value="CG"<?php if(\dash\data::userSettingDataRow_country() == 'CG') { echo ' selected '; } ?>>Congo</option>
		<option value="CK"<?php if(\dash\data::userSettingDataRow_country() == 'CK') { echo ' selected '; } ?>>Cook Islands</option>
		<option value="CR"<?php if(\dash\data::userSettingDataRow_country() == 'CR') { echo ' selected '; } ?>>Costa Rica</option>
		<option value="HR"<?php if(\dash\data::userSettingDataRow_country() == 'HR') { echo ' selected '; } ?>>Croatia</option>
		<option value="CY"<?php if(\dash\data::userSettingDataRow_country() == 'CY') { echo ' selected '; } ?>>Cyprus</option>
		<option value="CZ"<?php if(\dash\data::userSettingDataRow_country() == 'CZ') { echo ' selected '; } ?>>Czech Republic</option>
		<option value="DK"<?php if(\dash\data::userSettingDataRow_country() == 'DK') { echo ' selected '; } ?>>Denmark</option>
		<option value="DJ"<?php if(\dash\data::userSettingDataRow_country() == 'DJ') { echo ' selected '; } ?>>Djibouti</option>
		<option value="DM"<?php if(\dash\data::userSettingDataRow_country() == 'DM') { echo ' selected '; } ?>>Dominica</option>
		<option value="DO"<?php if(\dash\data::userSettingDataRow_country() == 'DO') { echo ' selected '; } ?>>Dominican Republic</option>
		<option value="TP"<?php if(\dash\data::userSettingDataRow_country() == 'TP') { echo ' selected '; } ?>>East Timor</option>
		<option value="EC"<?php if(\dash\data::userSettingDataRow_country() == 'EC') { echo ' selected '; } ?>>Ecuador</option>
		<option value="EG"<?php if(\dash\data::userSettingDataRow_country() == 'EG') { echo ' selected '; } ?>>Egypt</option>
		<option value="SV"<?php if(\dash\data::userSettingDataRow_country() == 'SV') { echo ' selected '; } ?>>El Salvador</option>
		<option value="GQ"<?php if(\dash\data::userSettingDataRow_country() == 'GQ') { echo ' selected '; } ?>>Equatorial Guinea</option>
		<option value="EE"<?php if(\dash\data::userSettingDataRow_country() == 'EE') { echo ' selected '; } ?>>Estonia</option>
		<option value="ET"<?php if(\dash\data::userSettingDataRow_country() == 'ET') { echo ' selected '; } ?>>Ethiopia</option>
		<option value="FK"<?php if(\dash\data::userSettingDataRow_country() == 'FK') { echo ' selected '; } ?>>Falkland Islands</option>
		<option value="FO"<?php if(\dash\data::userSettingDataRow_country() == 'FO') { echo ' selected '; } ?>>Faroe Islands</option>
		<option value="FJ"<?php if(\dash\data::userSettingDataRow_country() == 'FJ') { echo ' selected '; } ?>>Fiji</option>
		<option value="FI"<?php if(\dash\data::userSettingDataRow_country() == 'FI') { echo ' selected '; } ?>>Finland</option>
		<option value="SU"<?php if(\dash\data::userSettingDataRow_country() == 'SU') { echo ' selected '; } ?>>Former USSR</option>
		<option value="FX"<?php if(\dash\data::userSettingDataRow_country() == 'FX') { echo ' selected '; } ?>>France (European Territories)</option>
		<option value="FR"<?php if(\dash\data::userSettingDataRow_country() == 'FR') { echo ' selected '; } ?>>France</option>
		<option value="TF"<?php if(\dash\data::userSettingDataRow_country() == 'TF') { echo ' selected '; } ?>>French Southern Territories</option>
		<option value="GA"<?php if(\dash\data::userSettingDataRow_country() == 'GA') { echo ' selected '; } ?>>Gabon</option>
		<option value="GM"<?php if(\dash\data::userSettingDataRow_country() == 'GM') { echo ' selected '; } ?>>Gambia</option>
		<option value="GE"<?php if(\dash\data::userSettingDataRow_country() == 'GE') { echo ' selected '; } ?>>Georgia</option>
		<option value="DE"<?php if(\dash\data::userSettingDataRow_country() == 'DE') { echo ' selected '; } ?>>Germany</option>
		<option value="GH"<?php if(\dash\data::userSettingDataRow_country() == 'GH') { echo ' selected '; } ?>>Ghana</option>
		<option value="GI"<?php if(\dash\data::userSettingDataRow_country() == 'GI') { echo ' selected '; } ?>>Gibraltar</option>
		<option value="GB"<?php if(\dash\data::userSettingDataRow_country() == 'GB') { echo ' selected '; } ?>>United Kingdom</option>
		<option value="GR"<?php if(\dash\data::userSettingDataRow_country() == 'GR') { echo ' selected '; } ?>>Greece</option>
		<option value="GL"<?php if(\dash\data::userSettingDataRow_country() == 'GL') { echo ' selected '; } ?>>Greenland</option>
		<option value="GD"<?php if(\dash\data::userSettingDataRow_country() == 'GD') { echo ' selected '; } ?>>Grenada</option>
		<option value="GP"<?php if(\dash\data::userSettingDataRow_country() == 'GP') { echo ' selected '; } ?>>Guadeloupe (French)</option>
		<option value="GU"<?php if(\dash\data::userSettingDataRow_country() == 'GU') { echo ' selected '; } ?>>Guam (USA)</option>
		<option value="GT"<?php if(\dash\data::userSettingDataRow_country() == 'GT') { echo ' selected '; } ?>>Guatemala</option>
		<option value="GW"<?php if(\dash\data::userSettingDataRow_country() == 'GW') { echo ' selected '; } ?>>Guinea Bissau</option>
		<option value="GN"<?php if(\dash\data::userSettingDataRow_country() == 'GN') { echo ' selected '; } ?>>Guinea</option>
		<option value="GF"<?php if(\dash\data::userSettingDataRow_country() == 'GF') { echo ' selected '; } ?>>Guyana (Fr.)</option>
		<option value="GY"<?php if(\dash\data::userSettingDataRow_country() == 'GY') { echo ' selected '; } ?>>French Guyana</option>
		<option value="HT"<?php if(\dash\data::userSettingDataRow_country() == 'HT') { echo ' selected '; } ?>>Haiti</option>
		<option value="HM"<?php if(\dash\data::userSettingDataRow_country() == 'HM') { echo ' selected '; } ?>>Heard and McDonald Islands</option>
		<option value="HN"<?php if(\dash\data::userSettingDataRow_country() == 'HN') { echo ' selected '; } ?>>Honduras</option>
		<option value="HK"<?php if(\dash\data::userSettingDataRow_country() == 'HK') { echo ' selected '; } ?>>Hong Kong</option>
		<option value="HU"<?php if(\dash\data::userSettingDataRow_country() == 'HU') { echo ' selected '; } ?>>Hungary</option>
		<option value="IS"<?php if(\dash\data::userSettingDataRow_country() == 'IS') { echo ' selected '; } ?>>Iceland</option>
		<option value="IN"<?php if(\dash\data::userSettingDataRow_country() == 'IN') { echo ' selected '; } ?>>India</option>
		<option value="ID"<?php if(\dash\data::userSettingDataRow_country() == 'ID') { echo ' selected '; } ?>>Indonesia</option>
		<option value="IQ"<?php if(\dash\data::userSettingDataRow_country() == 'IQ') { echo ' selected '; } ?>>Iraq</option>
		<option value="IE"<?php if(\dash\data::userSettingDataRow_country() == 'IE') { echo ' selected '; } ?>>Ireland</option>
		<option value="IL"<?php if(\dash\data::userSettingDataRow_country() == 'IL') { echo ' selected '; } ?>>Israel</option>
		<option value="IT"<?php if(\dash\data::userSettingDataRow_country() == 'IT') { echo ' selected '; } ?>>Italy</option>
		<option value="CI"<?php if(\dash\data::userSettingDataRow_country() == 'CI') { echo ' selected '; } ?>>Ivory Coast (Cote D'I)</option>
		<option value="JM"<?php if(\dash\data::userSettingDataRow_country() == 'JM') { echo ' selected '; } ?>>Jamaica</option>
		<option value="JP"<?php if(\dash\data::userSettingDataRow_country() == 'JP') { echo ' selected '; } ?>>Japan</option>
		<option value="JO"<?php if(\dash\data::userSettingDataRow_country() == 'JO') { echo ' selected '; } ?>>Jordan</option>
		<option value="JF"<?php if(\dash\data::userSettingDataRow_country() == 'JF') { echo ' selected '; } ?>>Jothan Frakes Islands</option>
		<option value="KZ"<?php if(\dash\data::userSettingDataRow_country() == 'KZ') { echo ' selected '; } ?>>Kazachstan</option>
		<option value="KE"<?php if(\dash\data::userSettingDataRow_country() == 'KE') { echo ' selected '; } ?>>Kenya</option>
		<option value="KG"<?php if(\dash\data::userSettingDataRow_country() == 'KG') { echo ' selected '; } ?>>Kyrgyzstan</option>
		<option value="KI"<?php if(\dash\data::userSettingDataRow_country() == 'KI') { echo ' selected '; } ?>>Kiribati</option>
		<option value="KR"<?php if(\dash\data::userSettingDataRow_country() == 'KR') { echo ' selected '; } ?>>South Korea</option>
		<option value="KW"<?php if(\dash\data::userSettingDataRow_country() == 'KW') { echo ' selected '; } ?>>Kuwait</option>
		<option value="LA"<?php if(\dash\data::userSettingDataRow_country() == 'LA') { echo ' selected '; } ?>>Laos</option>
		<option value="LV"<?php if(\dash\data::userSettingDataRow_country() == 'LV') { echo ' selected '; } ?>>Latvia</option>
		<option value="LB"<?php if(\dash\data::userSettingDataRow_country() == 'LB') { echo ' selected '; } ?>>Lebanon</option>
		<option value="LS"<?php if(\dash\data::userSettingDataRow_country() == 'LS') { echo ' selected '; } ?>>Lesotho</option>
		<option value="LR"<?php if(\dash\data::userSettingDataRow_country() == 'LR') { echo ' selected '; } ?>>Liberia</option>
		<option value="LY"<?php if(\dash\data::userSettingDataRow_country() == 'LY') { echo ' selected '; } ?>>Libya</option>
		<option value="LI"<?php if(\dash\data::userSettingDataRow_country() == 'LI') { echo ' selected '; } ?>>Liechtenstein</option>
		<option value="LT"<?php if(\dash\data::userSettingDataRow_country() == 'LT') { echo ' selected '; } ?>>Lithuania</option>
		<option value="LU"<?php if(\dash\data::userSettingDataRow_country() == 'LU') { echo ' selected '; } ?>>Luxembourg</option>
		<option value="MO"<?php if(\dash\data::userSettingDataRow_country() == 'MO') { echo ' selected '; } ?>>Macau</option>
		<option value="MK"<?php if(\dash\data::userSettingDataRow_country() == 'MK') { echo ' selected '; } ?>>Macedonia</option>
		<option value="MG"<?php if(\dash\data::userSettingDataRow_country() == 'MG') { echo ' selected '; } ?>>Madagascar</option>
		<option value="MW"<?php if(\dash\data::userSettingDataRow_country() == 'MW') { echo ' selected '; } ?>>Malawi</option>
		<option value="MY"<?php if(\dash\data::userSettingDataRow_country() == 'MY') { echo ' selected '; } ?>>Malaysia</option>
		<option value="MV"<?php if(\dash\data::userSettingDataRow_country() == 'MV') { echo ' selected '; } ?>>Maldives</option>
		<option value="ML"<?php if(\dash\data::userSettingDataRow_country() == 'ML') { echo ' selected '; } ?>>Mali</option>
		<option value="MT"<?php if(\dash\data::userSettingDataRow_country() == 'MT') { echo ' selected '; } ?>>Malta</option>
		<option value="MH"<?php if(\dash\data::userSettingDataRow_country() == 'MH') { echo ' selected '; } ?>>Marshall Islands</option>
		<option value="MQ"<?php if(\dash\data::userSettingDataRow_country() == 'MQ') { echo ' selected '; } ?>>Martinique (French)</option>
		<option value="MR"<?php if(\dash\data::userSettingDataRow_country() == 'MR') { echo ' selected '; } ?>>Mauritania</option>
		<option value="MU"<?php if(\dash\data::userSettingDataRow_country() == 'MU') { echo ' selected '; } ?>>Mauritius</option>
		<option value="YT"<?php if(\dash\data::userSettingDataRow_country() == 'YT') { echo ' selected '; } ?>>Mayotte</option>
		<option value="MX"<?php if(\dash\data::userSettingDataRow_country() == 'MX') { echo ' selected '; } ?>>Mexico</option>
		<option value="FM"<?php if(\dash\data::userSettingDataRow_country() == 'FM') { echo ' selected '; } ?>>Micronesia</option>
		<option value="MD"<?php if(\dash\data::userSettingDataRow_country() == 'MD') { echo ' selected '; } ?>>Moldavia</option>
		<option value="MC"<?php if(\dash\data::userSettingDataRow_country() == 'MC') { echo ' selected '; } ?>>Monaco</option>
		<option value="MN"<?php if(\dash\data::userSettingDataRow_country() == 'MN') { echo ' selected '; } ?>>Mongolia</option>
		<option value="ME"<?php if(\dash\data::userSettingDataRow_country() == 'ME') { echo ' selected '; } ?>>Montenegro</option>
		<option value="MS"<?php if(\dash\data::userSettingDataRow_country() == 'MS') { echo ' selected '; } ?>>Montserrat</option>
		<option value="MA"<?php if(\dash\data::userSettingDataRow_country() == 'MA') { echo ' selected '; } ?>>Morocco</option>
		<option value="MZ"<?php if(\dash\data::userSettingDataRow_country() == 'MZ') { echo ' selected '; } ?>>Mozambique</option>
		<option value="MM"<?php if(\dash\data::userSettingDataRow_country() == 'MM') { echo ' selected '; } ?>>Myanmar</option>
		<option value="NA"<?php if(\dash\data::userSettingDataRow_country() == 'NA') { echo ' selected '; } ?>>Namibia</option>
		<option value="NR"<?php if(\dash\data::userSettingDataRow_country() == 'NR') { echo ' selected '; } ?>>Nauru</option>
		<option value="NP"<?php if(\dash\data::userSettingDataRow_country() == 'NP') { echo ' selected '; } ?>>Nepal</option>
		<option value="AN"<?php if(\dash\data::userSettingDataRow_country() == 'AN') { echo ' selected '; } ?>>Netherland Antilles</option>
		<option value="NL"<?php if(\dash\data::userSettingDataRow_country() == 'NL') { echo ' selected '; } ?>>Netherlands</option>
		<option value="NC"<?php if(\dash\data::userSettingDataRow_country() == 'NC') { echo ' selected '; } ?>>New Caledonia (French)</option>
		<option value="NZ"<?php if(\dash\data::userSettingDataRow_country() == 'NZ') { echo ' selected '; } ?>>New Zealand</option>
		<option value="NI"<?php if(\dash\data::userSettingDataRow_country() == 'NI') { echo ' selected '; } ?>>Nicaragua</option>
		<option value="NE"<?php if(\dash\data::userSettingDataRow_country() == 'NE') { echo ' selected '; } ?>>Niger</option>
		<option value="NG"<?php if(\dash\data::userSettingDataRow_country() == 'NG') { echo ' selected '; } ?>>Nigeria</option>
		<option value="NU"<?php if(\dash\data::userSettingDataRow_country() == 'NU') { echo ' selected '; } ?>>Niue</option>
		<option value="NF"<?php if(\dash\data::userSettingDataRow_country() == 'NF') { echo ' selected '; } ?>>Norfolk Island</option>
		<option value="MP"<?php if(\dash\data::userSettingDataRow_country() == 'MP') { echo ' selected '; } ?>>Northern Mariana Isl.</option>
		<option value="NO"<?php if(\dash\data::userSettingDataRow_country() == 'NO') { echo ' selected '; } ?>>Norway</option>
		<option value="EM"<?php if(\dash\data::userSettingDataRow_country() == 'EM') { echo ' selected '; } ?>>Office for Harmonization in the</option>
		<option value="OM"<?php if(\dash\data::userSettingDataRow_country() == 'OM') { echo ' selected '; } ?>>Oman</option>
		<option value="PK"<?php if(\dash\data::userSettingDataRow_country() == 'PK') { echo ' selected '; } ?>>Pakistan</option>
		<option value="PW"<?php if(\dash\data::userSettingDataRow_country() == 'PW') { echo ' selected '; } ?>>Palau</option>
		<option value="PA"<?php if(\dash\data::userSettingDataRow_country() == 'PA') { echo ' selected '; } ?>>Panama</option>
		<option value="PG"<?php if(\dash\data::userSettingDataRow_country() == 'PG') { echo ' selected '; } ?>>Papua New Guinea</option>
		<option value="PY"<?php if(\dash\data::userSettingDataRow_country() == 'PY') { echo ' selected '; } ?>>Paraguay</option>
		<option value="PE"<?php if(\dash\data::userSettingDataRow_country() == 'PE') { echo ' selected '; } ?>>Peru</option>
		<option value="PH"<?php if(\dash\data::userSettingDataRow_country() == 'PH') { echo ' selected '; } ?>>Philippines</option>
		<option value="PN"<?php if(\dash\data::userSettingDataRow_country() == 'PN') { echo ' selected '; } ?>>Pitcairn Island</option>
		<option value="PL"<?php if(\dash\data::userSettingDataRow_country() == 'PL') { echo ' selected '; } ?>>Poland</option>
		<option value="PF"<?php if(\dash\data::userSettingDataRow_country() == 'PF') { echo ' selected '; } ?>>Polynesia (Fr.)</option>
		<option value="PT"<?php if(\dash\data::userSettingDataRow_country() == 'PT') { echo ' selected '; } ?>>Portugal</option>
		<option value="ZN"<?php if(\dash\data::userSettingDataRow_country() == 'ZN') { echo ' selected '; } ?>>Prince Nizam Zambri Isle</option>
		<option value="PR"<?php if(\dash\data::userSettingDataRow_country() == 'PR') { echo ' selected '; } ?>>Puerto Rico (US)</option>
		<option value="QA"<?php if(\dash\data::userSettingDataRow_country() == 'QA') { echo ' selected '; } ?>>Qatar</option>
		<option value="RE"<?php if(\dash\data::userSettingDataRow_country() == 'RE') { echo ' selected '; } ?>>Reunion (Fr.)</option>
		<option value="RO"<?php if(\dash\data::userSettingDataRow_country() == 'RO') { echo ' selected '; } ?>>Romania</option>
		<option value="RU"<?php if(\dash\data::userSettingDataRow_country() == 'RU') { echo ' selected '; } ?>>Russian Federation</option>
		<option value="RW"<?php if(\dash\data::userSettingDataRow_country() == 'RW') { echo ' selected '; } ?>>Rwanda</option>
		<option value="GS"<?php if(\dash\data::userSettingDataRow_country() == 'GS') { echo ' selected '; } ?>>S. Georgia & S. Sandwich Islands</option>
		<option value="LC"<?php if(\dash\data::userSettingDataRow_country() == 'LC') { echo ' selected '; } ?>>Saint Lucia</option>
		<option value="WS"<?php if(\dash\data::userSettingDataRow_country() == 'WS') { echo ' selected '; } ?>>Samoa</option>
		<option value="SM"<?php if(\dash\data::userSettingDataRow_country() == 'SM') { echo ' selected '; } ?>>San Marino</option>
		<option value="SA"<?php if(\dash\data::userSettingDataRow_country() == 'SA') { echo ' selected '; } ?>>Saudi Arabia</option>
		<option value="SN"<?php if(\dash\data::userSettingDataRow_country() == 'SN') { echo ' selected '; } ?>>Senegal</option>
		<option value="SC"<?php if(\dash\data::userSettingDataRow_country() == 'SC') { echo ' selected '; } ?>>Seychelles</option>
		<option value="SL"<?php if(\dash\data::userSettingDataRow_country() == 'SL') { echo ' selected '; } ?>>Sierra Leone</option>
		<option value="SG"<?php if(\dash\data::userSettingDataRow_country() == 'SG') { echo ' selected '; } ?>>Singapore</option>
		<option value="SK"<?php if(\dash\data::userSettingDataRow_country() == 'SK') { echo ' selected '; } ?>>Slovak Republic</option>
		<option value="SI"<?php if(\dash\data::userSettingDataRow_country() == 'SI') { echo ' selected '; } ?>>Slovenia</option>
		<option value="SB"<?php if(\dash\data::userSettingDataRow_country() == 'SB') { echo ' selected '; } ?>>Solomon Islands</option>
		<option value="SO"<?php if(\dash\data::userSettingDataRow_country() == 'SO') { echo ' selected '; } ?>>Somalia</option>
		<option value="ZA"<?php if(\dash\data::userSettingDataRow_country() == 'ZA') { echo ' selected '; } ?>>South Africa</option>
		<option value="ES"<?php if(\dash\data::userSettingDataRow_country() == 'ES') { echo ' selected '; } ?>>Spain</option>
		<option value="LK"<?php if(\dash\data::userSettingDataRow_country() == 'LK') { echo ' selected '; } ?>>Sri Lanka</option>
		<option value="SH"<?php if(\dash\data::userSettingDataRow_country() == 'SH') { echo ' selected '; } ?>>Saint Helena</option>
		<option value="PM"<?php if(\dash\data::userSettingDataRow_country() == 'PM') { echo ' selected '; } ?>>Saint Pierre and Miqu</option>
		<option value="ST"<?php if(\dash\data::userSettingDataRow_country() == 'ST') { echo ' selected '; } ?>>Saint Tome (Sao Tome)</option>
		<option value="KN"<?php if(\dash\data::userSettingDataRow_country() == 'KN') { echo ' selected '; } ?>>Saint Kitts & Nevis</option>
		<option value="VC"<?php if(\dash\data::userSettingDataRow_country() == 'VC') { echo ' selected '; } ?>>Saint Vincent & Grena</option>
		<option value="RS"<?php if(\dash\data::userSettingDataRow_country() == 'RS') { echo ' selected '; } ?>>Serbia</option>
		<option value="SR"<?php if(\dash\data::userSettingDataRow_country() == 'SR') { echo ' selected '; } ?>>Suriname</option>
		<option value="SJ"<?php if(\dash\data::userSettingDataRow_country() == 'SJ') { echo ' selected '; } ?>>Svalbard & Jan Mayen Is</option>
		<option value="SZ"<?php if(\dash\data::userSettingDataRow_country() == 'SZ') { echo ' selected '; } ?>>Swaziland</option>
		<option value="SE"<?php if(\dash\data::userSettingDataRow_country() == 'SE') { echo ' selected '; } ?>>Sweden</option>
		<option value="CH"<?php if(\dash\data::userSettingDataRow_country() == 'CH') { echo ' selected '; } ?>>Switzerland</option>
		<option value="TJ"<?php if(\dash\data::userSettingDataRow_country() == 'TJ') { echo ' selected '; } ?>>Tajikistan</option>
		<option value="TW"<?php if(\dash\data::userSettingDataRow_country() == 'TW') { echo ' selected '; } ?>>Chinese Taipei</option>
		<option value="TZ"<?php if(\dash\data::userSettingDataRow_country() == 'TZ') { echo ' selected '; } ?>>Tanzania</option>
		<option value="TH"<?php if(\dash\data::userSettingDataRow_country() == 'TH') { echo ' selected '; } ?>>Thailand</option>
		<option value="TG"<?php if(\dash\data::userSettingDataRow_country() == 'TG') { echo ' selected '; } ?>>Togo</option>
		<option value="TK"<?php if(\dash\data::userSettingDataRow_country() == 'TK') { echo ' selected '; } ?>>Tokelau</option>
		<option value="TO"<?php if(\dash\data::userSettingDataRow_country() == 'TO') { echo ' selected '; } ?>>Tonga</option>
		<option value="TT"<?php if(\dash\data::userSettingDataRow_country() == 'TT') { echo ' selected '; } ?>>Trinidad & Tobago</option>
		<option value="TN"<?php if(\dash\data::userSettingDataRow_country() == 'TN') { echo ' selected '; } ?>>Tunisia</option>
		<option value="TR"<?php if(\dash\data::userSettingDataRow_country() == 'TR') { echo ' selected '; } ?>>Turkey</option>
		<option value="TM"<?php if(\dash\data::userSettingDataRow_country() == 'TM') { echo ' selected '; } ?>>Turkmenistan</option>
		<option value="TC"<?php if(\dash\data::userSettingDataRow_country() == 'TC') { echo ' selected '; } ?>>Turks & Caicos Islands</option>
		<option value="TV"<?php if(\dash\data::userSettingDataRow_country() == 'TV') { echo ' selected '; } ?>>Tuvalu</option>
		<option value="UM"<?php if(\dash\data::userSettingDataRow_country() == 'UM') { echo ' selected '; } ?>>USA Minor Outlying Isands</option>
		<option value="UG"<?php if(\dash\data::userSettingDataRow_country() == 'UG') { echo ' selected '; } ?>>Uganda</option>
		<option value="UA"<?php if(\dash\data::userSettingDataRow_country() == 'UA') { echo ' selected '; } ?>>Ukraine</option>
		<option value="AE"<?php if(\dash\data::userSettingDataRow_country() == 'AE') { echo ' selected '; } ?>>United Arab Emirates</option>
		<option value="US"<?php if(\dash\data::userSettingDataRow_country() == 'US') { echo ' selected '; } ?>>United States</option>
		<option value="UY"<?php if(\dash\data::userSettingDataRow_country() == 'UY') { echo ' selected '; } ?>>Uruguay</option>
		<option value="UZ"<?php if(\dash\data::userSettingDataRow_country() == 'UZ') { echo ' selected '; } ?>>Uzbekistan</option>
		<option value="VU"<?php if(\dash\data::userSettingDataRow_country() == 'VU') { echo ' selected '; } ?>>Vanuatu</option>
		<option value="VA"<?php if(\dash\data::userSettingDataRow_country() == 'VA') { echo ' selected '; } ?>>Vatican City State</option>
		<option value="VE"<?php if(\dash\data::userSettingDataRow_country() == 'VE') { echo ' selected '; } ?>>Venezuela</option>
		<option value="VN"<?php if(\dash\data::userSettingDataRow_country() == 'VN') { echo ' selected '; } ?>>Vietnam</option>
		<option value="VG"<?php if(\dash\data::userSettingDataRow_country() == 'VG') { echo ' selected '; } ?>>Virgin Islands (British)</option>
		<option value="VI"<?php if(\dash\data::userSettingDataRow_country() == 'VI') { echo ' selected '; } ?>>Virgin Islands (USA)</option>
		<option value="WF"<?php if(\dash\data::userSettingDataRow_country() == 'WF') { echo ' selected '; } ?>>Wallis & Futuna Islands</option>
		<option value="EH"<?php if(\dash\data::userSettingDataRow_country() == 'EH') { echo ' selected '; } ?>>Western Sahara</option>
		<option value="YE"<?php if(\dash\data::userSettingDataRow_country() == 'YE') { echo ' selected '; } ?>>Yemen</option>
		<option value="YU"<?php if(\dash\data::userSettingDataRow_country() == 'YU') { echo ' selected '; } ?>>Yugoslavia</option>
		<option value="ZM"<?php if(\dash\data::userSettingDataRow_country() == 'ZM') { echo ' selected '; } ?>>Zambia</option>
		<option value="ZW"<?php if(\dash\data::userSettingDataRow_country() == 'ZW') { echo ' selected '; } ?>>Zimbabwe</option>
		<option value="ZR"<?php if(\dash\data::userSettingDataRow_country() == 'ZR') { echo ' selected '; } ?>>Zaire</option>
	</select>
</div>

<div class="f">
	<div class="c6 s12 pLa5">
		<label for="province">State/Province</label>
		<div class="input ltr">
			<input type="text" name="province" value="<?php echo \dash\data::userSettingDataRow_province(); ?>" placeholder2="<?php echo T_("State/Province"); ?>" id="province" maxlength="50">
		</div>
	</div>
	<div class="c6 s12">
		<label for="city">City</label>
		<div class="input ltr">
			<input type="text" name="city" value="<?php echo \dash\data::userSettingDataRow_city(); ?>" placeholder2="<?php echo T_("City"); ?>" id="city" maxlength="50">
		</div>
	</div>
</div>




<label for="address">Address</label>
<div class="input ltr">
	<input type="text" placeholder2="<?php echo T_("Address"); ?>" name="address" value="<?php echo \dash\data::userSettingDataRow_address(); ?>" id="address" maxlength='60'>
</div>




<div class="f">
	<div class="c6 s12 pLa5">
		<label for="ifaxcc">Fax</label>
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
		<label for="postcode">Post code</label>
		<div class="input">
			<input type="text" placeholder2="<?php echo T_("Post code"); ?>" name="postcode" value="<?php echo \dash\data::userSettingDataRow_postcode(); ?>" id="postcode" data-format="postalCode">
		</div>
	</div>
</div>





<div class="f">
	<div class="c6 s12 pLa5">
		<label for="iphonecc">Phone number</label>
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
	<div class="c6 s12 pLa5">
		<label for="iemail">Email</label>
		<div class="input ltr">
			<input type="email" name="email" value="<?php echo \dash\data::userSettingDataRow_email(); ?>" placeholder2="<?php echo T_("Email"); ?>" id="iemail" maxlength="60">
		</div>
	</div>
</div>