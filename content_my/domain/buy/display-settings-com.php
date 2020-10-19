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
                <?php foreach (\dash\data::internationalPriceList() as $key => $value) {?>
                  <option value="<?php echo \dash\get::index($value, 'period') ?>"><?php echo \dash\get::index($value, 'title'). ' ('. \dash\fit::number(\dash\get::index($value, 'price')). ' '. T_("Toman"). ')'; ?> </option>
                <?php } //endfor ?>
              </select>
            </div>

            <h4 data-kerkere='.showWhoisDetail' data-kerkere-icon><?php echo T_("Whois detail"); ?></h4>

            <div class="showWhoisDetail" <?php if(\dash\data::userSettingDataRow_email()) {echo "data-kerkere-content='hide'"; }?>  >
              <div class="ltr">

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