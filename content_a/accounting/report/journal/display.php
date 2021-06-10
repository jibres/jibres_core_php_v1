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
      </tr>
    </thead>
    <tbody>
  <?php foreach (\dash\data::reportDetail() as $key => $value) {?>
        <tr>
        <?php if(a($value, 'type') === 'break_message') {?>
          <?php if(a($value, 'mode') === 'end_of_page' || a($value, 'mode') === 'start_new_page') {?>
            <td class="collapsing"><?php echo \dash\fit::number($key + 1) ?></td>
            <td class="collapsing"></td>
            <td class="collapsing"></td>
            <td class="txtB fs14 fc-blue"><?php echo a($value, 'message') ?></td>
            <td data-copy='<?php echo a($value, 'sum_debtor_on_page'); ?>' class="ltr txtR fc-green"><code><?php echo \dash\fit::number(a($value, 'sum_debtor_on_page'), true, 'en') ?></code></td>
            <td data-copy='<?php echo a($value, 'sum_creditor_on_page'); ?>' class="ltr txtR fc-red"><code><?php echo \dash\fit::number(a($value, 'sum_creditor_on_page'), true, 'en') ?></code></td>

          <?php }else{ ?>
            <td class="collapsing"><?php echo \dash\fit::number($key + 1) ?></td>
            <td class="collapsing"></td>
            <td class="collapsing"></td>
            <td class="txtB fs14 fc-pink"><?php echo a($value, 'message') ?></td>
            <td></td>
            <td></td>

          <?php } //endif ?>

        <?php }else{ ?>
          <td class="collapsing"><?php echo \dash\fit::number($key + 1) ?></td>
          <td class="collapsing"><?php echo \dash\fit::number(a($value, 'myNumber')); ?></td>
          <td class="collapsing"><?php if(isset($value['enddate'])) { echo \dash\utility\jdate::date("Y F", strtotime($value['enddate']) - (60*60*24*5)); } ?></td>
          <?php if(a($value, 'mode') === 'debtor') {?>
            <td><?php echo a($value, 'total_title') ?></td>
            <td data-copy='<?php echo a($value, 'show_value'); ?>' class="ltr txtR fc-green"><code><?php echo \dash\fit::number(a($value, 'show_value'), true, 'en') ?></code></td>
            <td></td>
          <?php }elseif(a($value, 'mode') === 'creditor') {?>
            <td class="txtL"><?php echo a($value, 'total_title') ?></td>
            <td></td>
            <td data-copy='<?php echo a($value, 'show_value'); ?>' class="ltr txtR fc-red"><code><?php echo \dash\fit::number(a($value, 'show_value'), true, 'en') ?></code></td>
          <?php } //endif ?>
        <?php } //endif ?>
        </tr>
      <?php } //endif ?>
    </tbody>
  </table>

<?php } //endif ?>