  <div id="jibresHeader">
   <div class="fit">
    <div class="f">
     <div class="cauto">
      <a class="logo" href='<?php echo \dash\url::kingdom() ?>/'>
       <img <?php
        if (\dash\language::current() === 'fa')
        {
         echo "src='". \dash\url::static(). "/logo/fa/svg/Jibres-Logo-fa.svg". "' alt='". T_('Jibres Logo'). "'";
        }
        else
        {
         echo "src='". \dash\url::static(). "/logo/en/svg/Jibres-Logo-en.svg". "' alt='". T_('Jibres Logo'). "'";
        }
       ?>>
       <h1><?php echo T_("Jibres"); ?></h1>
      </a>
     </div>
     <nav class="c">
       <a class="s0" href="<?php echo \dash\url::kingdom() ?>/pricing"><?php echo T_("Pricing"); ?></a>
       <a class="s0" href="<?php echo \dash\url::kingdom() ?>/domain"><?php echo T_("Domains"); ?></a>
       <a class="s0" href="<?php echo \dash\url::kingdom() ?>/support"><?php echo T_("Help Center"); ?></a>
     </nav>
     <div class="cauto">
      <?php
if (\dash\user::id())
{
 if (\dash\url::subdomain())
 {
  echo '<a data-to="store" href="'. \dash\url::sitelang(). '/a" data-direct>'. T_("Store Panel"). '</a>';
 }
 else
 {
  echo '<a data-to="dashboard" href="'. \dash\url::sitelang(). '/dashboard" data-direct>'. T_("Dashboard"). '</a>';
 }

}
else
{
 echo '<a data-to="enter" href="'. \dash\url::sitelang(). '/enter" data-direct>'. T_("Enter"). '</a>';
 echo '<a data-to="signup" href="'. \dash\url::sitelang(). '/enter/signup" data-direct>'. T_("SIGN UP"). '</a>';
}
?>
     </div>
    </div>
   </div>
  </div>


  <section id='jibresType'>
   <div class="cn">
    <div class="h2"><span class="typed"></span></div>

<?php
if (\dash\url::module())
{
?>
    <div id="typed-strings" class="hide">
     <h2><?php echo \dash\data::page_title(); ?></h2>
     <p><?php echo \dash\data::page_desc(); ?></p>
    </div>
<?php
}
else
{
?>
    <div id="typed-strings" class="hide">
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
    </div>
<?php
}
?>
   </div>
  </section>
