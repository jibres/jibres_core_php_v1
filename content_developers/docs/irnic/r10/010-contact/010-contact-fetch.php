<div class="box">
  <header>
    <h2 class="f" data-kerkere='#contact-fetch' data-kerkere-icon='open'>
      <span class="c"><?php echo T_("Get IRNIC contact list"); ?></span>
      <span class="cauto pRa10"><span class="badge success">GET</span></span>
    </h2>
  </header>
  <div class="body" id="contact-fetch">
      <div>

      <div class="msg url ltr txtL">
        <i class="method">GET</i>
        <span><?php echo \dash\data::IRNICApiURL(); ?><b>contact/fetch</b></span>
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
                <div class="txtB">all</div>
                <i>Boolean</i>
              </td>
              <td>
                <i><?php echo T_("If you want to get all list without pagination") ?></i>

              </td>
              <td>
                <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
                <i><?php echo T_("Default value: false") ?></i>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

        <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
        <pre>curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X GET '<?php echo \dash\data::IRNICApiURL(); ?>contact/fetch' -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'</pre>

        <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<samp>{
  "ok": true,
  "meta": {
    "filter_message": null,
    "is_filtered": false
  },
  "pagination": {
    "desc": "page 1 of 1 - Show record 1 to 1 of 1",
    "page": 1,
    "total_page": 1,
    "limit": 20,
    "total_rows": 1
  },
  "result": [
    {
      "id": "B",
      "nic_id": "ex66-irnic",
      "roid": "ex66-irnic",
      "title": "dsfsdfsdf",
      "holder": "1",
      "admin": "1",
      "tech": "1",
      "bill": "1",
      "isdefault": "1",
      "firstname": null,
      "lastname": null,
      "firstname_en": null,
      "lastname_en": null,
      "nationalcode": null,
      "passportcode": null,
      "company": null,
      "category": null,
      "email": null,
      "country": null,
      "province": null,
      "city": null,
      "postcode": null,
      "address": null,
      "mobile": null,
      "signator": null,
      "status": "enable",
      "jsonstatus": null,
      "datecreated": "2020-02-25 13:39:16",
      "datemodified": null
    }
  ]
}</samp>
    </div>
  </div>
</div>

