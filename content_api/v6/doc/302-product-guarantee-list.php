
<div class="cbox" id='product-guarantee-list'>

  <h2 class="f" data-kerkere='#product-guarantee-list-detail' data-kerkere-icon='open'>
    <div class="cauto pRa10"><span class="badge primary">GET</span></div>
    <div>{%trans "Get list of product guarantee"%}</div>
  </h2>
  <div id="product-guarantee-list-detail">
    <p>{%trans "See the product guarantee "%}</p>
    <p>{%trans "To add a new guarantee, you must add a product with the same guarantee"%}</p>


    <div class="msg url">
      <i class="method">GET</i>
      <span>{{apiURL}}<b>product/guarantee</b></span>
    </div>

    {%include "/content_api/v6/header.html"%}



    <h3>{%trans "cURL"%} <small>{%trans "example"%}</small></h3>
<pre>
curl -X GET \
  {{apiURL}}product/guarantee \
{%include "/content_api/v6/header-curl.html"%}

</pre>

<h3><span class="mRa5 badge xs rounded success">&nbsp;</span>{%trans "Response"%} <small>{%trans "Example"%}</small></h3>
<pre>
{
  "ok": true,
  "result": [
    {
      "id": "4",
      "title": "Ermile",
      "count": "1"
    }
  ]
}
</pre>


  </div>
</div>

