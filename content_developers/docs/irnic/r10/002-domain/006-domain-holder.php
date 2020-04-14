<div class="box">
  <header>
    <h2 class="f" data-kerkere='#domain-holder' data-kerkere-icon='open'>
      <span class="cauto pRa10"><span class="badge info">PATCH</span></span>
      <span class="c"><?php echo T_("Change domain holder"); ?></span>
    </h2>
  </header>
  <div class="body" id="domain-holder">
      <div>

        <div class="msg url ltr txtL">
          <i class="method">PATCH</i>
          <span><?php echo \dash\data::IRNICApiURL(); ?><b>domain/holder</b></span>
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
             <tr>
              <td>
                <div class="txtB">tech</div>
                <i>String</i>
              </td>
              <td>
                <i><?php echo T_("IRNIC contact") ?></i>
                <br>
                <code>ex66-irnic</code>
              </td>
              <td>
                <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
              </td>
            </tr>

            <tr>
              <td>
                <div class="txtB">bill</div>
                <i>String</i>
              </td>
              <td>
                <i><?php echo T_("IRNIC contact") ?></i>
                <br>
                <code>ex66-irnic</code>
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
curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X PATCH '<?php echo \dash\data::IRNICApiURL(); ?>domain/holder?id=S' \
-H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
-H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
-H 'Content-Type: application/json' \
--data-raw '{"bill": "ex66-irnic"}'
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

