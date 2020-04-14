<div class="box">
  <header>
    <h2 class="f" data-kerkere='#domain-detail' data-kerkere-icon='open'>
      <span class="cauto pRa10"><span class="badge success">GET</span></span>
      <span class="c"><?php echo T_("Get domain detail"); ?></span>
    </h2>
  </header>
  <div class="body" id="domain-detail">
      <div>

        <div class="msg url ltr txtL">
          <i class="method">GET</i>
          <span><?php echo \dash\data::IRNICApiURL(); ?><b>domain/detail</b></span>
        </div>

        <?php require(root. 'content_developers/docs/irnic/r10/000-public/header-appkey-apikey.php'); ?>

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
                <div class="txtB">domain</div>
                <i>string</i>
              </td>
              <td>
                <i><?php echo T_("For example") ?></i>
                <code>'yourdomain.ir'</code>
              </td>
              <td>
                <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>



        <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X GET '<?php echo \dash\data::IRNICApiURL(); ?>domain/detail?domain=yourdomain.ir' \
-H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
-H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

        <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<samp>{
  "ok": true,
  "result": {
    "id": "S",
    "registrar": "irnic",
    "name": "yourdomain.ir",
    "status": "enable",
    "holder": "ex66-irnic",
    "admin": "ex66-irnic",
    "tech": "ex66-irnic",
    "bill": "ex66-irnic",
    "roid": "123",
    "reseller": "ex61-irnic",
    "autorenew": null,
    "lock": "1",
    "verify": "1",
    "can_renew": true,
    "other_status": "",
    "status_html": "",
    "dns": false,
    "dateregister": "2020-04-06 11:44:09",
    "dateexpire": "2021-04-07 11:44:09",
    "datecreated": "2020-04-06 11:44:10",
    "datemodified": "2020-04-09 07:50:28",
    "lastdetail": "2020-04-09 07:50:28",
    "dateupdate": "2020-04-06 17:17:01",
    "ns1": null,
    "ns2": null,
    "ns3": null,
    "ns4": null,
    "ip1": null,
    "ip2": null,
    "ip3": null,
    "ip4": null,
    "nicstatus_array": [
      "ok",
      "irnicRegistered"
    ]
  }
}</samp>
    </div>
  </div>
</div>

