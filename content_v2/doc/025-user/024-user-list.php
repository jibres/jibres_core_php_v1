
<h2 class="f" data-kerkere='#user-list-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get list of users"); ?></span>
</h2>
<div id="user-list-detail">
  <div class="cbox" id='user-list'>
    <div class="msg url">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>user/list</b></span>
    </div>

    <?php require (root. 'content_api/v2/doc/000-public/header-appkey-apikey.php'); ?>


    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X GET \
  <?php echo \dash\data::CustomerApiURL(); ?>user/list \
  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
  -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

    <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "pagination": {
    "desc": "page 1 of 1 - Show record 1 to 2 of 2",
    "page": 1,
    "total_page": 1,
    "limit": 10,
    "total_rows": 2
  },
  "result": [
    {
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
    },
    {
      "id": "JJ",
      "username": null,
      "displayname": "رضا محیطی",
      "gender": "male",
      "mobile": "989109999999",
      "email": null,
      "status": "active",
      "avatar": "http://jibres.local/static/siftal/images/default/avatar.png",
      "permission": "admin",
      "datecreated": "2019-11-25 14:01:03",
      "datemodified": "2019-11-27 13:13:13",
      "birthday": "1991-04-05",
      "language": null,
      "website": null,
      "facebook": null,
      "twitter": null,
      "instagram": null,
      "linkedin": null,
      "gmail": null,
      "firstname": "رضا",
      "lastname": "محیطی",
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
  ]
}
</pre>

  </div>
</div>
