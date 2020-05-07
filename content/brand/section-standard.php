<?php
$myUrlStatic = \dash\url::cdn();
?>

  <section class="pTB4x">
   <div class="avand-lg">
    <div class="f align-center mB10">
      <div class="c4 m6 s12">
        <h3 class="mB50"><?php echo T_("STANDARD LOCKUP"); ?></h3>
        <p><?php echo T_("Our standard horizontal lockup is our official logotype, consisting of the icon and our wordmark. If you aren't sure which logo to use in your materials, use this one."); ?></p>
      </div>
      <div class="c s12 pLa10">
<?php
if(\dash\language::current() === 'fa')
{
?>
        <img class="slideImg width-400" src="<?php echo $myUrlStatic; ?>/logo/styleguide-fa/png/jibres-logo-styleguide-fa-4-img.png" alt='<?php echo T_("Jibres"); ?> <?php echo T_("STANDARD LOCKUP"); ?>'>
<?php
}
else
{
?>
        <img class="slideImg width-400" src="<?php echo $myUrlStatic; ?>/logo/styleguide/png/jibres-logo-styleguide-4-img.png" alt='<?php echo T_("Jibres"); ?> <?php echo T_("STANDARD LOCKUP"); ?>'>
<?php
} // endif
?>
      </div>
    </div>

   </div>
  </section>