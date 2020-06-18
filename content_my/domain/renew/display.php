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

    <div class="input ltr">
        <input type="text" name="domain" placeholder='<?php echo T_("Domain"); ?>' value="<?php echo \dash\request::get('domain'); ?>">
    </div>


    <?php if(\dash\data::internationalDomain()) {?>

      <label><?php echo T_("Choose renew time"); ?></label>

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

    <?php }else{ ?>


        <label><?php echo T_("Choose register time"); ?></label>

        <div class="f mB10">
          <div class="c pB10 pRa5">
           <div class="radio3">
          <input type="radio" name="period" value="1year" id="period1year" <?php if(\dash\data::autorenewperiod() === '1year') { echo 'checked';} ?>>
          <label for="period1year"><?php echo T_("1 Year"); ?> <span> <?php echo \lib\app\nic_domain\price::renew_string("1year"); ?> </span></label>
           </div>
          </div>
          <div class="c pB10">
           <div class="radio3">
          <input type="radio" name="period" value="5year" id="period5year" <?php if(\dash\data::autorenewperiod() === '5year') { echo 'checked';} ?>>
          <label for="period5year"><?php echo T_("5 Year"); ?> <span> <?php echo \lib\app\nic_domain\price::renew_string("5year"); ?> </span></label>
           </div>
          </div>
        </div>


    <div class="check1 mT20">
      <input type="checkbox" id="sChk1" name="agree">
      <label for="sChk1"><?php
      echo T_("By clicking Renew, you are indicating that you have read the :nic and agree to the :terms.",
        [
          'nic' => '<a rel="nofollow" target="_blank" href="'. \dash\url::kingdom(). '/terms/irnic">'. T_('IRNIC agreement') .'</a>',
          'terms' => '<a rel="nofollow" target="_blank" href="'. \dash\url::kingdom(). '/terms">'. T_('Jibres Terms of Service') .'</a>'
        ])
    ?></label>
    </div>
    <?php } // endif ?>

    <div class="txtRa mT10">
     <button class="btn success"><?php echo T_("Renew Domain"); ?></button>
    </div>

   </form>


  </div>
 </div>
</div>

<?php } //endif ?>
