<h2 class="f" data-kerkere='#responses-detail' data-kerkere-icon='open'><?php echo T_("Responses"); ?></h2>
<div id="responses-detail">
  <div class="cbox fs15" id='responses'>

    <p><?php echo T_("Each response is a JSON object."); ?></p>
    <ul class="list">
      <li><?php echo T_("The data requested is wrapped in the <code>result</code> tag."); ?></li>
      <li><?php echo T_("If you have a response, it will always be within the <code>result</code> field."); ?></li>
      <li><?php echo T_("We also include a <code>ok</code> flag and an array of <code>msg</code> in the response."); ?></li>
      <li><?php echo T_("Some responses can have additional pagination info wrapped in the <code>meta</code>"); ?></li>
      <li><?php echo T_("An msg object will contain a <code>type</code> field and a <code>text</code>"); ?></li>
    </ul>


    <h3><?php echo T_("Success Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": true,
  "result":
  {
      "abc": 123,
      "def": 456
  }
  "msg":
  [
    {
      "type": "info",
      "text": "How are you!"
    }
  ]
}
</pre>


    <h3><?php echo T_("Error Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
  "ok": false,
  "msg":
  [
    {
      "type": "error",
      "text": "A verification code was sended to user"
    }
  ]
}
</pre>


    <h3><?php echo T_("HTTP response codes"); ?></h3>
    <p><?php echo T_("The status of a response can be determined from the HTTP status code."); ?></p>
    <div class="tblBox">
      <table class="tbl1 v6">
        <thead>
          <tr>
            <th><?php echo T_("Code"); ?></th>
            <th><?php echo T_("Status"); ?></th>
            <th><?php echo T_("Description"); ?></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>200</th>
            <td>OK</td>
            <td><?php echo T_("request successful"); ?></td>
          </tr>

          <tr>
            <th>304</th>
            <td>Not Modified  </td>
            <td><?php echo T_("request successful"); ?></td>
          </tr>

          <tr>
            <th>400</th>
            <td>Bad Request </td>
            <td><?php echo T_("request was invalid"); ?></td>
          </tr>

          <tr>
            <th>401</th>
            <td>Unauthorized</td>
            <td><?php echo T_("user does not have permission"); ?></td>
          </tr>

          <tr>
            <th>403</th>
            <td>Forbidden</td>
            <td><?php echo T_("request not authenticated"); ?></td>
          </tr>

          <tr>
            <th>404</th>
            <td>Not Found</td>
            <td><?php echo T_("Invalid url"); ?></td>
          </tr>

          <tr>
            <th>429</th>
            <td>Too many requests</td>
            <td><?php echo T_("client is rate limited"); ?></td>
          </tr>

          <tr>
            <th>405</th>
            <td>Method Not Allowed</td>
            <td><?php echo T_("incorrect HTTP method provided"); ?></td>
          </tr>

          <tr>
            <th>415</th>
            <td>Unsupported Media Type</td>
            <td><?php echo T_("response is not valid JSON"); ?></td>
          </tr>

        </tbody>
      </table>
    </div>

  </div>
</div>
