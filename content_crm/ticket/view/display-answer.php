<form method="post" autocomplete="off" class="quickReply">
  <?php echo \dash\csrf::html(); ?>
  <div class="row align-start">
    <div class="c-xs-12 c-sm-12 c-md">
      <textarea class="txt" data-autoResize <?php if(!$customer_mode){echo 'name="answer" data-simple';}else{echo 'name="content"';} ?> rows="1" placeholder='<?php echo T_("Write a message..."); ?>' role="textbox"></textarea>

    </div>
    <div class="c-auto order-md-first">
      <div class="checkIcon">
        <label for="file1-2" data-kerkere='.uploadBox'>
          <?php echo \dash\utility\icon::svg('Paperclip', 'bootstrap'); ?>
        </label>
      </div>
    </div>
<?php if(!$customer_mode) {?>
    <div class="c-auto">
      <div class="checkIcon">
        <input type="checkbox" name="sendmessage" id="sendmessage">
        <label for="sendmessage" title="<?php echo T_("Send notify about your answer to creator of ticket") ?>">
          <?php echo \dash\utility\icon::svg('bell-fill', 'bootstrap'); ?>
        </label>
      </div>
    </div>
    <div class="c-auto">
      <div class="checkIcon">
        <input type="checkbox" name="note" id="inote">
        <label for="inote" title="<?php echo T_("Disabling this option will add your reply to the ticket as a note") ?>">
          <?php echo \dash\utility\icon::svg('sun-fill', 'bootstrap'); ?>
        </label>
      </div>
    </div>
<?php }?>
    <div class="c-xs c-sm c-md-auto txtRa">
      <button class="btn-primary"><?php echo T_("Send"); ?></button>
    </div>
  </div>
  <div class="uploadBox" data-kerkere-content='hide'>
    <div class="mT10" data-uploader data-name='file' data-ratio-free data-file-max-size='<?php echo \dash\data::maxFileSize() ?>'>
      <input type="file" id="file1">
      <label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?><abbr class="block"></abbr></label>
    </div>
  </div>
</form>
