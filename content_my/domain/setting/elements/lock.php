<section class="f" data-option='domain-lock'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Domain Transfer Lock");?></h3>
      <div class="body">
        <p><?php echo T_("In this section, you can manage domain transfer lock");?></p>
        <?php  if( (string) \dash\data::domainDetail_lock() === '1') {?>
          <div class="msg minimal success2"><?php echo T_("Your domain is locked") ?></div>
        <?php  }elseif( (string) \dash\data::domainDetail_lock() === '0') {?>
          <div class="msg minimal danger2"><?php echo T_("Your domain is unlocked and ready to transfer!") ?></div>
        <?php } // nedif ?>
      </div>
    </div>
  </div>
  <div class="c4 s12">
      <div class="action">
        <a class="btn secondary" href="<?php echo \dash\url::that(). '/transfer?domain='. \dash\request::get('domain') ?>"><?php echo T_("Manage Lock domain") ?></a>
      </div>
  </div>
</section>
