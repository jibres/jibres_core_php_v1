<?php
if(\dash\user::detail('twostep'))
{
?>


  <div class='text'>
   <p><?php echo T_("Two-step login is now active for you."); ?></p>
  </div>
  <button data-ajaxify data-method='post' data-data='{"action": "deactive"}' class="btn pain block"><?php echo T_("Deactive two-step"); ?></button>

<?php
}
else
{
?>

  <div class='text'>
   <p><?php echo T_("Two-step login is now deactive for you."); ?></p>
  </div>
  <button data-ajaxify data-method='post' data-data='{"action": "active"}' class="btn success block"><?php echo T_("Active two-step"); ?></button>


<?php
} // endif
?>


  <a class='link mT20' href="<?php echo \dash\url::sitelang(); ?>/account/security"><?php echo T_("Back"); ?></a>
