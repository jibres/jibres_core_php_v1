<?php require_once(root. '/content_a/accounting/filter.php'); ?>

  <?php if(!\dash\data::reportDetail()) {?>
    <div class="msg"><?php echo T_("No detail was founded") ?></div>
  <?php }else{ ?>

    <table class="tbl1 v6 font-10">
      <thead>
        <tr class="font-10">
          <th class="collapsing"><?php echo T_("Code") ?></th>
          <th><?php echo T_("Accounting Group") ?></th>

          <th><?php echo T_("Opening value") ?></th>
          <th class="txtR"><?php echo T_("Current value") ?></th>

        </tr>
      </thead>
      <tbody>
         <?php $lastGroup = null; ?>
      <?php foreach (\dash\data::reportDetail() as $key => $value) {?>
        <?php if($lastGroup !== \dash\get::index($value, 'group_title')) {?>
          <?php $lastGroup = \dash\get::index($value, 'group_title'); ?>
          <tr class="positive">
            <td colspan="8" class="txtB fs14"><a href="<?php echo \dash\url::this(). '/turnover?'. http_build_query(['year_id' => \dash\request::get('year_id'), 'group' => \dash\get::index($value, 'group_id')]); ?>"><?php echo \dash\get::index($value, 'group_title') ?></a></td>
          </tr>
        <?php } //endif ?>

          <tr>
            <td class="collapsing"><?php echo \dash\fit::number(\dash\get::index($value, 'total_code')) ?></td>
            <td><a href="<?php echo \dash\url::this(). '/turnover?'. http_build_query(['year_id' => \dash\request::get('year_id'), 'group' => \dash\get::index($value, 'total_id')]); ?>"><?php echo \dash\get::index($value, 'total_title') ?></a></td>
          <td data-copy="<?php echo \dash\get::index($value, 'opening') ?>" class="font-12 ltr txtR fc-black"></i><code><?php echo \dash\fit::number(\dash\get::index($value, 'opening'), true, 'en') ?></code></td>
          <td data-copy="<?php echo \dash\get::index($value, 'current') ?>" class="font-12 ltr txtR fc-black"></i><code><?php echo \dash\fit::number(\dash\get::index($value, 'current'), true, 'en') ?></code></td>
          </tr>
        <?php } //endif ?>
      </tbody>
    </table>
  <?php } //endif ?>
