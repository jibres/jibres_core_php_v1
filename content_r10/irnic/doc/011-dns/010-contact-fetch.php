<div class="box">
  <header>
    <h2 class="f" data-kerkere='#dns-fetch' data-kerkere-icon='open'>
      <span class="cauto pRa10"><span class="badge success">GET</span></span>
      <span class="c"><?php echo T_("Get IRNIC dns list"); ?></span>
    </h2>
  </header>
  <div class="body" id="dns-fetch">
      <div>

        <div class="msg url ltr txtL">
          <i class="method">GET</i>
          <span><?php echo \dash\data::IRNICApiURL(); ?><b>dns/fetch</b></span>
        </div>

        <?php require(root. 'content_r10/irnic/doc/000-public/header-appkey-apikey.php'); ?>

        <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
        <pre>curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X GET '<?php echo \dash\data::IRNICApiURL(); ?>dns/fetch' -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'</pre>

        <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<samp>{
  "ok": true,
  "result": {
    "ok": true,
    "meta": {
        "filter_message": null,
        "is_filtered": false
    },
    "pagination": {
        "desc": "page 1 of 1 - Show record 1 to 1 of 1",
        "page": 1,
        "total_page": 1,
        "limit": 20,
        "total_rows": 1
    },
    "result": [
      {
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
        "datecreated": "2020-04-08 04:05:01",
        "count_useage": "0"
      }
    ]
  }
}</samp>
    </div>
  </div>
</div>

