<div class="box">
  <header>
    <h2 class="f" data-kerkere='#contact-detail' data-kerkere-icon='open'>
      <span class="cauto pRa10"><span class="badge success">GET</span></span>
      <span class="c"><?php echo T_("Get IRNIC contact list"); ?></span>
    </h2>
  </header>
  <div class="body" id="contact-detail">
      <div id='contact'>

        <div class="msg url ltr txtL">
          <i class="method">GET</i>
          <span><?php echo \dash\data::IRNICApiURL(); ?><b>contact_list</b></span>
        </div>

        <?php require(root. 'content_r10/irnic/doc/000-public/header-appkey-apikey.php'); ?>

        <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
        <pre>curl -X GET <?php echo \dash\data::IRNICApiURL(); ?>contact_list -H 'appkey: <?php echo \dash\data::myAppKey(); ?>'</pre>

        <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<samp>{
  "ok": true,
  "result": {
    "lang_list": {
      "fa": {
        "name": "fa",
        "direction": "rtl",
        "iso": "fa_IR",
        "localname": "فارسی",
        "country": [
          "Iran"
        ]
      },
      "en": {
        "name": "en",
        "direction": "ltr",
        "iso": "en_US",
        "localname": "English",
        "country": [
          "United Kingdom",
          "United States"
        ]
      }
    }
  }
}</samp>
  </div>
</div>

