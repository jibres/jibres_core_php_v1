

<?php require_once(root. '/content_a/accounting/filter_only_year.php'); ?>
<?php if(!\dash\data::reportDetail()) {?>
  <div class="msg"><?php echo T_("No detail was founded") ?></div>
<?php }else{ ?>
  <?php foreach (\dash\data::reportDetail() as $key => $one_total) {?>

<style type="text/css">.page-break{page-break-after:always}</style>
  <div class="printArea" data-size='A4'>
    <div class="msg f align-center txtC font-16">
      <div class="c3"></div>
      <div class="c6"><h2 class="txtB"><?php echo T_("Ledger"); ?></h2></div>
      <div class="c3"><span class="inline-block w-16 h-16 rounded-full bg-gray-200 font-22"><?php echo \dash\fit::number($key + 1); ?></span></div>
    </div>
    <table class="table-fixed border-collapse w-full border-solid border-double border-4 border-eight-blue-500">
    <thead class="text-center font-20">
      <tr>
        <th class="w-10 h-32 font-10 border-solid border-b-2 border-e border-gray-400" rowspan="2"><span class="transform rotate-90 inline-block whitespace-nowrap translate-x-5" style="--tw-rotate: 270deg;"><?php echo T_("General Journal Number") ?></span></th>
        <th class="w-20 font-16 border-solid border-b border-e border-gray-400 bg-gray-200" colspan="2"><?php echo T_("Date") ?></th>
        <th class="border-solid border-b-2 border-e border-gray-400" rowspan="2"><?php echo T_("Explanation") ?></th>

        <th class="w-1/5 border-solid border-b border-e-2 border-gray-400"><?php echo T_("Debtor") ?></th>
        <th class="w-1/5 border-solid border-b border-gray-400"><?php echo T_("Creditor") ?></th>
        <th class="w-20 h-32 font-10 border-solid border-b-2 border-e-2 border-blue-900" rowspan="2"><span class="transform rotate-90 inline-block whitespace-nowrap translate-x-5" style="--tw-rotate: 270deg;"><?php echo T_("Detect") ?></span></th>

        <th class="w-1/5 border-solid border-b border-gray-400"><?php echo T_("Remain") ?></th>
      </tr>
      <tr>
        <th class="border-solid border-b-2 border-gray-400 border-e font-12 bg-gray-200"><?php echo T_("Day"); ?></th>
        <th class="border-solid border-b-2 border-gray-400 border-e font-12 bg-gray-200"><?php echo T_("Month"); ?></th>

        <th class="border-solid border-b-2 border-gray-400 font-12 border-e-2"><?php echo T_("Rial"); ?></th>
        <th class="border-solid border-b-2 border-gray-400 font-12 "><?php echo T_("Rial"); ?></th>
        <th class="border-solid border-b-2 border-gray-400 font-12 "><?php echo T_("Rial"); ?></th>
      </tr>
    </thead>
    <tbody class="leading-10 font-11">
  <?php foreach ($one_total as $key => $value) {?>
        <tr data-index="<?php echo ($key + 1) ?>" class="border-solid border-b border-blue-100">
          <td class="border-solid border-e border-gray-400 text-center"><?php echo \dash\fit::number(a($value, 'myNumber')); ?></td>
          <td class="border-solid border-e border-gray-400 text-center bg-gray-200"><?php if(isset($value['show_date'])) { echo \dash\utility\jdate::date("j", strtotime($value['show_date'])); } ?></td>
          <td class="border-solid border-e border-gray-400 text-center bg-gray-200"><?php if(isset($value['show_date'])) { echo \dash\utility\jdate::date("n", strtotime($value['show_date'])); } ?></td>
            <td class="border-solid border-e border-gray-400 pLa10"><?php echo a($value, 'show_title') ?></td>

          <?php if(a($value, 'mode') === 'debtor') {?>
            <td class="border-solid border-e-2 border-gray-400 font-15" data-copy='<?php echo a($value, 'show_value'); ?>' class="ltr txtR fc-green"><code class="font-bold"><?php echo \dash\fit::number(a($value, 'show_value'), true, 'en') ?></code></td>
            <td class="border-solid border-e-2 border-gray-400 font-15"></td>
          <?php }elseif(a($value, 'mode') === 'creditor') {?>
            <td class="border-solid border-e-2 border-gray-400"></td>
            <td data-copy='<?php echo a($value, 'show_value'); ?>' class="border-solid border-e-2 border-gray-400 font-15 ltr txtR fc-red font-15"><code class="font-bold"><?php echo \dash\fit::number(a($value, 'show_value'), true, 'en') ?></code></td>
          <?php } //endif ?>
          <th class="border-solid border-e-2 border-gray-400 font-15"><?php echo a($value, 'detect_title') ?></th>
            <td data-copy='<?php echo a($value, 'remain_value'); ?>' class="border-solid border-e-2 border-gray-400 font-15 ltr txtR font-15"><code class="font-bold"><?php echo \dash\fit::number(a($value, 'remain_value'), true, 'en') ?></code></td>
        </tr>
      <?php } //endif ?>
    </tbody>
  </table>
  <div class="msg mT10 f align-center">
    <div class="cauto pRa10"><?php echo T_("Ledger"); ?></div>
    <div class="cauto pRa10"><?php echo \lib\store::title(); ?></div>
    <div class="c pRa10"><?php echo a(\dash\data::currentYearDetail(), 'title'); ?></div>
    <div class="c"><?php echo T_('National ID') ?> <?php echo \dash\fit::text(\lib\store::detail('companynationalid')); ?></div>
    <div class="cauto os txtRa"><?php echo T_("Page :page from :total", ['page' => \dash\fit::number($key + 1), 'total' => \dash\fit::number(count(\dash\data::reportDetail())) ]); ?></div>
  </div>
 </div>
<?php } //endfor ?>

<?php require_once(root. '/content_a/accounting/report/journal_cover.php'); ?>
<?php } //endif ?>

