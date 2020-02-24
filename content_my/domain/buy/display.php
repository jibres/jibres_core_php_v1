<?php if(!\dash\data::myDomain()) {?>

<div class="cbox">

  <form class="domainSearchBox" action='<?php echo \dash\url::current() ?>' method='get' autocomplete='off'>
   <h4 class="txtC"><?php echo T_('Discover the perfect domain now'); ?></h4>
  <div class="input ltr">
   <input type="text" name="q" id='domainFirstSearch' maxlength='63' value="<?php echo \dash\request::get('q'); ?>" autocomplete='off'>
   <button class="addon btn primary"><?php echo T_('Search'); ?></button>
  </div>
 </form>
<?php require_once (root. 'content/domains/search/domainSearchResult.php'); ?>
</div>




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
      <label for="period1year"><?php echo T_("1 Year"); ?> <span> <?php echo \dash\fit::number('3000'). ' '. T_("Toman"); ?> </span></label>
       </div>
      </div>
      <div class="c pB10">
       <div class="radio3">
      <input type="radio" name="period" value="5year" id="period5year">
      <label for="period5year"><?php echo T_("5 Year"); ?> <span> <?php echo \dash\fit::number('12000'). ' '. T_("Toman"); ?> </span></label>
       </div>
      </div>
    </div>


<?php
if (\dash\data::myContactList())
{
?>
    <label for="irnicid"><?php echo T_("IRNIC Handle"); ?></label>
    <div class="f">
<?php
 foreach (\dash\data::myContactList() as $key => $value)
 {
?>
       <div class="c6 s12 pB5 pRa5">
        <div class="radio3">
       <input type="radio" name="irnicid" value="<?php echo \dash\get::index($value, 'nic_id'); ?>" id="ir-<?php echo \dash\get::index($value, 'nic_id'); ?>">
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



<?php if(\dash\data::myDNSList() && is_array(\dash\data::myDNSList())) {?>
    <label class="mT20"><?php echo T_("Enter your domain initial DNS record"); ?></label>
    <div class="f">
<?php foreach (\dash\data::myDNSList() as $key => $value) {?>

       <div class="c12 s12 pB5 pRa5">
        <div class="radio3">
       <input type="radio" name="dnsid" value="<?php echo \dash\coding::encode(\dash\get::index($value, 'id')); ?>" id="dns-<?php echo $key; ?>">
       <label for="dns-<?php echo $key; ?>"><?php echo \dash\get::index($value, 'ns1') . ' - '. \dash\get::index($value, 'ns2'); ?></label>
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




 <p class="fc-mute"><?php
  echo T_("By clicking Register, you are indicating that you have read the :nic and agree to the :terms.",
    [
      'nic' => '<a rel="nofollow" target="_blank" href="'. \dash\url::kingdom(). '/terms/irnic">'. T_('IRNIC agreement') .'</a>',
      'terms' => '<a rel="nofollow" target="_blank" href="'. \dash\url::kingdom(). '/terms">'. T_('Jibres Terms of Service') .'</a>'
    ])
?></p>

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