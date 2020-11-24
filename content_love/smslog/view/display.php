<?php $data = \dash\data::dataRow(); ?>
<div class="box">
  <div class="body">
    <div class="tblBox">
      <table class="tbl1 v4">
        <tbody>
          <tr><td><?php echo T_('id') ?></td><td><?php echo \dash\get::index($data, 'id'); ?></td></tr>
          <tr><td><?php echo T_('Mobile') ?></td><td><?php echo \dash\get::index($data, 'mobile'); ?></td></tr>
          <tr><td><?php echo T_('Mobiles') ?></td><td><?php echo \dash\get::index($data, 'mobiles'); ?></td></tr>
          <tr><td><?php echo T_('Message') ?></td><td><?php echo \dash\get::index($data, 'message'); ?></td></tr>
          <tr><td><?php echo T_('Mode') ?></td><td><?php echo \dash\get::index($data, 'mode'); ?></td></tr>
          <tr><td><?php echo T_('Type') ?></td><td><?php echo \dash\get::index($data, 'type'); ?></td></tr>
          <tr><td><?php echo T_('user_id') ?></td><td><?php echo \dash\get::index($data, 'user_id'); ?></td></tr>
          <tr><td><?php echo T_('IP') ?></td><td><?php echo \dash\get::index($data, 'ip'); ?></td></tr>
          <tr><td><?php echo T_('Business') ?></td><td><?php echo \dash\get::index($data, 'store_id'); ?></td></tr>
          <tr><td><?php echo T_('Url') ?></td><td><?php echo \dash\get::index($data, 'url'); ?></td></tr>
          <tr><td><?php echo T_('line') ?></td><td><?php echo \dash\get::index($data, 'line'); ?></td></tr>
          <tr><td><?php echo T_('apikey') ?></td><td><?php echo \dash\get::index($data, 'apikey'); ?></td></tr>
          <tr><td><?php echo T_('Url MD5') ?></td><td><?php echo \dash\get::index($data, 'urlmd5'); ?></td></tr>
          <tr><td><?php echo T_('IP id') ?></td><td><?php echo \dash\get::index($data, 'ip_id'); ?></td></tr>
          <tr><td><?php echo T_('IP MD5') ?></td><td><?php echo \dash\get::index($data, 'ip_md5'); ?></td></tr>
          <tr><td><?php echo T_('Agent') ?></td><td><?php echo \dash\get::index($data, 'agent_id'); ?></td></tr>
          <tr><td><?php echo T_('response') ?></td><td><pre class="txtL ltr"><?php echo \dash\get::index($data, 'response'); ?></pre></td></tr>
          <tr><td><?php echo T_('send') ?></td><td><pre class="txtL ltr"><?php echo \dash\get::index($data, 'send'); ?></pre></td></tr>
          <tr><td><?php echo T_('datesend') ?></td><td><?php echo \dash\fit::date_time(\dash\get::index($data, 'datesend')); ?></td></tr>
          <tr><td><?php echo T_('dateresponse') ?></td><td><?php echo \dash\fit::date_time(\dash\get::index($data, 'dateresponse')); ?></td></tr>
          <tr><td><?php echo T_('datecreated') ?></td><td><?php echo \dash\fit::date_time(\dash\get::index($data, 'datecreated')); ?></td></tr>
          <tr><td><?php echo T_('datemodified') ?></td><td><?php echo \dash\fit::date_time(\dash\get::index($data, 'datemodified')); ?></td></tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
