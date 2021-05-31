<?php
$policyPageDetail = \dash\data::policyPageDetail();

$currentPolicyPage = \dash\data::currentPolicyPage();


?>
<form method="post" autocomplete="off">
    <input type="hidden" name="set_<?php echo $currentPolicyPage; ?>" value="1">

  <div class="avand-sm">
    <div class="box">
      <div class="pad">
        <p><?php echo \dash\data::currentPolicyPageDetail_title(); ?></p>
              <select name="<?php echo $currentPolicyPage ?>" class="select22" id="privacyPolicyPage"  data-model='html'  data-ajax--delay="100" data-ajax--url='<?php echo \dash\url::kingdom(). '/cms/posts/api'; ?>?json=true' data-shortkey-search data-placeholder='<?php echo T_("Select from existing post"); ?>'>
        <?php if(a($policyPageDetail, $currentPolicyPage, 'code')) {?>
          <option value="<?php echo  a($policyPageDetail, $currentPolicyPage, 'code') ?>" selected><?php echo a($policyPageDetail, $currentPolicyPage, 'detail', 'title') ?></option>
        <?php } //endif ?>
      </select>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Save") ?></button>
      </footer>
    </div>
  </div>
</form>
