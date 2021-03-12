<section class="f" data-option='domain-lock'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Domain Transfer Lock");?></h3>
      <div class="body">
        <p class="mB10-f"><?php echo T_("From here, you can transfer your domain name to another person. To transfer out, you will need to make sure that Domain Lock is turned OFF and get an Auth Code. After you place the request here, we'll send your Auth Code to the registrant email address specified for this domain. It may take up to 5 days for the transfer to be completed."); ?></p>

        <?php  if( (string) \dash\data::domainDetail_lock() === '1') {?>
          <div class="msg minimal success2"><?php echo T_("Your domain is locked and safe.") ?></div>
        <?php  }elseif( (string) \dash\data::domainDetail_lock() === '0') {?>
          <div class="msg minimal danger2"><?php echo T_("Your domain is unlocked and ready to transfer!") ?></div>
        <?php } // nedif ?>
      </div>
    </div>
  </div>
  <div class="c4 s12">
      <div class="action">
        <a class="btn primary" href="<?php echo \dash\url::that(). '/transfer?domain='. \dash\request::get('domain') ?>"><?php echo T_("Manage Lock domain") ?></a>
      </div>
  </div>
</section>
