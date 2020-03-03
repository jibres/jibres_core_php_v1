<h2 class="f" data-kerkere='#user-add-crm-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge primary">POST</span></span>
  <span class="c"><?php echo T_("Add new user"); ?></span>
</h2>
<div id="user-add-crm-detail">
  <div class="cbox" id='user-add-crm'>
    <p><?php echo T_("Add new user to members list"); ?></p>
    <p><?php echo T_("This method is different by sinup user api"); ?></p>
    <p><?php echo T_("In this metho you must have permission to add new user"); ?></p>
    <div class="msg url ltr txtL">
      <i class="method">POST</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>user/add</b></span>
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
              <div class="txtB">mobile</div>
              <i>number</i>
            </td>
            <td>
              <p><?php echo T_("The user mobile"); ?></p>
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
curl -X POST \
  <?php echo \dash\data::CustomerApiURL(); ?>user/add \
  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
  -H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
  -d '{"mobile": "9109999999"}'
</pre>


<h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "User successfuly added"
    }
  ],
  "result": {
    "id": "Jy"
  }
}
</pre>

  </div>
</div>
