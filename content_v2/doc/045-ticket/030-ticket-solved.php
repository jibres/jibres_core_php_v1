<h2 class="f" data-kerkere='#ticket-solved-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge warn">PUT</span></span>
  <span class="c"><?php echo T_("Set solved ticket"); ?></span>
</h2>
<div id="ticket-solved-detail">
  <div class="cbox" id='ticket-solved'>
    <div class="msg url ltr txtL">
      <i class="method">PUT</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>ticket/{TICKET}/solved</b></span>
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
              <div class="txtB">solved</div>
              <i>Boolean</i>
            </td>
            <td>
              <p><?php echo T_("The ticket solved"); ?></p>
              <code>true, false</code>
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
curl -X PUT <?php echo \dash\data::CustomerApiURL(); ?>ticket/{TICKET}/solved -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?> -d '{"solved": true}'
</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span><?php echo T_("Response"); ?> <small><?php echo T_("Example"); ?></small></h3>
<pre>
{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "Ticket set as solved"
    }
  ],
  "result": true
}
</pre>


  </div>
</div>

