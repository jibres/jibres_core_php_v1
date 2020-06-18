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

                <?php require_once(root. 'content_my/domain/whoisdetail/whoisDetailForm.php'); ?>

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