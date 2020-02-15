<div id='enter'>

 <h1 class='logo'><a href="<?php
if (\dash\detect\device::detectPWA())
{
 echo \dash\url::kingdom(). '/enter';
}
else
{
 echo \dash\url::kingdom();
}
?>" tabindex='1' data-direct>
  <img src='<?php echo \dash\url::icon(); ?>' alt='<?php echo T_("Jibres") ?>'>
  <span><?php echo T_("Jibres") ?></span>
 </a></h1>
 <div data-xhr='enter'>
{%if url.module == ""%}
   <h2 class='flex justify-center align-center'>{{page.title}}</h2>
{%else%}
   <h2 class='flex justify-center align-center'>{{page.desc|raw}}</h2>
{%endif%}
  <form method="post" autocomplete="off">
  </form>
 </div>
<?php require_once \dash\engine\layout\fn::display(); ?>

</div>