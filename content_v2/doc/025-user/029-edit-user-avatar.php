<h2 class="f" data-kerkere='#edit-user-avatar-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge primary">POST</span></span>
  <span class="c"><?php echo T_("Update avatar"); ?></span>
</h2>
<div id="edit-user-avatar-detail">
  <div class="cbox" id='edit-user-avatar'>
    <p><?php echo T_("Upload user avatar to change it"); ?></p>
    <div class="msg url">
      <i class="method">POST</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>user/edit/avatar?id={USERID}</b></span>
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
              <div class="txtB">avatar</div>
              <i>FILE</i>
            </td>
            <td>
              <div><?php echo T_("You file location to upload"); ?></div>

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
  <?php echo \dash\data::CustomerApiURL(); ?>user/edit/avatar?id={USERID} \
  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
  -H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
  -F avatar=@/home/user/Desktop/yourfile.jpg
</pre>

    <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "User successfully updated"
    }
  ],
  "result": null
}
</pre>

  </div>
</div>
