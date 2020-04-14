<div class="box">
  <header>
    <h2 class="f" data-kerkere='#domain-check' data-kerkere-icon='open'>
      <span class="cauto pRa10"><span class="badge success">GET</span></span>
      <span class="c"><?php echo T_("Choose best domain"); ?></span>
    </h2>
  </header>
  <div class="body" id="domain-check">
      <div>

        <div class="msg url ltr txtL">
          <i class="method">GET</i>
          <span><?php echo \dash\data::IRNICApiURL(); ?><b>domain/check</b></span>
        </div>

        <?php require(root. 'content_developers/docs/irnic/r10/000-public/header-appkey.php'); ?>


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
curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X GET '<?php echo \dash\data::IRNICApiURL(); ?>domain/check?domain=jibresisamazing' \
-H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
-H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

        <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<samp>{
  "jibresisamazing.ir": {
    "name": "jibresisamazing",
    "available": true,
    "price": 5000,
    "compareAtPrice": 6000,
    "unit": "Toman",
    "tld": "ir",
    "paperwork": null
  },
  "jibresisamazing.id.ir": {
    "name": "jibresisamazing",
    "available": true,
    "price": 5000,
    "compareAtPrice": 6000,
    "unit": "Toman",
    "tld": "id.ir",
    "paperwork": "irnic person"
  },
  "jibresisamazing.gov.ir": {
    "name": "jibresisamazing",
    "available": true,
    "price": 5000,
    "compareAtPrice": 6000,
    "unit": "Toman",
    "tld": "gov.ir",
    "paperwork": "irnic gov"
  },
  "jibresisamazing.co.ir": {
    "name": "jibresisamazing",
    "available": true,
    "price": 5000,
    "compareAtPrice": 6000,
    "unit": "Toman",
    "tld": "co.ir",
    "paperwork": "irnic private"
  },
  "jibresisamazing.net.ir": {
    "name": "jibresisamazing",
    "available": true,
    "price": 5000,
    "compareAtPrice": 6000,
    "unit": "Toman",
    "tld": "net.ir",
    "paperwork": "irnic private"
  },
  "jibresisamazing.org.ir": {
    "name": "jibresisamazing",
    "available": true,
    "price": 5000,
    "compareAtPrice": 6000,
    "unit": "Toman",
    "tld": "org.ir",
    "paperwork": "irnic private or edu"
  },
  "jibresisamazing.sch.ir": {
    "name": "jibresisamazing",
    "available": true,
    "price": 5000,
    "compareAtPrice": 6000,
    "unit": "Toman",
    "tld": "sch.ir",
    "paperwork": "irnic edu"
  },
  "jibresisamazing.ac.ir": {
    "name": "jibresisamazing",
    "available": true,
    "price": 5000,
    "compareAtPrice": 6000,
    "unit": "Toman",
    "tld": "ac.ir",
    "paperwork": "irnic edu"
  }
}</samp>
    </div>
  </div>
</div>

