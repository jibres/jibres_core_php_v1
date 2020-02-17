<h2 class="f" data-kerkere='#mission-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get mission text"); ?></span>
</h2>
<div id="mission-detail">

  <div class="cbox" id='mission'>

    <div class="msg url">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>business/mission</b></span>
    </div>


    <div class="tblBox">
      <h3><?php echo T_("Required parameters"); ?> <?php echo T_("on header"); ?></h3>
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
              <div class="txtB">appkey</div>
              <i>string</i>
            </td>
            <td>
              <div><?php echo T_("APP key generated on the user panel"); ?></div>
              <code><?php echo \dash\data::myAppKey(); ?></code>
            </td>
            <td>
              <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              <?php echo T_("length"); ?> <?php echo \dash\fit::number(32); ?>
            </td>
          </tr>

        </tbody>
      </table>
    </div>

    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
    <pre>curl -X GET <?php echo \dash\data::CustomerApiURL(); ?>business/mission -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' </pre>

    <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "result": {
    "language": "en",
    "title": "mission",
    "slug": "mission",
    "url": "<?php echo \dash\data::CustomerApiURL(); ?>mission",
    "content": "Your mission text"
  }
}
</pre>

  </div>
</div>
