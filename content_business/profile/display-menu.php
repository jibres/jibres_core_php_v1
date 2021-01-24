<?php if(\dash\user::login()) {?>
<nav class="items">
 <ul>
   <li><a class="f" href="<?php echo \dash\url::here();?>/profile/detail"><div class="key"><?php echo T_('Profile');?></div><div class="go"></div></a></li>
   <li><a class="f" href="<?php echo \dash\url::here();?>/profile/avatar"><div class="key"><?php echo T_('Avatar');?></div><div class="go"></div></a></li>
   <li><a class="f" href="<?php echo \dash\url::here();?>/profile/address"><div class="key"><?php echo T_('Address');?></div><div class="go"></div></a></li>
   <li><a class="f" href="<?php echo \dash\url::here();?>/profile/notifications"><div class="key"><?php echo T_('Notifications');?></div><div class="go"></div></a></li>
   <li><a class="f" href="<?php echo \dash\url::here();?>/orders"><div class="key"><?php echo T_('My orders');?></div><div class="go"></div></a></li>

 </ul>
</nav>

<nav class="items">
 <ul>
   <li><a class="f" href="<?php echo \dash\url::here();?>/cart"><div class="key"><?php echo T_('My cart');?></div><div class="go"></div></a></li>
   <li><a class="f" href="<?php echo \dash\url::here();?>/enter/pass/change"><div class="key"><?php echo T_('Change your password');?></div><div class="go"></div></a></li>
 </ul>
</nav>

<?php } //endif ?>

<?php if(!\dash\user::login()) {?>
<nav class="items">
 <ul>
   <li><a class="f" href="<?php echo \dash\url::here();?>/cart"><div class="key"><?php echo T_('My cart');?></div><div class="go"></div></a></li>
   <li><a class="f" href="<?php echo \dash\url::here();?>/orders"><div class="key"><?php echo T_('My orders');?></div><div class="go"></div></a></li>
 </ul>
</nav>
<?php } //endif ?>
<nav class="items">
 <ul>
   <li><a class="f" href="<?php echo \dash\url::here();?>/ticket"><div class="key"><?php echo T_('Tickets');?></div><div class="go"></div></a></li>
   <li><a class="f" href="<?php echo \dash\url::here();?>/ticket/add"><div class="key"><?php echo T_('Add new ticket');?></div><div class="go"></div></a></li>
 </ul>
</nav>
<?php if(\dash\user::login()) {?>
<nav class="items">
 <ul>
   <li><a class="f" href="<?php echo \dash\url::here();?>/logout"><div class="key"><?php echo T_('Logout');?></div><div class="go"></div></a></li>
 </ul>
</nav>
<?php } // endif ?>
<?php if(!\dash\user::login()) {?>
<nav class="items">
 <ul>
   <li><a class="f" href="<?php echo \dash\url::here();?>/enter"><div class="key"><?php echo T_('Login');?></div><div class="go"></div></a></li>
 </ul>
</nav>
<?php } //endif ?>