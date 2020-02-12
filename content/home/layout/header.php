
  <div id="jibresTopLine">
   <div class="cn">
    <div class="f">
     <nav class="cauto os"><?php
if (\dash\user::id())
{
 if (\dash\url::subdomain())
 {
  echo '<a data-to="store" href="'. \dash\url::sitelang(). '/a" data-direct>'. T_("Store Panel"). '</a>';
 }
 else
 {
  echo '<a data-to="adminPanel" href="'. \dash\url::sitelang(). '/store" data-direct>'. T_("Admin Panel"). '</a>';
  echo '<a data-to="dashboard" href="'. \dash\url::sitelang(). '/dashboard" data-direct>'. T_("Dashboard"). '</a>';
 }

}
else
{
 echo '<a data-to="signup" href="'. \dash\url::sitelang(). '/enter/signup" data-direct>'. T_("SIGN UP"). '</a>';
 echo '<a data-to="enter" href="'. \dash\url::sitelang(). '/enter" data-direct>'. T_("Enter"). '</a>';
}
?></nav>
    </div>
   </div>
  </div>

   <div class="cn f">

    <h1 class="cauto logo">
    <a class="flex" href='<?php echo \dash\url::kingdom() ?>/' tabindex='1'>
     <img src='<?php echo \dash\url::icon();?>' alt='<?php echo \dash\data::site_title(). ' | '. \dash\data::site_desc(); ?>'>
     <span><?php echo \dash\data::site_title(); ?></span> <small class="fs05 pLa5 s0"> <?php echo T_('Beta');?></small>
    </a>
    </h1>
    <div class="c"></div>
    <nav class="cauto os">
    <a class="s0" href="<?php echo \dash\url::kingdom() ?>/pricing"><?php echo T_("Pricing"); ?></a>
    <a class="s0" href="<?php echo \dash\url::kingdom() ?>/contact"><?php echo T_("Contact"); ?></a>
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

