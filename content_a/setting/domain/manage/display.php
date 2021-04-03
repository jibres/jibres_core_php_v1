<div class="avand-lg">
  <div class="box">
    <div class="body">
      <div class="f">
        <div class="cauto fc-mute"><?php echo \dash\data::domainDetail_tstatus(); ?></div>
        <div class="c"></div>
        <div class="cauto">
          <div class="txtB ltr">
            <a href="<?php echo \dash\url::protocol(). '://'. \dash\data::domainDetail_domain();  ?>" target="_blank"><?php echo \dash\data::domainDetail_domain() ?> <i class="sf-link-external"></i></a>
          </div>
        </div>
      </div>

    </div>
  </div>

  <?php if(\dash\data::domainDetail_status() === 'pending' && (\dash\data::domainDetail_subdomain() || \dash\data::domainDetail_cdn() !== 'enterprise')) {?>
  <div class="box">
    <div class="body">
      <p>
        <?php echo T_("To connect a subdomain, you must log in to your domain management panel and set CNAME record for that subdomain at the following address:") ?>
        <table class="tbl1 v4 minimal ltr txtL">
          <thead class="font-12">
            <tr>
              <th class="ltr txtL">Type</th>
              <th class="ltr txtL">Key</th>
              <th class="ltr txtL">Value</th>
            </tr>
          </thead>
          <tbody>
            <tr class="ltr txtL">
              <td class="ltr txtL">CNAME</td>
              <td class="ltr txtL" data-copy='<?php echo \dash\data::domainDetail_subdomain() ?>'><?php echo \dash\data::domainDetail_subdomain() ?></td>
              <td class="ltr txtL"><span data-copy='business.jibres.ir'><code>business.jibres.ir</code></span></td>
            </tr>
          </tbody>
        </table>
      </p>
    </div>
  </div>
      <?php } //endif ?>



  <?php if(\dash\data::domainDetail_status() === 'pending' && !\dash\data::domainDetail_subdomain() && \dash\data::domainDetail_cdn() !== 'enterprise') {?>
    <div class="box">
      <div class="body">
        <p><?php echo T_("The process of connecting a domain to a business may take several minutes") ?></p>
        <div class="mB20">
          <a class="checklist fc-black" <?php if(\dash\data::domainDetail_checkdns()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("DNS resolved"); ?></a>
          <a class="checklist fc-black" <?php if(\dash\data::domainDetail_cdnpanel()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("Add to CDN panel"); ?></a>
          <a class="checklist fc-black" <?php if(\dash\data::domainDetail_httpsrequest()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("HTTPS Request"); ?></a>
          <a class="checklist fc-black" <?php if(\dash\data::domainDetail_httpsverify()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("HTTPS verify"); ?></a>
        </div>
        <div class="msg minumal">
          <?php echo T_("To connect domain, all DNS servers must identify your domain DNS. The following link can show you the DNS status of your domain") ?>
          <a class="link" target="_blank" href="https://dnschecker.org/#NS/<?php echo \dash\data::domainDetail_domain() ?>"><?php echo T_("Check DNS") ?></a>
        </div>
      </div>
    </div>
  <?php } //endif ?>

  <?php if(\dash\data::domainDetail_cdnpanel()) {?>

  <form method="post" autocomplete="off" class="">
    <input type="hidden" name="adddns" value="adddns">
    <div class="box">
      <header><h2><?php echo T_("DNS records") ?></h2></header>
      <div class="body">
        <div class="row ltr">
          <div class="c-xs-12 c-sm-2">
            <label for="itype">Type</label>
            <div class="txtL">
              <select class="select22 ltr txtL" name="type" id="itype">
                <option value="">Type</option>
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
          <div class="c-xs-12 c-sm">
            <label for="ikey">Key</label>
            <div class="input ltr">
              <input type="text" name="key" id="ikey" placeholder="Use @ for root">
            </div>
          </div>
          <div class="c-xs-12 c-sm">
            <label for="ivalue">Value</label>
            <div class="input ltr">
              <input type="text" name="value" id="ivalue" placeholder="">
            </div>
          </div>
          <div data-response='type' data-response-where='MX' data-response-hide>
            <div class="c-xs-12 c-sm">
              <label for="ipriority">Priority</label>
              <div class="input ltr">
                <input type="tel" name="priority" id="ipriority" placeholder="" maxlength="5" min="0" max="65535">
              </div>
            </div>
          </div>

        </div>
      </div>
      <footer class="f">
        <div class="cauto"><button class="btn master">Add</button></div>
        <div class="c"></div>
      </footer>
    </div>
  </form>

        <?php if(\dash\data::dnsList()) {?>
          <?php $have_any_record = false; foreach (\dash\data::dnsList() as $key => $value) { if(a($value, 'allow_remove')) { $have_any_record = true; } }?>

          <?php if($have_any_record) {?>
            <div class="tblBox">
              <table class="tbl1 v4 font-12 ltr txtL">
                <thead>
                  <tr>
                    <th class="ltr txtL">Type</th>
                    <th class="ltr txtL">Key</th>
                    <th class="ltr txtL">Value</th>
                    <th class="ltr txtL s0">Status</th>
                    <th class="ltr txtL"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach (\dash\data::dnsList() as $key => $value) {?>
                          <?php if(a($value, 'allow_remove')) {?>
                    <tr class="txtL">
                      <td class="ltr txtL"><?php echo a($value, 'type'); ?></td>
                      <td class="ltr txtL"><?php echo a($value, 'key'); ?></td>
                      <td class="ltr txtL"><?php echo a($value, 'value'); ?>
                        <?php if(a($value, 'priority')) { ?>
                          <div class="badge" title="Priority"><?php echo a($value, 'priority'); ?></div>
                        <?php }  // end if?>
                      </td>
                      <td class="ltr txtL s0"><?php echo a($value, 'status'); ?></td>
                      <td class="ltr txtL">
                        <?php if(a($value, 'status') !== 'pending_delete') {?>
                            <div data-confirm data-data='{"removedns": "removedns", "dnsid": "<?php echo a($value, 'id'); ?>"}'><i class="sf-trash fc-red font-14"></i></div>
                          <?php } //endif ?>
                      </td>
                      <?php } //endif ?>

                    </tr>
                  <?php } // endif ?>
                </tbody>
              </table>
            </div>
        <?php } // endif ?>
        <?php } // endif ?>

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