<h2 class="f" data-kerkere='#ticket-replay-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge primary">POST</span></span>
  <span class="c"><?php echo T_("Replay the ticket"); ?></span>
</h2>
<div id="ticket-replay-detail">
  <div class="cbox" id='ticket-replay'>
    <div class="msg url ltr txtL">
      <i class="method">POST</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>ticket/{TICKET}/replay</b></span>
    </div>

         <?php require (root. 'content_v2/doc/000-public/header-appkey-apikey.php'); ?>

     <div class="tblBox">
      <h3><?php echo T_("Required parameters"); ?></h3>
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
              <div class="txtB">content</div>
              <i>String</i>
            </td>
            <td>
              <p><?php echo T_("The ticket content"); ?></p>
            </td>
            <td>
              <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
            </td>
          </tr>

          <tr>
            <td>
              <div class="txtB">title</div>
              <i>String</i>
            </td>
            <td>
              <p><?php echo T_("The ticket title"); ?></p>
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
curl -X POST <?php echo \dash\data::CustomerApiURL(); ?>ticket/{TICKET}/replay -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?> -d '{"content": "Can Help me?"}'
</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span><?php echo T_("Response"); ?> <small><?php echo T_("Example"); ?></small></h3>
<pre>
{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "Your ticket was sended"
    }
  ],
  "result": {
    "id": 1,
    "date": "2019-11-30 11:50:18",
    "code": "3b74e53be7bcfbc0822ebe46221bc07a",
    "codeurl": "<?php echo \dash\url::kingdom(); ?>/support/ticket/show?id=1&guest=3b74e53be7bcfbc0822ebe46221bc07a"
  }
}
</pre>


  </div>
</div>

