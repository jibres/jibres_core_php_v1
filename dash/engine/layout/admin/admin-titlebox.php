
{%if page.titleBox%}
<div class="titleBox">
  <div class="f align-center">
{%if back.text and back.link%}
    <div class="cauto pRa10">
      <a class="btn master back" href="{{back.link}}"><i class="pRa5 sf-chevron-{%if global.direction == 'rtl'%}right{%else%}left{%endif%}"></i><span class="s0">{{back.text}}</span></a>
    </div>
{%endif%}

    <div class="c s10 pRa10 pageTitle">
      <h2>{{page.title | raw}}</h2>
    </div>
    <nav class="cauto actions">
{%if page.import%}
      <a class="btn light" href="{{page.import}}"><i class="pRa5 compact sf-in"></i><span>{%trans "Import"%}</span></a>
{%endif%}
{%if page.export%}
      <a class="btn light" href="{{page.export}}"><i class="pRa5 compact sf-out"></i><span>{%trans "Export"%}</span></a>
{%endif%}
{%if page.duplicate%}
      <a class="btn light" href="{{page.duplicate}}"><i class="pRa5 compact sf-files-o"></i><span>{%trans "Duplicate"%}</span></a>
{%endif%}
{%if page.view%}
      <a class="btn light" href="{{page.view}}" target="_blank"><i class="pRa5 compact sf-eye"></i><span>{%trans "View"%}</span></a>
{%endif%}
{%if page.help%}
      <a class="btn light" href="{{page.help}}" target="_blank"><i class="pRa5 compact sf-question-circle"></i><span>{%trans "Help"%}</span></a>
{%endif%}
    </nav>

{%if page.prev or page.next%}
    <nav class="cauto os pLa10 nav">
       <a class="btn{%if page.prev == 'disabled'%} disabled{%endif%}" {%if page.prev == 'disabled'%}{%else%}href="{{page.prev}}"{%endif%} title='{%trans "Previous item"%}'><i class="sf-arrow-{%if global.direction == 'rtl'%}right{%else%}left{%endif%}"></i></a>
       <a class="btn{%if page.next == 'disabled'%} disabled{%endif%}" {%if page.next == 'disabled'%}{%else%}href="{{page.next}}"{%endif%} title='{%trans "Next item"%}'><i class="sf-arrow-{%if global.direction == 'rtl'%}left{%else%}right{%endif%}"></i></a>
    </nav>
{%endif%}

{%if action.text and action.link%}
    <nav class="cauto os pLa10">
       <a class="btn master" href="{{action.link}}" data-shortkey="120"{%if page.btnDirect%} data-direct{%endif%}><span>{{action.text}}</span> <kbd>F9</kbd></a>
    </nav>
{%endif%}
  </div>

{%if page.breadcrumb%}
  <nav class="breadcrumb">
{%for key, value in page.breadcrumb%}
   <a{%if value.link%} href="{{value.link}}"{%endif%}{%if value.title%} title="{{value.title}}"{%endif%}{%if value.attr%} {{value.attr}}{%endif%}>{%if value.icon%}<span class="sf-{{value.icon}} mRa5"></span>{%endif%}{{value.text}}</a>
{%endfor%}
  </nav>
{%endif%}
</div>


{%endif%}

