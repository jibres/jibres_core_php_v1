<?php require_once(root. '/content_a/accounting/filter_only_year.php'); ?>
<?php if(!\dash\data::reportDetail()) {?>
  <div class="msg"><?php echo T_("No detail was founded") ?></div>
<?php }else{ ?>
    <table class="tbl1 v4 fs14">
    <thead>
      <tr class="">
        <th class="collapsing">#</th>
        <th class="collapsing"><?php echo T_("Number") ?></th>
        <th class="collapsing"><?php echo T_("Date") ?></th>

        <th><?php echo T_("Description") ?></th>
        <th class="txtR"><?php echo T_("Debtor") ?></th>
        <th class="txtR"><?php echo T_("Creditor") ?></th>
        <th class="collapsing"><?php echo T_("Detect") ?></th>
        <th class="txtR"><?php echo T_("Remain") ?></th>
      </tr>
    </thead>
    <tbody>
  <?php foreach (\dash\data::reportDetail() as $key => $one_total) {?>
  <?php foreach ($one_total as $value) {?>
        <tr>

          <td class="collapsing"><?php echo \dash\fit::number($key + 1) ?></td>
          <td class="collapsing"><?php echo \dash\fit::number(a($value, 'myNumber')); ?></td>
          <td class="collapsing"><?php if(isset($value['enddate'])) { echo \dash\utility\jdate::date("Y F", strtotime($value['enddate']) - (60*60*24*5)); } ?></td>
          <?php if(a($value, 'mode') === 'debtor') {?>
            <td><?php echo a($value, 'total_title') ?></td>
            <td data-copy='<?php echo a($value, 'show_value'); ?>' class="ltr txtR fc-green"><code><?php echo \dash\fit::number(a($value, 'show_value'), true, 'en') ?></code></td>
            <td></td>
          <?php }elseif(a($value, 'mode') === 'creditor') {?>
            <td class=""><?php echo a($value, 'total_title') ?></td>
            <td></td>
            <td data-copy='<?php echo a($value, 'show_value'); ?>' class="ltr txtR fc-red"><code><?php echo \dash\fit::number(a($value, 'show_value'), true, 'en') ?></code></td>
          <?php } //endif ?>
            <td class="collapsing"><?php echo a($value, 'detect_title') ?></td>
            <td data-copy='<?php echo a($value, 'remain_value'); ?>' class="ltr txtR fc-black"><code><?php echo \dash\fit::number(a($value, 'remain_value'), true, 'en') ?></code></td>

        </tr>
      <?php } //enfor ?>
      <tr>
        <td colspan="8" class="txtC fc-pink txtB"><?php echo T_("Go to next page") ?></td>
      </tr>
      <?php } //enfor ?>
    </tbody>
  </table>

<?php } //endif ?>