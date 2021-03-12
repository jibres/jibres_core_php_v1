<?php if(!\dash\data::domainDetail_verify()) {?>
<section class="f" data-option='domain-remove'>
  <div class="c8 s12">
    <div class="data">
      <h3 class="mB0-f"><?php echo T_("Remove domain");?></h3>
      <div class="body">
        <p><?php echo T_("Do you want to remove this domain from your account?");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
      <div class="action">
        <div class="btn danger" data-confirm data-data='{"status" : "remove"}'><?php echo T_("Remove") ?></div>
      </div>
  </div>
</section>
<?php } //endif ?>
