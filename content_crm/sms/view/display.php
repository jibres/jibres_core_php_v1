<?php $data = \dash\data::dataRow(); ?>
<div class="box">
  <div class="body">
    <div class="tblBox">
      <table class="tbl1 v4">
        <tbody>
          <tr><td><?php echo T_('id') ?></td><td><?php echo \dash\get::index($data, 'id'); ?></td></tr>
          <tr><td><?php echo T_('Mobile') ?></td><td><?php echo \dash\get::index($data, 'mobile'); ?></td></tr>
          <?php if(\dash\get::index($data, 'mobiles')) {?><tr><td><?php echo T_('Mobiles') ?></td><td><?php echo \dash\get::index($data, 'mobiles'); ?></td></tr><?php } //endif ?>
          <tr><td><?php echo T_('Message') ?></td><td><?php echo \dash\get::index($data, 'message'); ?></td></tr>
          <tr><td><?php echo T_('Mode') ?></td><td><?php echo \dash\get::index($data, 'mode'); ?></td></tr>
          <tr><td><?php echo T_('Type') ?></td><td><?php echo \dash\get::index($data, 'type'); ?></td></tr>
          <tr><td><?php echo T_('IP') ?></td><td><?php echo \dash\get::index($data, 'ip'); ?></td></tr>
          <tr><td><?php echo T_('Url') ?></td><td><?php echo \dash\get::index($data, 'url'); ?></td></tr>
          <tr><td><?php echo T_('line') ?></td><td><?php echo \dash\get::index($data, 'line'); ?></td></tr>
          <tr><td><?php echo T_('datecreated') ?></td><td><?php echo \dash\fit::date_time(\dash\get::index($data, 'datecreated')); ?></td></tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
