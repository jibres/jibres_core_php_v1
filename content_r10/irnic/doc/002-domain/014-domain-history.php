<div class="box">
  <header>
    <h2 class="f" data-kerkere='#domain-history' data-kerkere-icon='open'>
      <span class="cauto pRa10"><span class="badge success">GET</span></span>
      <span class="c"><?php echo T_("Get all domains history"); ?></span>
    </h2>
  </header>
  <div class="body" id="domain-history">
      <div>

        <div class="msg url ltr txtL">
          <i class="method">GET</i>
          <span><?php echo \dash\data::IRNICApiURL(); ?><b>domain/history</b></span>
        </div>

        <?php require(root. 'content_r10/irnic/doc/000-public/header-appkey-apikey.php'); ?>



        <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X GET '<?php echo \dash\data::IRNICApiURL(); ?>domain/history' \
-H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
-H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

        <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<samp>{
  "ok": true,
  "pagination": {
    "desc": "صفحه ۱ از ۱ - نمایش رکورد ۱ تا ۱ از ۱",
    "page": 1,
    "total_page": 1,
    "limit": 20,
    "total_rows": 1
  },
  "result": [
    {
      "id": "R",
      "domain_id": "S",
      "status": "enable",
      "action": "register",
      "mode": "manual",
      "detail": null,
      "date": "2020-02-26 16:24:08",
      "price": "3000",
      "discount": null,
      "transaction_id": "BL",
      "datecreated": "2020-02-26 16:24:08",
      "taction": "ثبت دامنه",
      "class": "",
      "icon": ""
    }
  ]
}</samp>
    </div>
  </div>
</div>

