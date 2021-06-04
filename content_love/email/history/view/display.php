<?php $data = \dash\data::dataRow(); ?>
<div class="box">
  <div class="body">
    <div class="tblBox">
      <table class="tbl1 v4">
        <tbody>
          <tr><td><?php echo T_('id') ?></td><td><?php echo a($data, 'id'); ?></td></tr>
          <tr><td><?php echo T_('From') ?></td><td><?php echo a($data, 'from'); ?></td></tr>
          <tr><td><?php echo T_('To') ?></td><td><?php echo a($data, 'to'); ?></td></tr>
          <tr><td><?php echo T_('Subject') ?></td><td><?php echo a($data, 'subject'); ?></td></tr>
          <tr><td><?php echo T_('datesend') ?></td><td><?php echo \dash\fit::date_time(a($data, 'datesend')); ?></td></tr>
          <tr><td><?php echo T_('datecreated') ?></td><td><?php echo \dash\fit::date_time(a($data, 'datecreated')); ?></td></tr>
          <tr><td><?php echo T_('datemodified') ?></td><td><?php echo \dash\fit::date_time(a($data, 'datemodified')); ?></td></tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
<pre><?php print_r($data) ?></pre>
