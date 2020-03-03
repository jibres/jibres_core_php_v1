<h2 class="f" data-kerkere='#show-cart-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("List of your cart"); ?></span>
</h2>
<div id="show-cart-detail">
  <div class="cbox" id='show-cart'>
    <div class="msg url ltr txtL">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>cart/fetch</b></span>
    </div>

         <?php require (root. 'content_v2/doc/000-public/header-appkey-apikey.php'); ?>


    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X GET <?php echo \dash\data::CustomerApiURL(); ?>cart/fetch -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span><?php echo T_("Response"); ?> <small><?php echo T_("Example"); ?></small></h3>
<pre>
{
  "ok": true,
  "result": [
    {
      "product": 1,
      "count": 10,
      "date": "2019-12-05 14:05:14",
      "product_detail": {
          "title": "product 1",
          "price": 1000
      }
    },
    {
      "product": 2,
      "count": 10,
      "date": "2019-12-05 14:05:14",
      "product_detail": {
          "title": "product 2",
          "price": 2000
      }
    }
  ]
}
</pre>


  </div>
</div>

