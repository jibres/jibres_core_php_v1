<h2 class="f" data-kerkere='#category-list-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get list of category"); ?></span>
</h2>
<div id="category-list-detail">
  <div class="cbox" id='category-list'>
    <div class="msg url ltr txtL">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>category/fetch</b></span>
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
              <div class="txtB">q</div>
              <i>String</i>
            </td>
            <td>
              <p>
                <?php echo T_("Query string"); ?>
              </p>
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
curl -X GET <?php echo \dash\data::CustomerApiURL(); ?>category/fetch -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span><?php echo T_("Response"); ?> <small><?php echo T_("Example"); ?></small></h3>
<pre>
{
  "ok": true,
  "result": [
    {
      "id": "5",
      "title": "لوازم جانبی گوشی",
      "slug": "mobile",
      "language": null,
      "desc": null,
      "seotitle": null,
      "seodesc": null,
      "file": null,
      "count": 4,
      "parent_slug": "digital/plus",
      "parent_title": "کالای دیجیتال -> لوازم کالای دیجیتال",
      "full_slug": "digital/plus/mobile",
      "full_title": "کالای دیجیتال -> لوازم کالای دیجیتال -> لوازم جانبی گوشی",
      "have_child": true,
      "have_product": true
    }
  ]
}
</pre>


  </div>
</div>

