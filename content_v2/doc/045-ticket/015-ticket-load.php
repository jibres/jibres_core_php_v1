<h2 class="f" data-kerkere='#ticket-load-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Load a ticket"); ?></span>
</h2>
<div id="ticket-load-detail">
  <div class="cbox" id='ticket-load'>
    <div class="msg url">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>ticket/{TICKET}</b></span>
    </div>

         <?php require (root. 'content_api/v2/doc/000-public/header-appkey-apikey.php'); ?>



    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X GET <?php echo \dash\data::CustomerApiURL(); ?>ticket/{TICKET} -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span><?php echo T_("Response"); ?> <small><?php echo T_("Example"); ?></small></h3>
<pre>
{
  "ok": true,
  "result": [
    {
      "id": "1",
      "code": "3b74e53be7bcfbc0822ebe46221bc07a",
      "user_id": "JJ",
      "title": null,
      "content": "salam ticket",
      "meta": null,
      "rowColor": null,
      "colorClass": "pain",
      "status": "awaiting",
      "parent": null,
      "type": "ticket",
      "prettyip": "127.0.0.1",
      "ip": "2130706433",
      "file": null,
      "plus": null,
      "answertime": null,
      "solved": null,
      "via": null,
      "see": null,
      "datemodified": null,
      "datecreated": "2019-11-30 11:50:18",
      "avatar": "<?php echo \dash\url::site(); ?>/static/siftal/images/default/avatar.png",
      "firstname": "رضا",
      "displayname": "رضا محیطی"
    }
  ]
}
</pre>


  </div>
</div>

