


<table class="tbl1 v3 cbox fs12">
  <thead>
    <tr>
      <th><?php echo T_("User"); ?></th>
      <th><?php echo T_("Chatid"); ?></th>

      <th><?php echo T_("Count"); ?></th>

    </tr>
  </thead>
  <tbody>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>

    <tr>
      <td class="collapsing">
        <a href="<?php echo \dash\url::that(); ?>?user_id=<?php echo a($value, 'user_id'); ?>">
          <img src="<?php echo a($value, 'avatar'); ?>" class="avatar mRa5" alt="<?php echo a($value, 'displayname'); ?>">
          <span class="font-bold s0 fs08"><?php echo a($value, 'displayname'); ?></span>
        </a>
        <div class="txtRa fs08">
          <a href="<?php echo \dash\url::that(); ?>?mobile=<?php echo a($value, 'mobile'); ?>" title='<?php echo T_("Mobile"); ?>'><?php echo a($value, 'mobile'); ?></a>
          <a href="<?php echo \dash\url::that(); ?>?userid=<?php echo a($value, 'user_id'); ?>" class="badge" title='<?php echo T_("User id"); ?>'><?php echo a($value, 'user_id'); ?></a>
        </div>
        <div class="txtRa fs08" data-tippy-placement='left' title='<?php echo T_("Telegram chatid"); ?>'>
          <a href="<?php echo \dash\url::that(); ?>?chatid=<?php echo a($value, 'chatid'); ?>"><?php echo a($value, 'chatid'); ?></a>
        </div>
        <nav class="txtRa">
          <a href="<?php echo \dash\url::that(); ?>?user_id=<?php echo a($value, 'user_id'); ?>" title='<?php echo T_("User logs"); ?>'><i class="sf-briefcase"></i></a>
          <a href="<?php echo \dash\url::kingdom(); ?>/crm/member/glance?id=<?php echo \dash\coding::encode(a($value, 'user_id')); ?>" title='<?php echo T_("User Profile"); ?>'><i class="sf-user-md"></i></a>

        </nav>
      </td>
      <td class="">
        <a href="<?php echo \dash\url::this(); ?>/log?chatid=<?php echo a($value, 'chatid'); ?>">
          <?php echo a($value, 'chatid'); ?>
        </a>
      </td>

      <td class="">
          <?php echo a($value, 'count'); ?> </td>

    </tr>
<?php } //endfor ?>
  </tbody>
</table>

<?php \dash\utility\pagination::html(); ?>

