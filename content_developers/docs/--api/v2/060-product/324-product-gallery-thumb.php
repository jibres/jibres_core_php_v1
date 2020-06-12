<h2 class="f" data-kerkere='#product-gallery-thumb-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge warn">PUT</span></span>
  <span class="c"><?php echo T_("Set one gallery image as thumb image"); ?></span>
</h2>

<div id="product-gallery-thumb-detail">
  <div class="cbox" id='product-gallery-thumb'>
     <p><?php echo T_("Replace {PRODUCT_ID} by your product id"); ?></p>


    <div class="msg url ltr txtL">
      <i class="method">PUT</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>product/gallery/thumb?id={PRODUCT_ID}</b></span>
    </div>

         <?php require (root. 'content_developers/docs/api/v2/000-public/header-appkey-apikey.php'); ?>


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
curl -X PUT \
  <?php echo \dash\data::CustomerApiURL(); ?>product/gallery/thumb?id={PRODUCT_ID} \
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
      "text": "Product thumb set"
    }
  ],
  "result": true
}
</pre>


  </div>
</div>

