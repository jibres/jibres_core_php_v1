<h2 class="f" data-kerkere='#session-list-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get session list"); ?></span>
</h2>
<div id="session-list-detail">
  <div class="cbox" id='session-list'>
    <p>
      <?php echo T_("Get your active session detail."); ?>
    </p>
    <div class="msg url ltr txtL">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>account/session</b></span>
    </div>
<?php require (root. 'content_developers/docs/api/v2/000-public/header-appkey-apikey.php'); ?>

    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
    <pre>curl -X GET <?php echo \dash\data::CustomerApiURL(); ?>account/session -H 'apikey: <?php echo \dash\data::myApiKey(); ?>' -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' </pre>

    <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "result": [
    {
      "id": "3N",
      "ip": "127.0.0.1",
      "last": "Tuesday 28 May 2019 16:13:49",
      "browser": "Chrome",
      "browserVer": "74.0.3729.169",
      "os": "Linux",
      "os_version": null
    },
    {
      "id": "3J",
      "ip": "127.0.0.1",
      "last": "Friday 17 May 2019 14:18:16",
      "browser": "Chrome",
      "browserVer": "74.0.3729.157",
      "os": "Linux",
      "os_version": null
    }
  ]
}
</pre>

  </div>
</div>
