<?php if(\dash\permission::check('supportTicketManageSubdomain') || \dash\permission::check('supportTicketManage')) {?>

<div class="f">
  <div class="c">
    <a class="dcard <?php if(\dash\data::accessMode() === 'mine') { echo ' active';} ?>" href='<?php echo \dash\url::this(); ?>?access=mine'>
     <div class="statistic <?php if(\dash\data::accessMode() === 'mine') { echo ' blue ';}else{ echo ' brown ';} ?>">
      <div class="value mB10"><i class="sf-user"></i></div>
      <div class="label"><?php echo T_("My tickets"); ?></div>
     </div>
    </a>
  </div>

  <?php if(\dash\permission::check('supportTicketManage')) {?>

  <div class="c">
    <a class="dcard <?php if(\dash\data::accessMode() === 'manage') {echo ' active'; }?>" href='<?php echo \dash\url::this(); ?>?access=manage'>
     <div class="statistic <?php if(\dash\data::accessMode() === 'manage') { echo ' blue ';}else{ echo ' brown ';} ?>">
      <div class="value mB10"><i class="sf-users"></i></div>
      <div class="label"><?php echo T_("Manage tickets"); ?></div>
     </div>
    </a>
  </div>
  <?php } ?>


</div>

<?php } ?>
