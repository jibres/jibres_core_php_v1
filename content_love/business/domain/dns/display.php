<?php require_once(root. 'content_love/business/domain/pageStep.php'); ?>
<div class="avand-lg">


  <form method="post" autocomplete="off">
    <input type="hidden" name="adddns" value="adddns">
    <div class="box">
      <header><h2><?php echo T_("Add DNS record") ?></h2></header>
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
          <div class="c-xs-12 c-sm-4">
            <label for="ivalue"><?php echo T_("Value") ?></label>
            <div class="input ltr">
              <input type="text" name="value" id="ivalue" placeholder="">
            </div>
          </div>

          <div class="c-xs-auto c-sm-auto">
            <div class="check1 mt-4">
              <input type="checkbox" name="cloud" value="1" id="cloud" checked>
              <label for="cloud"><?php echo T_("Cloud") ?></label>
            </div>
          </div>


          <div class="check1">
            <input type="checkbox" name="addtocdnpaneldns" value="1" id="iaddtocdnpaneldns" checked>
            <label for="iaddtocdnpaneldns"><?php echo T_("Also add to CDN panel DNS record") ?></label>
          </div>
          <div class="text-gray-400">
            <?php echo T_("If you do not add to the panel, the system will automatically add to the panel after a few minutes, but if you sync in the meantime, this information will be deleted."); ?>
          </div>

          <p class="msg minimal mt-2"><?php echo T_("You can insert Jibres DNS record to this domain"); ?> <span data-confirm data-data='{"jibresdns": "jibresdns"}' class="link-primary"><?php echo T_("Insert now!") ?></span></p>



        </div>
        <footer class="f">
          <div class="cauto"><div data-confirm data-data='{"dnsfetch": "dnsfetch"}' class="btn-link"><?php echo T_("Fetch DNS") ?></div></div>
          <div class="c"></div>
          <div class="cauto"><button class="btn master"><?php echo T_("Add DNS") ?></button></div>
        </footer>
      </div>
      </div>
    </form>

    <form method="post">
      <div class="box">
        <div class="pad">
          <input type="hidden" name="changeserver" value="changeserver">
          <div>
            <label for="iserver"><?php echo T_("Server") ?></label>
            <select class="select22" name="server" id="iserver">
              <option value="" readonly><?php echo T_("Choose server") ?></option>
              <?php foreach (\dash\data::serverList() as $key => $value) {?>
                <option value="<?php echo a($value, 'code') ?>" <?php if(a($value, 'code') == \dash\data::currentServerKey()) { echo 'selected';} ?>><?php echo a($value, 'title') ?></option>
              <?php } //endif ?>
            </select>
          </div>

        </div>
        <footer class="txtRa">
          <button class="btn-danger"><?php echo T_("Change source server") ?></button>
        </footer>
      </div>

    </form>


    <?php if(\dash\data::dnsList()) {?>
      <table class="tbl1 v4 font-12">
        <thead>
          <tr>
            <th class="collapsing"></th>
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
              <td class="collapsing"><?php if(a($value, 'cloud')) {?><i title="<?php echo T_("Cloud") ?>" class="sf-cloud fc-green"></i><?php }else{ ?><i title="<?php echo T_("Raw") ?>" class="sf-cloud text-gray-400"></i><?php } //endif ?></td>
              <td><?php echo a($value, 'type'); ?></td>
              <td><?php echo a($value, 'key'); ?></td>
              <td><?php echo a($value, 'value'); ?></td>
              <td><?php echo a($value, 'status'); ?></td>
              <td class="collapsing"><div data-confirm data-data='{"removedns": "removedns", "dnsid": "<?php echo a($value, 'id'); ?>"}'><i class="sf-trash text-red-800 font-14"></i></div></td>
            </tr>
          <?php } // endif ?>
        </tbody>
      </table>
    <?php } // endif ?>



  </div>

