  <li><a href="{{url.here}}"><i class='sf-gauge'></i> <span>{% trans "Dashboard" %}</span></a></li>

  <li>
  {%if perm('productList')%}<a href="{{url.here}}/products"><i class="sf-box"></i>{%trans "Products"%}</a>{%endif%}
  {%if url.module in ['products', 'category', 'units', 'company', 'pricehistory']%}
    <ul>
        {%if perm('productListPrice')%}<li><a href="{{url.here}}/products/price"><i class="floatRa mRa10 fc-mute sf-dollar"></i>{%trans "Product price"%}</a></li>{%endif%}
        {%if false and perm('productSummary')%}<li><a href="{{url.here}}/products/summary"><i class="floatRa mRa10 fc-mute sf-list"></i>{%trans "Products Summary"%}</a></li>{%endif%}
        {%if perm('productAdd')%}<li><a href="{{url.here}}/products/add"><i class="floatRa mRa10 fc-mute sf-plus"></i>{%trans "Add new Product"%}</a></li>{%endif%}
        {%if perm('productCategoryListView')%}<li><a href="{{url.here}}/category"><i class="floatRa mRa10 fc-mute sf-grid-1"></i>{%trans "Categories of Product"%}</a></li>{%endif%}
        {%if perm('productUnitListView')%}<li><a href="{{url.here}}/units"><i class="floatRa mRa10 fc-mute sf-eye-galsses"></i>{%trans "Product Units"%}</a></li>{%endif%}
        {%if perm('productCompanyListView')%}<li><a href="{{url.here}}/company"><i class="floatRa mRa10 fc-mute sf-industry"></i>{%trans "Product Compnay"%}</a></li>{%endif%}
        {%if perm('productPriceHistoryView')%}<li><a href="{{url.here}}/pricehistory"><i class="floatRa mRa10 fc-mute sf-chart-line"></i>{%trans "Price history"%}</a></li>{%endif%}
        {%if perm('productTagView')%}<li><a href="{{url.here}}/products/tag"><i class="floatRa mRa10 fc-mute sf-tags"></i>{%trans "Product tag"%}</a></li>{%endif%}
    </ul>
  {%endif%}
  </li>

  <li>
    {%if perm('factorAccess')%}<a href="{{url.here}}/factor"><i class="sf-print"></i>{%trans "Factor"%}</a>{%endif%}

    <ul>
      {%if perm('factorSaleAdd')%}<li><a href="{{url.here}}/sale"><i class="floatRa mRa10 fc-mute sf-cart-plus"></i>{%trans "register new sale factor"%} <kbd class="light">F2</kbd> </a></li>{%endif%}
{%if url.module == "factor" or url.module == "sale" or url.module == "buy"%}
      {%if perm('factorSaleList')%}<li><a href="{{url.here}}/factor?type=sale"><i class="floatRa mRa10 fc-mute sf-basket"></i>{%trans "List of sales"%}</a></li>{%endif%}
      {%if perm('factorBuyList')%}<li><a href="{{url.here}}/factor?type=buy"><i class="floatRa mRa10 fc-mute sf-bag"></i>{%trans "List of purchases"%}</a></li>{%endif%}
      {%if perm('factorAccess')%}<li><a href="{{url.here}}/factor"><i class="floatRa mRa10 fc-mute sf-list"></i>{%trans "List of all factors"%}</a></li>{%endif%}
{%endif%}
    </ul>
  </li>

{%if false%}
<li>
    {%if perm('reportView')%}<a href="{{url.here}}/report"><i class="sf-chart"></i>{%trans "Reports"%}</a>{%endif%}
{%if url.module == "report"%}
    <ul>
      {%if perm('reportDaily')%}<li><a href="{{url.here}}/report/daily"><i class="floatRa mRa10 fc-mute sf-bar-chart"></i>{%trans "Daily report"%}</a></li>{%endif%}
      {%if perm('reportMonth')%}<li><a href="{{url.here}}/report/month"><i class="floatRa mRa10 fc-mute sf-analytics-chart-graph"></i>{%trans "Monthly report"%}</a></li>{%endif%}
    </ul>
{%endif%}
  </li>
  {%endif%}

  <li>
    {%if perm('settingView')%}<a href="{{url.here}}/setting/general"><i class="sf-cogs"></i>{%trans "Setting"%}</a>{%endif%}

{%if false and url.module == "setting"%}
    <ul>
      {%if perm('settingEditPlan')%}<li><a href="{{url.here}}/setting/plan"><i class="floatRa mRa10 fc-mute sf-lamp"></i>{%trans "Store plans"%}</a></li>{%endif%}
      {%if perm('settingEditFactor')%}<li><a href="{{url.here}}/setting/factor"><i class="floatRa mRa10 fc-mute sf-sliders"></i>{%trans "Factor settings"%}</a></li>{%endif%}
    </ul>
{%endif%}
  </li>

  <li class="s0 hide">
    <a data-kerkere='.slideShifTransformation' data-kerkere-icon><i class="sf-refresh"></i>{%trans "Shift transformation"%}</a>
    <div class="slideShifTransformation" data-kerkere-content='hide'>

{%if staffList%}
    <ul>
      <li>
        <a href="{{url.base}}/logout?referer={{url.pwd}}"><i class="sf-log-out"></i>{%trans "Logout"%}</a>
      </li>

{%for key, value in staffList%}
{%if value.mobile%}
{%if value.mobile == login.mobile%}
    {%if false%}
      <li title='{%trans "You are active user"%}'><a class='disabled' data-href="{{url.base}}/account/profile">{{value.firstname}} <b>{{value.lastname}}</b> <i class="floatRa mRa10 fc-green sf-check"></i></a></li>
      {%endif%}
{%else%}
      <li><a href="{{url.base}}/logout?mobile={{value.mobile}}&referer={{url.pwd}}">{{value.firstname}} <b>{{value.lastname}}</b> <i class="floatRa mRa10 fc-mute sf-at"></i></a></li>
{%endif%}
{%endif%}
{%endfor%}
    </ul>
{%endif%}
    </div>
  </li>