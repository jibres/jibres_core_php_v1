<h2 class="f" data-kerkere='#edit-user-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge info">PATCH</span></span>
  <span class="c"><?php echo T_("Update your profile"); ?></span>
</h2>
<div id="edit-user-detail">
  <div class="cbox" id='edit-user'>
    <p><?php echo T_("Update profile detail"); ?></p>
    <div class="msg url ltr txtL">
      <i class="method">PATCH</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>user/edit?id={USERID}</b></span>
    </div>

    <?php require (root. 'content_v2/doc/000-public/header-appkey-apikey.php'); ?>


    <div class="tblBox">
      <h3><?php echo T_("Parameters"); ?></h3>
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
              <div class="txtB">displayname</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("Example"); ?></div>
              <i>Reza Mohiti</i>
            </td>
            <td>
              <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">firstname</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("Example"); ?></div>
              <i>Reza</i>
            </td>
            <td>
              <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">lastname</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("Example"); ?></div>
              <i>Mohiti</i>
            </td>
            <td>
              <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">username</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("Example"); ?></div>
              <i>Biqarar</i>
            </td>
            <td>
              <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">language</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("Example"); ?></div>
              <i>fa</i>
            </td>
            <td>
              <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">birthday</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("Example"); ?></div>
              <i>1990-01-16</i>
            </td>
            <td>
              <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
            </td>
          </tr>

          <tr>
            <td>
              <div class="txtB">gender</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("Example"); ?></div>
              <i>male</i> <?php echo T_("Or"); ?> <i>female</i>
            </td>
            <td>
              <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">email</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("Example"); ?></div>
              <i>name@domain.com</i>
            </td>
            <td>
              <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">website</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("Example"); ?></div>
              <i>http://yourwebsite.tld</i>
            </td>
            <td>
              <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">instagram</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("User account username in"); ?> <?php echo T_("instagram"); ?></div>
            </td>
            <td>
              <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">linkedin</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("User account username in"); ?> <?php echo T_("linkedin"); ?></div>
            </td>
            <td>
              <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">facebook</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("User account username in"); ?> <?php echo T_("facebook"); ?></div>
            </td>
            <td>
              <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">twitter</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("User account username in"); ?> <?php echo T_("twitter"); ?></div>
            </td>
            <td>
              <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">title</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("Example"); ?></div>
              <i>Programer</i>
            </td>
            <td>
              <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="txtB">bio</div>
              <i>string</i>
            </td>
            <td>
              <div class="fc-mute"><?php echo T_("Example"); ?></div>
              <i>your bio text</i>
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
curl -X PATCH \
  <?php echo \dash\data::CustomerApiURL(); ?>user/edit?id={USERID} \
  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
  -H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
  -d '{"username": "biqarar", "bio": "programing is my life"}'
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
