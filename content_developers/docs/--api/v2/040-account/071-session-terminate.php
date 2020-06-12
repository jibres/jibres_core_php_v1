<h2 class="f" data-kerkere='#session-terminate-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge primary">POST</span></span>
  <span class="c"><?php echo T_("Terminate session"); ?></span>
</h2>
<div id="session-terminate-detail">
  <div class="cbox" id='session-terminate'>
    <p><?php echo T_("Terminate one session or all session"); ?></p>
    <div class="msg url ltr txtL">
      <i class="method">POST</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>account/session</b></span>
    </div>

   <?php require (root. 'content_developers/docs/api/v2/000-public/header-appkey-apikey.php'); ?>



    <div class="tblBox">
      <h3><?php echo T_("Parameters"); ?></h3>
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
              <div class="txtB">type</div>
              <i>String</i>
            </td>
            <td>
              <code>terminate</code> <?php echo T_("Or"); ?> <code>terminateall</code>

            </td>
          </tr>

          <tr>
            <td>
              <div class="txtB">id</div>
              <i>String</i>
            </td>
            <td>
              <div><?php echo T_("example"); ?></div>
              <code>3N</code>
              <div><?php echo T_("If type is `terminate` the id is require"); ?></div>
            </td>
          </tr>

        </tbody>
      </table>
    </div>


    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X POST \
  <?php echo \dash\data::CustomerApiURL(); ?>account/session \
  -H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
  -d '{"type":"terminate", "id": "3N"}'
</pre>

<h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "This Session was terminated"
    }
  ],
  "result": true
}
</pre>

  </div>
</div>
