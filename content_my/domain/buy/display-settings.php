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

     <div class="f mB10">
      <div class="c pB10 pRa5">
       <div class="radio3">
        <input type="radio" name="period" value="1year" id="period1year" <?php if(\dash\data::userSetting_autorenewperiod() === '1year') { echo 'checked';} ?>>
        <label for="period1year"><?php echo T_("1 Year"); ?> <span> <?php echo \lib\app\nic_domain\price::register_string("1year"); ?> </span></label>
       </div>
      </div>
      <div class="c pB10">
       <div class="radio3">
        <input type="radio" name="period" value="5year" id="period5year" <?php if(\dash\data::userSetting_autorenewperiod() === '5year') { echo 'checked';} ?>>
        <label for="period5year"><?php echo T_("5 Year"); ?> <span> <?php echo \lib\app\nic_domain\price::register_string("5year"); ?> </span></label>
       </div>
      </div>
     </div>


     <label for="irnicid"><?php echo T_("IRNIC Handle"); ?> <a href="<?php echo \dash\url::this() ?>/irnic/add?type=new" target="_blank" ><?php echo T_("Don't have IRNIC Handle? Create one."); ?></a></label>
     <div class="input ltr">
      <input type="text" name="irnicid-new" id="irnicid" maxlength="15" value="<?php echo \dash\data::myContactListDefault(); ?>">
     </div>

     <div class="block fs08" data-kerkere='.otherDomainHandle' data-kerkere-icon ><?php echo T_("If you want to customize domain Handle click here") ?></div>


     <div class="otherDomainHandle" data-kerkere-content='hide'>
      <div class="f">
       <div class="c4 s12 pRa5">
        <label for="irnic_admin"><?php echo T_("IRNIC Admin"); ?></label>
        <div class="input ltr">
         <input type="text" name="irnic_admin" id="irnic_admin" maxlength="50">
        </div>
       </div>
       <div class="c4 s12 pRa5">
        <label for="irnic_tech"><?php echo T_("IRNIC Tecnical"); ?></label>
        <div class="input ltr">
         <input type="text" name="irnic_tech" id="irnic_tech" maxlength="50">
        </div>
       </div>
       <div class="c4 s12">
        <label for="irnic_bill"><?php echo T_("IRNIC Billing"); ?></label>
        <div class="input ltr">
         <input type="text" name="irnic_bill" id="irnic_bill" maxlength="50">
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