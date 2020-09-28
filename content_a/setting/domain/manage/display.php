<div class="avand-lg">


  <?php if(\dash\data::domainDetail_status() === 'pending' && (\dash\data::domainDetail_subdomain() || \dash\data::domainDetail_cdn() === 'enterprise')) {?>
  <div class="box">
    <div class="body">
      <p>
        <?php echo T_("To connect a subdomain, you must log in to your domain management panel and set A record for that subdomain at the following address:") ?>
      <div class="msg ltr txtL"><span data-copy='business.jibres.com'><code>business.jibres.com</code></span></div>
      </p>
    </div>
  </div>
      <?php } //endif ?>



  <?php if(\dash\data::domainDetail_status() === 'pending') {?>
    <div class="box">
      <div class="body">
        <p><?php echo T_("The process of connecting a domain to a business may take several minutes") ?></p>
        <div class="mB20">
          <a class="checklist fc-black" <?php if(\dash\data::domainDetail_checkdns()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("DNS resolved"); ?></a>
          <a class="checklist fc-black" <?php if(\dash\data::domainDetail_dnsok()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("DNS is ok"); ?></a>
          <a class="checklist fc-black" <?php if(\dash\data::domainDetail_cdnpanel()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("Add to CDN panel"); ?></a>
          <a class="checklist fc-black" <?php if(\dash\data::domainDetail_httpsrequest()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("HTTPS Request"); ?></a>
          <a class="checklist fc-black" <?php if(\dash\data::domainDetail_httpsverify()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("HTTPS verify"); ?></a>
        </div>
      </div>
    </div>
  <?php } //endif ?>

  <form method="post" autocomplete="off" class="">
    <input type="hidden" name="adddns" value="adddns">
    <div class="box">
      <header><h2><?php echo T_("DNS records") ?></h2></header>
      <div class="body">
        <div class="row">
          <div class="c-xs-12 c-sm-2">
            <div>
              <label for="itype"><?php echo T_("Type") ?></label>
              <select class="select22" name="type" id="itype">
                <option value=""><?php echo T_("Type") ?></option>
                <option value="A">A</option>
                <option value="AAAA">AAAA</option>
                <option value="ANAME">ANAME</option>
                <option value="CNAME">CNAME</option>
                <option value="MX">MX</option>
                <option value="NS">NS</option>
                <option value="PTR">PTR</option>
                <?php if(false) {?>
                <option value="SOA">SOA</option>
                <option value="SRV">SRV</option>
              <?php } //endif ?>
                <option value="TXT">TXT</option>
              </select>
            </div>
          </div>
          <div class="c-xs-12 c-sm-5">
            <label for="ikey"><?php echo T_("Key") ?></label>
            <div class="input ltr">
              <input type="text" name="key" id="ikey" placeholder="Use @ for root">
            </div>
          </div>
          <div class="c-xs-12 c-sm-5">
            <label for="ivalue"><?php echo T_("Value") ?></label>
            <div class="input ltr">
              <input type="text" name="value" id="ivalue" placeholder="">
            </div>
          </div>
        </div>
      </div>
      <footer class="f">
        <div class="c"></div>
        <div class="cauto"><button class="btn master"><?php echo T_("Add DNS") ?></button></div>
      </footer>
    </div>
  </form>
        <?php if(\dash\data::dnsList()) {?>
          <table class="tbl1 v4 font-12 ">
            <thead>
              <tr>
                <th><?php echo T_("Type") ?></th>
                <th><?php echo T_("Key") ?></th>
                <th><?php echo T_("Value") ?></th>
                <th><?php echo T_("Status") ?></th>
                <th class="collapsing"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach (\dash\data::dnsList() as $key => $value) {?>
                <tr>
                  <td><?php echo \dash\get::index($value, 'type'); ?></td>
                  <td><?php echo \dash\get::index($value, 'key'); ?></td>
                  <td><?php echo \dash\get::index($value, 'value'); ?></td>
                  <td><?php echo \dash\get::index($value, 'tstatus'); ?></td>
                  <td class="collapsing">
                    <?php if(\dash\get::index($value, 'status') !== 'pending_delete') {?>
                      <?php if(\dash\get::index($value, 'allow_remove')) {?>
                        <div data-confirm data-data='{"removedns": "removedns", "dnsid": "<?php echo \dash\get::index($value, 'id'); ?>"}'><i class="sf-trash fc-red font-14"></i></div>
                      <?php } //endif ?>
                  <?php } //endif ?>
                  </td>

                </tr>
              <?php } // endif ?>
            </tbody>
          </table>
        <?php } // endif ?>



    <input type="hidden" name="setting" value="setting">
    <div class="box">
      <div class="body">
        <p><?php echo T_("Remove domain from your business") ?></p>
      </div>
      <footer class="f">
        <div class="c"></div>
        <div class="cauto"><a href="<?php echo \dash\url::that(). '/remove?'. \dash\request::fix_get() ?>" class="btn linkDel" ><?php echo T_("Remove domain") ?></a></div>
      </footer>
    </div>



</div>