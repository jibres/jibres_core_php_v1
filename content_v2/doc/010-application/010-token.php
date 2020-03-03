<h2 class="f" data-kerkere='#token-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge primary">POST</span></span>
  <span class="c"><?php echo T_("Get Access Token"); ?></span>
</h2>
<div id="token-detail">
  <div class="cbox" id='token'>

    <p><?php echo T_("Get access token of new connection from server"); ?></p>
    <p><?php echo T_("This key is disposable and has a time limit. It is usable only at the specified time and if it is used successfully or unsuccessfully once in a request, it loses its validity and needs to be rebuilt for the next request"); ?></p>
    <div class="msg url ltr txtL">
      <i class="method">POST</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>account/token</b></span>
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
    <pre>curl -X POST <?php echo \dash\data::CustomerApiURL(); ?>account/token -H 'appkey: <?php echo \dash\data::myAppKey(); ?>'</pre>

    <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "result": {
    "token": "ec8e69c19ebb7c202ae1097aa40484e0",
    "create": "2019-02-19 14:04:32",
    "expire": "2019-02-19 14:07:32"
  }
}
</pre>

  </div>
</div>
