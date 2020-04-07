<div class="box">
  <header>
    <h2 class="f" data-kerkere='#dns-load' data-kerkere-icon='open'>
      <span class="cauto pRa10"><span class="badge success">GET</span></span>
      <span class="c"><?php echo T_("Load domain dns detail"); ?></span>
    </h2>
  </header>
  <div class="body" id="dns-load">
    <div>

      <div class="msg url ltr txtL">
        <i class="method">GET</i>
        <span><?php echo \dash\data::IRNICApiURL(); ?><b>dns</b></span>
      </div>

      <?php require(root. 'content_r10/irnic/doc/000-public/header-appkey-apikey.php'); ?>


      <h3 class="mB20"><?php echo T_("Query Params"); ?></h3>

      <div class="tblBox">
        <table class="tbl1 v3">
          <thead>
            <tr>
              <th><?php echo T_("Name"); ?> <small><?php echo T_("type"); ?></small></th>
              <th><?php echo T_("Description"); ?> <small><?php echo T_("example"); ?></small></th>
              <th><?php echo T_("Constraints"); ?></th>
            </tr>
          </thead>
          <tbody>
             <tr>
              <td>
                <div class="txtB">id</div>
                <i>code</i>
              </td>
              <td>
                <i><?php echo T_("For example") ?></i>
                <code>'d'</code>
              </td>
              <td>
                <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>



      <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
      <pre>curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X GET '<?php echo \dash\data::IRNICApiURL(); ?>dns?id=d' -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'</pre>

      <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<samp>{
  "ok": true,
  "result": {
    "ok": true,
    "result": {
      "id": "d",
      "title": "my DNS",
      "ns1": "ns1.jibres.com",
      "ip1": null,
      "ns2": "ns2.jibres.com",
      "ip2": null,
      "ns3": null,
      "ip3": null,
      "ns4": null,
      "ip4": null,
      "isdefault": "1",
      "status": "enable",
      "datecreated": "2020-04-08 04:05:09",
      "count_useage": "0"
    }
  }
}</samp>
    </div>
  </div>
</div>