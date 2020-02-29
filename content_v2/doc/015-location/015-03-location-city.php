<h2 class="f" data-kerkere='#location-city-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get list of city"); ?></span>
</h2>
<div id="location-city-detail">
  <div class="cbox" id='location-city'>

    <p><?php echo T_("The endpoint for this method is different"); ?></p>
    <div class="msg url">
      <i class="method">GET</i>
      <span><?php echo \dash\data::JibresApiURL(); ?><b>location/city</b></span>
    </div>


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
              <div class="txtB">province</div>
              <i>Code</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("example"); ?></div>
              <code>IR-01</code>
            </td>
            <td>
              <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>curl -X GET <?php echo \dash\data::JibresApiURL(); ?>location/city?province=IR-01</pre>

    <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "result": [
    {
      "id": 0,
      "text": "Please choose city",
      "disable": true
    },
    {
      "country": "IR",
      "province": "IR-01",
      "name": "tabriz",
      "localname": "تبریز",
      "population": 1695094,
      "width": "38°066667",
      "length": "46°3",
      "province_phone_code": 41,
      "id": "tabriz",
      "text": "تبریز"
    },
    ...
  ]
}
</pre>

  </div>
</div>
