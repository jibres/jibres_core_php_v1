<h2 class="f" data-kerkere='#location-province-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get list of province"); ?></span>
</h2>
<div id="location-province-detail">
  <div class="cbox" id='location-province'>

    <p><?php echo T_("The endpoint for this method is different"); ?></p>
    <div class="msg url ltr txtL">
      <i class="method">GET</i>
      <span><?php echo \dash\data::JibresApiURL(); ?><b>location/province</b></span>
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
              <div class="txtB">country</div>
              <i>Code</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("example"); ?></div>
              <code>IR</code>
            </td>
            <td>
              <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>curl -X GET <?php echo \dash\data::JibresApiURL(); ?>location/province?country=IR</pre>

    <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "result": [
    {
        "id": 0,
        "text": "Please choose province",
        "disable": true
    },
    {
        "country": "IR",
        "slug": "iran-east-azerbaijan",
        "name": "east azerbaijan",
        "localname": "آذربایجان شرقی",
        "map_code": "ir-wa",
        "population": 3724620,
        "width": "37°9035733",
        "length": "46°2682109",
        "phone_code": 41,
        "id": "IR-01",
        "text": "آذربایجان شرقی"
    },
    ...
  ]
}
</pre>

  </div>
</div>
