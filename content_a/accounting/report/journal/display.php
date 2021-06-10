<?php require_once(root. '/content_a/accounting/filter_only_year.php'); ?>
<?php if(!\dash\data::reportDetail()) {?>
  <div class="msg"><?php echo T_("No detail was founded") ?></div>
<?php }else{ ?>
<?php $pageNumber = 1; ?>
  <div class="printArea" data-size='A4.landscape'>
    <div class="msg f align-center txtC font-16">
      <div class="c3"></div>
      <div class="c6"><h2 class="txtB"><?php echo T_("General Journal"); ?></h2></div>
      <div class="c3"><span class="inline-block w-16 h-16 rounded-full bg-gray-200 font-22"><?php echo \dash\fit::number($pageNumber); ?></span></div>
    </div>
    <table class="table-fixed w-full border border-indigo-600">
    <thead class="text-center font-20">
      <tr>
        <th class="w-10 h-32 font-10" rowspan="2"><span class="transform rotate-90 inline-block whitespace-nowrap translate-x-5" style="--tw-rotate: 270deg;"><?php echo T_("General Journal Number") ?></span></th>
        <th class="w-20" colspan="2"><?php echo T_("Date") ?></th>
        <th class="w-10 font-10" rowspan="2"><span class="transform rotate-90 block whitespace-nowrap -translate-y-6" style="--tw-rotate: 270deg;"><?php echo T_("Ledger Number") ?></span></th>
        <th class=""><?php echo T_("Description") ?></th>
        <th class="w-10"></th>
        <th class="w-1/6"><?php echo T_("Debtor") ?></th>
        <th class="w-1/6"><?php echo T_("Creditor") ?></th>
      </tr>
      <tr>
        <th class=""><?php echo T_("Day"); ?></th>
        <th class=""><?php echo T_("Month"); ?></th>
        <th class=""></th>
        <th class=""></th>
        <th class=""><?php echo T_("Rial"); ?></th>
        <th class=""><?php echo T_("Rial"); ?></th>
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
 </div>

<?php } //endif ?>