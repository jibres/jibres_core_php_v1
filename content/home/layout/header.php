
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
       <img src='<?php echo \dash\url::logo();?>' alt='<?php echo T_("Jibres"). ' | '. \dash\data::site_slogan(); ?>'>
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

  <section id='jibresType'>
   <div class="cn">
    <div class="h2"><span class="typed"></span></div>

    <div id="typed-strings" class="hide">
<?php
var_dump(\dash\url::module());
if (\dash\url::module())
{
?>
     <h2><?php echo \dash\data::page_title(); ?></h2>
<?php
}
else
{
?>
     <h3><?php echo T_('Invoice Software'); ?></h3>
     <h4><?php echo T_('Easy Invoicing Software'); ?></h4>
     <h3><?php echo T_('Online Invoicing Software'); ?></h3>
     <h2><?php echo T_('Free Invoicing Software'); ?></h2>

     <h3><?php echo T_('Accounting Software'); ?></h3>
     <h2><?php echo T_('Online Accounting Software'); ?></h2>

     <h3><?php echo T_('Sales'); ?></h3>
     <h3><?php echo T_('Sales Software'); ?></h3>
     <h4><?php echo T_('Integrated Sales'); ?></h4>
     <h2 class="bold"><?php echo T_('Integrated Ecommerce Platform'); ?></h2>
<?php
}
?>
    </div>
    <p><?php echo \dash\data::page_desc(); ?></p>
   </div>
  </section>
