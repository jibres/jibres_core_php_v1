<?php if(\dash\data::editMode() && \dash\data::docDetail()) {?>
  <form method="post">
    <input type="hidden" name="sortable" value="sortable">
  <div class="box">
    <div class="pad2">
       <table class="tbl1 v6 mB0">
         <thead>
           <tr class="font-12">
             <th class="collapsing"></th>
             <th><?php echo T_("Assistant"); ?> - <?php echo T_("Document Detail") ?></th>
             <th><?php echo T_("Explanation"); ?></th>
             <th class="collapsing"><?php echo T_("Debtor") ?></th>
             <th class="collapsing"><?php echo T_("Creditor") ?></th>
             <th class="collapsing"></th>
           </tr>
         </thead>
         <tbody class="sortable" data-sortable>
           <?php foreach (\dash\data::docDetail() as $key => $value) {?>
            <tr title="<?php echo ($key + 1); ?>">
              <td>
                <i data-handle class="sf-sort"></i>
                <input type="hidden" class="hide" name="sort[]" value="<?php echo \dash\get::index($value, 'id'); ?>">
              </div>
              <td>
                <div class="font-12">
                  <a href="<?php echo \dash\url::this(). '/coding?view='. \dash\get::index($value, 'assistant_id') ?>"><code><?php echo \dash\get::index($value, 'assistant_code'); ?></code></a>
                  <span class="compact"><?php echo \dash\get::index($value, 'assistant_title'); ?></span>
                </div>
                <div class="font-11 pLa10"><?php echo \dash\get::index($value, 'details_title'); ?></div>
              </td>


              <td><?php echo \dash\get::index($value, 'desc') ?></td>
              <td class="fc-red"><?php echo \dash\fit::number_decimal(\dash\get::index($value, 'debtor')) ?></td>
              <td class="fc-green"><?php echo \dash\fit::number_decimal(\dash\get::index($value, 'creditor')) ?></td>
              <td class="">
                <a class="btn link mRa5" href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'). '&did='. \dash\get::index($value, 'id') ?>"><?php echo T_("Edit") ?></a>
                <sapn data-confirm data-data='{"remove":"removedetail", "docdetailid" : "<?php echo \dash\get::index($value, 'id') ?>"}'><i class="sf-trash fc-red fs12"></i></sapn>
              </td>
            </tr>
           <?php } //endfor ?>
         </tbody>

       </table>
    </div>
    <footer>
      <div class="f">
        <div class="cauto"><?php echo T_("Total"). ' '. T_("Debtor"); ?> <span class="txtB"><?php echo \dash\fit::number(\dash\data::summary_debtor()); ?></span></div>
        <div class="c"></div>
        <div class="cauto"><?php echo T_("Total"). ' '.T_("Creditor"); ?> <span class="txtB"><?php echo \dash\fit::number(\dash\data::summary_creditor()); ?></span></div>
      </div>
    </footer>
  </div>
  </form>


  <?php if( \dash\data::summary_debtor() && \dash\data::summary_creditor() && floatval(\dash\data::summary_debtor()) === floatval(\dash\data::summary_creditor())) {?>
    <div class="msg success txtB txtC fs14"><?php echo T_("Document balance") ?> <span class="fs08"><?php echo T_("Status"). ' '. T_(\dash\data::dataRow_status()); ?></span></div>
  <?php }else{ ?>
    <div class="msg danger txtB txtC fs14"><?php echo T_("Accounting document is not balance!") ?> <span class="fs08"><?php echo T_("Status"). ' '. T_(\dash\data::dataRow_status()); ?></span></div>
  <?php }//endif ?>

<?php } //endif ?>
