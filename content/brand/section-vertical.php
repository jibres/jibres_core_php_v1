<?php
$myUrlStatic = \dash\url::cdn();
?>

  <section class="avand-xl impact pTB4x">
   <div class="">
    <div class="f align-center mB10">
      <div class="c4 m6 s12">
        <h3 class="mB50"><?php echo T_("VERTICAL LOCKUP"); ?></h3>
        <p><?php echo T_("The vertical lockup can be used when the provided space is square and use of the horizontal lockup will make the logo look too small."); ?></p>
      </div>
      <div class="c s12 pLa10">
<?php
if(\dash\language::current() === 'fa')
{
?>

        <img class="slideImg width-300" src="<?php echo $myUrlStatic; ?>/logo/fa-vertical/svg/Jibres-Logo-fa-vertical.svg" alt='<?php echo T_("Jibres"); ?> <?php echo T_("VERTICAL LOCKUP"); ?>'>
<?php
}
else
{
?>
        <img class="slideImg width-300" src="<?php echo $myUrlStatic; ?>/logo/en-vertical/svg/Jibres-Logo-en-vertical.svg" alt='<?php echo T_("Jibres"); ?> <?php echo T_("VERTICAL LOCKUP"); ?>'>
<?php
} // endif
?>
      </div>
    </div>

   </div>
  </section>