<div class="box">
  <header>
    <h2 class="f" data-kerkere='#contact-load' data-kerkere-icon='open'>
      <span class="cauto pRa10"><span class="badge success">GET</span></span>
      <span class="c"><?php echo T_("Load domain contact detail"); ?></span>
    </h2>
  </header>
  <div class="body" id="contact-load">
    <div id='contact'>

      <div class="msg url ltr txtL">
        <i class="method">GET</i>
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



      <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
      <pre>curl <?php if(\dash\url::isLocal()) { echo '-k'; } ?> -X GET '<?php echo \dash\data::IRNICApiURL(); ?>contact?id=B' -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'</pre>

      <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<samp>{
  "ok": true,
  "result": {
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
}</samp>
  </div>
</div>

