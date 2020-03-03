<h2 class="f" data-kerkere='#user-address-add-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge primary">POST</span></span>
  <span class="c"><?php echo T_("Add new address to user"); ?></span>
</h2>
<div id="user-address-add-detail">
  <div class="cbox" id='user-address-add'>

    <p><?php echo T_("Add new address to user"); ?></p>
    <div class="msg url ltr txtL">
      <i class="method">POST</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>user/address/add?id={USERID}</b></span>
    </div>

    <?php require (root. 'content_v2/doc/000-public/header-appkey-apikey.php'); ?>


    <div class="tblBox">
      <h3><?php echo T_("Parameters"); ?></h3>
      <table class="tbl1 v3">
        <thead>
          <tr>
            <th><?php echo T_("Name"); ?> <small><?php echo T_("type"); ?></small></th>
            <th><?php echo T_("Description"); ?> <small><?php echo T_("example"); ?></small></th>
            <th><?php echo T_("Constraints"); ?></th>
          </tr>
        </thead>
        <tbody>

          <tr><td><div class="txtB">address</div><i>String</i></td><td><div class="fc-mute"><?php echo T_("Example"); ?></div><i>St 19. qom. iran</i></td><td><div class="fc-red"><?php echo T_("Required"); ?></div></td></tr>
          <tr><td><div class="txtB">title</div><i>String</i></td><td><div class="fc-mute"><?php echo T_("Example"); ?></div><i>Sample 123</i></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
          <tr><td><div class="txtB">name</div><i>String</i></td><td><div class="fc-mute"><?php echo T_("Example"); ?></div><i>Sample 123</i></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
          <tr><td><div class="txtB">country</div><i>Code</i></td><td><div class="fc-mute"><?php echo T_("Get from location API"); ?> <a href="<?php echo \dash\url::this(); ?>#location-country"><?php echo T_("Click here"); ?></a></div></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
          <tr><td><div class="txtB">province</div><i>Code</i></td><td><div class="fc-mute"><?php echo T_("Get from location API"); ?> <a href="<?php echo \dash\url::this(); ?>#location-province"><?php echo T_("Click here"); ?></a></div></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
          <tr><td><div class="txtB">city</div><i>Code</i></td><td><div class="fc-mute"><?php echo T_("Get from location API"); ?> <a href="<?php echo \dash\url::this(); ?>#location-city"><?php echo T_("Click here"); ?></a></div></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
          <tr><td><div class="txtB">postcode</div><i>Number</i></td><td><div class="fc-mute"><?php echo T_("Example"); ?></div><i>3711111111</i></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
          <tr><td><div class="txtB">phone</div><i>Number</i></td><td><div class="fc-mute"><?php echo T_("Example"); ?></div><i>02537777777</i></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
          <tr><td><div class="txtB">mobile</div><i>Number</i></td><td><div class="fc-mute"><?php echo T_("Example"); ?></div><i>09109999999</i></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
          <tr><td><div class="txtB">address2</div><i>String</i></td><td><div class="fc-mute"><?php echo T_("Example"); ?></div><i>Sample 123</i></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
          <tr><td><div class="txtB">company</div><i>boolean</i></td><td><div class="fc-mute"><?php echo T_("Example"); ?></div><i>true</i></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
          <tr><td><div class="txtB">companyname</div><i>String</i></td><td><div class="fc-mute"><?php echo T_("Example"); ?></div><i>Sample 123</i></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
          <tr><td><div class="txtB">jobtitle</div><i>String</i></td><td><div class="fc-mute"><?php echo T_("Example"); ?></div><i>Sample 123</i></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>


        </tbody>
      </table>
    </div>

    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X POST \
  <?php echo \dash\data::CustomerApiURL(); ?>user/address/add?id={USERID} \
  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
  -H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
  -d '{"address" : "St 19. qom"}'
 </pre>

    <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "Address successfully added"
    }
  ],
  "result": {
    "id": "6"
  }
}
</pre>

  </div>
</div>
