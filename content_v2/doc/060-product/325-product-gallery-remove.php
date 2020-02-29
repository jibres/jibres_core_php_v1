<h2 class="f" data-kerkere='#product-gallery-remove-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge danger">DELETE</span></span>
  <span class="c"><?php echo T_("Delete one file from product gallery"); ?></span>
</h2>

<div id="product-gallery-remove-detail">
  <div class="cbox" id='product-gallery-remove'>

     <p><?php echo T_("Replace {PRODUCT_ID} by your product id"); ?></p>


    <div class="msg url">
      <i class="method">DELETE</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>product/{PRODUCT_ID}/gallery/remove</b></span>
    </div>

         <?php require (root. 'content_api/v2/doc/000-public/header-appkey-apikey.php'); ?>


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
              <div class="txtB">fileid</div>
              <i>int</i>
            </td>
            <td>
              <p>

              </p>
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
curl -X DELETE \
  <?php echo \dash\data::CustomerApiURL(); ?>product/{PRODUCT_ID}/gallery/remove \
  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
  -H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
  -d '{"fileid" : 1}'
</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span><?php echo T_("Response"); ?> <small><?php echo T_("Example"); ?></small></h3>
<pre>
{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "File removed from gallery"
    }
  ],
  "result": true
}
</pre>


  </div>
</div>

