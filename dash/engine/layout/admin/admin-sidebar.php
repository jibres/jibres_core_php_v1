


{%if url.subdomain%}
      <li><a href="{{url.kingdom}}/a" {%if url.content == "a"%} class="activeContent"{%endif%}><i class='sf-align-left'></i> {% trans "Store admin panel" %}</a></li>
  {%if url.content == "a"%}
    {%embed "includes/html/sidebar/sidebar-a.html"%}{%endembed%}
  {%endif%}
{%endif%}

      <li><a href="{{url.kingdom}}/store" {%if url.content == "store"%} class="activeContent"{%endif%}><i class='sf-atom'></i> {% trans "Jibres Panel" %}</a></li>

{%if perm('contentCp')%}
      <li><a href="{{url.kingdom}}/cms" {%if url.content == "cms"%} class="activeContent"{%endif%} data-shortkey="67+77" data-shortkey-prevent data-shortkey-timeout='1000'><i class='sf-align-left'></i> {% trans "CMS" %}</a></li>
  {%if url.content == "cms"%}
    {%embed "includes/html/sidebar/sidebar-cms.html"%}{%endembed%}
  {%endif%}
{%endif%}

{%if perm('contentCrm')%}
      <li><a href="{{url.kingdom}}/crm" {%if url.content == "crm"%} class="activeContent"{%endif%} data-shortkey="77+85" data-shortkey-prevent data-shortkey-timeout='1000'><i class='sf-group-full'></i> {% trans "CRM Panel" %}</a></li>
  {%if url.content == "crm"%}
    {%embed "includes/html/sidebar/sidebar-crm.html"%}{%endembed%}
  {%endif%}
{%endif%}

{%if perm_su()%}
        <li><a href="{{url.kingdom}}/su" {%if url.content == "su"%} class="activeContent"{%endif%} data-shortkey="83+85" data-shortkey-prevent data-shortkey-timeout='1000'><i class='sf-heartbeat'></i> <span>{% trans "Supervisor Panel" %}</span></a></li>
  {%if url.content == "su"%}
    {%embed "includes/html/sidebar/sidebar-su.html"%}{%endembed%}
  {%endif%}
{%endif%}


{%if login%}
    <li><a href="{{url.kingdom}}/account" {%if url.content == "account"%} class="activeContent"{%endif%} data-shortkey="77+69" data-shortkey-prevent data-shortkey-timeout='1000'><i class='sf-user'></i> <span>{% trans "My Account" %}</span></a></li>
  {%if url.content == "account"%}
    {%embed "includes/html/sidebar/sidebar-account.html"%}{%endembed%}
  {%endif%}
{%endif%}

      <li><a href="{{url.kingdom}}/support" {%if url.content == "support"%} class="activeContent"{%endif%} data-shortkey="112" data-shortkey-prevent data-shortkey-timeout='1000'><i class='sf-life-ring'></i> <span>{% trans "Help Center" %}</span></a></li>
{%if url.content == "support"%}
{%embed "includes/html/sidebar/sidebar-support.html"%}{%endembed%}
{%endif%}