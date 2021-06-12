<?php require_once(root. '/content_a/accounting/filter_only_year.php'); ?>
<?php if(!\dash\data::reportDetail()) {?>
  <div class="msg"><?php echo T_("No detail was founded") ?></div>
<?php }else{ ?>
  <?php foreach (\dash\data::reportPerPage() as $pageNumber => $one_page) {?>

<style type="text/css">.page-break{page-break-after:always}</style>
  <div class="printArea" data-size='A4'>
    <div class="msg f align-center txtC font-16">
      <div class="c3"></div>
      <div class="c6"><h2 class="txtB"><?php echo T_("General Journal"); ?></h2></div>
      <div class="c3"><span class="inline-block w-16 h-16 rounded-full bg-gray-200 font-22"><?php echo \dash\fit::number($pageNumber); ?></span></div>
    </div>
    <table class="table-fixed border-collapse w-full border-solid border-double border-4 border-eight-blue-500">
    <thead class="text-center font-20">
      <tr>
        <th class="w-10 h-32 font-10 border-solid border-b-2 border-e border-blue-900" rowspan="2"><span class="transform rotate-90 inline-block whitespace-nowrap translate-x-5" style="--tw-rotate: 270deg;"><?php echo T_("General Journal Number") ?></span></th>
        <th class="w-20 font-16 border-solid border-b border-e border-blue-900" colspan="2"><?php echo T_("Date") ?></th>
        <th class="w-10 font-10 border-solid border-b-2 border-e border-blue-900" rowspan="2"><span class="transform rotate-90 block whitespace-nowrap -translate-y-6" style="--tw-rotate: 270deg;"><?php echo T_("Ledger Number") ?></span></th>
        <th class="border-solid border-b-2 border-e border-blue-900" rowspan="2"><?php echo T_("Explanation") ?></th>
        <th class="w-10 border-solid border-e border-blue-900"></th>
        <th class="w-1/6 border-solid border-b border-e-2 border-blue-900"><?php echo T_("Debtor") ?></th>
        <th class="w-1/6 border-solid border-b border-blue-900"><?php echo T_("Creditor") ?></th>
      </tr>
      <tr>
        <th class="border-solid border-b-2 border-blue-900 border-e font-12"><?php echo T_("Day"); ?></th>
        <th class="border-solid border-b-2 border-blue-900 border-e font-12"><?php echo T_("Month"); ?></th>
        <th class="border-solid border-b-2 border-blue-900 border-e"></th>
        <th class="border-solid border-b-2 border-blue-900 font-12 border-e-2"><?php echo T_("Rial"); ?></th>
        <th class="border-solid border-b-2 border-blue-900 font-12 "><?php echo T_("Rial"); ?></th>
      </tr>
    </thead>
    <tbody class="leading-10">
  <?php foreach ($one_page as $key => $value) {?>
        <tr data-index="<?php echo ($key + 1) ?>" class="border-solid border-b border-blue-100">
        <?php if(a($value, 'type') === 'break_message') {?>
          <?php if(a($value, 'mode') === 'end_of_page' || a($value, 'mode') === 'start_new_page') {?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="txtB fs14 text-blue-900 txtRa"><?php echo a($value, 'message') ?></td>
            <td></td>
            <td class="border-solid border-e-2 border-purple-700 border-solid border-double border-4 border-eight-blue-500" data-copy='<?php echo a($value, 'sum_debtor_on_page'); ?>' class="ltr txtR fc-green"><code><?php echo \dash\fit::number(a($value, 'sum_debtor_on_page'), true, 'en') ?></code></td>
            <td data-copy='<?php echo a($value, 'sum_creditor_on_page'); ?>' class="ltr txtR fc-red border-solid border-double border-4 border-eight-blue-500"><code><?php echo \dash\fit::number(a($value, 'sum_creditor_on_page'), true, 'en') ?></code></td>
          <?php }else{ ?>
            <td class="border-solid border-e border-blue-900"></td>
            <td class="border-solid border-e border-blue-900"></td>
            <td class="border-solid border-e border-blue-900"></td>
            <td class="border-solid border-e border-blue-900"></td>
            <td class="border-solid border-e border-blue-900 txtB fs14 text-center fc-pink"><?php echo a($value, 'message') ?></td>
            <td class="border-solid border-e border-blue-900"></td>
            <td class="border-solid border-e-2 border-purple-700"></td>
            <td></td>
          <?php } //endif ?>

        <?php }else{ ?>
          <td class="border-solid border-e border-blue-900 text-center"><?php echo \dash\fit::number(a($value, 'myNumber')); ?></td>
          <td class="border-solid border-e border-blue-900 text-center"><?php if(isset($value['show_date'])) { echo \dash\utility\jdate::date("j", strtotime($value['show_date'])); } ?></td>
          <td class="border-solid border-e border-blue-900 text-center"><?php if(isset($value['show_date'])) { echo \dash\utility\jdate::date("n", strtotime($value['show_date'])); } ?></td>
          <td class="border-solid border-e border-blue-900"></td>
          <?php if(a($value, 'mode') === 'debtor') {?>
            <td class="border-solid border-e border-blue-900 pLa5"><?php echo a($value, 'total_title') ?></td>
            <td class="border-solid border-e border-blue-900"></td>
            <td class="border-solid border-e-2 border-purple-700" data-copy='<?php echo a($value, 'show_value'); ?>' class="ltr txtR fc-green"><code><?php echo \dash\fit::number(a($value, 'show_value'), true, 'en') ?></code></td>
            <td class=""></td>
          <?php }elseif(a($value, 'mode') === 'creditor') {?>
            <td class="border-solid border-e border-blue-900 txtRa pRa5"><?php echo a($value, 'total_title') ?></td>
            <td class="border-solid border-e border-blue-900"></td>
            <td class="border-solid border-e-2 border-purple-700"></td>
            <td data-copy='<?php echo a($value, 'show_value'); ?>' class="ltr txtR fc-red"><code><?php echo \dash\fit::number(a($value, 'show_value'), true, 'en') ?></code></td>
          <?php } //endif ?>
        <?php } //endif ?>
        </tr>
      <?php } //endif ?>
    </tbody>
  </table>
 </div>
<?php } //endfor ?>

<?php require_once(root. '/content_a/accounting/report/journal_cover.php'); ?>
<?php } //endif ?>