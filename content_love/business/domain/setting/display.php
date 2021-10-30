<?php require_once(root. 'content_love/business/domain/pageStep.php'); ?>
<div class="avand-md">

    <form method="post" autocomplete="off">
    <input type="hidden" name="changecdn" value="changecdn">
    <div class="box">
      <header><h2><?php echo T_("CDN") ?></h2></header>
      <div class="body">
        <p><?php echo T_("Change CDN!") ?></p>
        <div class="radio3 mB10">
          <input type="radio" name="cdn" value="arvancloud" id="arvancloud" <?php if(\dash\data::dataRow_cdn() === 'arvancloud') {echo 'checked';} ?>>
          <label for="arvancloud">Arvan Cloud</label>
        </div>
        <div class="radio3 mB10">
          <input type="radio" name="cdn" value="cloudflare" id="cloudflare" <?php if(\dash\data::dataRow_cdn() === 'cloudflare') {echo 'checked';} ?>>
          <label for="cloudflare">Cloudflare</label>
        </div>

        <div class="radio3 mB10">
          <input type="radio" name="cdn" value="enterprise" id="enterprise" <?php if(\dash\data::dataRow_cdn() === 'enterprise') {echo 'checked';} ?>>
          <label for="enterprise">Enterprise</label>
        </div>


      </div>
      <footer class="txtRa">
          <button class="btn success"><?php echo T_("Save") ?></button>
      </footer>
    </div>
  </form>

  <form method="post" autocomplete="off">
    <input type="hidden" name="checkdns" value="checkdns">
    <div class="box">
      <header><h2><?php echo T_("DNS") ?></h2></header>
      <div class="body">
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


      </div>
      <footer class="txtRa">
          <button class="btn master"><?php echo T_("Check DNS") ?></button>
      </footer>
    </div>
  </form>


   <form method="post" autocomplete="off">

    <?php if(!\dash\data::dataRow_cdnpanel()) {?>
      <input type="hidden" name="addtocdnpanel" value="addtocdnpanel">
    <?php }else{ ?>
      <input type="hidden" name="removefromcdnpanel" value="removefromcdnpanel">
    <?php } //endif ?>

    <div class="box">
      <header><h2><?php echo T_("CDN panel status") ?></h2></header>
      <div class="body">
        <?php if(\dash\data::dataRow_cdnpanel()) {?>
          <div class="msg minimal success2 f"><div class="c"><?php echo T_("Added to CDN panel") ?></div> <div class="cauto ltr txtL compact"><?php echo \dash\fit::date_time(\dash\data::dataRow_cdnpanel()); ?></div></div>
        <?php }else{ ?>
          <div class="msg minimal"><?php echo T_("Not add to CDN panel yet"); ?></div>
        <?php } //endif ?>
      </div>
      <footer class="txtRa">
        <?php if(!\dash\data::dataRow_cdnpanel()) {?>
          <button class="btn master"><?php echo T_("Add to CDN panel Now!") ?></button>
        <?php }else{ ?>
          <button class="btn danger"><?php echo T_("Remove from CDN panel") ?></button>
        <?php } //endif ?>
      </footer>
    </div>
  </form>



   <form method="post" autocomplete="off">
     <input type="hidden" name="httpsrequest" value="httpsrequest">
    <div class="box">
      <header><h2><?php echo T_("HTTPS") ?></h2></header>
      <div class="body">
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
      <footer class="f">
        <div class="cauto"><div class="linkDel btn" data-confirm data-data='{"resethttps": "resethttps"}'><?php echo T_("Reset HTTPS date") ?></div></div>
        <div class="c"></div>
        <div class="cauto"><button class="btn master"><?php echo T_("Send HTTPS request") ?></button></div>

      </footer>
    </div>
  </form>



   <form method="post" autocomplete="off">
     <input type="hidden" name="changestatus" value="changestatus">
    <div class="box">
      <header><h2><?php echo T_("Status") ?></h2></header>
      <div class="body">
        <p><?php echo T_("You can change status of this domain maually") ?></p>
        <div>
          <select class="select22" name="status">
            <option value="pending" <?php if(\dash\data::dataRow_status() === 'pending') {echo 'selected';} ?>><?php echo T_('Pending') ?></option>
            <option value="failed" <?php if(\dash\data::dataRow_status() === 'failed') {echo 'selected';} ?>><?php echo T_('Failed') ?></option>
            <option value="ok" <?php if(\dash\data::dataRow_status() === 'ok') {echo 'selected';} ?>><?php echo T_('Ok') ?></option>
            <option value="pending_delete" <?php if(\dash\data::dataRow_status() === 'pending_delete') {echo 'selected';} ?>><?php echo T_('Pending_delete') ?></option>
            <option value="deleted" <?php if(\dash\data::dataRow_status() === 'deleted') {echo 'selected';} ?>><?php echo T_('Deleted') ?></option>
            <option value="inprogress" <?php if(\dash\data::dataRow_status() === 'inprogress') {echo 'selected';} ?>><?php echo T_('Inprogress') ?></option>
            <option value="dns_not_resolved" <?php if(\dash\data::dataRow_status() === 'dns_not_resolved') {echo 'selected';} ?>><?php echo T_('Dns_not_resolved') ?></option>
          </select>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Save") ?></button>

      </footer>
    </div>
  </form>



  <div class="box">
    <div class="body">
      <div class="f">
        <div class="c">
          <p class=""><?php echo T_("Something else") ?></p>
          <div data-confirm data-data='{"f_ssl_redirect": "true"}' class="link"><?php echo T_("Auto move HTTP to HTTPS") ?></div>
        </div>
      </div>
    </div>
  </div>


  <div class="box">
    <div class="body">
      <div class="f">
        <div class="c">
          <p class=""><?php echo T_("All action, dns record and Domain record of this domain will be removed") ?></p>
        </div>
        <div class="cauto pRa5">
          <div data-confirm data-data='{"removedomain": "removedomain"}' class="btn linkDel"><?php echo T_("Remove domain") ?></div>
        </div>
      </div>
    </div>
  </div>

</div>
