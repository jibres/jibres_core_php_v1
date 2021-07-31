<?php $locDelMode = (\dash\data::dataRow_status() === 'lock' || \dash\data::dataRow_status() === 'deleted') ?>
<?php if(\dash\data::editMode() && \dash\data::docDetail()) {?>

  <?php if(\dash\data::dataRow_status() === 'temp' || \dash\data::dataRow_status() === 'lock') {?>
    <form method="post" id="formlock1">
      <input type="hidden" name="newlockstatus" value="<?php if(\dash\data::dataRow_status() === 'temp') { echo 'lock'; }elseif(\dash\data::dataRow_status() === 'lock'){ echo 'temp';} ?>">
    </form>
  <?php } //endif ?>
  <form method="post" class="box">
    <input type="hidden" name="sortable" value="sortable">
    <div class="pad2">
      <div class="tblBox">

       <table class="tbl1 v6 repeatHead minimal mB0">
         <thead>
           <tr class="font-12">

              <th class="collapsing"></th>

             <th><?php echo T_("Assistant"); ?> - <?php echo T_("Document Detail") ?></th>
             <?php if(!\dash\data::descEmpty()) {?>
               <th class="collapsing"><?php echo T_("Explanation"); ?></th>
             <?php } //endif ?>
             <th class="collapsing txtR"><?php echo T_("Debtor") ?></th>
             <th class="collapsing txtR"><?php echo T_("Creditor") ?></th>
             <?php if($locDelMode) {}else{?>
             <th class="collapsing p0"></th>
             <?php } //endif ?>
           </tr>
         </thead>
         <tbody class="sortable" data-sortable>
           <?php foreach (\dash\data::docDetail() as $key => $value) {?>
            <tr title="<?php echo ($key + 1); ?>" <?php if(\dash\request::get('did') == a($value, 'id')) { echo " class='negative' ";} ?>>
              <td class="collapsing">
             <?php if($locDelMode) {?>
                <span><?php echo \dash\fit::number($key + 1) ?></span>
             <?php }else{?>
                <i data-handle class="sf-sort p0"></i>
                <input type="hidden" class="hide" name="sort[]" value="<?php echo a($value, 'id'); ?>">
                <?php }// endif ?>
              </td>
              <td>
                <div class="font-12">
                  <a href="<?php echo \dash\url::this(). '/coding?view='. a($value, 'assistant_id') ?>"><code><?php echo a($value, 'assistant_code'); ?></code></a>
                  <a class="link" target="_blank" href="<?php echo \dash\url::this(). '/turnover?contain='. a($value, 'assistant_id') ?>"><i class="sf-retweet" title="<?php echo T_("Turnover") ?>"></i> </a>
                  <span class="compact"> <?php echo a($value, 'total_title') . ' - '. a($value, 'assistant_title'); ?> </span>
                </div>
                <div class="font-11 pLa10"><?php echo a($value, 'details_title'); ?>

                </div>
              </td>

               <?php if(!\dash\data::descEmpty()) {?>
                  <td class="collapsing"><?php echo a($value, 'desc') ?></td>
               <?php } //endif ?>
              <td data-copy='<?php echo a($value, 'debtor'); ?>' class="ltr txtR fc-green"><code class="txtB"><?php echo \dash\fit::number_decimal(a($value, 'debtor'), 'en') ?></code></td>
              <td data-copy='<?php echo a($value, 'creditor'); ?>' class="ltr txtR fc-red"><code class="txtB"><?php echo \dash\fit::number_decimal(a($value, 'creditor'), 'en') ?></code></td>
              <?php if($locDelMode) {}else{?>
              <td class="p0 txtRa">
                <?php if(\dash\request::get('did') == a($value, 'id')) {?>
                  <span class="fc-mute"><i><?php echo T_("Editing") ?>...</i></span>
                <?php }else{ ?>
                <a class="btn link mRa5" href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'). '&did='. a($value, 'id') ?>"><?php echo T_("Edit") ?></a>
                <sapn data-confirm data-data='{"remove":"removedetail", "docdetailid" : "<?php echo a($value, 'id') ?>"}'><i class="sf-trash fc-red fs12"></i></sapn>
              <?php } //endif ?>
              </td>
              <?php } //endif ?>
            </tr>
           <?php } //endfor ?>
         </tbody>
         <tfoot class="dontRepeatFoot">
           <tr>
                <td class="collapsing"></td>
             <?php if(!\dash\data::descEmpty()) {?>
              <td></td>
            <?php } //endif ?>

              <td><?php echo T_("Total"); ?> <?php if(\dash\data::currentCurrency()) { echo ' ('. \dash\data::currentCurrency(). ') ';} ?></td>
             <td data-copy='<?php echo \dash\data::summary_debtor() ?>' class="ltr txtR"><code class="txtB"><?php echo \dash\fit::number_decimal(\dash\data::summary_debtor(), 'en'); ?></code></td>
             <td data-copy='<?php echo \dash\data::summary_creditor() ?>' class="ltr txtR"><code class="txtB"><?php echo \dash\fit::number_decimal(\dash\data::summary_creditor(), 'en'); ?></code></td>
              <?php if($locDelMode) {}else{?>
                <td class="p0 txtRa txtB">
                   <?php $remain_doc = \dash\data::summary_debtor() - \dash\data::summary_creditor(); if($remain_doc != 0) {?>
                  <a class="fc-white  block" href="<?php $myType = 'debtor'; if($remain_doc > 0){ $myType = 'creditor';} echo \dash\url::current(). '?id='. \dash\request::get('id'). '&value='. abs($remain_doc). '&type='. $myType;  ?>"><span class="compact mRa10"><?php echo T_("Diff"); ?></span><span class="compact ltr"><?php echo  \dash\fit::number_decimal($remain_doc, 'en'); ?></span></a>
                <?php } //endif ?>
                </td>
              <?php } //endif ?>
           </tr>
         </tfoot>

       </table>
      </div>
    </div>
    <footer class="hide">
      <div class="f">
        <div class="cauto"><?php echo \dash\data::deptorICON(); ?><?php echo T_("Total"). ' '. T_("Debtor"); ?> <span class="txtB fc-green"><?php echo \dash\fit::number_decimal(\dash\data::summary_debtor()); ?> </span></div>
        <div class="c txtC"><?php echo \dash\data::equalICON(); ?></div>
        <div class="cauto"><?php echo T_("Total"). ' '.T_("Creditor"); ?> <span class="txtB fc-red"><?php echo \dash\fit::number_decimal(\dash\data::summary_creditor()); ?></span> <?php echo \dash\data::creditorICON(); ?></div>
      </div>
    </footer>
  </form>


<?php if(!\dash\data::printAllMode()) {?>
  <?php if( \dash\data::summary_debtor() && \dash\data::summary_creditor() && floatval(\dash\data::summary_debtor()) === floatval(\dash\data::summary_creditor())) {?>
    <div class="msg p0 mT20 success txtB txtC fs14"><?php echo T_("Document balance") ?> <span class="fs08"><?php echo T_("Status"). ' '. \dash\data::dataRow_tstatus(); ?></span></div>
  <?php }else{ ?>
    <div class="msg p0 mT20 danger txtB txtC fs14"><?php echo T_("Accounting document is not balance!") ?> <span class="fs08"><?php echo T_("Status"). ' '. \dash\data::dataRow_tstatus(); ?></span></div>
  <?php }//endif ?>
  <?php }//endif ?>

<?php } //endif ?>

<?php if(\dash\data::editMode()) {?>
<?php if(!\dash\data::printAllMode()) {?>
<?php require_once('display-gallery.php'); ?>
<?php } //endif ?>
<?php } //endif ?>