<?php if(\dash\data::editMode() && \dash\data::docDetail()) {?>

  <?php if(\dash\data::dataRow_status() === 'temp' || \dash\data::dataRow_status() === 'lock') {?>
    <form method="post" id="formlock1">
      <input type="hidden" name="newlockstatus" value="<?php if(\dash\data::dataRow_status() === 'temp') { echo 'lock'; }elseif(\dash\data::dataRow_status() === 'lock'){ echo 'temp';} ?>">
    </form>
  <?php } //endif ?>
  <form method="post" class="box">
    <input type="hidden" name="sortable" value="sortable">
    <div class="pad2">
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
             <?php if(\dash\data::dataRow_status() === 'lock') {}else{?>
             <th class="collapsing p0"></th>
             <?php } //endif ?>
           </tr>
         </thead>
         <tbody class="sortable" data-sortable>
           <?php foreach (\dash\data::docDetail() as $key => $value) {?>
            <tr title="<?php echo ($key + 1); ?>" <?php if(\dash\request::get('did') == \dash\get::index($value, 'id')) { echo " class='negative' ";} ?>>
              <td class="collapsing">
             <?php if(\dash\data::dataRow_status() === 'lock') {?>
                <span><?php echo \dash\fit::number($key + 1) ?></span>
             <?php }else{?>
                <i data-handle class="sf-sort p0"></i>
                <input type="hidden" class="hide" name="sort[]" value="<?php echo \dash\get::index($value, 'id'); ?>">
                <?php }// endif ?>
              </td>
              <td>
                <div class="font-12">
                  <a href="<?php echo \dash\url::this(). '/coding?view='. \dash\get::index($value, 'assistant_id') ?>"><code><?php echo \dash\get::index($value, 'assistant_code'); ?></code></a>
                  <span class="compact"><?php echo \dash\get::index($value, 'assistant_title'); ?></span>
                </div>
                <div class="font-11 pLa10"><?php echo \dash\get::index($value, 'details_title'); ?></div>
              </td>

               <?php if(!\dash\data::descEmpty()) {?>
                  <td class="collapsing"><?php echo \dash\get::index($value, 'desc') ?></td>
               <?php } //endif ?>
              <td class="ltr txtR fc-green"><code class="txtB"><?php echo \dash\fit::number_decimal(\dash\get::index($value, 'debtor'), 'en') ?></code></td>
              <td class="ltr txtR fc-red"><code class="txtB"><?php echo \dash\fit::number_decimal(\dash\get::index($value, 'creditor'), 'en') ?></code></td>
              <?php if(\dash\data::dataRow_status() === 'lock') {}else{?>
              <td class="p0 txtRa">
                <?php if(\dash\request::get('did') == \dash\get::index($value, 'id')) {?>
                  <span class="fc-mute"><i><?php echo T_("Editing") ?>...</i></span>
                <?php }else{ ?>
                <a class="btn link mRa5" href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'). '&did='. \dash\get::index($value, 'id') ?>"><?php echo T_("Edit") ?></a>
                <sapn data-confirm data-data='{"remove":"removedetail", "docdetailid" : "<?php echo \dash\get::index($value, 'id') ?>"}'><i class="sf-trash fc-red fs12"></i></sapn>
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
             <td class="ltr txtR"><code class="txtB"><?php echo \dash\fit::number_decimal(\dash\data::summary_debtor(), 'en'); ?></code></td>
             <td class="ltr txtR"><code class="txtB"><?php echo \dash\fit::number_decimal(\dash\data::summary_creditor(), 'en'); ?></code></td>
              <?php if(\dash\data::dataRow_status() === 'lock') {}else{?>
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
<form method="post" class="p0">
  <input type="hidden" name="uploaddoc" value="uploaddoc">
    <div class="box">
      <div class="pad1">
        <?php if(is_array(\dash\data::dataRow_gallery_array()) && count(\dash\data::dataRow_gallery_array()) > 10) {?>
          <div class="msg minimal mB0 warn2"><?php echo T_("Document gallery is full!"); ?></div>
        <?php }else{ ?>
          <div data-uploader data-ratio-free data-name='gallery' data-autoSend>
            <input type="file" id="file1">
            <label for="file1"><abbr><?php echo T_('Drag &amp; Drop your files or Browse'); ?></abbr> <small class="fc-mute block"><?php echo T_("Maximum file size"). ' '. \dash\data::maxUploadSize(); ?></small></label>

        <?php if(\dash\data::dataRow_gallery_array()) {?>
          <div class="previewList">
            <?php foreach (\dash\data::dataRow_gallery_array() as $key => $value) {?>
                <div class="fileItem" data-removeElement data-type='<?php echo \dash\get::index($value, 'type'); ?>'>
                  <?php if(\dash\get::index($value, 'type') === 'video') {?>
                    <video controls>
                      <source src="<?php echo \dash\get::index($value, 'path'); ?>" type="<?php echo \dash\get::index($value, 'mime'); ?>">
                    </video>
                  <?php }elseif(\dash\get::index($value, 'type') === 'image') {?>
                    <img src="<?php echo \dash\get::index($value, 'path'); ?>" alt="<?php echo \dash\get::index(\dash\data::dataRow(), 'title'); ?>">
                  <?php } else { ?>
                    <a target="_blank" class="btn xl" href="<?php echo \dash\get::index($value, 'path'); ?>" ><?php echo \dash\get::index($value, 'ext'); ?></a>
                  <?php } ?>
                  <div>
                    <div class="imageDel" data-ajaxify data-data='{"fileaction": "remove", "fileid" : "<?php echo \dash\get::index($value, 'id'); ?>"}'></div>
                  </div>
                </div>
            <?php } //endfor ?>
          </div>
        <?php } //endif ?>
          </div>
        <?php } //endif ?>
      </div>
    </div>
</form>

<?php } //endif ?>
<?php } //endif ?>
