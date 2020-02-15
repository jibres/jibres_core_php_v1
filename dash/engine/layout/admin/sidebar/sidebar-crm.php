

  {%if perm('cpUsersView') or perm('cpUsersAdd') %}
      <li>
        {%if perm('cpUsersView') %}
          <a href="{{url.here}}/member"><i class='sf-users'></i> <span>{% trans "Users" %}</span></a>
        {%endif%}
          <ul>
            {%if perm('cpUsersAdd') %}
              <li><a href="{{url.here}}/member/add">{% trans "Add new user" %} <i class='floatLa mRa10 fc-mute sf-user-plus'></i></a></li>
            {%endif%}
          </ul>
      </li>
  {%endif%}
    {%if perm('cpPermissionView') %}
      <li><a href="{{url.here}}/permission"><i class='sf-lock'></i> {% trans "Permissions" %}</a></li>
    {%endif%}

  {%if perm('cpSMS') or perm('cpSmsSend') or perm('cpSmsSendGroup') or perm('cpTemplateSmsView') %}
      <li>
          {%if perm('cpSMS') %}
          <a href="{{url.here}}/sms"><i class='sf-envelope'></i> <span>{% trans "SMS" %}</span></a>
          {%endif%}
          <ul>
            {%if perm('cpSmsSend') %}
              <li><a href="{{url.here}}/sms/send">{% trans "Quick send" %} <i class='floatLa mRa10 fc-mute sf-paper-plane'></i></a></li>
            {%endif%}
          </ul>
      </li>
  {%endif%}

  {%if perm('cpTransaction') or perm('cpTransactionAdd') %}
      <li>
          {%if perm('cpSMS') %}
          <a href="{{url.here}}/transactions"><i class='sf-card'></i> <span>{% trans "Transactions" %}</span></a>
          {%endif%}
          <ul>
            {%if perm('cpTransactionAdd') %}
              <li><a href="{{url.here}}/transactions/add">{% trans "Plus charge account" %} <i class='floatLa mRa10 fc-mute sf-plus-circle'></i></a></li>
              <li><a href="{{url.here}}/transactions/minus">{% trans "Minus charge account" %} <i class='floatLa mRa10 fc-mute sf-minus-circle'></i></a></li>
            {%endif%}
          </ul>
      </li>
  {%endif%}
