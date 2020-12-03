
<?php
if(\dash\url::store() && \dash\url::content() === 'a')
{
require_once ('sidebar/sidebar-a.php');
}
//endif ?>


     <li><a href="<?php echo \dash\url::sitelang(); ?>/my" <?php if(\dash\url::content() === 'my') {?> class="activeContent"<?php }//endif ?>><i class='sf-atom'></i> <?php echo T_("Jibres Panel"); ?></a></li>
     <li><a href="<?php echo \dash\url::sitelang(); ?>/my/domain" <?php if(\dash\url::content() === 'my' && \dash\url::module() === 'domain') {?> class="active"<?php }//endif ?>><i class='sf-flag'></i> <?php echo T_("Jibres Domains"); ?></a></li>
     <li><a href="<?php echo \dash\url::sitelang(); ?>/my/business" <?php if(\dash\url::content() === 'my' && \dash\url::module() === 'business') {?> class="active"<?php }//endif ?>><i class='sf-heart'></i> <?php echo T_("My Business"); ?></a></li>



<?php if(\dash\permission::check('contentCp')) {?>
     <li><a href="<?php echo \dash\url::kingdom(); ?>/cms" <?php if(\dash\url::content() === 'cms') {?> class="activeContent"<?php }//endif ?> data-shortkey="67+77" data-shortkey-prevent data-shortkey-timeout='1000'><i class='sf-align-left'></i> <?php echo T_("CMS"); ?></a></li>
<?php
 if(\dash\url::content() === 'cms')
 {
  require_once ('sidebar/sidebar-cms.php');
 }
?>
<?php }//endif ?>
<?php if(\dash\permission::check('_group_crm')) {?>
     <li><a href="<?php echo \dash\url::kingdom(); ?>/crm" <?php if(\dash\url::content() === 'crm') {?> class="activeContent"<?php }//endif ?> data-shortkey="77+85" data-shortkey-prevent data-shortkey-timeout='1000'><i class='sf-group-full'></i> <?php echo T_("CRM Panel"); ?></a></li>
  <?php
  if(\dash\url::content() === 'crm')
  {
   require_once ('sidebar/sidebar-crm.php');
  }
  ?>
<?php }//endif ?>
<?php if(\dash\permission::supervisor()) {?>
   <li><a href="<?php echo \dash\url::sitelang(); ?>/love"<?php if(\dash\url::content() === 'love') {?> class="activeContent"<?php }//endif ?>><img src="<?php echo \dash\url::icon() ?>" alt='jibres' class="avatar"> <span><?php echo T_("Jibres Managment"); ?></span></a></li>
     <li><a href="<?php echo \dash\url::sitelang(); ?>/su"<?php if(\dash\url::content() === 'su') {?> class="activeContent"<?php }//endif ?> data-shortkey="83+85" data-shortkey-prevent data-shortkey-timeout='1000'><i class='sf-heartbeat'></i> <span><?php echo T_("Supervisor Panel"); ?></span></a></li>
<?php
 if(\dash\url::content() === 'su')
 {
  require_once ('sidebar/sidebar-su.php');
 }
?>
<?php }//endif ?>
<?php if(\dash\user::id()) {?>
     <li><a href="<?php echo \dash\url::sitelang(); ?>/account"<?php if(\dash\url::content() === 'account') {?> class="activeContent"<?php }//endif ?> data-shortkey="77+69" data-shortkey-prevent data-shortkey-timeout='1000'><i class='sf-user'></i> <span><?php echo T_("My Account"); ?></span></a></li>
<?php }//endif ?>
     <li><a href="<?php echo \dash\url::sitelang(); ?>/support"<?php if(\dash\url::content() === 'support') {?> class="activeContent"<?php }//endif ?> data-shortkey="112" data-shortkey-prevent data-shortkey-timeout='1000'><i class='sf-life-ring'></i> <span><?php echo T_("Help Center"); ?></span></a></li>
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

if(\dash\url::content() === 'm')
{
 require_once ('sidebar/sidebar-m.php');
}

?>