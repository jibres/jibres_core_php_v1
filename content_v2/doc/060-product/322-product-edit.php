<h2 class="f" data-kerkere='#product-edit-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge info">PATCH</span></span>
  <span class="c"><?php echo T_("Edit product"); ?></span>
</h2>
<div id="product-edit-detail">
  <div class="cbox" id='product-edit'>
     <p><?php echo T_("Replace {PRODUCT_ID} by your product id"); ?></p>

     <div class="msg url">
      <i class="method">PATCH</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>product/{PRODUCT_ID}/edit</b></span>
    </div>

    <?php require (root. 'content_v2/doc/000-public/header-appkey-apikey.php'); ?>


      <h3><?php echo T_("Parameters"); ?></h3>
        <p><?php echo T_("All parameter in add module can be use in edit"); ?></p>




    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X PATCH \
  <?php echo \dash\data::CustomerApiURL(); ?>product/{PRODUCT_ID}/edit \
  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
  -H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
  -d '{"title":"Product1"}'
</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span><?php echo T_("Response"); ?> <small><?php echo T_("Example"); ?></small></h3>
<pre>
{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "Your product successfully updated"
    }
  ],
  "result": true
}
</pre>


  </div>
</div>

