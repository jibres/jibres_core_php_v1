<h2 class="f" data-kerkere='#get-post-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get last get-post"); ?></span>
</h2>
<div id="get-post-detail">
  <div class="cbox" id='get-post'>

    <div class="msg url">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>posts/{$POSTID}</b></span>
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
    <pre>curl -X GET <?php echo \dash\data::CustomerApiURL(); ?>post/{$POSTID} -H 'appkey: <?php echo \dash\data::myAppKey(); ?>'</pre>

    <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
{
    "ok": true,
    "result": {
        "id": "3zC",
        "language": "fa",
        "subdomain": null,
        "title": "Post title",
        "seotitle": null,
        "slug": "post slug",
        "slug_raw": "post slug",
        "parent_url": [],
        "url": "post url",
        "link": "Post full url",
        "content": "Post content",
        "meta": {
            "thumb": "image.jpg",
            "gallery": [
            ],
            "download": {
                "title": "",
                "url": null,
                "target": false,
                "color": ""
            },
            "source": {
                "title": "",
                "url": null
            },
            "redirect": null
        },
        "file": {

        },
        "type": "post",
        "subtype": null,
        "special": "0",
        "comment": "closed",
        "count": null,
        "order": null,
        "status": "publish",
        "parent": null,
        "user_id": "5Xv",
        "publishdate": "2019-08-07 10:03:00",
        "datemodified": "2019-08-26 13:11:11",
        "datecreated": "2019-08-10 09:06:31",
        "subtitle": null,
        "excerpt": "expert"
    }
}
</pre>

  </div>
</div>
