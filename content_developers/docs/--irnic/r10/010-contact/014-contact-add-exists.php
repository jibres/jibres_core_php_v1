<div class="box">
  <header>
    <h2 class="f" data-kerkere='#contact-add' data-kerkere-icon='open'>
      <span class="c"><?php echo T_("Add An existing contact to your list"); ?></span>
      <span class="cauto pRa10"><span class="badge primary">POST</span></span>
    </h2>
  </header>
  <div class="body" id="contact-add">
    <div>

      <div class="msg url ltr txtL">
        <i class="method">POST</i>
        <span><?php echo \dash\data::IRNICApiURL(); ?><b>contact/add</b></span>
      </div>

      <?php require(root. 'content_developers/docs/irnic/r10/000-public/header-appkey-apikey.php'); ?>


      <h3 class="mB20"><?php echo T_("Body"); ?></h3>

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
            <tr>
              <td>
                <div class="txtB">contact_id</div>
                <i>String</i>
              </td>
              <td>
                <i><?php echo T_("Exists contact id"); ?></i>
              </td>
              <td>
                <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>



      <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X POST '<?php echo \dash\data::IRNICApiURL(); ?>contact/add' \
-H 'Content-Type: application/json' \
-H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
-H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
--data-raw '{"contact_id":"ex66-xxxxx"}'
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