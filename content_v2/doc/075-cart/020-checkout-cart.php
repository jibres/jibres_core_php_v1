<h2 class="f" data-kerkere='#checkout-cart-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge primary">POST</span></span>
  <span class="c"><?php echo T_("Checkout cart"); ?></span>
</h2>
<div id="checkout-cart-detail">
  <div class="cbox" id='checkout-cart'>
    <div class="msg url">
      <i class="method">POST</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>cart/checkout</b></span>
    </div>

         <?php require (root. 'content_api/v2/doc/000-public/header-appkey-apikey.php'); ?>

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
              <div class="txtB">address_id</div>
              <i>code</i>
            </td>
            <td>
              <p><?php echo T_("User address id"); ?></p>
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
curl -X POST <?php echo \dash\data::CustomerApiURL(); ?>cart/checkout -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?>' -d '{"address_id": "R"}'
</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span><?php echo T_("Response"); ?> <small><?php echo T_("Example"); ?></small></h3>
<pre>
{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "فاکتور با موفقیت اضافه شد"
    }
  ],
  "result": {
    "factor_id": "JF1356075"
  }
}
</pre>

  </div>
</div>

