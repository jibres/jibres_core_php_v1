<h2 class="f" data-kerkere='#delete-from-cart-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge danger">DELETE</span></span>
  <span class="c"><?php echo T_("Delete product from cart"); ?></span>
</h2>
<div id="delete-from-cart-detail">
  <div class="cbox" id='delete-from-cart'>
    <div class="msg url">
      <i class="method">DELETE</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>cart/delete</b></span>
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
              <div class="txtB">product</div>
              <i>integer</i>
            </td>
            <td>
              <p><?php echo T_("The product id"); ?></p>
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
curl -X DELETE <?php echo \dash\data::CustomerApiURL(); ?>cart/delete -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?>' -d '{"product": 1}'
</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span><?php echo T_("Response"); ?> <small><?php echo T_("Example"); ?></small></h3>
<pre>
{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "The product was removed from your cart"
    }
  ],
  "result": null
}
</pre>


  </div>
</div>

