<h2 class="f" data-kerkere='#product-comment-add-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge primary">POST</span></span>
  <span class="c"><?php echo T_("Add new comment to product"); ?></span>
</h2>

<div id="product-comment-add-detail">
  <div class="cbox" id='product-comment-add'>

    <div class="msg url">
      <i class="method">POST</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>product/{PRODUCT_ID}/comment/add</b></span>
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

          <tr><td><div class="txtB">content</div><i>String</i></td><td><p><?php echo T_("Maximum length"); ?> <?php echo \dash\fit::number(500); ?> <?php echo T_("Characters"); ?></p></td><td><div class="fc-red"><i><?php echo T_("Require"); ?></i></div></td></tr>
          <tr><td><div class="txtB">star</div><i>Integer</i></td><td><p><code>[1,2,3,4,5]</code></p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>

        </tbody>
      </table>
    </div>

<h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X POST <?php echo \dash\data::CustomerApiURL(); ?>product/{PRODUCT_ID}/comment/add \
  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
  -H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
  -d '{"content":"All is well ;)", "star" : 5}'
</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span><?php echo T_("Response"); ?> <small><?php echo T_("Example"); ?></small></h3>
<pre>
{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "Your comment saved"
    }
  ]
}
</pre>


  </div>
</div>

