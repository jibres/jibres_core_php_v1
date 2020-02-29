<h2 class="f" data-kerkere='#user-address-list-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get user address list"); ?></span>
</h2>
<div id="user-address-list-detail">
  <div class="cbox" id='user-address-list'>
    <p><?php echo T_("Get user address list"); ?></p>
    <div class="msg url">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>user/{USERID}/address/list</b></span>
    </div>

    <?php require (root. 'content_api/v2/doc/000-public/header-appkey-apikey.php'); ?>



    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X GET \
  <?php echo \dash\data::CustomerApiURL(); ?>user/{USERID}/address/list \
  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
  -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
 </pre>

    <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "result": [
    {
      "id": "B",
      "title": null,
      "name": null,
      "company": null,
      "companyname": null,
      "jobtitle": null,
      "country": null,
      "country_name": null,
      "province": null,
      "province_name": null,
      "city": null,
      "city_name": null,
      "address": "St 19. qom",
      "postcode": null,
      "phone": null,
      "mobile": null,
      "status": "enable",
      "latitude": null,
      "longitude": null,
      "map": null,
      "datecreated": "2019-11-30 07:51:07",
      "datemodified": null,
      "location_string": ""
    }
  ]
}

</pre>

  </div>
</div>
