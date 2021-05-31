<?php
$policyPageDetail = \dash\data::policyPageDetail();
$choose_url = \dash\url::that(). '/choosepage';
?>



<section class="f" data-option='setting-legal-about' id="setting-legal-about">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("About Us page"); ?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
     <?php if(a($policyPageDetail, 'aboutus_page', 'code')) {?>
        <a class="btn primary" href="<?php echo a($policyPageDetail, 'aboutus_page', 'detail', 'edit_link') ?>"><?php echo T_("Edit about us page") ?></a>
      <?php }else{ ?>
        <button data-ajaxify data-data='{"template": "template", "mode", "aboutus_page"}' class="btn primary"><?php echo T_("Create from template") ?></button>
      <?php } //endif ?>
    </div>
  </form>
  <footer class="txtRa">
    <?php if(\dash\data::havePublishedPost()) {?>
       <?php if(a($policyPageDetail, 'aboutus_page', 'code')) {?>
          <a class="btn link" href="<?php echo $choose_url . '?page=aboutus_page' ?>"><?php echo T_("Change with existing post") ?></a>
       <?php }else{ ?>
          <a class="btn link" href="<?php echo $choose_url . '?page=aboutus_page' ?>"><?php echo T_("Choose from existing post") ?></a>
       <?php } //endif ?>
   <?php } //endif ?>
  </footer>
</section>



<section class="f" data-option='setting-legal-refund-policy' id="setting-legal-refund-policy">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Refund policy"); ?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
     <?php if(a($policyPageDetail, 'refund_policy_page', 'code')) {?>
        <a class="btn primary" href="<?php echo a($policyPageDetail, 'refund_policy_page', 'detail', 'edit_link') ?>"><?php echo T_("Edit about us page") ?></a>
      <?php }else{ ?>
        <button data-ajaxify data-data='{"template": "template", "mode", "refund_policy_page"}' class="btn primary"><?php echo T_("Create from template") ?></button>
      <?php } //endif ?>
    </div>
  </form>
  <footer class="txtRa">
    <?php if(\dash\data::havePublishedPost()) {?>
       <?php if(a($policyPageDetail, 'refund_policy_page', 'code')) {?>
          <a class="btn link" href="<?php echo $choose_url . '?page=refund_policy_page' ?>"><?php echo T_("Change with existing post") ?></a>
       <?php }else{ ?>
          <a class="btn link" href="<?php echo $choose_url . '?page=refund_policy_page' ?>"><?php echo T_("Choose from existing post") ?></a>
       <?php } //endif ?>
   <?php } //endif ?>
  </footer>
</section>





<section class="f" data-option='setting-legal-privacy-policy' id="setting-legal-privacy-policy">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Pricacy policy"); ?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
     <?php if(a($policyPageDetail, 'privacy_policy_page', 'code')) {?>
        <a class="btn primary" href="<?php echo a($policyPageDetail, 'privacy_policy_page', 'detail', 'edit_link') ?>"><?php echo T_("Edit about us page") ?></a>
      <?php }else{ ?>
        <button data-ajaxify data-data='{"template": "template", "mode", "privacy_policy_page"}' class="btn primary"><?php echo T_("Create from template") ?></button>
      <?php } //endif ?>
    </div>
  </form>
  <footer class="txtRa">
    <?php if(\dash\data::havePublishedPost()) {?>
       <?php if(a($policyPageDetail, 'privacy_policy_page', 'code')) {?>
          <a class="btn link" href="<?php echo $choose_url . '?page=privacy_policy_page' ?>"><?php echo T_("Change with existing post") ?></a>
       <?php }else{ ?>
          <a class="btn link" href="<?php echo $choose_url . '?page=privacy_policy_page' ?>"><?php echo T_("Choose from existing post") ?></a>
       <?php } //endif ?>
   <?php } //endif ?>
  </footer>
</section>


<section class="f" data-option='setting-legal-termsofservice' id="setting-legal-termsofservice">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Terms of service"); ?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
     <?php if(a($policyPageDetail, 'termsofservice_page', 'code')) {?>
        <a class="btn primary" href="<?php echo a($policyPageDetail, 'termsofservice_page', 'detail', 'edit_link') ?>"><?php echo T_("Edit about us page") ?></a>
      <?php }else{ ?>
        <button data-ajaxify data-data='{"template": "template", "mode", "termsofservice_page"}' class="btn primary"><?php echo T_("Create from template") ?></button>
      <?php } //endif ?>
    </div>
  </form>
  <footer class="txtRa">
    <?php if(\dash\data::havePublishedPost()) {?>
       <?php if(a($policyPageDetail, 'termsofservice_page', 'code')) {?>
          <a class="btn link" href="<?php echo $choose_url . '?page=termsofservice_page' ?>"><?php echo T_("Change with existing post") ?></a>
       <?php }else{ ?>
          <a class="btn link" href="<?php echo $choose_url . '?page=termsofservice_page' ?>"><?php echo T_("Choose from existing post") ?></a>
       <?php } //endif ?>
   <?php } //endif ?>
  </footer>
</section>



