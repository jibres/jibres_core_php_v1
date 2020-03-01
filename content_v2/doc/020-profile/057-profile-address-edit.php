<h2 class="f" data-kerkere='#profile-address-edit-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge info">PATCH</span></span>
  <span class="c"><?php echo T_("Edit address"); ?></span>
</h2>
<div id="profile-address-edit-detail">
  <div class="cbox" id='profile-address-edit'>

    <div class="msg url">
      <i class="method">PATCH</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>profile/address/{ADDRESSID}/edit</b></span>
    </div>

    <?php require (root. 'content_v2/doc/000-public/header-appkey-apikey.php'); ?>


    <div class="tblBox">
      <h3><?php echo T_("Parameters"); ?></h3>
      <p><?php echo T_("Every parameter in add new address can be use in edit mode"); ?></p>

    </div>

    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X PATCH \
  <?php echo \dash\data::CustomerApiURL(); ?>profile/address/{ADDRESSID}/edit \
  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
  -H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
  -d '{"address" : "St 19. qom"}'
 </pre>

    <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "Address successfully edited"
    }
  ],
  "result": true
}
</pre>

  </div>
</div>
