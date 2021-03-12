<?php if(!\dash\data::domainDetail_verify()) {?>
<section class="f" data-option='domain-remove'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Remove this domain from your account");?></h3>
      <div class="body">

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
