<h2 class="f" data-kerkere='#ticket-list-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get list of ticket"); ?></span>
</h2>
<div id="ticket-list-detail">
  <div class="cbox" id='ticket-list'>
    <div class="msg url ltr txtL">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>ticket/fetch</b></span>
    </div>

         <?php require (root. 'content_developers/docs/api/v2/000-public/header-appkey-apikey.php'); ?>



    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X GET <?php echo \dash\data::CustomerApiURL(); ?>ticket/fetch -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span><?php echo T_("Response"); ?> <small><?php echo T_("Example"); ?></small></h3>
<pre>
{
  "ok": true,
  "pagination": {
    "desc": "page 1 of 1 - Show record 1 to 1 of 1",
    "page": 1,
    "total_page": 1,
    "limit": 10,
    "total_rows": 1
  },
  "result": [
    {
      "id": "1",
      "code": "72d9135f3a870e775e3671a974a1446a",
      "user_id": "JJ",
      "title": null,
      "content": "salam ticdket",
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
      "datecreated": "2019-11-30 11:56:41",
      "avatar": "<?php echo \dash\url::site(); ?>/static/siftal/images/default/avatar.png",
      "firstname": "رضا",
      "displayname": "رضا محیطی",
      "user_in_ticket": [],
      "tag": null,
      "user_in_ticket_detail": []
    }
  ]
}
</pre>


  </div>
</div>

