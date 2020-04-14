<div class="box">
  <header>
    <h2 class="f" data-kerkere='#domain-fetch' data-kerkere-icon='open'>
      <span class="cauto pRa10"><span class="badge success">GET</span></span>
      <span class="c"><?php echo T_("Fetch your domain"); ?></span>
    </h2>
  </header>
  <div class="body" id="domain-fetch">
      <div>

        <div class="msg url ltr txtL">
          <i class="method">GET</i>
          <span><?php echo \dash\data::IRNICApiURL(); ?><b>domain/fetch</b></span>
        </div>

        <?php require(root. 'content_developers/docs/irnic/r10/000-public/header-appkey-apikey.php'); ?>


        <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X GET '<?php echo \dash\data::IRNICApiURL(); ?>domain/fetch' \
-H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
-H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

        <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<samp>{
  "ok": true,
  "meta": {
    "filter_message": null,
    "is_filtered": false
  },
  "pagination": {
    "desc": "صفحه ۱ از ۱ - نمایش رکورد ۱ تا ۱ از ۱",
    "page": 1,
    "total_page": 1,
    "limit": 20,
    "total_rows": 1
  },
  "result": [
    {
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
      "lastfetch": "2020-04-09 07:50:28",
      "dateupdate": "2020-04-06 17:17:01",
      "ns1": null,
      "ns2": null,
      "ns3": null,
      "ns4": null,
      "ip1": null,
      "ip2": null,
      "ip3": null,
      "ip4": null
    }
  ]
}</samp>
    </div>
  </div>
</div>

