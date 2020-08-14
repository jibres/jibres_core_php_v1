<?php if(\dash\data::editMode() && \dash\data::docDetail()) {?>
  <?php if( \dash\data::summary_debtor() && \dash\data::summary_creditor() && floatval(\dash\data::summary_debtor()) === floatval(\dash\data::summary_creditor())) {?>
    <div class="msg success txtB txtC fs14"><?php echo T_("Document balance") ?></div>
  <?php }else{ ?>
    <div class="msg danger txtB txtC fs14"><?php echo T_("Accounting document is not balance!") ?></div>
  <?php }//endif ?>
  <div class="box">
    <div class="body">
       <table class="tbl1 v4">
         <thead>
           <tr>
             <th class="collapsing"></th>
             <th><?php echo T_("Assistant") ?></th>
             <th><?php echo T_("Detail") ?></th>
             <th><?php echo T_("Description") ?></th>
             <th><?php echo T_("Debtor") ?></th>
             <th><?php echo T_("Creditor") ?></th>
             <th class="collapsing"></th>
           </tr>
         </thead>
         <tbody>
           <?php foreach (\dash\data::docDetail() as $key => $value) {?>
            <tr>
              <td class="collapsing"><?php echo \dash\fit::number($key + 1); ?></td>
              <td><a href="<?php echo \dash\url::this(). '/coding?view='. \dash\get::index($value, 'assistant_id') ?>"><?php echo \dash\get::index($value, 'assistant_title') . ' - '. \dash\fit::text(\dash\get::index($value, 'assistant_code')) ?></a></td>
              <td><a href="<?php echo \dash\url::this(). '/coding?view='. \dash\get::index($value, 'details_id') ?>"><?php echo \dash\get::index($value, 'details_title') . ' - '. \dash\fit::text(\dash\get::index($value, 'details_code')) ?></a></td>
              <td><?php echo \dash\get::index($value, 'desc') ?></td>
              <td><?php echo \dash\fit::number_decimal(\dash\get::index($value, 'debtor')) ?></td>
              <td><?php echo \dash\fit::number_decimal(\dash\get::index($value, 'creditor')) ?></td>
              <td class="collapsing">
                <a class="btn link mRa20" href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'). '&did='. \dash\get::index($value, 'id') ?>"><?php echo T_("Edit") ?></a>
                <sapn data-confirm data-data='{"remove":"removedetail", "docdetailid" : "<?php echo \dash\get::index($value, 'id') ?>"}'><i class="sf-trash fc-red fs12"></i></sapn>
              </td>
            </tr>
           <?php } //endfor ?>
         </tbody>

       </table>
    </div>
    <footer>
      <div class="f">
        <div class="cauto"><?php echo T_("Debtor") ?> <span class="txtB"><?php echo \dash\fit::number(\dash\data::summary_debtor()); ?></span></div>
        <div class="c"></div>
        <div class="cauto"><?php echo T_("Creditor") ?> <span class="txtB"><?php echo \dash\fit::number(\dash\data::summary_creditor()); ?></span></div>
      </div>
    </footer>
  </div>
<?php } //endif ?>

