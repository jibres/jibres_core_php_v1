<h2 class="f" data-kerkere='#product-search-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Search in products"); ?></span>
</h2>
<div id="product-search-detail">
  <div class="cbox" id='product-search'>
    <div class="msg url ltr txtL">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>product/search</b></span>
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
curl -X GET <?php echo \dash\data::CustomerApiURL(); ?>product/search?q=123 -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span><?php echo T_("Response"); ?> <small><?php echo T_("Example"); ?></small></h3>
<pre>
{
  "ok": true,
  "pagination": {
      "desc": "page 1 of 2 - Show record 1 to 10 of 13",
      "page": 1,
      "total_page": 2,
      "limit": 10,
      "total_rows": 13
  },
  "result": [
      {
          "id": "3",
          "title": "Product Sample 1",
          "seotitle": "Seo Title Sample",
          "slug": "test-slug",
          "seodesc": "Test Seo desc",
          "desc": null,
          "barcode": "16469",
          "barcode2": "202954073370000013116469",
          "cat_id": "1",
          "unit_id": "1",
          "company_id": "1",
          "sku": "14",
          "salestep": "2",
          "minstock": null,
          "maxstock": null,
          "minsale": "10",
          "maxsale": "1000",
          "carton": null,
          "scalecode": "12345",
          "weight": "10",
          "weightunit": "kg",
          "type": "product",
          "status": "available",
          "thumb": "YourFileLocation",
          "gallery_array": {
              "files": [
                  {
                      "id": 5,
                      "path": "YourFileLocation"
                  },
                  {
                      "id": 6,
                      "path": "YourFileLocation"
                  },
                  {
                      "id": 7,
                      "path": "YourFileLocation"
                  },
                  {
                      "id": 8,
                      "path": "YourFileLocation"
                  }
              ],
              "thumbid": 5
          },
          "vat": true,
          "infinite": true,
          "oversale": true,
          "saleonline": true,
          "saletelegram": true,
          "saleapp": true,
          "optionname1": null,
          "optionname2": null,
          "optionname3": null,
          "optionvalue1": null,
          "optionvalue2": null,
          "optionvalue3": null,
          "parent": null,
          "datecreated": "2019-11-18 18:37:03",
          "datemodified": "2019-11-19 09:48:37",
          "category": "Food",
          "variants_detail": []
      }
  ]
}
</pre>


  </div>
</div>

