<h2 class="f" data-kerkere='#notif-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get notification list"); ?></span>
</h2>
<div id="notif-detail">
  <div class="cbox" id='notif'>
    <p><?php echo T_("Get list of your notification"); ?></p>
    <div class="msg url">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>account/notif</b></span>
    </div>
<?php require (root. 'content_api/v2/doc/000-public/header-appkey-apikey.php'); ?>



    <div class="tblBox">
      <h3><?php echo T_("Response"); ?></h3>
      <table class="tbl1 v3">
        <thead>
          <tr>
            <th><?php echo T_("Name"); ?> <small><?php echo T_("type"); ?></small></th>
            <th><?php echo T_("Description"); ?> <small><?php echo T_("example"); ?></small></th>

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <div class="txtB">id</div>
              <i>String</i>
            </td>
            <td>
              <div><?php echo T_("example"); ?></div>
              <code>3NW</code>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">readdate</div>
              <i>Date time</i>
            </td>
            <td>
              <?php echo T_("If user not read this notif, this response is null else see read date of this notif"); ?>
              <div><?php echo T_("example"); ?></div>
              <code>2019-02-10 08:14:12</code>
            </td>
          </tr>
           <tr>
            <td>
              <div class="txtB">datecreated</div>
              <i>Date time</i>
            </td>
            <td>

              <div><?php echo T_("example"); ?></div>
              <code>2019-02-09 07:15:13</code>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">title</div>
              <i>String</i>
            </td>
            <td>
              <div><?php echo T_("example"); ?></div>
              <code>Notif title</code>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">icon</div>
              <i>String</i>
            </td>
            <td>
              <div><?php echo T_("example"); ?></div>
              <code>home</code>
              <a href="http://siftal.ir/examples/icon" target="_blank"><?php echo T_("Read more"); ?></a>
            </td>
          </tr>

          <tr>
            <td>
              <div class="txtB">cat</div>
              <i>String</i>
            </td>
            <td>
              <div><?php echo T_("example"); ?></div>
              <code>Notif category</code>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">excerpt</div>
              <i>String</i>
            </td>
            <td>
              <div><?php echo T_("example"); ?></div>
              <code>Notif excerpt</code>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">text</div>
              <i>String</i>
            </td>
            <td>
              <div><?php echo T_("example"); ?></div>
              <code>Notif text</code>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">image</div>
              <i>URL</i>
            </td>
            <td>
              <div><?php echo T_("example"); ?></div>
              <code><?php echo \dash\url::cdn(); ?>/images/logo.png</code>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">footer</div>
              <i>String</i>
            </td>
            <td>
              <div><?php echo T_("example"); ?></div>
              <code>Notif Footer</code>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">url</div>
              <i>URL</i>
            </td>
            <td>
               <div><?php echo T_("example"); ?></div>
              <code><?php echo \dash\url::site(); ?></code>
            </td>
          </tr>

        </tbody>
      </table>
    </div>


    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X GET \
  <?php echo \dash\data::CustomerApiURL(); ?>account/notif \
  -H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>'
</pre>

<h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "result": [
    {
      "id": "36v",
      "readdate": null,
      "datecreated": "2019-02-09 07:15:13",
      "title": "Notif title",
      "icon": "test icon",
      "cat": "category of notif",
      "excerpt": "Notif excerpt",
      "text" : "Notif text",
      "image" : "<?php echo \dash\url::cdn(); ?>/images/logo.png",
      "footer" : "Notif footer",
      "url" : "<?php echo \dash\url::cdn(); ?>"
    }
  ]
}
</pre>

  </div>
</div>
