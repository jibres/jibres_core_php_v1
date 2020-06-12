<h2 class="f" data-kerkere='#get-profile-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get profile detail"); ?></span>
</h2>

<div id="get-profile-detail">
  <div class="cbox" id='get-profile'>
    <div class="msg url ltr txtL">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>profile/get</b></span>
    </div>

    <?php require (root. 'content_developers/docs/api/v2/000-public/header-appkey-apikey.php'); ?>


    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X GET \
  <?php echo \dash\data::CustomerApiURL(); ?>profile/get \
  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
  -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

    <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
    "ok": true,
    "result": {
        "username": "Biqarar",
        "displayname": "Reza mohiti",
        "gender": "male",
        "title": "Programer",
        "mobile": "9891...",
        "verifymobile": "1",
        "status": "active",
        "avatar": "<?php echo \dash\url::site(); ?>/static/images/logo.png",
        "datecreated": "2017-12-27 22:40:53",
        "datemodified": "2019-06-18 21:29:32",
        "birthday": "1990-01-16",
        "language": "fa",
        "firstname": "Reza",
        "lastname": "Mohitit",
        "bio": null,
        "email": null
    }
}
</pre>

  </div>
</div>
