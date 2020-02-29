<h2 class="f" data-kerkere='#collection-list-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get list of collection"); ?></span>
</h2>
<div id="collection-list-detail">
  <div class="cbox" id='collection-list'>
    <div class="msg url">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>collection/list</b></span>
    </div>

         <?php require (root. 'content_api/v2/doc/000-public/header-appkey-apikey.php'); ?>
    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X GET <?php echo \dash\data::CustomerApiURL(); ?>collection/list -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span><?php echo T_("Response"); ?> <small><?php echo T_("Example"); ?></small></h3>
<pre>
{
  "ok": true,
  "result": [
    {
      "id": "1",
      "title": "پیشنهاد ویژه",
      "count": "1"
    }
  ]
}
</pre>


  </div>
</div>

