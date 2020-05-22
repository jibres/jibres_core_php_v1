
<div class="cbox">
  <form method="post" enctype="multipart/form-data" autocomplete="off" action="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'); ?>">

    <?php \dash\utility\hive::html(); ?>

    <?php if(\dash\url::child() === 'add') {?>

    <label for="icontent"><?php echo T_("Please write your message"); ?> <small class="fc-red"><?php echo T_("Require"); ?> *</small></label>

    <?php }else{ ?>

    <label for="icontent"><?php echo T_("Description"); ?> <small class="fc-red"><?php echo T_("Require"); ?> *</small></label>

    <?php } //endif ?>

    <?php if(\dash\permission::check('supportTicketSignature')) {?>

      <textarea class="txt mB10" data-editor id='icontent' name="content"  maxlength='100000' ><?php echo \dash\user::detail('signature'); ?></textarea>

    <?php }else{ ?>

      <textarea class="txt mB10" id='icontent' name="content" placeholder='' maxlength='1000' rows="5"><?php echo \dash\data::dataRow_desc(); ?></textarea>

    <?php } //endif ?>

    <label for="file1"><?php echo T_("Attachment"); ?> <small class="fc-mute"><?php echo T_("Maximum file size"). ' '. \dash\data::maxUploadSize(); ?></small></label>

    <div class="box min-y120" data-uploader data-name='file'>
      <input type="file"  id="file1">
      <label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
    </div>

    <?php if(\dash\permission::check('supportTicketAnswer') && \dash\url::child() !== 'add') {?>

      <?php if(\dash\data::masterTicketDetail_user_id()) {?>

      <div class="check1 pLa5">
       <input type="checkbox" name="sendmessage" id="sendmessage" checked>
       <label for="sendmessage"><?php echo T_("Send notify about your answer to creator of ticket"); ?>
        <?php if(\dash\data::masterTicketDetail_mobile()) {?>

          <i title='<?php echo T_("Via sms to"). ' '. \dash\fit::mobile(\dash\data::masterTicketDetail_mobile()); ?>' class="sf-mobile fs14"></i>
        <?php } //endif ?>

        <?php if(\dash\data::masterTicketDetail_chatid()) {?>

          <i title='<?php echo T_("Via telegram"); ?>' class="sf-paper-plane fs12"></i>

        <?php } //endif ?>

       </label>
      </div>

      <?php } //endif ?>

    <?php } //endif ?>

    <?php if(\dash\url::child() === 'add') {?>

    <button class="btn primary block mT20"><?php echo T_("Submit a ticket"); ?></button>

    <?php }else{ ?>

    <?php if(\dash\permission::check('supportTicketAddNote')) {?>

      <div class="f">
        <div class="c9 s12">
          <button class="btn primary block mT20"><?php echo T_("Send new message"); ?></button>
        </div>
        <div class="c s12">
          <button class="btn secondary outline mLa5 block mT20" name="addnote" value="note"><?php echo T_("Add note"); ?></button>
        </div>
      </div>

    <?php }else{ ?>

    <button class="btn primary block mT20"><?php echo T_("Send new message"); ?></button>
    <?php } //endif ?>

   <?php } //endif ?>

  </form>
</div>
