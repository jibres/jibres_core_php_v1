<div class="box">
  <header>
    <h2 class="f" data-kerkere='#contact-patch' data-kerkere-icon='open'>
      <span class="cauto pRa10"><span class="badge info">PATCH</span></span>
      <span class="c"><?php echo T_("Update contact information"); ?></span>
    </h2>
  </header>
  <div class="body" id="contact-patch">
    <div>

      <div class="msg url ltr txtL">
        <i class="method">PATCH</i>
        <span><?php echo \dash\data::IRNICApiURL(); ?><b>contact</b></span>
      </div>

      <?php require(root. 'content_r10/irnic/doc/000-public/header-appkey-apikey.php'); ?>


      <h3 class="mB20"><?php echo T_("Query Params"); ?></h3>

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
                <div class="txtB">id</div>
                <i>code</i>
              </td>
              <td>
                <i><?php echo T_("For example") ?></i>
                <code>'B'</code>
              </td>
              <td>
                <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>


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
                <div class="txtB">title</div>
                <i>String</i>
              </td>
              <td>
                <i><?php echo T_("For example") ?></i>
                <code>Contact New title</code>
              </td>
              <td>
                <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
              </td>
            </tr>

            <tr>
              <td>
                <div class="txtB">isdefault</div>
                <i>Boolean</i>
              </td>
              <td>
                <i>true | false</i>
              </td>
              <td>
                <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>



      <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X PATCH '<?php echo \dash\data::IRNICApiURL(); ?>contact?id=B' \
-H 'Content-Type: application/json' \
-H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
-H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
--data-raw '{"isdefault":false, "title":"Contact New title"}'
</pre>

      <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<samp>{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "Contact updateded"
    }
  ],
  "result": true
}</samp>
    </div>
  </div>
</div>

