
  <div id="jibresTopLine">
   <div class="cn">
    <div class="f">
     <div class="c"><h1><?php echo T_("Jibres"); ?></h1></div>
     <nav class="cauto"><?php
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
  <div id="jibresHeader">
   <div class="cn">
    <div class="f">
     <div class="cauto">
      <a class="logo" href='<?php echo \dash\url::kingdom() ?>/'>
       <img src='<?php echo \dash\url::logo();?>' alt='<?php echo T_("Jibres"). ' | '. \dash\data::site_desc(); ?>'>
      </a>
     </div>
     <div class="c"></div>
     <nav class="cauto">
      <a class="s0" href="<?php echo \dash\url::kingdom() ?>/pricing"><?php echo T_("Pricing"); ?></a>
      <a class="s0" href="<?php echo \dash\url::kingdom() ?>/domain"><?php echo T_("Domains"); ?></a>
      <a class="s0" href="<?php echo \dash\url::kingdom() ?>/support"><?php echo T_("Help Center"); ?></a>
     </nav>
    </div>
   </div>
  </div>
