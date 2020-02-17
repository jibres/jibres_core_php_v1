<h2 class="f" data-kerkere='#user-add-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge primary">POST</span></span>
  <span class="c"><?php echo T_("Sign Up User"); ?></span>
</h2>
<div id="user-add-detail">
  <div class="cbox" id='user-add'>

    <p><?php echo T_("This service is used to add users through the Android app."); ?></p>
    <div class="msg url">
      <i class="method">POST</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>account/android/add</b></span>
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
              <code>ec8e69c19ebb7c202ae1097aa40484e0</code>
            </td>
            <td>
              <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              <?php echo T_("length"); ?> <?php echo \dash\fit::number(32); ?>
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
              <div class="txtB">model</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("example"); ?></div>
              <code>HUAWEI Y560-U02</code>
            </td>
            <td>
              <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              <?php echo T_("Max length"); ?> <?php echo \dash\fit::number(100); ?>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">serial</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("example"); ?></div>
              <code>60D15B27D1259123456</code>
            </td>
            <td>
              <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              <?php echo T_("Max length"); ?> <?php echo \dash\fit::number(100); ?>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">manufacturer</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("example"); ?></div>
              <code>HUAWEI</code>
            </td>
            <td>
              <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              <?php echo T_("Max length"); ?> <?php echo \dash\fit::number(100); ?>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">version</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("example"); ?></div>
              <code>19</code>
            </td>
            <td>
              <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              <?php echo T_("Max length"); ?> <?php echo \dash\fit::number(20); ?>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">hardware</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("example"); ?></div>
              <code>sc8830</code>
            </td>
            <td>
              <div class="fc-mute fs08"><i><?php echo T_("Optional"); ?></i></div>
              <?php echo T_("Max length"); ?> <?php echo \dash\fit::number(50); ?>
            </td>
          </tr>

          <tr>
            <td>
              <div class="txtB">type</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("example"); ?></div>
              <code>user</code>
            </td>
            <td>
              <div class="fc-mute fs08"><i><?php echo T_("Optional"); ?></i></div>
              <?php echo T_("Max length"); ?> <?php echo \dash\fit::number(50); ?>
            </td>
          </tr>

          <tr>
            <td>
              <div class="txtB">board</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("example"); ?></div>
              <code>HUAWEI</code>
            </td>
            <td>
              <div class="fc-mute fs08"><i><?php echo T_("Optional"); ?></i></div>
              <?php echo T_("Max length"); ?> <?php echo \dash\fit::number(100); ?>
            </td>
          </tr>

          <tr>
            <td>
              <div class="txtB">id</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("example"); ?></div>
              <code>HUAWEIY560-U02</code>
            </td>
            <td>
              <div class="fc-mute fs08"><i><?php echo T_("Optional"); ?></i></div>
              <?php echo T_("Max length"); ?> <?php echo \dash\fit::number(100); ?>
            </td>
          </tr>

          <tr>
            <td>
              <div class="txtB">product</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("example"); ?></div>
              <code>Y560-U02</code>
            </td>
            <td>
              <div class="fc-mute fs08"><i><?php echo T_("Optional"); ?></i></div>
              <?php echo T_("Max length"); ?> <?php echo \dash\fit::number(100); ?>
            </td>
          </tr>

          <tr>
            <td>
              <div class="txtB">device</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("example"); ?></div>
              <code>HWY560-U</code>
            </td>
            <td>
              <div class="fc-mute fs08"><i><?php echo T_("Optional"); ?></i></div>
              <?php echo T_("Max length"); ?> <?php echo \dash\fit::number(100); ?>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">brand</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("example"); ?></div>
              <code>HUAWEI</code>
            </td>
            <td>
              <div class="fc-mute fs08"><i><?php echo T_("Optional"); ?></i></div>
              <?php echo T_("Max length"); ?> <?php echo \dash\fit::number(100); ?>
            </td>
          </tr>


        </tbody>
      </table>
    </div>

    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X POST \
  <?php echo \dash\data::CustomerApiURL(); ?>account/android/add \
  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
  -H 'token: ec8e69c19ebb7c202ae1097aa40484e0' \
  -d '{"model": "HUAWEI Y560-U02", "serial": "60D15B27D1259123456", "manufacturer": "HUAWEI", "version": "19","hardware": "sc8830","type": "user","board": "HUAWEI","id": ">HUAWEIY560-U02","product": "Y560-U02","device": "HWY560-U","brand": "HUAWEI"}'
</pre>

    <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "result": {
    "usercode": "3N5C",
    "zoneid": "android-ZW3N"
    "apikey": "87923bd0d04b30aa5f66b699c2698e3b",
  }
}
</pre>

  </div>
</div>
