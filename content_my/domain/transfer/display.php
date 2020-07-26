<?php if(!\dash\data::myDomain()) {?>

  <div class="f justify-center">
    <div class="c6 m8 s12">
      <div class="cbox">


        <form method="get" autocomplete="off">

          <div class="input ltr mB10">
            <input type="text" name="domain" placeholder='<?php echo T_("Domain"); ?>' value="<?php echo \dash\request::get('domain'); ?>">
          </div>

          <div class="txtRa mT10">
            <button class="btn success"><?php echo T_("Transfer Domain"); ?></button>
          </div>

        </form>


      </div>
    </div>
  </div>

<?php }else{ ?>

  <div class="f justify-center">
    <div class="c6 m8 s12">
      <div class="cbox">


        <form method="post" autocomplete="off">

          <div class="input ltr mB10">
            <input type="text" name="domain" placeholder='<?php echo T_("Domain"); ?>' value="<?php echo \dash\request::get('domain'); ?>">
          </div>


          <div class="input ltr mB20">
            <input type="text" name="pin" placeholder='<?php echo T_("Transfer code"); ?>' >
          </div>

          <?php if(\dash\data::internationalDomain()) {?>

             <h4 data-kerkere='.showWhoisDetail' data-kerkere-icon><?php echo T_("Whois detail"); ?></h4>

            <div class="showWhoisDetail" <?php if(\dash\data::userSettingDataRow_email()) {echo "data-kerkere-content='hide'"; }?>  >
              <div class="ltr">

                <?php require_once(root. 'content_my/domain/whoisdetail/whoisDetailForm.php'); ?>

              </div>

            </div>
          <?php } // endit ?>

          <?php if(!\dash\data::internationalDomain()) {?>

            <label for="irnicid"><?php echo T_("IRNIC Handle"); ?> <a href="<?php echo \dash\url::this() ?>/irnic/add?type=new" target="_blank" ><?php echo T_("Don't have IRNIC Handle? Create one."); ?></a></label>
            <div class="input ltr">
              <input type="text" name="irnicid-new" id="irnicid" maxlength="15" value="<?php echo \dash\data::myContactListDefault(); ?>">
            </div>



            <div class="check1 mT20">
              <input type="checkbox" id="sChk1" name="agree">
              <label for="sChk1"><?php
              echo T_("By clicking Register, you are indicating that you have read the :nic and agree to the :terms.",
                [
                  'nic' => '<a rel="nofollow" target="_blank" href="'. \dash\url::kingdom(). '/terms/irnic">'. T_('IRNIC agreement') .'</a>',
                  'terms' => '<a rel="nofollow" target="_blank" href="'. \dash\url::kingdom(). '/terms">'. T_('Jibres Terms of Service') .'</a>'
                ])
                ?></label>
              </div>

            <?php }else{ ?>

              <p class="fc-mute mT10"><?php
              echo T_("By submit this form, you are indicating that you have agree to the :terms.",
                [
                  'terms' => '<a rel="nofollow" target="_blank" href="'. \dash\url::kingdom(). '/terms">'. T_('Jibres Terms of Service') .'</a>'
                ])
                ?></p>

            <?php } //endiof ?>

            <div class="txtRa mT10">
              <button class="btn success"><?php echo T_("Transfer Domain"); ?></button>
            </div>

          </form>


        </div>
      </div>
    </div>
  <?php } //endif ?>

