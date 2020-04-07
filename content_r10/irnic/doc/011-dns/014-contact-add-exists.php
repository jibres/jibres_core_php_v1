<div class="box">
  <header>
    <h2 class="f" data-kerkere='#dns-add' data-kerkere-icon='open'>
      <span class="cauto pRa10"><span class="badge primary">POST</span></span>
      <span class="c"><?php echo T_("Add An existing dns to your list"); ?></span>
    </h2>
  </header>
  <div class="body" id="dns-add">
    <div>

      <div class="msg url ltr txtL">
        <i class="method">POST</i>
        <span><?php echo \dash\data::IRNICApiURL(); ?><b>dns/add</b></span>
      </div>

      <?php require(root. 'content_r10/irnic/doc/000-public/header-appkey-apikey.php'); ?>


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
                <div class="txtB">dns_id</div>
                <i>String</i>
              </td>
              <td>
                <i><?php echo T_("Exists dns id"); ?></i>
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
curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X POST '<?php echo \dash\data::IRNICApiURL(); ?>dns/create' \
-H 'Content-Type: application/json' \
-H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
-H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
--data-raw '{"title":"my DNS"}'
</pre>

      <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<samp>{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "dns added"
    }
  ],
  "result": true
}</samp>
    </div>
  </div>
</div>