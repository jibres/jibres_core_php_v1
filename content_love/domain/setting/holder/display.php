<?php require_once (root. 'content_love/domain/setting/pageStep.php'); ?>
<div class="f justify-center">
 <div class="c9 m12 s12">
  <div class="cbox">
   <div class="msg minimal pLR20-f fs16 txtB ltr txtL success"><?php echo \dash\data::domainDetail_name() ?></div>

   <p class="msg info2"><?php echo T_('You can change domain technical and billing holder to another one to allow them to do some action.'); ?></p>
   <form method="post" autocomplete="off" >
       <label for="iholder"><?php echo T_("Domain Holder"); ?></label>
    <div class="input ltr">
     <input type="text" name="holder" id="iholder" maxlength="15" disabled value="<?php echo \dash\data::domainDetail_holder(); ?>" >
    </div>

    <label for="iadmin"><?php echo T_("Domain Admin"); ?></label>
    <div class="input ltr">
     <input type="text" name="admin" id="iadmin" maxlength="15" disabled value="<?php echo \dash\data::domainDetail_admin(); ?>" >
    </div>

    <label for="itech"><?php echo T_("Domain Technical"); ?></label>
    <div class="input ltr">
     <input type="text" name="tech" id="itech" maxlength="15" value="<?php echo \dash\data::domainDetail_tech(); ?>" >
    </div>

    <label for="ibill"><?php echo T_("Domain Billing"); ?></label>
    <div class="input ltr">
     <input type="text" name="bill" id="ibill" maxlength="15" value="<?php echo \dash\data::domainDetail_bill(); ?>" >
    </div>

    <div class="txtRa mT25">
     <button class="btn success"><?php echo T_("Update"); ?></button>
    </div>
   </form>
  </div>
 </div>
</div>
