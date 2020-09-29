<?php require_once (root. 'content_love/domain/setting/pageStep.php'); ?>
<div class="avand-md">
  <div class="box">
    <div class="body">
      <?php if(\dash\data::businessDomainDetail()) {?>
        <div class="msg success"><?php echo T_("This domain exist in business domain list") ?></div>
      <?php }else{ ?>
        <div class="msg warn2"><?php echo T_("Doamin was not found in business domain list") ?>
          <span class="btn link" data-confirm data-data='{"adddomain": "adddomain"}'><?php echo T_("Add now") ?></span>
        </div>

      <?php } //endif ?>
    </div>
  </div>
</div>