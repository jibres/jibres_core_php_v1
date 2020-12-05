<?php $data = \dash\data::dataRow(); ?>
<div class="box">
  <div class="body">
    <div class="tblBox">
      <table class="tbl1 v4">
        <tbody>
          <tr><td><?php echo T_('id') ?></td><td><?php echo \dash\get::index($data, 'id'); ?></td></tr>
          <tr><td><?php echo T_('Mobile') ?></td><td class="ltr"><?php echo \dash\fit::mobile(\dash\get::index($data, 'mobile')); ?></td></tr>
          <tr><td><?php echo T_('Message') ?></td><td><?php echo \dash\get::index($data, 'message'); ?></td></tr>
          <tr><td><?php echo T_('line') ?></td><td><?php echo \dash\fit::text(\dash\get::index($data, 'line')); ?></td></tr>
          <tr><td><?php echo T_('datecreated') ?></td><td><?php echo \dash\fit::date_time(\dash\get::index($data, 'datecreated')); ?></td></tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
