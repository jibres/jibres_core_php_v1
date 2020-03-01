<h2 class="f" data-kerkere='#product-remove-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge danger">DELETE</span></span>
  <span class="c"><?php echo T_("Delete Product"); ?></span>
</h2>
<div id="product-remove-detail">
  <div class="cbox" id='product-remove'>
     <p><?php echo T_("Replace {PRODUCT_ID} by your product id"); ?></p>


    <div class="msg url">
      <i class="method">DELETE</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>product/{PRODUCT_ID}/remove</b></span>
    </div>

         <?php require (root. 'content_v2/doc/000-public/header-appkey-apikey.php'); ?>



    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X DELETE \
  <?php echo \dash\data::CustomerApiURL(); ?>product/{PRODUCT_ID}/remove \
  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
  -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span><?php echo T_("Response"); ?> <small><?php echo T_("Example"); ?></small></h3>
<pre>
{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "Product removed"
    }
  ],
  "result": true
}
</pre>


  </div>
</div>

