  <div id="jibresHeader" <?php echo \dash\request::country(); ?>>
   <div class="fit">
    <div class="f">
     <div class="cauto">
      <a class="logo" href='<?php echo \dash\url::kingdom() ?>/'><img <?php
        if (\dash\language::current() === 'fa')
        {
         echo "src='". \dash\url::cdn(). "/logo/fa/svg/Jibres-Logo-fa.svg". "' alt='". T_('Jibres Logo'). "'";
        }
        else
        {
         echo "src='". \dash\url::cdn(). "/logo/en/svg/Jibres-Logo-en.svg". "' alt='". T_('Jibres Logo'). "'";
        }
       ?>><h1><?php echo T_("Jibres"); ?></h1></a>
     </div>
     <nav class="c s0">
       <a href="<?php echo \dash\url::kingdom() ?>/pricing"><?php echo T_("Pricing"); ?></a>
       <?php if(false) { ?><a href="<?php echo \dash\url::kingdom() ?>/domain"><?php echo T_("Domains"); ?></a> <?php } // endif ?>
       <a href="<?php echo \dash\url::kingdom() ?>/support"><?php echo T_("Help Center"); ?></a>
     </nav>
     <div class="cauto"><?php
if (\dash\user::id())
{
 if (\dash\url::store())
 {
  echo '<a class="master" href="'. \dash\url::kingdom(). '/a">'. T_("Store Panel"). '</a>';
 }
 else
 {
  echo '<a class="master" href="'. \dash\url::sitelang(). '/my/store">'. T_("Dashboard"). '</a>';
 }

}
else
{
 echo '<a class="slave" href="'. \dash\url::sitelang(). '/enter">'. T_("Enter"). '</a>';
 echo '<a class="master" href="'. \dash\url::sitelang(). '/enter/signup">'. T_("SIGN UP"). '</a>';
}
?></div>
    </div>
   </div>
  </div>
<?php
if (\dash\language::current() !== 'fa' && \dash\request::country() === 'IR') {?>
  <a id="jibresGoToFa" href="https://jibres.ir" target="_blank">سلام. برای استفاده از نسخه فارسی جیبرس کلیک کنید</a>
<?php }?>
  <section id='jibresPageTitle'><div class="typing"><span class="typed"></span></div>
<?php
if (\dash\url::module())
{
?>
    <div id="typed-strings">
     <h2><?php echo \dash\face::title(); ?></h2>
    </div>
<?php
}
else
{
?>
    <div id="typed-strings">
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
  </section>