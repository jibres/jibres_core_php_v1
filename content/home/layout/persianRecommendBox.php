<?php
if (\dash\language::current() !== 'fa' && \dash\request::from_iranian())
{
?>
  <a id="jibresGoToFa" href="<?php echo \dash\url::persianWebsite(); ?>" data-mode='<?php echo \dash\request::from_iranian(); ?>'>
    <img src="<?php echo \dash\url::cdn(); ?>/img/flags/svg/ir.svg" alt='ایران'>
    <b>سلام هم‌وطن.</b>
    <span>برای استفاده از نسخه فارسی جیبرس از اینجا وارد شوید</span>
  </a>
<?php
}
?>