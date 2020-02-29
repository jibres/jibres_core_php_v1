<h2 class="f" data-kerkere='#product-collection-list-detail' data-kerkere-icon='open'>
  <span class="cauto pRa10"><span class="badge success">GET</span></span>
  <span class="c"><?php echo T_("Get list of products by special collection"); ?></span>
</h2>

<div id="product-collection-list-detail">
  <div class="cbox" id='product-collection-list'>

    <div class="msg url">
      <i class="method">GET</i>
      <span><?php echo \dash\data::CustomerApiURL(); ?><b>products/collection/{COLLECTION}</b></span>
    </div>

         <?php require (root. 'content_api/v2/doc/000-public/header-appkey-apikey.php'); ?>



    <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl -X GET <?php echo \dash\data::CustomerApiURL(); ?>products/collection/{COLLECTION} -H 'appkey: <?php echo \dash\data::myAppKey(); ?>' -H 'apikey: <?php echo \dash\data::myApiKey(); ?>'
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
          "collection": "Food",
          "variants_detail": []
      }
  ]
}
</pre>


  </div>
</div>

