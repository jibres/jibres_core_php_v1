<div class="box">
  <header>
    <h2 class="f" data-kerkere='#domain-available' data-kerkere-icon='open'>
      <span class="cauto pRa10"><span class="badge success">GET</span></span>
      <span class="c"><?php echo T_("Load domain available"); ?></span>
    </h2>
  </header>
  <div class="body" id="domain-available">
      <div>

        <div class="msg url ltr txtL">
          <i class="method">GET</i>
          <span><?php echo \dash\data::IRNICApiURL(); ?><b>domain/available</b></span>
        </div>

        <?php require(root. 'content_r10/irnic/doc/000-public/header-appkey.php'); ?>


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
                <div class="txtB">domain</div>
                <i>string</i>
              </td>
              <td>
                <i><?php echo T_("For example") ?></i>
                <code>'jibresisamazing'</code>
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
curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X GET '<?php echo \dash\data::IRNICApiURL(); ?>domain/available?domain=jibresisamazing' \
-H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
-H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

        <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<samp>{
  "ok": true,
  "result": {
    "available": true
  }
}</samp>
    </div>
  </div>
</div>

