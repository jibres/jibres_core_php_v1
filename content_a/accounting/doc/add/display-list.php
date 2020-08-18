<?php if(\dash\data::editMode() && \dash\data::docDetail()) {?>

  <?php if(\dash\data::dataRow_status() === 'temp' || \dash\data::dataRow_status() === 'lock') {?>
    <form method="post" id="formlock1">
      <input type="hidden" name="newlockstatus" value="<?php if(\dash\data::dataRow_status() === 'temp') { echo 'lock'; }elseif(\dash\data::dataRow_status() === 'lock'){ echo 'temp';} ?>">
    </form>
  <?php } //endif ?>
  <form method="post" class="box">
    <input type="hidden" name="sortable" value="sortable">
    <div class="pad2">
       <table class="tbl1 v6 minimal mB0">
         <thead>
           <tr class="font-12">
             <?php if(\dash\data::dataRow_status() === 'lock') {}else{?>
              <th class="collapsing"></th>
             <?php } //endif ?>
             <th><?php echo T_("Assistant"); ?> - <?php echo T_("Document Detail") ?></th>
             <th class="collapsing"><?php echo T_("Explanation"); ?></th>
             <th class="collapsing txtR"><?php echo T_("Debtor") ?></th>
             <th class="collapsing txtR"><?php echo T_("Creditor") ?></th>
             <?php if(\dash\data::dataRow_status() === 'lock') {}else{?>
             <th class="collapsing p0"></th>
             <?php } //endif ?>
           </tr>
         </thead>
         <tbody class="sortable" data-sortable>
           <?php foreach (\dash\data::docDetail() as $key => $value) {?>
            <tr title="<?php echo ($key + 1); ?>">
             <?php if(\dash\data::dataRow_status() === 'lock') {}else{?>
              <td>
                <i data-handle class="sf-sort p0"></i>
                <input type="hidden" class="hide" name="sort[]" value="<?php echo \dash\get::index($value, 'id'); ?>">
              </td>
                <?php }// endif ?>
              <td>
                <div class="font-12">
                  <a href="<?php echo \dash\url::this(). '/coding?view='. \dash\get::index($value, 'assistant_id') ?>"><code><?php echo \dash\get::index($value, 'assistant_code'); ?></code></a>
                  <span class="compact"><?php echo \dash\get::index($value, 'assistant_title'); ?></span>
                </div>
                <div class="font-11 pLa10"><?php echo \dash\get::index($value, 'details_title'); ?></div>
              </td>


              <td class="collapsing"><?php echo \dash\get::index($value, 'desc') ?></td>
              <td class="ltr txtR fc-red"><code class="txtB"><?php echo \dash\fit::number_decimal(\dash\get::index($value, 'debtor'), 'en') ?></code></td>
              <td class="ltr txtR fc-green"><code class="txtB"><?php echo \dash\fit::number_decimal(\dash\get::index($value, 'creditor'), 'en') ?></code></td>
              <?php if(\dash\data::dataRow_status() === 'lock') {}else{?>
              <td class="p0">
                <a class="btn link mRa5" href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'). '&did='. \dash\get::index($value, 'id') ?>"><?php echo T_("Edit") ?></a>
                <sapn data-confirm data-data='{"remove":"removedetail", "docdetailid" : "<?php echo \dash\get::index($value, 'id') ?>"}'><i class="sf-trash fc-red fs12"></i></sapn>
              </td>
              <?php } //endif ?>
            </tr>
           <?php } //endfor ?>
         </tbody>
         <tfoot class="">

           <tr>
              <?php if(\dash\data::dataRow_status() === 'lock') {}else{?>
                <td></td>
              <?php } //endif ?>
              <td><?php echo "Total"; ?></td>
              <td></td>
             <td class="ltr txtR"><code class="txtB"><?php echo \dash\fit::number_decimal(\dash\data::summary_debtor(), 'en'); ?></code></td>
             <td class="ltr txtR"><code class="txtB"><?php echo \dash\fit::number_decimal(\dash\data::summary_creditor(), 'en'); ?></code></td>
              <?php if(\dash\data::dataRow_status() === 'lock') {}else{?>
                <td></td>
              <?php } //endif ?>
           </tr>
         </tfoot>

       </table>
    </div>
    <footer class="hide">
      <div class="f">
        <div class="cauto"><?php echo \dash\data::deptorICON(); ?><?php echo T_("Total"). ' '. T_("Debtor"); ?> <span class="txtB fc-red"><?php echo \dash\fit::number_decimal(\dash\data::summary_debtor()); ?> </span></div>
        <div class="c txtC"><?php echo \dash\data::equalICON(); ?></div>
        <div class="cauto"><?php echo T_("Total"). ' '.T_("Creditor"); ?> <span class="txtB fc-green"><?php echo \dash\fit::number_decimal(\dash\data::summary_creditor()); ?></span> <?php echo \dash\data::creditorICON(); ?></div>
      </div>
    </footer>
  </form>


  <?php if( \dash\data::summary_debtor() && \dash\data::summary_creditor() && floatval(\dash\data::summary_debtor()) === floatval(\dash\data::summary_creditor())) {?>
    <div class="msg p0 mT20 success txtB txtC fs14"><?php echo T_("Document balance") ?> <span class="fs08"><?php echo T_("Status"). ' '. T_(\dash\data::dataRow_status()); ?></span></div>
  <?php }else{ ?>
    <div class="msg p0 mT20 danger txtB txtC fs14"><?php echo T_("Accounting document is not balance!") ?> <span class="fs08"><?php echo T_("Status"). ' '. T_(\dash\data::dataRow_status()); ?></span></div>
  <?php }//endif ?>

<?php } //endif ?>
