  <div class="scr">
<?php
if(\dash\url::subdomain() === 'developers')
{
 echo "<ul class='pT50'>";
 if(\dash\url::directory() === 'docs/api/v2')
 {
  require_once ('sidebar/sidebar-api-v2.php');
 }
 elseif(\dash\url::directory() === 'docs/irnic/r10')
 {
  require_once ('sidebar/sidebar-api-domain.php');
 }
 echo "</ul>";
}
else
{
  require_once ('admin-sidebar-frame.php');
}
?>
  </div>
  <abbr class="toggleClean" title='<?php echo T_("Click to toggle sidebar status"); ?>'><span class="sf-arrows-out"></span></abbr>
  <a href="<?php echo \dash\url::sitelang() ?>" id='ermileBadge' class="f">
   <div class="cauto pRa10"><img src="<?php echo \dash\url::icon() ?>" alt='<?php echo T_("Jibres") ?>'></div>
   <div class="c"><h2><?php echo T_("Jibres") ?></h2><h3><?php echo T_("Sell & Enjoy") ?></h3></div>
  </a>