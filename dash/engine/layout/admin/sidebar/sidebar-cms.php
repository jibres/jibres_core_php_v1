
{%if perm('cpPostsView') or perm('cpCategoryView') or perm('cpTagView') or perm('cpPageView')%}
  <li>
    <ul>
{%if perm('cpPostsView') %}
      <li><a href="{{url.here}}/posts"><i class='fc-mute sf-pinboard'></i> {% trans "News" %}</a></li>
{%endif%}
{%if perm('cpCategoryView') %}
      <li><a href="{{url.here}}/terms?type=cat"><i class='fc-mute sf-grid'></i> {% trans "Categories" %}</a></li>
{%endif%}
{%if perm('cpTagView') %}
      <li><a href="{{url.here}}/terms?type=tag"><i class='fc-mute sf-tags'></i> {% trans "Keywords" %}</a></li>
{%endif%}
{%if perm('cpPageView') %}
      <li><a href="{{url.here}}/posts?type=page"><i class='fc-mute sf-files-o'></i> {% trans "Static Pages" %}</a></li>
{%endif%}
    </ul>
  </li>
{%endif%}





{%if perm('cpHelpCenterView') or perm('cpTagHelpAdd') or perm('cpTagHelpEdit') or perm('cpTagSupportAdd') or perm('cpTagSupportEdit')  %}
  <li>
    <ul>
{%if perm('cpHelpCenterView') %}
      <li><a href="{{url.here}}/posts?type=help"><i class='fc-mute sf-info-circle'></i> {% trans "Help Center" %}</a></li>
{%endif%}
{%if perm('cpTagHelpAdd') or perm('cpTagHelpEdit')%}
      <li><a href="{{url.here}}/terms?type=help_tag"><i class='fc-mute sf-clone'></i> {% trans "Help Center Keywords" %}</a></li>
{%endif%}

      </ul>
    </li>
{%endif%}



{%if perm('cpCommentsView')%}
  <li>
    <ul>
{%if perm('cpCommentsView')%}
      <li><a href="{{url.here}}/comments"><i class='fc-mute sf-comments'></i> {% trans "All Comments" %}</a></li>
{%endif%}
    </ul>
  </li>
{%endif%}





{%if perm('cpPostsView') %}
  <li>
    <ul>
      {%if perm('cpPostsView') %}
        <li><a href="{{url.here}}/attachment"><i class='fc-mute sf-file-o'></i> {% trans "Library" %}</a></li>
      {%endif%}
      {%if perm('cpPostsView') %}
        <li><a href="{{url.here}}/attachment/add"><i class='fc-mute sf-plus'></i> {% trans "Add new file" %}</a></li>
      {%endif%}
    </ul>
  </li>
{%endif%}
