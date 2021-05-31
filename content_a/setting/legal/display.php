<?php $policyPageDetail = \dash\data::policyPageDetail() ?>



<section class="f" data-option='setting-legal-about' id="setting-legal-about">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("About Us page"); ?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_aboutus_page" value="1">
    <div class="action">
     <select name="aboutus_page" class="select22" id="aboutUsPage"  data-model='html'  data-ajax--delay="100" data-ajax--url='<?php echo \dash\url::kingdom(). '/cms/posts/api'; ?>?json=true' data-shortkey-search data-placeholder='<?php echo T_("Select Shipping policy page"); ?>'>
        <?php if(a($policyPageDetail, 'aboutus_page', 'code')) {?>
          <option value="<?php echo  a($policyPageDetail, 'aboutus_page', 'code') ?>" selected><?php echo a($policyPageDetail, 'aboutus_page', 'detail', 'title') ?></option>
        <?php } //endif ?>
      </select>
    </div>
  </form>
  <footer class="txtRa">
    <a class="link btn" href="<?php echo \dash\url::kingdom(). '/cms/posts/add' ?>"><?php echo T_("Add Shipping policy") ?></a>
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
    <input type="hidden" name="set_refund_policy_page" value="1">
    <div class="action">
     <select name="refund_policy_page" class="select22" id="refundPolicyPage"  data-model='html'  data-ajax--delay="100" data-ajax--url='<?php echo \dash\url::kingdom(). '/cms/posts/api'; ?>?json=true' data-shortkey-search data-placeholder='<?php echo T_("Select Refund policy page"); ?>'>
        <?php if(a($policyPageDetail, 'refund_policy_page', 'code')) {?>
          <option value="<?php echo  a($policyPageDetail, 'refund_policy_page', 'code') ?>" selected><?php echo a($policyPageDetail, 'refund_policy_page', 'detail', 'title') ?></option>
        <?php } //endif ?>
      </select>
    </div>
  </form>
  <footer class="txtRa">
    <a class="link btn" href="<?php echo \dash\url::kingdom(). '/cms/posts/add' ?>"><?php echo T_("Add Refund policy") ?></a>
  </footer>
</section>



<section class="f" data-option='setting-legal-privacy-policy' id="setting-legal-privacy-policy">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Privacy policy"); ?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_privacy_policy_page" value="1">
    <div class="action">
     <select name="privacy_policy_page" class="select22" id="privacyPolicyPage"  data-model='html'  data-ajax--delay="100" data-ajax--url='<?php echo \dash\url::kingdom(). '/cms/posts/api'; ?>?json=true' data-shortkey-search data-placeholder='<?php echo T_("Select Privacy policy page"); ?>'>
        <?php if(a($policyPageDetail, 'privacy_policy_page', 'code')) {?>
          <option value="<?php echo  a($policyPageDetail, 'privacy_policy_page', 'code') ?>" selected><?php echo a($policyPageDetail, 'privacy_policy_page', 'detail', 'title') ?></option>
        <?php } //endif ?>
      </select>
    </div>
  </form>
  <footer class="txtRa">
    <a class="link btn" href="<?php echo \dash\url::kingdom(). '/cms/posts/add' ?>"><?php echo T_("Add Privacy policy") ?></a>
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
    <input type="hidden" name="set_termsofservice_policy_page" value="1">
    <div class="action">
     <select name="termsofservice_policy_page" class="select22" id="termsofservicePolicyPage"  data-model='html'  data-ajax--delay="100" data-ajax--url='<?php echo \dash\url::kingdom(). '/cms/posts/api'; ?>?json=true' data-shortkey-search data-placeholder='<?php echo T_("Select Terms of service page"); ?>'>
         <?php if(a($policyPageDetail, 'termsofservice_policy_page', 'code')) {?>
          <option value="<?php echo  a($policyPageDetail, 'termsofservice_policy_page', 'code') ?>" selected><?php echo a($policyPageDetail, 'termsofservice_policy_page', 'detail', 'title') ?></option>
        <?php } //endif ?>
      </select>
    </div>
  </form>
  <footer class="txtRa">
    <a class="link btn" href="<?php echo \dash\url::kingdom(). '/cms/posts/add' ?>"><?php echo T_("Add Terms of service") ?></a>
  </footer>
</section>





<section class="f" data-option='setting-legal-shipping-policy' id="setting-legal-shipping-policy">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Shipping policy"); ?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_shipping_policy_page" value="1">
    <div class="action">
     <select name="shipping_policy_page" class="select22" id="shippingPolicyPage"  data-model='html'  data-ajax--delay="100" data-ajax--url='<?php echo \dash\url::kingdom(). '/cms/posts/api'; ?>?json=true' data-shortkey-search data-placeholder='<?php echo T_("Select Shipping policy page"); ?>'>
         <?php if(a($policyPageDetail, 'shipping_policy_page', 'code')) {?>
          <option value="<?php echo  a($policyPageDetail, 'shipping_policy_page', 'code') ?>" selected><?php echo a($policyPageDetail, 'shipping_policy_page', 'detail', 'title') ?></option>
        <?php } //endif ?>
      </select>
    </div>
  </form>
  <footer class="txtRa">
    <a class="link btn" href="<?php echo \dash\url::kingdom(). '/cms/posts/add' ?>"><?php echo T_("Add Shipping policy") ?></a>
  </footer>
</section>

