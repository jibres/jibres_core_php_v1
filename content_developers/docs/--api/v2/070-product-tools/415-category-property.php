<h2 class="f" data-kerkere='#category-property-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get category property"); ?></span>
</h2>
<div id="category-property-detail">
  <div class="cbox" id='category-property'>
    <div class="msg url ltr txtL">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>category/property?id={CATEGORYID}</b></span>
    </div>

         <?php require (root. 'content_developers/docs/api/v2/000-public/header-appkey-apikey.php'); ?>


    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X GET <?php echo \dash\data::CustomerApiURL(); ?>category/property?id={CATEGORYID} -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span><?php echo T_("Response"); ?> <small><?php echo T_("Example"); ?></small></h3>
<pre>
{
  "ok": true,
  "result": [
    {
      "title": "مشخصات فیزیکی",
      "list": {
        "وزن": [
          "۹ کیلو گرم",
          "۱۲ کیلو گرم",
          "۱۸ کیلو گرم"
        ],
        "ابعاد": [
          "15*15*12"
        ]
      }
    },
    {
      "title": "مشخصات فنی",
      "list": {
        "cpu": [
          "۹ هسته ای",
          "۳ هسته ای"
        ],
        "garanty": [
          "ایران جیبرس"
        ]
      }
    }
  ]
}
</pre>


  </div>
</div>

