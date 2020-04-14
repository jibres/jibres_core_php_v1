<div class="box">
  <header>
    <h2 class="f" data-kerkere='#contact-create-new' data-kerkere-icon='open'>
      <span class="cauto pRa10"><span class="badge primary">POST</span></span>
      <span class="c"><?php echo T_("Create new IRNIC contact"); ?></span>
    </h2>
  </header>
  <div class="body" id="contact-create-new">
    <div>

      <div class="msg url ltr txtL">
        <i class="method">POST</i>
        <span><?php echo \dash\data::IRNICApiURL(); ?><b>contact/create</b></span>
      </div>

      <?php require(root. 'content_developers/docs/irnic/r10/000-public/header-appkey-apikey.php'); ?>


      <h3 class="mB20"><?php echo T_("Input Body"); ?></h3>

      <div class="tblBox">
        <table class="tbl1 v3">
          <thead>
            <tr>
              <th><?php echo T_("Name"); ?> <small><?php echo T_("type"); ?></small></th>
              <th><?php echo T_("Description"); ?> <small><?php echo T_("example"); ?></small></th>
              <th><?php echo T_("Constraints"); ?></th>
            </tr>
          </thead>
          <tbody>
            <tr><td><div class="txtB">title</div><i>String</i></td><td></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
            <tr><td><div class="txtB">firstname</div><i>String</i></td><td></td><td><div class="fc-red"><i><?php echo T_("Required"); ?></i></div></td></tr>
            <tr><td><div class="txtB">lastname</div><i>String</i></td><td></td><td><div class="fc-red"><i><?php echo T_("Required"); ?></i></div></td></tr>
            <tr><td><div class="txtB">nationalcode</div><i>Number</i></td><td></td><td><div class="fc-red"><i><?php echo T_("Required"); ?></i></div></td></tr>
            <tr><td><div class="txtB">email</div><i>String</i></td><td></td><td><div class="fc-red"><i><?php echo T_("Required"); ?></i></div></td></tr>
            <tr><td><div class="txtB">country</div><i>String</i></td><td></td><td><div class="fc-red"><i><?php echo T_("Required"); ?></i></div></td></tr>
            <tr><td><div class="txtB">province</div><i>String</i></td><td></td><td><div class="fc-red"><i><?php echo T_("Required"); ?></i></div></td></tr>
            <tr><td><div class="txtB">city</div><i>String</i></td><td></td><td><div class="fc-red"><i><?php echo T_("Required"); ?></i></div></td></tr>
            <tr><td><div class="txtB">postcode</div><i>Number</i></td><td></td><td><div class="fc-red"><i><?php echo T_("Required"); ?></i></div></td></tr>
            <tr><td><div class="txtB">phone</div><i>Number</i></td><td></td><td><div class="fc-red"><i><?php echo T_("Required"); ?></i></div></td></tr>
            <tr><td><div class="txtB">address</div><i>String</i></td><td></td><td><div class="fc-red"><i><?php echo T_("Required"); ?></i></div></td></tr>
          </tbody>
        </table>
      </div>



      <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X POST '<?php echo \dash\data::IRNICApiURL(); ?>contact/create' \
-H 'Content-Type: application/json' \
-H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
-H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
--data-raw '{"title": "Test","firstname": "Test","lastname": "Test","nationalcode": "1234567890","email": "Test@test.com","country": "Test","province": "Test","city": "Test","postcode": "Test","phone": "Test","address": "Test"}'
</pre>

      <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<samp>{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "Contact added"
    }
  ],
  "result": true
}</samp>
    </div>
  </div>
</div>