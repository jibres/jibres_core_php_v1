
  <section id="enterBox">
   <h1 class='logo'><a href="<?php
if (\dash\detect\device::detectPWA())
{
 echo \dash\url::kingdom(). '/enter';
}
else
{
 echo \dash\url::kingdom();
}
?>"><img src='<?php echo \dash\url::icon(); ?>' alt='<?php echo T_("Jibres") ?>'><span><?php echo T_("Jibres") ?></span></a></h1>
   <?php
if(\dash\url::module() === null)
{
 echo "<h2>". T_("Jibres"). "</h2>";
}
else
{
 echo "<h2>". \dash\face::desc(). "</h2>";
}
?>
   <form method="post" autocomplete="off">
<?php require_once \dash\layout\func::display(); ?>
   </form>
  </section>