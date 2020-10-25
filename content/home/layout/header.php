
  <div id="jibresHeader">
   <div class="avand">
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
       ?>><h1><?php echo T_("Jibres"); ?> - <?php echo T_('No.1 Free eCommerce Solution'); ?></h1></a>
     </div>
     <nav class="c s0">
       <a href="<?php echo \dash\url::kingdom() ?>/pricing"><?php echo T_("Pricing"); ?></a>
       <a href="<?php echo \dash\url::kingdom() ?>/domains"><?php echo T_("Domains"); ?></a>
       <a href="<?php echo \dash\url::kingdom() ?>/support"><?php echo T_("Help Center"); ?></a>
     </nav>
     <div class="cauto"><?php
if (\dash\user::id())
{
  echo '<a class="master" href="'. \dash\url::sitelang(). '/my">'. T_("Control Center"). '</a>';
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
if (\dash\language::current() !== 'fa' && (\dash\request::country() === 'IR' || \dash\url::isLocal())) {?>
  <a id="jibresGoToFa" href="https://jibres.ir">
    <img src="<?php echo \dash\url::cdn(); ?>/img/flags/svg/ir.svg" alt='ایران'>
    <b>سلام هم‌وطن.</b>
    <span>برای استفاده از نسخه فارسی جیبرس از اینجا وارد شوید</span>
  </a>
<?php }?>

<?php
if (\dash\url::module())
{
?>
  <section id='jibresPageTitle'>
    <div class="avand">
      <div class="typing"><span class="typed"></span></div>
      <div id="typed-strings">
       <h2><?php echo \dash\face::title(); ?></h2>
      </div>
    </div>
  </section>
<?php
}
?>