 <div class="scr">
  <figure>
<?php
if(\dash\user::id())
{
  $avatarLink = \dash\data::avatarLink();
  if(!$avatarLink)
  {
    $avatarLink = \dash\url::kingdom(). '/account';
  }

  echo "<a href='$avatarLink' title='". T_('Edit your profile'). "' class='avatar'>";
  if(\dash\user::detail('avatar'))
  {
    echo '<img src="'. \dash\user::detail('avatar'). '" alt="'. T_("Avatar of you"). ' '. \dash\user::detail('displayname') .'">';
  }
  elseif(\dash\user::id())
  {
      echo '<img src="'. \dash\url::static().'/siftal/images/default/avatar.png" alt='. T_("Default Avatar").'>';
  }
  else
  {

  }
  echo '</a>';
  echo '<figcaption>'. T_("Hello").' <b>'. \dash\user::detail('displayname'). '</b></figcaption>';

}
else
{
  echo "<a href='". \dash\url::kingdom(). "/enter?referer=". \dash\url::pwd(). "' class='avatar'>";
  echo '<img src="'. \dash\url::static().'/siftal/images/avatar/guest.png" alt="'. T_("Default Avatar").'">';
  echo '<figcaption> '. T_("Hello ").  ' <b> '. T_("dear GUEST!"). '</b></figcaption>';
}

?>
  </figure>
  <div class="menu">
   <ul class="sidenav">





<?php if(\dash\url::subdomain()) {?>
  <li><a href="<?php echo \dash\url::kingdom(); ?>/a" <?php if(\dash\url::content() === 'a') {?> class="activeContent"<?php }//endif ?>><i class='sf-align-left'></i> <?php echo T_("Store admin panel"); ?></a></li>
  <?php
  if(\dash\url::content() === 'a')
  {
    require_once ('sidebar/sidebar-a.php');
  }
  ?>
<?php }//endif ?>

  <li><a href="<?php echo \dash\url::sitelang(); ?>/my" <?php if(\dash\url::content() === 'my') {?> class="activeContent"<?php }//endif ?>><i class='sf-atom'></i> <?php echo T_("Jibres Panel"); ?></a></li>

<?php if(\dash\permission::check('contentCp')) {?>
      <li><a href="<?php echo \dash\url::kingdom(); ?>/cms" <?php if(\dash\url::content() === 'cms') {?> class="activeContent"<?php }//endif ?> data-shortkey="67+77" data-shortkey-prevent data-shortkey-timeout='1000'><i class='sf-align-left'></i> <?php echo T_("CMS"); ?></a></li>
  <?php
  if(\dash\url::content() === 'cms')
  {
    require_once ('sidebar/sidebar-cms.php');
  }
  ?>

<?php }//endif ?>

<?php if(\dash\permission::check('contentCrm')) {?>
   <li><a href="<?php echo \dash\url::kingdom(); ?>/crm" <?php if(\dash\url::content() === 'crm') {?> class="activeContent"<?php }//endif ?> data-shortkey="77+85" data-shortkey-prevent data-shortkey-timeout='1000'><i class='sf-group-full'></i> <?php echo T_("CRM Panel"); ?></a></li>

    <?php
    if(\dash\url::content() === 'crm')
    {
      require_once ('sidebar/sidebar-crm.php');
    }
    ?>
<?php }//endif ?>


<?php if(\dash\permission::supervisor()) {?>

  <li><a href="<?php echo \dash\url::sitelang(); ?>/su" <?php if(\dash\url::content() === 'su') {?> class="activeContent"<?php }//endif ?> data-shortkey="83+85" data-shortkey-prevent data-shortkey-timeout='1000'><i class='sf-heartbeat'></i> <span><?php echo T_("Supervisor Panel"); ?></span></a></li>
  <?php
  if(\dash\url::content() === 'su')
  {
    require_once ('sidebar/sidebar-su.php');
  }
  ?>

<?php }//endif ?>


<?php if(\dash\user::id()) {?>
    <li><a href="<?php echo \dash\url::sitelang(); ?>/account" <?php if(\dash\url::content() === 'account') {?> class="activeContent"<?php }//endif ?> data-shortkey="77+69" data-shortkey-prevent data-shortkey-timeout='1000'><i class='sf-user'></i> <span><?php echo T_("My Account"); ?></span></a></li>
  <?php
  if(\dash\url::content() === 'account')
  {
    require_once ('sidebar/sidebar-account.php');
  }
  ?>

<?php }//endif ?>

  <li><a href="<?php echo \dash\url::sitelang(); ?>/support" <?php if(\dash\url::content() === 'support') {?> class="activeContent"<?php }//endif ?> data-shortkey="112" data-shortkey-prevent data-shortkey-timeout='1000'><i class='sf-life-ring'></i> <span><?php echo T_("Help Center"); ?></span></a></li>
<?php
if(\dash\url::content() === 'support')
{
  require_once ('sidebar/sidebar-support.php');
}
?>





<?php
if(\dash\url::content() === 'domain')
{
  require_once ('sidebar/sidebar-domain.php');
}
?>


<?php
if(\dash\url::content() === 'api')
{
  require_once ('sidebar/sidebar-api.php');
}
?>


<?php
if(\dash\url::content() === 'm')
{
  require_once ('sidebar/sidebar-m.php');
}
?>




   </ul>
  </div>
 </div>
  <abbr class="toggleClean" title='{%trans "Click to toggle sidebar status"%}'><span class="sf-arrows-out"></span></abbr>

  <a href="<?php echo \dash\url::kingdom() ?>" id='ermileBadge' class="f" target="_blank">
   <div class="cauto pRa10">
    <img src="<?php echo \dash\url::icon() ?>" alt='<?php echo T_("Jibres") ?>'>
   </div>
   <div class="c">
    <h2><?php echo T_("Jibres") ?></h2>
    <h3><?php echo T_("Sell & Enjoy") ?></h3>
   </div>
  </a>








