<form method="post" autocomplete="off" class="quickReply">
  <div class="row align-start">
    <div class="c-auto">
      <div class="checkIcon">
        <label for="file1-2" class="sf-attach" data-kerkere='.uploadBox'></label>
      </div>
    </div>
    <div class="c">
      <textarea class="txt" data-autoResize <?php if(!$customer_mode){echo 'name="answer" data-simple';}else{echo 'name="content"';} ?> rows="1" placeholder='<?php echo T_("Write a message..."); ?>' role="textbox"></textarea>

    </div>
<?php if(!$customer_mode) {?>
    <div class="c-auto">
      <div class="checkIcon">
        <input type="checkbox" name="sendmessage" id="sendmessage">
        <label for="sendmessage" class="sf-bell"></label>
      </div>
    </div>
    <div class="c-auto">
      <div class="checkIcon">
        <input type="checkbox" name="note" id="inote">
        <label for="inote" class="sf-sun-o"></label>
      </div>
    </div>
<?php }?>
    <div class="c-auto">
      <button class="btn master"><?php echo T_("Send"); ?></button>
    </div>
  </div>
  <div class="uploadBox" data-kerkere-content='hide'>
    <div class="mT10" data-uploader data-name='file' data-file-max-size='<?php echo \dash\data::maxFileSize() ?>'>
      <input type="file"  id="file1">
      <label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
    </div>
  </div>
</form>
