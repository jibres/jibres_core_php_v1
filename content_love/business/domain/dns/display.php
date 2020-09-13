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
                <option value="ALIAS">ALIAS</option>
                <option value="CNAME">CNAME</option>
                <option value="MX">MX</option>
                <option value="NS">NS</option>
                <option value="PTR">PTR</option>
                <option value="SOA">SOA</option>
                <option value="SRV">SRV</option>
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
      <footer class="txtRa">
          <button class="btn master"><?php echo T_("Add DNS") ?></button>
      </footer>
    </div>
  </form>

  <?php if(\dash\data::dnsList()) {?>
    <table class="tbl1 v4 font-12">
      <thead>
        <tr>
          <th><?php echo T_("Type") ?></th>
          <th><?php echo T_("Key") ?></th>
          <th><?php echo T_("Value") ?></th>
          <th class="collapsing"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach (\dash\data::dnsList() as $key => $value) {?>
          <tr>
            <td><?php echo \dash\get::index($value, 'type'); ?></td>
            <td><?php echo \dash\get::index($value, 'key'); ?></td>
            <td><?php echo \dash\get::index($value, 'value'); ?></td>
            <td class="collapsing"><div data-confirm data-data='{"removedns": "removedns", "dnsid": "<?php echo \dash\get::index($value, 'id'); ?>"}'><i class="sf-trash fc-red font-14"></i></div></td>
          </tr>
        <?php } // endif ?>
      </tbody>
    </table>
  <?php } // endif ?>



</div>

