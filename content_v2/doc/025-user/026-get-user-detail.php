<h2 class="f" data-kerkere='#get-user-detail-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get user detail"); ?></span>
</h2>
<div id="get-user-detail-detail">
  <div class="cbox" id='get-user-detail'>
    <div class="msg url ltr txtL">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>user/detail?id={USERID}</b></span>
    </div>

    <?php require (root. 'content_v2/doc/000-public/header-appkey-apikey.php'); ?>


    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X GET \
  <?php echo \dash\data::CustomerApiURL(); ?>user/detail?id={USERID} \
  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
  -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

    <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "result": {
    "id": "R",
    "username": null,
    "displayname": null,
    "gender": null,
    "mobile": "99029522525",
    "email": null,
    "status": "awaiting",
    "avatar": "http://jibres.local/static/siftal/images/default/avatar.png",
    "permission": null,
    "datecreated": "2019-11-27 13:01:10",
    "datemodified": null,
    "birthday": null,
    "language": null,
    "website": null,
    "facebook": null,
    "twitter": null,
    "instagram": null,
    "linkedin": null,
    "gmail": null,
    "firstname": null,
    "lastname": null,
    "bio": null,
    "father": null,
    "nationalcode": null,
    "nationality": null,
    "pasportcode": null,
    "pasportdate": null,
    "marital": null,
    "foreign": null,
    "phone": null
  }
}
</pre>

  </div>
</div>
