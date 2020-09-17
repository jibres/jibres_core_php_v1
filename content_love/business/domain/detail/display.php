<?php require_once(root. 'content_love/business/domain/pageStep.php'); ?>
<form method="post" autocomplete="off">
  <div class="avand-md">
    <div class="box">
      <div class="body">
        <div class="msg">
          <a href="<?php echo \dash\url::protocol(). '://'. \dash\data::dataRow_domain() ?>" target="_blank"><?php echo \dash\data::dataRow_domain() ?> <i class="sf-link-external"></i></a>
        </div>
          <?php if(\dash\data::dataRow_store_id()) {?>
          <div class="msg info2"><?php echo T_("This domain connected to Business") ?></div>
        <?php }elseif(\dash\data::dataRow_domain_id()) {?>
          <div class="msg info2"><?php echo T_("This domain connected to Domain") ?></div>
        <?php }else{ ?>
          <div class="msg info2"><?php echo T_("This domain is not connected to any business or any domain!") ?></div>
        <?php } //endif ?>

        <div class="msg minimal"><?php echo T_("Status") ?> <span class="txtB"><?php echo \dash\data::dataRow_tstatus() ?></span></div>
        <div class="msg minimal"><?php echo T_("Date created") ?> <span class="txtB"><?php echo \dash\fit::date_time(\dash\data::dataRow_datecreated()) ?></span></div>

        <?php if(\dash\data::dataRow_checkdns()) {?>
          <div class="msg minimal f"><div class="c"><?php echo T_("DNS Resolved") ?></div> <div class="cauto ltr txtL compact"><?php echo \dash\fit::date_time(\dash\data::dataRow_checkdns()); ?></div></div>
          <?php if(\dash\data::dataRow_dnsok()) {?>
            <div class="msg minimal success2 f"><div class="c"><?php echo T_("DNS was set on our DNS record") ?></div> <div class="cauto ltr txtL compact"><?php echo \dash\fit::date_time(\dash\data::dataRow_dnsok()); ?></div></div>
          <?php }else{ ?>
            <div class="msg minimal danger2"><?php echo T_("DNS was is not set on our dns record") ?></div>
          <?php } //endif ?>
        <?php }else{ ?>
          <div class="msg minimal info2"><?php echo T_("DNS not resolved yet") ?></div>
        <?php } //endif ?>

         <?php if(\dash\data::dataRow_cdnpanel()) {?>
          <div class="msg minimal success2 f"><div class="c"><?php echo T_("Added to CDN panel") ?></div> <div class="cauto ltr txtL compact"><?php echo \dash\fit::date_time(\dash\data::dataRow_cdnpanel()); ?></div></div>
        <?php }else{ ?>
          <div class="msg minimal"><?php echo T_("Not add to CDN panel yet"); ?></div>
        <?php } //endif ?>

         <?php if(\dash\data::dataRow_httpsrequest()) {?>
          <div class="msg minimal f"><div class="c"><?php echo T_("Last HTTPS request date") ?></div> <div class="cauto ltr txtL compact"><?php echo \dash\fit::date_time(\dash\data::dataRow_httpsrequest()); ?></div></div>
        <?php }else{ ?>
          <div class="msg minimal"><?php echo T_("Not send HTTPS request to CDN panel yet"); ?></div>
        <?php } //endif ?>

        <?php if(\dash\data::dataRow_httpsverify()) {?>
          <div class="msg minimal success2"><?php echo T_("HTTPS ok") ?></div>
        <?php }else{ ?>
          <div class="msg minimal danger2"><?php echo T_("HTTPS not ok!") ?></div>
        <?php } //endif ?>
      </div>
    </div>
  </div>
</form>
