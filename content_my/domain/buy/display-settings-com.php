<div class="f justify-center">
  <div class="c6 m8 s12">
    <div class="cbox">

      <?php if(\dash\data::checkResult_available()) {?>
        <div class="msg minimal success2 txtC txtB mB10-f fs16">
          <?php echo \dash\data::myDomain(); ?>
        </div>
      <?php }else{ ?>
        <div class="msg minimal warn2 txtC txtB mB10-f fs16">
          <p><?php echo T_("Can not register this domain"); ?></p>
          <?php echo \dash\data::myDomain(); ?>
          <br>
          <a class="fs06 link" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Try another"); ?></a>
        </div>

      <?php } //endif ?>

      <?php if(\dash\data::checkResult()) {?>

        <?php if(\dash\data::checkResult_available()) {?>

          <form method="post" autocomplete="off">
            <label><?php echo T_("Choose register time"); ?></label>

            <div>
              <select name="period" class="select22">
                <option value="1" <?php if(\dash\data::userSetting_autorenewperiod() === '1year') { echo 'selected';} ?>><?php echo T_("1 Year") ?></option>
                <option value="2" <?php if(\dash\data::userSetting_autorenewperiod() === '2year') { echo 'selected';} ?>><?php echo T_("2 Year") ?></option>
                <option value="3" <?php if(\dash\data::userSetting_autorenewperiod() === '3year') { echo 'selected';} ?>><?php echo T_("3 Year") ?></option>
                <option value="4" <?php if(\dash\data::userSetting_autorenewperiod() === '4year') { echo 'selected';} ?>><?php echo T_("4 Year") ?></option>
                <option value="5" <?php if(\dash\data::userSetting_autorenewperiod() === '5year') { echo 'selected';} ?>><?php echo T_("5 Year") ?></option>
                <option value="6" <?php if(\dash\data::userSetting_autorenewperiod() === '6year') { echo 'selected';} ?>><?php echo T_("6 Year") ?></option>
                <option value="7" <?php if(\dash\data::userSetting_autorenewperiod() === '7year') { echo 'selected';} ?>><?php echo T_("7 Year") ?></option>
                <option value="8" <?php if(\dash\data::userSetting_autorenewperiod() === '8year') { echo 'selected';} ?>><?php echo T_("8 Year") ?></option>
                <option value="9" <?php if(\dash\data::userSetting_autorenewperiod() === '9year') { echo 'selected';} ?>><?php echo T_("9 Year") ?></option>
                <option value="10" <?php if(\dash\data::userSetting_autorenewperiod() === '10year') { echo 'selected';} ?>><?php echo T_("10 Year") ?></option>
              </select>
            </div>


            <div class="f mB10">
            <div class="c pB10 pRa5">
             <div class="radio3">
              <input type="radio" name="whoistype" value="jibreswhoisgard" id="jibresWhoisGard" checked>
              <label for="jibresWhoisGard"><?php echo T_("Use Jibres whois gard"); ?></label>
             </div>
            </div>
            <div class="c pB10">
             <div class="radio3">
              <input type="radio" name="whoistype" value="customizedetail" id="customizedetail" >
              <label for="customizedetail"><?php echo T_("I want to enter whois detail"); ?></label>
             </div>
            </div>
           </div>

            <div data-response='whoistype' data-response-where='customizedetail' data-response-hide>
              <div class="example ltr">

                <?php if(\dash\language::current() != 'en') {?>
                  <div class="msg danger2 rtl"><?php echo T_("Enter in Latin characters"); ?></div>
                <?php } //endif ?>
                <div class="f">
                  <div class="c6 s12 pLa5">
                    <label for="fullname">Full name</label>
                    <div class="input ltr">
                      <input type="text" name="fullname" placeholder2="<?php echo T_("Full name"); ?>" id="fullname" maxlength="60">
                    </div>
                  </div>
                  <div class="c6 s12">
                    <label for="org">Organization</label>
                    <div class="input ltr">
                      <input type="text" name="org" placeholder2="<?php echo T_("Organization"); ?>" id="org" maxlength="60">
                    </div>
                  </div>
                </div>





                <div class="mB10">
                  <label for='country'>Country</label>
                  <select class="select22 ltr" name="country" id="country" >
                    <option value=""><?php echo T_("Choose your country"); ?></option>
                    <option value="AU">Australia</option><option value="AF">Afghanistan</option><option value="AL">Albania</option><option value="DZ">Algeria</option><option value="AS">American Samoa</option><option value="AD">Andorra</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AQ">Antarctica</option><option value="AG">Antigua and Barbuda</option><option value="AR">Argentina</option><option value="AM">Armenia</option><option value="AW">Aruba</option><option value="AT">Austria</option><option value="AZ">Azerbaidjan</option><option value="BS">Bahamas</option><option value="BH">Bahrain</option><option value="BD">Bangladesh</option><option value="BB">Barbados</option><option value="BY">Belarus</option><option value="BE">Belgium</option><option value="BZ">Belize</option><option value="BJ">Benin</option><option value="BM">Bermuda</option><option value="BO">Bolivia</option><option value="BA">Bosnia-Herzegovina</option><option value="BW">Botswana</option><option value="BV">Bouvet Island</option><option value="BR">Brazil</option><option value="IO">British Indian Ocean</option><option value="BN">Brunei Darussalam</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="BT">Buthan</option><option value="KH">Cambodia</option><option value="CM">Cameroon</option><option value="CA">Canada</option><option value="CV">Cape Verde</option><option value="KY">Cayman Islands</option><option value="CF">Central African Rep.</option><option value="TD">Chad</option><option value="CL">Chile</option><option value="CN">China</option><option value="CX">Christmas Island</option><option value="CC">Cocos (Keeling) Islands</option><option value="CO">Colombia</option><option value="KM">Comoros</option><option value="CG">Congo</option><option value="CK">Cook Islands</option><option value="CR">Costa Rica</option><option value="HR">Croatia</option><option value="CY">Cyprus</option><option value="CZ">Czech Republic</option><option value="DK">Denmark</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="DO">Dominican Republic</option><option value="TP">East Timor</option><option value="EC">Ecuador</option><option value="EG">Egypt</option><option value="SV">El Salvador</option><option value="GQ">Equatorial Guinea</option><option value="EE">Estonia</option><option value="ET">Ethiopia</option><option value="FK">Falkland Islands</option><option value="FO">Faroe Islands</option><option value="FJ">Fiji</option><option value="FI">Finland</option><option value="SU">Former USSR</option><option value="FX">France (European Territories)</option><option value="FR">France</option><option value="TF">French Southern Territories</option><option value="GA">Gabon</option><option value="GM">Gambia</option><option value="GE">Georgia</option><option value="DE">Germany</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GB">United Kingdom</option><option value="GR">Greece</option><option value="GL">Greenland</option><option value="GD">Grenada</option><option value="GP">Guadeloupe (French)</option><option value="GU">Guam (USA)</option><option value="GT">Guatemala</option><option value="GW">Guinea Bissau</option><option value="GN">Guinea</option><option value="GF">Guyana (Fr.)</option><option value="GY">French Guyana</option><option value="HT">Haiti</option><option value="HM">Heard and McDonald Islands</option><option value="HN">Honduras</option><option value="HK">Hong Kong</option><option value="HU">Hungary</option><option value="IS">Iceland</option><option value="IN">India</option><option value="ID">Indonesia</option><option value="IQ">Iraq</option><option value="IE">Ireland</option><option value="IL">Israel</option><option value="IT">Italy</option><option value="CI">Ivory Coast (Cote D'I)</option><option value="JM">Jamaica</option><option value="JP">Japan</option><option value="JO">Jordan</option><option value="JF">Jothan Frakes Islands</option><option value="KZ">Kazachstan</option><option value="KE">Kenya</option><option value="KG">Kyrgyzstan</option><option value="KI">Kiribati</option><option value="KR">South Korea</option><option value="KW">Kuwait</option><option value="LA">Laos</option><option value="LV">Latvia</option><option value="LB">Lebanon</option><option value="LS">Lesotho</option><option value="LR">Liberia</option><option value="LY">Libya</option><option value="LI">Liechtenstein</option><option value="LT">Lithuania</option><option value="LU">Luxembourg</option><option value="MO">Macau</option><option value="MK">Macedonia</option><option value="MG">Madagascar</option><option value="MW">Malawi</option><option value="MY">Malaysia</option><option value="MV">Maldives</option><option value="ML">Mali</option><option value="MT">Malta</option><option value="MH">Marshall Islands</option><option value="MQ">Martinique (French)</option><option value="MR">Mauritania</option><option value="MU">Mauritius</option><option value="YT">Mayotte</option><option value="MX">Mexico</option><option value="FM">Micronesia</option><option value="MD">Moldavia</option><option value="MC">Monaco</option><option value="MN">Mongolia</option><option value="ME">Montenegro</option><option value="MS">Montserrat</option><option value="MA">Morocco</option><option value="MZ">Mozambique</option><option value="MM">Myanmar</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal</option><option value="AN">Netherland Antilles</option><option value="NL">Netherlands</option><option value="NC">New Caledonia (French)</option><option value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option value="NE">Niger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk Island</option><option value="MP">Northern Mariana Isl.</option><option value="NO">Norway</option><option value="EM">Office for Harmonization in the</option><option value="OM">Oman</option><option value="PK">Pakistan</option><option value="PW">Palau</option><option value="PA">Panama</option><option value="PG">Papua New Guinea</option><option value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Philippines</option><option value="PN">Pitcairn Island</option><option value="PL">Poland</option><option value="PF">Polynesia (Fr.)</option><option value="PT">Portugal</option><option value="ZN">Prince Nizam Zambri Isle</option><option value="PR">Puerto Rico (US)</option><option value="QA">Qatar</option><option value="RE">Reunion (Fr.)</option><option value="RO">Romania</option><option value="RU">Russian Federation</option><option value="RW">Rwanda</option><option value="GS">S. Georgia & S. Sandwich Islands</option><option value="LC">Saint Lucia</option><option value="WS">Samoa</option><option value="SM">San Marino</option><option value="SA">Saudi Arabia</option><option value="SN">Senegal</option><option value="SC">Seychelles</option><option value="SL">Sierra Leone</option><option value="SG">Singapore</option><option value="SK">Slovak Republic</option><option value="SI">Slovenia</option><option value="SB">Solomon Islands</option><option value="SO">Somalia</option><option value="ZA">South Africa</option><option value="ES">Spain</option><option value="LK">Sri Lanka</option><option value="SH">Saint Helena</option><option value="PM">Saint Pierre and Miqu</option><option value="ST">Saint Tome (Sao Tome)</option><option value="KN">Saint Kitts & Nevis</option><option value="VC">Saint Vincent & Grena</option><option value="RS">Serbia</option><option value="SR">Suriname</option><option value="SJ">Svalbard & Jan Mayen Is</option><option value="SZ">Swaziland</option><option value="SE">Sweden</option><option value="CH">Switzerland</option><option value="TJ">Tajikistan</option><option value="TW">Chinese Taipei</option><option value="TZ">Tanzania</option><option value="TH">Thailand</option><option value="TG">Togo</option><option value="TK">Tokelau</option><option value="TO">Tonga</option><option value="TT">Trinidad & Tobago</option><option value="TN">Tunisia</option><option value="TR">Turkey</option><option value="TM">Turkmenistan</option><option value="TC">Turks & Caicos Islands</option><option value="TV">Tuvalu</option><option value="UM">USA Minor Outlying Isands</option><option value="UG">Uganda</option><option value="UA">Ukraine</option><option value="AE">United Arab Emirates</option><option value="US">United States</option><option value="UY">Uruguay</option><option value="UZ">Uzbekistan</option><option value="VU">Vanuatu</option><option value="VA">Vatican City State</option><option value="VE">Venezuela</option><option value="VN">Vietnam</option><option value="VG">Virgin Islands (British)</option><option value="VI">Virgin Islands (USA)</option><option value="WF">Wallis & Futuna Islands</option><option value="EH">Western Sahara</option><option value="YE">Yemen</option><option value="YU">Yugoslavia</option><option value="ZM">Zambia</option><option value="ZW">Zimbabwe</option><option value="ZR">Zaire</option>
                  </select>
                </div>

                <div class="f">
                  <div class="c6 s12 pLa5">
                    <label for="province">State/Province</label>
                    <div class="input ltr">
                      <input type="text" name="province" placeholder2="<?php echo T_("State/Province"); ?>" id="province" maxlength="50">
                    </div>
                  </div>
                  <div class="c6 s12">
                    <label for="city">City</label>
                    <div class="input ltr">
                      <input type="text" name="city" placeholder2="<?php echo T_("City"); ?>" id="city" maxlength="50">
                    </div>
                  </div>
                </div>




                <label for="address">Address</label>
                <textarea class="txt ltr mB10" placeholder2="<?php echo T_("Address"); ?>" name="address" id="address" maxlength='60' rows="1"></textarea>




                <div class="f">
                  <div class="c6 s12 pLa5">
                    <label for="postcode">Post code</label>
                    <div class="input">
                      <input type="text" placeholder2="<?php echo T_("Post code"); ?>" name="postcode" id="postcode" data-format="postalCode">
                    </div>
                  </div>
                  <div class="c6 s12 pLa5">
                    <label for="ifax">Fax</label>
                    <div class="input ltr">
                      <input type="tel" name="fax" placeholder2="<?php echo T_("Fax"); ?>" id="ifax" maxlength="100">
                    </div>
                  </div>
                </div>





                <div class="f">
                  <div class="c6 s12 pLa5">
                    <label for="iphone">Phone number</label>
                    <div class="input">
                      <input type="text" placeholder2="<?php echo T_("Phone Number"); ?>" name="phone" id="iphone" data-format="tel">
                    </div>
                  </div>
                  <div class="c6 s12 pLa5">
                    <label for="iemail">Email</label>
                    <div class="input ltr">
                      <input type="email" name="email" placeholder2="<?php echo T_("Email"); ?>" id="iemail" maxlength="100">
                    </div>
                  </div>
                </div>




              </div>

            </div>

            <br>



            <div class="f mT20">
              <div class="c6 s12">
                <label for="ns1"><?php echo T_("DNS #1"); ?></label>
                <div class="input ltr">
                  <input type="text" name="ns1" id="ns1" maxlength="100" value="<?php echo \dash\data::userSetting_ns1(); ?>" placeholder="<?php echo \dash\data::defaultNDS1(); ?>" >
                </div>
              </div>
              <div class="c6 s12">
                <div class="mLa5">
                  <label for="ns2"><?php echo T_("DNS #2"); ?></label>
                  <div class="input ltr">
                    <input type="text" name="ns2" id="ns2" maxlength="100" value="<?php echo \dash\data::userSetting_ns2(); ?>" placeholder="<?php echo \dash\data::defaultNDS2(); ?>" >
                  </div>
                </div>
              </div>
            </div>

            <div class="block fs08" data-kerkere='.otherDomainDNS' data-kerkere-icon ><?php echo T_("If you have more DNS click here to set them") ?></div>

            <div class="otherDomainDNS" data-kerkere-content='hide'>
              <div class="f">
                <div class="c6 s12">
                  <label for="ns3"><?php echo T_("DNS #3"); ?></label>
                  <div class="input ltr">
                    <input type="text" name="ns3" id="ns3" maxlength="100" value="<?php echo \dash\data::userSetting_ns3(); ?>">
                  </div>
                </div>
                <div class="c6 s12">
                  <div class="mLa5">
                    <label for="ns4"><?php echo T_("DNS #4"); ?></label>
                    <div class="input ltr">
                      <input type="text" name="ns4" id="ns4" maxlength="100" value="<?php echo \dash\data::userSetting_ns4(); ?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <p class="fc-mute mT10"><?php
            echo T_("By submit this form, you are indicating that you have agree to the :terms.",
              [
                'terms' => '<a rel="nofollow" target="_blank" href="'. \dash\url::kingdom(). '/terms">'. T_('Jibres Terms of Service') .'</a>'
              ])
              ?></p>

              <div class="txtRa mT10">
                <button class="btn success"><?php echo T_("Review Detail"); ?></button>
              </div>

            </form>

          <?php }else{ ?>

            <div class="msg warn2">
              <div class="f">
                <div class="c">
                  <?php echo T_("Domain is occupied"); ?>
                </div>
                <div class="cauto">
                  <a class="btn warn" target="_blank" href="<?php echo \dash\url::kingdom(); ?>/whois/<?php echo \dash\data::myDomain(); ?>"><?php echo T_("Who is?"); ?></a>
                </div>
              </div>
            </div>

          <?php } //endif ?>


        <?php } //endif ?>
      </div>
    </div>
  </div>