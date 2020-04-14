<div class="box">
  <header>
    <h2 class="f" data-kerkere='#domain-dns' data-kerkere-icon='open'>
      <span class="c"><?php echo T_("Change domain dns"); ?></span>
      <span class="cauto pRa10"><span class="badge info">PATCH</span></span>
    </h2>
  </header>
  <div class="body" id="domain-dns">
      <div>

        <div class="msg url ltr txtL">
          <i class="method">PATCH</i>
          <span><?php echo \dash\data::IRNICApiURL(); ?><b>domain/dns</b></span>
        </div>

        <?php require(root. 'content_developers/docs/irnic/r10/000-public/header-appkey-apikey.php'); ?>

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
                <code>'S'</code>
              </td>
              <td>
                <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <h3 class="mB20"><?php echo T_("Input body"); ?></h3>



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
            <tr><td><div class="txtB">ns1</div><i>String</i></td><td><code>ns1.jibresdns.ir</code></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
            <tr><td><div class="txtB">ns2</div><i>String</i></td><td><code>ns2.jibresdns.ir</code></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
            <tr><td><div class="txtB">ns3</div><i>String</i></td><td><code>ns3.jibresdns.ir</code></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
            <tr><td><div class="txtB">ns4</div><i>String</i></td><td><code>ns4.jibresdns.ir</code></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
            <tr><td><div class="txtB">ip1</div><i>String</i></td><td><code></code></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
            <tr><td><div class="txtB">ip2</div><i>String</i></td><td><code></code></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
            <tr><td><div class="txtB">ip3</div><i>String</i></td><td><code></code></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
            <tr><td><div class="txtB">ip4</div><i>String</i></td><td><code></code></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          </tbody>
        </table>
      </div>



        <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X PATCH '<?php echo \dash\data::IRNICApiURL(); ?>domain/dns?id=S' \
-H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
-H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
-H 'Content-Type: application/json' \
--data-raw '{"ns1": "ns1.jibresdns.ir"}'
</pre>

        <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<samp>{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "Detail updated"
    }
  ],
  "result": true
}</samp>
    </div>
  </div>
</div>

