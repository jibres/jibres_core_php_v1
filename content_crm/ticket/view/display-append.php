<form method="post" autocomplete="off" >
  <?php if($customer_mode){ \dash\csrf::html(false); } ?>
  <div class="box">
    <div class="pad">
      <textarea class="txt" <?php if(!$customer_mode){echo 'name="answer" data-editor';}else{echo 'name="content"';} ?> rows="4" <?php \dash\layout\autofocus::html() ?> placeholder='<?php if(!$customer_mode) { echo T_("Answer to ticket"); }else{ echo T_("Write your message");} ?>'></textarea>
      <div class="mT10" data-uploader data-name='file' data-file-max-size='<?php echo \dash\data::maxFileSize() ?>'>
        <input type="file"  id="file1">
        <label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
      </div>
        <?php if(!$customer_mode) {?>
        <div class="check1">
          <input type="checkbox" name="sendmessage" id="sendmessage" checked>
          <label for="sendmessage"><?php echo T_("Send notify about your answer to creator of ticket"); ?></label>
        </div>

       <div class="check1">
          <input type="checkbox" name="note" id="inote">
          <label for="inote"><?php echo T_("Add yout message as note."); ?> <small><?php echo T_('Users do not see the notes and only the system administrator sees them') ?></small></label>
        </div>
      <?php } //endif ?>
    </div>
    <footer class="txtRa">
      <?php if($customer_mode) {?>
        <button class="btn master"><?php echo T_("Send ticket"); ?></button>
      <?php }else{ ?>
        <button class="btn master"><?php echo T_("Send answer"); ?></button>
      <?php } //endif ?>
    </footer>
  </div>
</form>

