<div id='enter'>

  <h1 class='logo'><a href='{%if runPWA%}{{url.kingdom}}/enter{%else%}{{url.kingdom}}{%endif%}' tabindex='1' data-direct>
    <img src='{{url.icon}}' alt='{{site.title}}'>
    <span>{{site.title}}</span>
  </a></h1>

<?php require_once \dash\engine\layout\fn::display(); ?>

</div>