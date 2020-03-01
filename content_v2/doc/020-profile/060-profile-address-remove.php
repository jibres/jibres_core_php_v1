<h2 class="f" data-kerkere='#profile-address-remove-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge danger">DELETE</span></span>
  <span class="c"><?php echo T_("Remove address"); ?></span>
</h2>
<div id="profile-address-remove-detail">
  <div class="cbox" id='profile-address-remove'>
    <div class="msg url">
      <i class="method">DELETE</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>profile/address/{ADDRESSID}/remove</b></span>
    </div>

    <?php require (root. 'content_v2/doc/000-public/header-appkey-apikey.php'); ?>

    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X DELETE <?php echo \dash\data::CustomerApiURL(); ?>profile/address/{ADDRESSID}/remove  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>'  -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

    <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "Address removed"
    }
  ],
  "result": true
}
</pre>

  </div>
</div>
