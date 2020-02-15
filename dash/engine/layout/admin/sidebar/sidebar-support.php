

<li>
  <a href="{{url.here}}/ticket{{accessGet}}"><i class="sf-question-circle"></i>{%trans "Tickets"%}</a>

    <ul>
      <li><a href="{{url.here}}/ticket/add{{accessGet}}"><i class="floatLa mRa10 fc-mute sf-plus"></i>{%trans "New Ticket"%}</a></li>
{%if sidebarDetail.all%}
      <li><a href="{{url.here}}/ticket?status=all{{accessGetAnd}}"><span class="floatLa mRa10 fc-mute badge dark">{{sidebarDetail.all | fitNumber}}</span>{%trans "All"%}</a></li>
{%endif%}

{%if sidebarDetail.awaiting%}
      <li><a href="{{url.here}}/ticket?status=awaiting{{accessGetAnd}}"><span class="floatLa mRa10 fc-mute badge dark">{{sidebarDetail.awaiting | fitNumber}}</span>{%trans "Awaiting answer"%}</a></li>
{%endif%}

{%if sidebarDetail.answered%}
      <li><a href="{{url.here}}/ticket?status=answered{{accessGetAnd}}"><span class="floatLa mRa10 fc-mute badge dark">{{sidebarDetail.answered | fitNumber}}</span>{%trans "Answered"%}</a></li>
{%endif%}

{%if (sidebarDetail.all or sidebarDetail.awaiting or sidebarDetail.answered) and ((perm('supportTicketAnswer') and sidebarDetail.unsolved) or (perm('supportTicketAnswer') and sidebarDetail.solved))%}
<li class="hr"></li>
{%endif%}

{%if perm('supportTicketAnswer') and sidebarDetail.unsolved%}
{%set haveBeforeLink = true%}
      <li><a href="{{url.here}}/ticket?status=unsolved{{accessGetAnd}}"><span class="floatLa mRa10 fc-mute badge dark">{{sidebarDetail.unsolved | fitNumber}}</span>{%trans "Unsolved"%}</a></li>
{%endif%}

{%if perm('supportTicketAnswer') and sidebarDetail.solved%}

{%set haveBeforeLink = true%}
      <li><a href="{{url.here}}/ticket?status=solved{{accessGetAnd}}"><span class="floatLa mRa10 fc-mute badge dark">{{sidebarDetail.solved | fitNumber}}</span>{%trans "Solved"%}</a></li>
{%endif%}

{%if haveBeforeLink and (sidebarDetail.open or sidebarDetail.archived)%}
<li class="hr"></li>
{%endif%}

{%if sidebarDetail.open%}
      <li><a href="{{url.here}}/ticket?status=open{{accessGetAnd}}"><span class="floatLa mRa10 fc-mute badge dark">{{sidebarDetail.open | fitNumber}}</span>{%trans "Open tickets"%}</a></li>
{%endif%}

{%if sidebarDetail.archived%}
      <li><a href="{{url.here}}/ticket?status=archived{{accessGetAnd}}"><span class="floatLa mRa10 fc-mute badge dark">{{sidebarDetail.archived | fitNumber}}</span>{%trans "Archived"%}</a></li>
{%endif%}

{%if perm('supportTicketTrash') and sidebarDetail.trash%}
      <li><a href="{{url.here}}/ticket?status=deleted{{accessGetAnd}}"><span class="floatLa mRa10 fc-mute badge dark">{{sidebarDetail.trash | fitNumber}}</span>{%trans "Trash"%}</a></li>
      <li><a href="{{url.here}}/ticket?status=spam{{accessGetAnd}}"><span class="floatLa mRa10 fc-mute badge dark">{{sidebarDetail.spam | fitNumber}}</span>{%trans "Spam"%}</a></li>
{%endif%}
    </ul>

</li>




{%if perm('cpTagSupportEdit')%}
  <li><a href="{{url.here}}/ticket/tags"><i class='fc-mute sf-bug'></i> {% trans "Ticket Topics" %}</a></li>
{%endif%}
{%if sidebarDetail.tags%}
<li class="hr"></li>
<li>
  {%if perm('cpSupportTagAdd') and 0 %}
    <a data-direct href="{{url.kingdom}}/cp/terms?type=support_tag"><i class='sf-tag'></i> {%trans "Tags"%}</a>
  {%else%}
    <a href="#" class="title"><i class='sf-tag'></i> {%trans "Tags"%}</a>
  {%endif%}
    <ul>
    {%for key, value in sidebarDetail.tags%}
      {%if value.status == 'enable' or perm('cpTagSupportEdit')%}
          <li>
            <a href="{{url.here}}/ticket?tag={{value.slug}}{{accessGetAnd}}">
            <span class="floatLa mRa10 badge dark fc-mute"> {{value.useage_count | fitNumber}}</span>
            <span class="mRa10 badge rounded {{value.meta.color}}">&nbsp;</span>{{value.title}}</a>
          </li>
      {%endif%}
    {%endfor%}
    </ul>
</li>
{%endif%}