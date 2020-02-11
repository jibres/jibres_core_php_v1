 <header class='site-header' data-scroll>
  <div class="cn f">

   <h1 class="cauto logo">
    <a class="flex" href='{{url.kingdom}}' tabindex='1'>
     <img src='<?php echo \dash\url::icon();?>' alt='<?php echo \dash\data::site_title(). ' | '. \dash\data::site_desc(); ?>'>
     <span><?php echo \dash\data::site_title(); ?></span> <small class="fs05 pLa5 s0"> <?php echo T_('Beta');?></small>
    </a>
   </h1>

   <nav class="cauto os">
    <a class="s0" href="{{url.kingdom}}/pricing"><?php echo T_("Pricing"); ?></a>
    <a class="s0" href="{{url.kingdom}}/contact"><?php echo T_("Contact"); ?></a>
<?php
if (\dash\user::id())
{
  if (\dash\url::subdomain())
  {
    echo '<a href="'. \dash\url::sitelang(). '/a" data-direct class="btn">'. T_("Store Panel"). '</a>';
  }
  else
  {
    echo '<a href="'. \dash\url::sitelang(). '/store" data-direct class="btn">'. T_("Admin Panel"). '</a>';
  }

}
else
{
  echo '<a href="'. \dash\url::sitelang(). '/enter" data-direct class="btn">'. T_("Enter"). '</a>';
}
?>
   </nav>
  </div>
 </header>

