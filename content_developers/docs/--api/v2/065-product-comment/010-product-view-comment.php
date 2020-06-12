<h2 class="f" data-kerkere='#product-comment-view-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get product comment"); ?></span>
</h2>

<div id="product-comment-view-detail">
  <div class="cbox" id='product-comment-view'>

    <div class="msg url ltr txtL">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>product/{PRODUCT_ID}/comment</b></span>
    </div>

      <?php require (root. 'content_developers/docs/api/v2/000-public/header-appkey-apikey.php'); ?>



<h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X GET <?php echo \dash\data::CustomerApiURL(); ?>product/{PRODUCT_ID}/comment -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span><?php echo T_("Response"); ?> <small><?php echo T_("Example"); ?></small></h3>
<pre>
{
  "ok": true,
  "pagination": {
    "desc": "page 1 of 1 - Show record 1 to 1 of 1",
    "page": 1,
    "total_page": 1,
    "limit": 10,
    "total_rows": 1
  },
  "result": {
    "star": {
      "total": 4.5,
      "person": 182,
      "1": 2,
      "2": 3,
      "3": 2,
      "4": 2,
      "5": 1
    },
    "list": [
      {
        "id": "S",
        "content": "Sample1",
        "star": "1",
        "status": "approved",
        "tstatus": "approved",
        "datecreated": "2020-01-11 20:27:39",
        "user_id": "10",
        "avatar": "http://jibres.local/static/siftal/images/default/avatar.png",
        "displayname": "Without name",
        "gender": null
      }
    ]
  }
}
</pre>


  </div>
</div>

