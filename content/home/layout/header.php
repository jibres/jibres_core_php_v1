
  <div id="jibresHeader">
   <div class="avand">
    <div class="f">
     <div class="cauto">
      <a class="logo" href='<?php echo \dash\url::homepage() ?>'><?php
if (\dash\language::current() === 'fa')
{
  echo file_get_contents(root."content/home/layout/brand-fa.svg");
}
else
{
  echo file_get_contents(root."content/home/layout/brand-en.svg");
}
       ?><h1><?php echo T_("Jibres"); ?> - <?php echo T_('No.1 Free eCommerce Solution'); ?></h1></a>
     </div>
     <nav class="c s0">
       <a href="<?php echo \dash\url::kingdom(); ?>/free"><?php echo T_("Why Free?"); ?></a>
       <a href="<?php echo \dash\url::kingdom(); ?>/domains"><?php echo T_("Domains"); ?></a>
<?php if (\dash\url::tld() === 'ir') {?>
       <a target="_blank" href="<?php echo \dash\url::support(); ?>"><?php echo T_("Help Center"); ?> <i class="sf-link-external"></i></a>
<?php } ?>
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