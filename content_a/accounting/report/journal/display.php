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
        <th class="w-10 h-32 font-10 border-solid border-b-2 border-e border-gray-400" rowspan="2"><span class="transform rotate-90 inline-block whitespace-nowrap translate-x-5" style="--tw-rotate: 270deg;"><?php echo T_("General Journal Number") ?></span></th>
        <th class="w-20 font-16 border-solid border-b border-e border-gray-400 bg-gray-200" colspan="2"><?php echo T_("Date") ?></th>
        <th class="w-10 font-10 border-solid border-b-2 border-e border-gray-400" rowspan="2"><span class="transform rotate-90 block whitespace-nowrap -translate-y-6" style="--tw-rotate: 270deg;"><?php echo T_("Ledger Number") ?></span></th>
        <th class="border-solid border-b-2 border-e border-gray-400" rowspan="2"><?php echo T_("Explanation") ?></th>
        <th class="w-10 border-solid border-e border-gray-400"></th>
        <th class="w-1/5 border-solid border-b border-e-2 border-gray-400" colspan="14"><?php echo T_("Debtor") ?></th>
        <th class="w-1/5 border-solid border-b border-gray-400" colspan="14"><?php echo T_("Creditor") ?></th>
      </tr>
      <tr>
        <th class="border-solid border-b-2 border-gray-400 border-e font-12 bg-gray-200"><?php echo T_("Day"); ?></th>
        <th class="border-solid border-b-2 border-gray-400 border-e font-12 bg-gray-200"><?php echo T_("Month"); ?></th>
        <th class="border-solid border-b-2 border-gray-400 border-e"></th>
        <th class="border-solid border-b-2 border-gray-400 font-12 border-e-2" colspan="14"><?php echo T_("Rial"); ?></th>
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
            <td class="border-solid <?php echo $borderPosClass; ?> border-e border-gray-400"></td>
            <td class="border-solid <?php echo $borderPosClass; ?> border-e border-gray-400 text-blue-900 txtRa pRa10 font-black" style="line-height:70px;"><?php echo a($value, 'message') ?></td>
            <td class="border-solid <?php echo $borderPosClass; ?> border-e border-gray-400"></td>
            <?php wow_number(a($value, 'sum_debtor_on_page')) ?>
            <?php wow_number(a($value, 'sum_creditor_on_page')) ?>
            <?php if(false) {?>
              <td class="border-solid <?php echo $borderPosClass; ?> border-e-2 border-gray-400 font-15" style="line-height:70px;" data-copy='<?php echo a($value, 'sum_debtor_on_page'); ?>'><code class="ltr txtR fc-green font-bold"><?php echo \dash\fit::number(a($value, 'sum_debtor_on_page'), true, 'en') ?></code></td>
              <td class="border-solid <?php echo $borderPosClass; ?> border-e-2 border-gray-400 font-15" style="line-height:70px;" data-copy='<?php echo a($value, 'sum_creditor_on_page'); ?>'><code class="ltr txtR fc-red font-bold"><?php echo \dash\fit::number(a($value, 'sum_creditor_on_page'), true, 'en') ?></code></td>
            <?php }// endif ?>
          <?php }else{ ?>
            <td class="border-solid border-e border-gray-400"></td>
            <td class="border-solid border-e border-gray-400 bg-gray-200"></td>
            <td class="border-solid border-e border-gray-400 bg-gray-200"></td>
            <td class="border-solid border-e border-gray-400"></td>
            <td class="border-solid border-e border-gray-400 text-center fc-pink font-black"><?php echo a($value, 'message') ?></td>
            <td class="border-solid border-e border-gray-400" colspan="14"></td>
            <td class="border-solid border-e-2 border-gray-400" colspan="14"></td>
            <td></td>
          <?php } //endif ?>

        <?php }else{ ?>
          <td class="border-solid border-e border-gray-400 text-center"><?php echo \dash\fit::number(a($value, 'myNumber')); ?></td>
          <td class="border-solid border-e border-gray-400 text-center bg-gray-200"><?php if(isset($value['show_date'])) { echo \dash\utility\jdate::date("j", strtotime($value['show_date'])); } ?></td>
          <td class="border-solid border-e border-gray-400 text-center bg-gray-200"><?php if(isset($value['show_date'])) { echo \dash\utility\jdate::date("n", strtotime($value['show_date'])); } ?></td>
          <td class="border-solid border-e border-gray-400 text-center"><?php echo \dash\fit::number(a($value, 'total_code')); ?></td>
          <?php if(a($value, 'mode') === 'debtor') {?>
            <td class="border-solid border-e border-gray-400 pLa10"><?php echo a($value, 'total_title') ?></td>
            <td class="border-solid border-e border-gray-400"></td>
            <?php echo  wow_number(a($value, 'show_value')); ?>
            <?php echo  wow_number(null); ?>
            <?php if(false) {?>
            <td class="border-solid border-e-2 border-gray-400 font-15" data-copy='<?php echo a($value, 'show_value'); ?>' class="ltr txtR fc-green"><code class="font-bold"><?php echo \dash\fit::number(a($value, 'show_value'), true, 'en') ?></code></td>
            <?php } //endif ?>

          <?php }elseif(a($value, 'mode') === 'creditor') {?>
            <td class="border-solid border-e border-gray-400 txtRa pRa10"><?php echo a($value, 'total_title') ?></td>
            <td class="border-solid border-e border-gray-400"></td>
            <td class="border-solid border-e-2 border-gray-400"></td>
            <?php echo  wow_number(null); ?>
            <?php echo  wow_number(a($value, 'show_value')); ?>

            <?php if(false) {?>
              <td data-copy='<?php echo a($value, 'show_value'); ?>' class="ltr txtR fc-red font-15"><code class="font-bold"><?php echo \dash\fit::number(a($value, 'show_value'), true, 'en') ?></code></td>
            <?php } //endif ?>

          <?php } //endif ?>
        <?php } //endif ?>
        </tr>
      <?php } //endif ?>
    </tbody>
  </table>
  <div class="msg mT10 f align-center">
    <div class="cauto pRa10"><?php echo T_("General Journal"); ?></div>
    <div class="cauto pRa10"><?php echo \lib\store::title(); ?></div>
    <div class="c pRa10"><?php echo a(\dash\data::currentYearDetail(), 'title'); ?></div>
    <div class="c"><?php echo T_('National ID') ?> <?php echo \dash\fit::text(\lib\store::detail('companynationalid')); ?></div>
    <div class="cauto os txtRa"><?php echo T_("Page :page from :total", ['page' => \dash\fit::number($pageNumber), 'total' => \dash\fit::number(count(\dash\data::reportPerPage())) ]); ?></div>
  </div>
 </div>
<?php } //endfor ?>

<?php require_once(root. '/content_a/accounting/report/journal_cover.php'); ?>
<?php } //endif ?>




<?php
function wow_number($number)
{
  if($number === null)
  {
    $number = '--------------';
  }
  $number = str_replace(',', '', $number);
  $number_split = str_split($number);
  $number_split = array_reverse($number_split);
  if(count($number_split) < 14)
  {
    for ($i=1; $i <= 14 - count($number_split) ; $i++)
    {
      array_push($number_split, '-');
    }
  }

  $html = '';
  foreach ($number_split as $one_number)
  {
    $html .= '<td class="ltr txtR fc-red font-15">';
    if($one_number === '-')
    {
      $html .= '&nbsp;';
    }
    else
    {
      $html .= \dash\fit::number($one_number);
    }
    $html .= '</td>';

  }

  echo $html;

}
?>