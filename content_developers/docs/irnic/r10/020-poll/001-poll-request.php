<div class="box">
  <header>
    <h2 class="f" data-kerkere='#poll-request' data-kerkere-icon='open'>
      <span class="c"><?php echo T_("Get IRNIC poll request"); ?></span>
      <span class="cauto pRa10"><span class="badge success">GET</span></span>
    </h2>
  </header>
  <div class="body" id="poll-request">
      <div>

      <div class="msg url ltr txtL">
        <i class="method">GET</i>
        <span><?php echo \dash\data::IRNICApiURL(); ?><b>poll</b></span>
      </div>

      <?php require(root. 'content_developers/docs/irnic/r10/000-public/header-appkey-apikey.php'); ?>


        <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
        <pre>curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X GET '<?php echo \dash\data::IRNICApiURL(); ?>poll' -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'</pre>

        <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<samp>{
  "ok": true,
  "result": [
    {
      "domain": "rezamohiti.ir",
      "nic_id": null,
      "index": "DomainUpdateStatus",
      "note": null,
      "read": null,
      "acknowledge": null,
      "datecreated": null,
      "taction": "وضعیت دامنه شما به‌روز شده است",
      "class": "",
      "meta": "rezamohiti.ir",
      "icon": ""
    }
  ]
}</samp>
    </div>
  </div>
</div>

