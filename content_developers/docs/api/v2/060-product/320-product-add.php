<h2 class="f" data-kerkere='#product-add-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge primary">POST</span></span>
  <span class="c"><?php echo T_("Add new product"); ?></span>
</h2>

<div id="product-add-detail">
  <div class="cbox" id='product-add'>

    <div class="msg url ltr txtL">
      <i class="method">POST</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>product/add</b></span>
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

          <tr><td><div class="txtB">title</div><i>String</i></td><td><p><?php echo T_("Maximum length"); ?> <?php echo \dash\fit::number(500); ?> <?php echo T_("Characters"); ?></p></td><td><div class="fc-red"><i><?php echo T_("Require"); ?></i></div></td></tr>
          <tr><td><div class="txtB">slug</div><i>String</i></td><td><p><?php echo T_("Maximum length"); ?> <?php echo \dash\fit::number(200); ?> <?php echo T_("Characters"); ?></p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">desc</div><i>String</i></td><td><p><?php echo T_("Maximum length"); ?> <?php echo \dash\fit::number(60000); ?> <?php echo T_("Characters"); ?></p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>

          <tr><td><div class="txtB">barcode</div><i>String</i></td><td><p><?php echo T_("Maximum length"); ?> <?php echo \dash\fit::number(100); ?> <?php echo T_("Characters"); ?></p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">barcode2</div><i>String</i></td><td><p><?php echo T_("Maximum length"); ?> <?php echo \dash\fit::number(100); ?> <?php echo T_("Characters"); ?></p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>

          <tr><td><div class="txtB">buyprice</div><i>Number</i></td><td><p>   </p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">price</div><i>Number</i></td><td><p>   </p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">discount</div><i>Number</i></td><td><p>   </p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">vat</div><i>Boolean</i></td><td><p>[true, false]</p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">sku</div><i>String</i></td><td><p><?php echo T_("Maximum length"); ?> <?php echo \dash\fit::number(100); ?> <?php echo T_("Characters"); ?></p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">infinite</div><i>Boolean</i></td><td><p>[true, false]</p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">gallery</div><i>FILES</i></td><td><p>   </p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">weight</div><i>Number</i></td><td><p>   </p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">weightunit</div><i>ENUM</i></td><td><p>['lb','oz','kg','g']</p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">seotitle</div><i>String</i></td><td><p><?php echo T_("Maximum length"); ?> <?php echo \dash\fit::number(100); ?> <?php echo T_("Characters"); ?></p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">type</div><i>ENUM</i></td><td><p>['product','file','service']</p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">seodesc</div><i>String</i></td><td><p><?php echo T_("Maximum length"); ?> <?php echo \dash\fit::number(100); ?> <?php echo T_("Characters"); ?></p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">saleonline</div><i>Boolean</i></td><td><p>[true, false]</p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">saletelegram</div><i>Boolean</i></td><td><p>[true, false]</p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">saleapp</div><i>Boolean</i></td><td><p>[true, false]</p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">company</div><i>String</i></td><td><p><?php echo T_("Maximum length"); ?> <?php echo \dash\fit::number(100); ?> <?php echo T_("Characters"); ?></p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">scalecode</div><i>String</i></td><td><p><?php echo T_("Maximum length"); ?> <?php echo \dash\fit::number(100); ?> <?php echo T_("Characters"); ?></p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">status</div><i>ENUM</i></td><td><p>['unset','available','unavailable','soon','discountinued', 'deleted']</p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">minsale</div><i>Number</i></td><td><p>   </p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">maxsale</div><i>Number</i></td><td><p>   </p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">salestep</div><i>Number</i></td><td><p>   </p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">oversale</div><i>Boolean</i></td><td><p>[true, false]</p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">unit</div><i>String</i></td><td><p><?php echo T_("Maximum length"); ?> <?php echo \dash\fit::number(100); ?> <?php echo T_("Characters"); ?></p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">category</div><i>String</i></td><td><p><?php echo T_("Maximum length"); ?> <?php echo \dash\fit::number(100); ?> <?php echo T_("Characters"); ?></p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>
          <tr><td><div class="txtB">tag</div><i>String</i></td><td><p><?php echo T_("Maximum length"); ?> <?php echo \dash\fit::number(100); ?> <?php echo T_("Characters"); ?></p></td><td><div class="fc-green"><i><?php echo T_("Optional"); ?></i></div></td></tr>



        </tbody>
      </table>
    </div>



    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X POST \
  <?php echo \dash\data::CustomerApiURL(); ?>product/add \
  -H 'appkey: <?php echo \dash\data::myAppKey(); ?>'
  -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
  -d '{"title":"Product1"}'
</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span><?php echo T_("Response"); ?> <small><?php echo T_("Example"); ?></small></h3>
<pre>
{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "Your product successfully added"
    }
  ],
  "result": {
    "id": "1408"
  }
}
</pre>


  </div>
</div>

