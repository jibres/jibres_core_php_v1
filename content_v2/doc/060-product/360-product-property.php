<h2 class="f" data-kerkere='#product-property-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get products property"); ?></span>
</h2>
<div id="product-property-detail">

  <div class="cbox" id='product-property'>
    <div class="msg url ltr txtL">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>product/property?id={PRODUCT_ID}</b></span>
    </div>

         <?php require (root. 'content_v2/doc/000-public/header-appkey-apikey.php'); ?>



    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X GET <?php echo \dash\data::CustomerApiURL(); ?>product/property?id={PRODUCT_ID} -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span><?php echo T_("Response"); ?> <small><?php echo T_("Example"); ?></small></h3>
<pre>
{
  "ok": true,
  "result": [
    {
      "title": "مشخصات فیزیکی",
      "list": {
        "وزن": "۹ کیلو گرم",
        "ابعاد": "15*15*12"
      }
    },
    {
      "title": "مشخصات فنی",
      "list": {
        "cpu": "۹ هسته ای",
        "garanty": "ایران جیبرس"
      }
    }
  ]
}
</pre>


  </div>
</div>

