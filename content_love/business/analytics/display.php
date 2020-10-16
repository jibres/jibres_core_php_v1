<div class="avand">
  <?php $store_time_line = \lib\app\store\analytics::average_creating_time(); ?>
  <nav class="items">
    <ul>
      <li>
        <a class="f item">
          <div class="key"><?php echo T_("Average Creating time"); ?></div>
          <div class="value"><?php echo \dash\fit::text(\dash\get::index($store_time_line, 'avg'));?> <small><?php echo T_("second") ?></small></div>
          <div class="go"></div>
        </a>
      </li>

      <li>
        <a class="f item">
          <div class="key"><?php echo T_("Maximum Creating time"); ?></div>
          <div class="value"><?php echo \dash\fit::text(\dash\get::index($store_time_line, 'max'));?> <small><?php echo T_("second") ?></small></div>
          <div class="go"></div>
        </a>
      </li>

      <li>
        <a class="f item">
          <div class="key"><?php echo T_("Minimum Creating time"); ?></div>
          <div class="value"><?php echo \dash\fit::text(\dash\get::index($store_time_line, 'min'));?> <small><?php echo T_("second") ?></small></div>
          <div class="go"></div>
        </a>
      </li>

    </ul>
  </nav>

  <div class="tblBox">
    <table class="tbl1 v5 font-14">
      <thead>
        <tr>
          <th><?php echo T_("Title"); ?></th>
          <th><?php echo T_("Sum"); ?></th>
          <th><?php echo T_("Maximum"); ?></th>
          <th><?php echo T_("Minimum"); ?></th>
          <th><?php echo T_("Average"); ?></th>
          <th class="collapsing"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach (\dash\data::storeAnalytics() as $key => $value) {?>
          <tr>
            <td><?php echo \dash\get::index($value, 'title'); ?></td>
            <td class="txtB fc-blue"><?php echo \dash\fit::number_en(\dash\get::index($value, 'sum')); ?></td>
            <td class="txtB fc-blue"><?php echo \dash\fit::number_en(\dash\get::index($value, 'max')); ?></td>
            <td><?php echo \dash\fit::number_en(\dash\get::index($value, 'min')); ?></td>
            <td><?php echo \dash\fit::number_en(\dash\get::index($value, 'avg')); ?></td>
            <td class="collapsing"><a class="btn link" href="<?php echo \dash\url::this(). '/analytics/table?f='. $key ?>"><?php echo T_("Show list") ?></a></td>
          </tr>
        <?php } //endfor ?>
      </tbody>
    </table>
  </div>
</div>