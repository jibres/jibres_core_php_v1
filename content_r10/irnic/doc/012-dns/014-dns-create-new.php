<div class="box">
  <header>
    <h2 class="f" data-kerkere='#dns-create-new' data-kerkere-icon='open'>
      <span class="cauto pRa10"><span class="badge primary">POST</span></span>
      <span class="c"><?php echo T_("Create new IRNIC dns"); ?></span>
    </h2>
  </header>
  <div class="body" id="dns-create-new">
    <div>

      <div class="msg url ltr txtL">
        <i class="method">POST</i>
        <span><?php echo \dash\data::IRNICApiURL(); ?><b>dns/create</b></span>
      </div>

      <?php require(root. 'content_r10/irnic/doc/000-public/header-appkey-apikey.php'); ?>


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
             <tr>
              <td>
                <div class="txtB">title</div>
                <i>String</i>
              </td>
              <td>
                <i><?php echo T_("For example") ?></i>
                <code>DNS New title</code>
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

            <tr><td><div class="txtB">ns1</div><i>String</i></td><td></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
            <tr><td><div class="txtB">ns2</div><i>String</i></td><td></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
            <tr><td><div class="txtB">ns3</div><i>String</i></td><td></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
            <tr><td><div class="txtB">ip1</div><i>String</i></td><td></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
            <tr><td><div class="txtB">ip2</div><i>String</i></td><td></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
            <tr><td><div class="txtB">ns4</div><i>String</i></td><td></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
            <tr><td><div class="txtB">ip3</div><i>String</i></td><td></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
            <tr><td><div class="txtB">ip4</div><i>String</i></td><td></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
          </tbody>
        </table>
      </div>



      <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X POST '<?php echo \dash\data::IRNICApiURL(); ?>dns/create' \
-H 'Content-Type: application/json' \
-H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
-H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
--data-raw '{"title": "Test","ns1": "ns1.jibres.com","ns2": "ns2.jibres.com","ip1": "192.168.1.1","ip2": "192.168.1.2"}'
</pre>

      <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<samp>{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "DNS added"
    }
  ],
  "result": true
}</samp>
    </div>
  </div>
</div>