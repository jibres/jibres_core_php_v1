<h2 class="f" data-kerkere='#language-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get language list"); ?></span>
</h2>
<div id="language-detail">
  <div class="cbox" id='language'>

    <div class="msg url">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>language</b></span>
    </div>


    <div class="tblBox">
      <h3><?php echo T_("Required parameters"); ?> <?php echo T_("on header"); ?></h3>
      <table class="tbl1 v3">
        <thead>
          <tr>
            <th><?php echo T_("Name"); ?> <small><?php echo T_("type"); ?></small></th>
            <th><?php echo T_("Description"); ?> <small><?php echo T_("example"); ?></small></th>
            <th><?php echo T_("Constraints"); ?></th>
          </tr>
        </thead>
        <tbody>
           <tr>
            <td>
              <div class="txtB">appkey</div>
              <i>string</i>
            </td>
            <td>
              <div><?php echo T_("APP key generated on the user panel"); ?></div>
              <code><?php echo \dash\data::myAppKey(); ?></code>
            </td>
            <td>
              <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              <?php echo T_("length"); ?> <?php echo \dash\fit::number(32); ?>
            </td>
          </tr>

        </tbody>
      </table>
    </div>

    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
    <pre>curl -X GET <?php echo \dash\data::CustomerApiURL(); ?>language -H 'appkey: <?php echo \dash\data::YourAppKey(); ?>'</pre>

    <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "result": {
    "en": {
      "website": "https://jibres.com",
      "endpoint": "https://api.jibres.com/v2",
      "doc": "https://api.jibres.com/v2/doc",
      "direction": "ltr",
      "lang": "English",
      "langname": "English"
    },
    "fa": {
      "website": "https://jibres.ir",
      "endpoint": "https://api.jibres.ir/v2",
      "doc": "https://api.jibres.ir/v2/doc",
      "direction": "rtl",
      "lang": "Persian",
      "langname": "فارسی"
    }
  }
}
</pre>

  </div>
</div>
