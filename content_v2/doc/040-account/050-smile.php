<h2 class="f" data-kerkere='#smile-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get notification count"); ?></span>
</h2>
<div id="smile-detail">
  <div class="cbox" id='smile'>
    <p><?php echo T_("To get this user have notification or no"); ?></p>
    <div class="msg url">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>account/smile</b></span>
    </div>
<?php require (root. 'content_api/v2/doc/000-public/header-appkey-apikey.php'); ?>


    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X GET \
  <?php echo \dash\data::CustomerApiURL(); ?>account/smile \
  -H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>'
</pre>

<h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "result": {
    "notif_new": true,
    "notif_count": 1
  }
}
</pre>

  </div>
</div>
