

  <?php if(\dash\permission::check('cpUsersView') || \dash\permission::check('cpUsersAdd')) {?>
      <li>
        <?php if(\dash\permission::check('cpUsersView')) {?>
          <a href="<?php echo \dash\url::here(); ?>/member"><i class='sf-users'></i> <span><?php echo T_("Users"); ?></span></a>
        <?php } //endif ?>
          <ul>
            <?php if(\dash\permission::check('cpUsersAdd')) {?>
              <li><a href="<?php echo \dash\url::here(); ?>/member/add"><?php echo T_("Add new user"); ?> <i class='floatLa mRa10 fc-mute sf-user-plus'></i></a></li>
            <?php } //endif ?>
          </ul>
      </li>
  <?php } //endif ?>
    <?php if(\dash\permission::check('cpPermissionView')) {?>
      <li><a href="<?php echo \dash\url::here(); ?>/permission"><i class='sf-lock'></i> <?php echo T_("Permissions"); ?></a></li>
    <?php } //endif ?>



  <?php if(\dash\permission::check('cpTransaction') || \dash\permission::check('cpTransactionAdd')) {?>
      <li>
          <?php if(\dash\permission::check('cpSMS')) {?>
          <a href="<?php echo \dash\url::here(); ?>/transactions"><i class='sf-card'></i> <span><?php echo T_("Transactions"); ?></span></a>
          <?php } //endif ?>
          <ul>
            <?php if(\dash\permission::check('cpTransactionAdd')) {?>
              <li><a href="<?php echo \dash\url::here(); ?>/transactions/add"><?php echo T_("Plus charge account"); ?> <i class='floatLa mRa10 fc-mute sf-plus-circle'></i></a></li>
              <li><a href="<?php echo \dash\url::here(); ?>/transactions/minus"><?php echo T_("Minus charge account"); ?> <i class='floatLa mRa10 fc-mute sf-minus-circle'></i></a></li>
            <?php } //endif ?>
          </ul>
      </li>
<?php }  ?>

