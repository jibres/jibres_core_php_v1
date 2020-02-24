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

    <form method="get" autocomplete="off" action="<?php echo \dash\url::current(); ?>">
    <label><?php echo T_("Choose register time based on price!"); ?></label>
    <div class="f">
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

    <label for="irnicid"><?php echo T_("IRNIC Handle"); ?></label>

    <div class="f">
<?php
if (\dash\data::myContactList())
{
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
}
else
{
?>
    <a target="_blank" href="<?php echo \dash\url::this(); ?>/irnic/add?type=new"><?php echo T_("Create new IRNIC Handle"); ?></a>
<?php
}
?>

     <div class="c6 s12 pB5 pRa5">
        <div class="radio3">
       <input type="radio" name="irnicid" value="something-else" id="ir-something-else">
       <label for="ir-something-else"><?php echo T_("Something else") ?></label>
        </div>
       </div>
    </div>

    <div data-response='irnicid' data-response-where='something-else' data-response-hide>
     <label for="irnicid"><?php echo T_("IRNIC id"); ?> <small><a href="<?php echo \dash\url::this() ?>/irnic/add?type=new" target="_blank" ><?php echo T_("Create new contact"); ?></a></small></label>
     <div class="input">
      <input type="text" name="irnicid" id="irnicid" maxlength="100">
     </div>
    </div>




     <?php if(\dash\data::myDNSList() && is_array(\dash\data::myDNSList())) {?>
     <label for="dnsid"><?php echo T_("DNS records"); ?> <small><a data-kerkere='.addNewDns' ><?php echo T_("Create new DNS"); ?></a></small></label>
     <select name="dnsid" class="select ui dropdown search addition" id="dnsid">
     <option value=""><?php echo T_("DNS record"); ?></option>
     <?php foreach (\dash\data::myDNSList() as $key => $value) {?>


       <option value="<?php echo \dash\coding::encode(\dash\get::index($value, 'id')); ?>" <?php if(isset($value['isdefault']) && $value['isdefault']) { echo "selected"; } ?>><?php echo implode(' - ', [\dash\get::index($value, 'title'), \dash\get::index($value, 'ns1'), \dash\get::index($value, 'ns2')]); ?></option>

     <?php } //endfor ?>
     </select>
    <?php } //endif ?>



    <div class='addNewDns' <?php if(\dash\data::myDNSList() && is_array(\dash\data::myDNSList())) {?> data-kerkere-content='hide' <?php } //endif ?>>

     <div class="f">
      <div class="c6 s12">
       <label for="ns1"><?php echo T_("DNS #1"); ?></label>
       <div class="input">
        <input type="text" name="ns1" id="ns1" maxlength="100">
       </div>
      </div>

      <div class="c6 s12">
       <div class="mLa5">
        <label for="ns2"><?php echo T_("DNS #2"); ?></label>
        <div class="input">
         <input type="text" name="ns2" id="ns2" maxlength="100">
        </div>
       </div>
      </div>


      <div class="c6 s12">
       <label for="ns3"><?php echo T_("DNS #3"); ?></label>
       <div class="input">
        <input type="text" name="ns3" id="ns3" maxlength="100">
       </div>
      </div>

      <div class="c6 s12">
       <div class="mLa5">
        <label for="ns4"><?php echo T_("DNS #4"); ?></label>
        <div class="input">
         <input type="text" name="ns4" id="ns4" maxlength="100">
        </div>
       </div>
      </div>

     </div>

    </div>



    <div class="check1">
      <input type="checkbox" name="agree" id="agree">
      <label for="agree"><?php echo T_("I have read and agree to the terms and conditions"); ?> <small><a target="_blank" href="https://www.nic.ir/Domain_Register_Policy.html"><?php echo T_("Show terms"); ?></a></small></label>
    </div>


    <div class="f mT20">
     <div class="cauto">

      <a href="<?php echo \dash\url::that() ?>" class="btn secondary"><?php echo T_("Cancel"); ?></a>
     </div>

     <div class="c"></div>

     <div class="cauto">
      <button class="btn success"><?php echo T_("Continue"); ?></button>

     </div>
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