<?php if(!\dash\data::myDomain()) {?>

  <div class="f justify-center">
    <div class="c6 m8 s12">
      <form class="domainSearchBox cbox" action='<?php echo \dash\url::current() ?>' method='get' autocomplete='off'>
       <h4 class="txtC"><?php echo T_('Discover the perfect domain now'); ?></h4>
      <div class="input ltr">
       <input type="search" name="q" id='domainFirstSearch' maxlength='63' value="<?php echo \dash\request::get('q'); ?>" autocomplete='off' autofocus>
       <button class="addon btn primary"><?php echo T_('Search'); ?></button>
      </div>
     </form>
    </div>
  </div>

<?php if(\dash\request::get('q')) {?>
<div class="cbox">
<?php require_once (root. 'content/domains/search/domainSearchResult.php'); ?>
</div>
<?php }?>




<?php }else{ ?>

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
  </div>

  <?php } //endif ?>

  <?php if(\dash\data::checkResult()) {?>

   <?php if(\dash\data::checkResult_available()) {?>

    <form method="post" autocomplete="off">
    <label><?php echo T_("Choose register time"); ?></label>

    <div class="f mB10">
      <div class="c pB10 pRa5">
       <div class="radio3">
      <input type="radio" name="period" value="1year" id="period1year">
      <label for="period1year"><?php echo T_("1 Year"); ?> <span> <?php echo \lib\app\nic_domain\price::register_string("1year"); ?> </span></label>
       </div>
      </div>
      <div class="c pB10">
       <div class="radio3">
      <input type="radio" name="period" value="5year" id="period5year">
      <label for="period5year"><?php echo T_("5 Year"); ?> <span> <?php echo \lib\app\nic_domain\price::register_string("5year"); ?> </span></label>
       </div>
      </div>
    </div>


<?php
if (\dash\data::myContactList())
{
?>
    <label for="irnicid"><?php echo T_("IRNIC Handle"); ?> <small><?php echo T_("Holder IRNIC"); ?></small></label>
    <div class="f">
<?php
 foreach (\dash\data::myContactList() as $key => $value)
 {
?>
       <div class="c6 s12 pB5 pRa5">
        <div class="radio3">
       <input type="radio" name="irnicid" value="<?php echo \dash\get::index($value, 'nic_id'); ?>" id="ir-<?php echo \dash\get::index($value, 'nic_id'); ?>" <?php if(\dash\get::index($value, 'isdefault')) { echo 'checked';} ?>>
       <label for="ir-<?php echo \dash\get::index($value, 'nic_id'); ?>"><?php echo \dash\get::index($value, 'nic_id'); ?></label>
        </div>
       </div>
<?php
 }
?>
      <div class="c6 s12 pB5 pRa5">
        <div class="radio3">
        <input type="radio" name="irnicid" value="something-else" id="ir-something-else">
        <label for="ir-something-else"><?php echo T_("Another IRNIC Handle") ?></label>
        </div>
      </div>
    </div>
     <div data-response='irnicid' data-response-where='something-else' data-response-effect='slide' data-response-hide>
      <label for="irnicid"><?php echo T_("Enter Your new IRNIC Handle"); ?></label>
      <div class="input ltr">
       <input type="text" name="irnicid-new" id="irnicid" maxlength="15">
      </div>
     </div>

<?php
}
else
{
?>
      <label for="irnicid"><?php echo T_("IRNIC Handle"); ?> <a href="<?php echo \dash\url::this() ?>/irnic/add?type=new" target="_blank" ><?php echo T_("Don't have IRNIC Handle? Create one."); ?></a></label>
      <div class="input ltr">
       <input type="text" name="irnicid-new" id="irnicid" maxlength="15">
      </div>
<?php
}
?>

<label class="block" data-kerkere='.otherDomainHandle' data-kerkere-icon ><?php echo T_("Special domain Handle"); ?> <small><?php echo T_("If you wan to customize domain Handle click here") ?></small></label>


<div class="otherDomainHandle" data-kerkere-content='hide'>

  <div class="f">

    <div class="c4 s12">
     <label for="irnic_admin"><?php echo T_("IRNIC Admin"); ?></label>
     <div class="input ltr">
      <input type="text" name="irnic_admin" id="irnic_admin" maxlength="50">
     </div>
    </div>

    <div class="c4 s12">
     <div class="mLa5">
      <label for="irnic_tech"><?php echo T_("IRNIC Tecnical"); ?></label>
      <div class="input ltr">
       <input type="text" name="irnic_tech" id="irnic_tech" maxlength="50">
      </div>
     </div>
    </div>

    <div class="c4 s12">
     <div class="mLa5">
      <label for="irnic_bill"><?php echo T_("IRNIC Billing"); ?></label>
      <div class="input ltr">
       <input type="text" name="irnic_bill" id="irnic_bill" maxlength="50">
      </div>
     </div>
    </div>
  </div>

</div>

<br>

<?php if(\dash\data::myDNSList() && is_array(\dash\data::myDNSList())) {?>
    <label class="mT20"><?php echo T_("Enter your domain initial DNS record"); ?></label>
    <div class="f">
<?php foreach (\dash\data::myDNSList() as $key => $value) {?>

       <div class="c12 s12 pB5 pRa5">
        <div class="radio3">
       <input type="radio" name="dnsid" value="<?php echo \dash\coding::encode(\dash\get::index($value, 'id')); ?>" id="dns-<?php echo $key; ?>" <?php if(\dash\get::index($value, 'isdefault')) { echo 'checked';} ?>>
       <label for="dns-<?php echo $key; ?>"><?php if(\dash\get::index($value, 'title')) { echo \dash\get::index($value, 'title'). ' - '; } echo \dash\get::index($value, 'ns1') . ' - '. \dash\get::index($value, 'ns2'); ?></label>
        </div>
       </div>

<?php } //endfor ?>
      <div class="c12 s12 pB5 pRa5">
        <div class="radio3">
        <input type="radio" name="dnsid" value="something-else" id="dns-something-else">
        <label for="dns-something-else"><?php echo T_("Enter New DNS for this domain") ?></label>
        </div>
      </div>
    </div>
     <div data-response='dnsid' data-response-where='something-else' data-response-effect='slide' data-response-hide>

     <div class="f">
      <div class="c6 s12">
       <label for="ns1"><?php echo T_("DNS #1"); ?></label>
       <div class="input ltr">
        <input type="text" name="ns1" id="ns1" maxlength="100">
       </div>
      </div>

      <div class="c6 s12">
       <div class="mLa5">
        <label for="ns2"><?php echo T_("DNS #2"); ?></label>
        <div class="input ltr">
         <input type="text" name="ns2" id="ns2" maxlength="100">
        </div>
       </div>
      </div>
    </div>


     <div class="f">
      <div class="c6 s12">
       <label for="ns3"><?php echo T_("DNS #3"); ?></label>
       <div class="input ltr">
        <input type="text" name="ns3" id="ns3" maxlength="100">
       </div>
      </div>

      <div class="c6 s12">
       <div class="mLa5">
        <label for="ns4"><?php echo T_("DNS #2"); ?></label>
        <div class="input ltr">
         <input type="text" name="ns4" id="ns4" maxlength="100">
        </div>
       </div>
      </div>
    </div>


     </div>



<?php }else{ ?>


  <div class="f mT20">
    <div class="c6 s12">
     <label for="ns1"><?php echo T_("DNS #1"); ?></label>
     <div class="input ltr">
      <input type="text" name="ns1" id="ns1" maxlength="100">
     </div>
    </div>

    <div class="c6 s12">
     <div class="mLa5">
      <label for="ns2"><?php echo T_("DNS #2"); ?></label>
      <div class="input ltr">
       <input type="text" name="ns2" id="ns2" maxlength="100">
      </div>
     </div>
    </div>
  </div>



<?php } //endif ?>

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
     <button class="btn success"><?php echo T_("Register Domain"); ?></button>
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

<?php } //endif ?>