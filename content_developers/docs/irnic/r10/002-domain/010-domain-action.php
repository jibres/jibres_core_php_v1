<div class="box">
  <header>
    <h2 class="f" data-kerkere='#domain-action' data-kerkere-icon='open'>
      <span class="cauto pRa10"><span class="badge success">GET</span></span>
      <span class="c"><?php echo T_("Get domain action"); ?></span>
    </h2>
  </header>
  <div class="body" id="domain-action">
      <div>

        <div class="msg url ltr txtL">
          <i class="method">GET</i>
          <span><?php echo \dash\data::IRNICApiURL(); ?><b>domain/action</b></span>
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


        <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X GET '<?php echo \dash\data::IRNICApiURL(); ?>domain/action?id=S' \
-H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
-H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

        <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<samp>{
  "ok": true,
  "pagination": {
    "desc": "صفحه ۱ از ۱ - نمایش رکورد ۱ تا ۱ از ۱",
    "page": 1,
    "total_page": 1,
    "limit": 20,
    "total_rows": 1
  },
  "result": [
    {
      "id": "R",
      "domain_id": "S",
      "status": "enable",
      "action": "register",
      "mode": "manual",
      "detail": null,
      "date": "2020-02-26 16:24:08",
      "price": "3000",
      "discount": null,
      "transaction_id": "BL",
      "datecreated": "2020-02-26 16:24:08",
      "taction": "ثبت دامنه",
      "class": "",
      "icon": ""
    }
  ]
}</samp>
    </div>
  </div>
</div>

