<h2 class="f" data-kerkere='#profile-address-add-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge primary">POST</span></span>
  <span class="c"><?php echo T_("Add new address"); ?></span>
</h2>
<div id="profile-address-add-detail">
  <div class="cbox" id='profile-address-add'>
    <p><?php echo T_("Add new address to your profile"); ?></p>
    <div class="msg url ltr txtL">
      <i class="method">POST</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>profile/address/add</b></span>
    </div>

    <?php require (root. 'content_developers/docs/api/v2/000-public/header-appkey-apikey.php'); ?>


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
  <?php echo \dash\data::CustomerApiURL(); ?>profile/address/add \
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
