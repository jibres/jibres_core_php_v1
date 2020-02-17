<h2 class="f" data-kerkere='#user-login-verify-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge primary">POST</span></span>
  <span class="c"><?php echo T_("Verify user"); ?></span>
</h2>
<div id="user-login-verify-detail">
  <div class="cbox" id='user-login-verify'>
    <p><?php echo T_("After send verification code to user you must verify it"); ?></p>
    <div class="msg url">
      <i class="method">POST</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>account/enter/verify</b></span>
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
          <tr>
            <td>
              <div class="txtB">token</div>
              <i>string</i>
            </td>
            <td>
              <div><?php echo T_("Your temporary token"); ?></div>
              <code>d97a1190a211bc8896c1c7319af916a9</code>
            </td>
            <td>
              <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              <?php echo T_("length"); ?> <?php echo \dash\fit::number(32); ?>
              <div><?php echo T_("To get this token see"); ?> <a href="<?php echo \dash\url::that(); ?>#token"><small><?php echo T_("Read more"); ?></small></a></div>
            </td>
          </tr>

          <tr>
            <td>
              <div class="txtB">apikey</div>
              <i>string</i>
            </td>
            <td>
              <div><?php echo T_("Your apikey"); ?></div>
              <code><?php echo \dash\data::myApiKey(); ?></code>
            </td>
            <td>
              <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              <?php echo T_("length"); ?> <?php echo \dash\fit::number(32); ?>
              <div><?php echo T_("Get from your account or signup user"); ?> <a href="<?php echo \dash\url::that(); ?>#user-add"><small><?php echo T_("Read more"); ?></small></a></div>
          </td>
          </tr>
        </tbody>
      </table>
    </div>


    <div class="tblBox">
      <h3><?php echo T_("Required parameters"); ?></h3>
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
              <div class="txtB">mobile</div>
              <i>number</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("example"); ?></div>
              <code>989121234567</code>
            </td>
            <td>
              <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              <?php echo T_("Max length"); ?> <?php echo \dash\fit::number(12); ?>
              <?php echo T_("Min length"); ?> <?php echo \dash\fit::number(7); ?>
            </td>
          </tr>

          <tr>
            <td>
              <div class="txtB">verifycode</div>
              <i>int</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("example"); ?></div>
              <code>12345</code>
            </td>
            <td>
              <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              <?php echo T_("length"); ?> <?php echo \dash\fit::number(5); ?>

            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X POST \
  <?php echo \dash\data::CustomerApiURL(); ?>account/enter/verify \
  -H 'token: d97a1190a211bc8896c1c7319af916a9' \
  -H 'apikey: <?php echo \dash\data::YourApiKey(); ?>' \
  -H 'appkey: <?php echo \dash\data::YourAppKey(); ?>' \
  -d '{"mobile":"989121234567", "verifycode": "12345"}'
</pre>

    <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "Code is ok"
    }
  ],
  "result": {
    "apikey": "<?php echo \dash\data::myApiKey(); ?>"
  }
}
</pre>

  </div>
</div>
