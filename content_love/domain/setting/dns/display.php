<?php require_once (root. 'content_love/domain/setting/pageStep.php'); ?>
<div class="f justify-center">
 <div class="c9 m12 s12">
  <div class="cbox">
   <div class="msg minimal pLR20-f fs16 txtB ltr txtL success"><?php echo \dash\data::domainDetail_name() ?></div>

   <p class="msg warn2"><?php echo T_('Filling the server IP address records (glue records) are required when you wish to set the name servers of a domain name to a hostname under the domain name itself.'); ?></p>
   <form method="post" autocomplete="off" >
      <div class="f">

        <div class="c6 s12 pRa5">
         <label for="ns1"><?php echo T_("DNS #1"); ?></label>
      <div class="input ltr">
       <input type="text" name="ns1" id="ns1" maxlength="50" value="<?php echo \dash\data::domainDetail_ns1(); ?>" >
      </div>

        </div>
        <div class="c6 s12">
      <label for="ip1"><?php echo T_("Server IP #1"); ?></label>
      <div class="input ltr">
       <input type="text" name="ip1" id="ip1" maxlength="16" value="<?php echo \dash\data::domainDetail_ip1(); ?>" >
      </div>
        </div>

        <div class="c6 s12 pRa5">
      <label for="ns2"><?php echo T_("DNS #2"); ?></label>
      <div class="input ltr">
       <input type="text" name="ns2" id="ns2" maxlength="50" value="<?php echo \dash\data::domainDetail_ns2(); ?>" >
      </div>
        </div>
        <div class="c6 s12">
      <label for="ip2"><?php echo T_("Server IP #2"); ?></label>
      <div class="input ltr">
       <input type="text" name="ip2" id="ip2" maxlength="16" value="<?php echo \dash\data::domainDetail_ip2(); ?>" >
      </div>
        </div>

        <div class="c6 s12 pRa5">
      <label for="ns3"><?php echo T_("DNS #3"); ?></label>
      <div class="input ltr">
       <input type="text" name="ns3" id="ns3" maxlength="50" value="<?php echo \dash\data::domainDetail_ns3(); ?>" >
      </div>
        </div>
        <div class="c6 s12">
       <label for="ip3"><?php echo T_("Server IP #3"); ?></label>
       <div class="input ltr">
        <input type="text" name="ip3" id="ip3" maxlength="16" value="<?php echo \dash\data::domainDetail_ip3(); ?>" >
       </div>
        </div>
        <div class="c6 s12 pRa5">
      <label for="ns4"><?php echo T_("DNS #4"); ?></label>
      <div class="input ltr">
       <input type="text" name="ns4" id="ns4" maxlength="50" value="<?php echo \dash\data::domainDetail_ns4(); ?>" >
      </div>
        </div>
        <div class="c6 s12">

       <label for="ip4"><?php echo T_("Server IP #4"); ?></label>
       <div class="input ltr">
        <input type="text" name="ip4" id="ip4" maxlength="16" value="<?php echo \dash\data::domainDetail_ip4(); ?>" >
       </div>
        </div>
       </div>


    <div class="txtRa mT25">
     <button class="btn success"><?php echo T_("Update"); ?></button>
    </div>
   </form>
  </div>
 </div>
</div>
