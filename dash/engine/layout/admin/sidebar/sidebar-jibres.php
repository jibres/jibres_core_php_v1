
<li>
  <ul>
    {%if listStore.owner or listStore.staff%}
    <li data-kerkere='[data-sideStoreList]'><a><i class='sf-shopping-cart'></i> <span>{% trans "My Stores" %}</span><span class="floatRa fc-mute">{{storesCount | fitNumber}}</span></a></li>

    <li>
      <ul data-sideStoreList data-kerkere-content='show'>
    {%for key, value in listStore.owner%}
        <li><a href="{{value.url}}">{{value.title}}</a></li>
    {%endfor%}
    {%for key, value in listStore.staff%}
        <li><a href="{{value.url}}">{{value.title}}</a></li>
    {%endfor%}
      </ul>
    </li>
    {%endif%}

    <li><a data-direct href="{{url.here}}/start"><i class='sf-plus'></i> <span>{%trans "Add new store"%}</span></a></li>


    <li><a href="{{url.kingdom}}/account/billing"><i class="sf-credit-card"></i>{%trans "Billing"%}</a></li>

  </ul>
</li>