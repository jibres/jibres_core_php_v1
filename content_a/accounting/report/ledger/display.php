<?php require_once(root. '/content_a/accounting/report/wow_number.php'); ?>
<?php require_once(root. '/content_a/accounting/filter_only_year.php'); ?>
<?php if(!\dash\data::reportDetail()) {?>
  <div class="msg"><?php echo T_("No detail was founded") ?></div>
<?php }else{ ?>
  <?php foreach (\dash\data::reportPerPage() as $pageNumber => $one_page) { ?>

<style type="text/css">.page-break{page-break-after:always}</style>
  <div class="printArea" data-size='A4'>
    <div class="msg f align-center font-16">
      <div class="c5"><span><?php echo \dash\fit::number(a($one_page, 1, 'total_code')); ?></span> <span><?php echo a($one_page, 1, 'total_title'); ?></span></div>
      <div class="c2 text-center"><h2 class="txtB"><?php echo T_("Ledger"); ?></h2></div>
      <div class="c5 text-center"><span class="inline-block w-16 h-16 rounded-full bg-gray-200 font-22"><?php echo \dash\fit::number($pageNumber + 1); ?></span></div>
    </div>
    <table class="table-fixed border-collapse w-full border-solid border-double border-4 border-eight-blue-500">
    <thead class="text-center font-20">
      <tr>
        <th class="w-8 h-32 font-10 border-solid border-b-2 border-e border-gray-400" rowspan="2"><span class="transform rotate-90 inline-block whitespace-nowrap translate-x-3" style="--tw-rotate: 270deg;"><?php echo T_("Ledger") ?></span></th>
        <th class="w-16 font-14 border-solid border-b border-e border-gray-400 bg-gray-200" colspan="2"><?php echo T_("Date") ?></th>

        <th class="border-solid border-b-2 border-e border-gray-400" rowspan="2"><?php echo T_("Explanation") ?></th>
        <th class="border-solid border-b border-e border-gray-700" colspan="14" style="width:140px;"><?php echo T_("Debtor") ?></th>
        <th class="border-solid border-b border-e border-gray-700" colspan="14" style="width:140px;"><?php echo T_("Creditor") ?></th>
        <th class="w-8 h-32 font-10 border-solid border-b-2 border-e border-gray-400" rowspan="2"><span class="transform rotate-90 inline-block whitespace-nowrap translate-x-3" style="--tw-rotate: 270deg;"><?php echo T_("Diagnosis") ?></span></th>
        <th class="border-solid border-b border-gray-700" colspan="14" style="width:140px;"><?php echo T_("Remain") ?></th>
      </tr>
      <tr>
        <th class="border-solid border-b-2 border-gray-400 border-e font-10 bg-gray-200"><?php echo T_("Day"); ?></th>
        <th class="border-solid border-b-2 border-gray-400 border-e font-10 bg-gray-200"><?php echo T_("Month"); ?></th>
        <th class="border-solid border-b-2 border-gray-400 font-12 border-e" colspan="14"><?php echo T_("Rial"); ?></th>
        <th class="border-solid border-b-2 border-gray-400 font-12 border-e" colspan="14"><?php echo T_("Rial"); ?></th>
        <th class="border-solid border-b-2 border-gray-400 font-12 " colspan="14"><?php echo T_("Rial"); ?></th>
      </tr>
    </thead>
    <tbody class="leading-10 font-11">
  <?php foreach ($one_page as $key => $value) {?>
        <tr data-index="<?php echo ($key + 1) ?>" class="border-solid border-b border-blue-100">
        <?php if(a($value, 'type') === 'break_message') {?>
          <?php if(a($value, 'mode') === 'end_of_page' || a($value, 'mode') === 'start_new_page') {?>
          <?php if(a($value, 'mode') === 'end_of_page') { $borderPosClass = 'border-t-4';} else { $borderPosClass = 'border-b-4';} ?>
            <td class="border-solid <?php echo $borderPosClass; ?> border-e border-gray-400"></td>
            <td class="border-solid <?php echo $borderPosClass; ?> border-e border-gray-400 bg-gray-200"></td>
            <td class="border-solid <?php echo $borderPosClass; ?> border-e border-gray-400 bg-gray-200"></td>

            <td class="border-solid <?php echo $borderPosClass; ?> border-e border-gray-400 text-blue-900 txtRa  pRa10 font-black" style="line-height:70px;"><?php echo a($value, 'message') ?></td>
            <?php wow_number(a($value, 'sum_debtor_on_page'), $borderPosClass ) ?>
            <?php wow_number(a($value, 'sum_creditor_on_page'), $borderPosClass) ?>
            <td class="border-solid <?php echo $borderPosClass; ?> border-e border-gray-400"></td>
            <?php wow_number(a($value, 'sum_remain_on_page'), $borderPosClass) ?>
          <?php }else{ ?>
            <td class="border-solid border-e border-gray-400"></td>
            <td class="border-solid border-e border-gray-400 bg-gray-200"></td>
            <td class="border-solid border-e border-gray-400 bg-gray-200"></td>
            <td class="border-solid border-e border-gray-400 text-center fc-pink font-black txtRa"><?php echo a($value, 'message') ?></td>
            <?php wow_number(a($value, 'sum_debtor_on_page')) ?>
            <?php wow_number(a($value, 'sum_creditor_on_page')) ?>
            <td class="border-solid border-e border-gray-400"></td>
            <?php wow_number(a($value, 'sum_remain_on_page')) ?>
          <?php } //endif ?>
        <?php }else{ ?>
          <td class="border-solid border-e border-gray-400 text-center"><?php echo \dash\fit::number(a($value, 'myNumber')); ?></td>
          <td class="border-solid border-e border-gray-400 text-center bg-gray-200"><?php if(isset($value['show_date'])) { echo \dash\utility\jdate::date("j", strtotime($value['show_date'])); } ?></td>
          <td class="border-solid border-e border-gray-400 text-center bg-gray-200"><?php if(isset($value['show_date'])) { echo \dash\utility\jdate::date("n", strtotime($value['show_date'])); } ?></td>
            <td class="border-solid border-e border-gray-400 pLa10"><?php echo a($value, 'show_title') ?></td>
          <?php if(a($value, 'mode') === 'debtor') {?>
            <?php echo  wow_number(a($value, 'show_value')); ?>
            <?php echo  wow_number(null); ?>

          <?php }elseif(a($value, 'mode') === 'creditor') {?>

            <?php echo  wow_number(null); ?>
            <?php echo  wow_number(a($value, 'show_value')); ?>
          <?php } //endif ?>
            <td class="border-solid border-e border-gray-400 text-center"><?php echo a($value, 'detect_title');  ?></td>
            <?php echo  wow_number(abs(a($value, 'remain_value')), null, true); ?>
        <?php } //endif ?>
        </tr>
      <?php } //endif ?>
    </tbody>
  </table>
  <div class="msg mT10 f align-center">
    <div class="cauto pRa10"><?php echo T_("Ledger"); ?></div>
    <div class="cauto pRa10"><?php echo \lib\store::title(); ?></div>
    <div class="c pRa10"><?php echo a(\dash\data::currentYearDetail(), 'title'); ?></div>
    <div class="c"><?php echo T_('National ID') ?> <?php echo \dash\fit::text(\lib\store::detail('companynationalid')); ?></div>
    <div class="cauto os "><?php echo T_("Page :page from :total", ['page' => \dash\fit::number($pageNumber + 1), 'total' => \dash\fit::number(count(\dash\data::reportPerPage())) ]); ?></div>
  </div>
 </div>
<?php } //endfor ?>

<?php require_once(root. '/content_a/accounting/report/journal_cover.php'); ?>
<?php } //endif ?>
