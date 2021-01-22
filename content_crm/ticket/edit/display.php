<form method="post" autocomplete="off" >
  <div class="box">
    <div class="pad">
      <textarea class="txt" name="content" data-editor rows="3" <?php \dash\layout\autofocus::html() ?> placeholder='<?php echo T_("Answer to ticket") ?>'><?php echo \dash\data::dataRow_content() ?></textarea>
      <?php if(\dash\data::dataRow_file()) {?>
        <div class="ibtn x30 wide mT10"><span><?php echo T_("Attachment"); ?></span><i class="sf-times fc-red"></i></div>
      <?php } //endif ?>
      <div class="mT10" data-uploader data-name='file'>
        <input type="file"  id="file1">
        <label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
      </div>
    </div>
    <footer class="f">
      <div class="cauto"><div data-confirm data-data='{"remove": "remove"}' class="btn linkDel"><?php echo T_("Remove this message") ?></div></div>
      <div class="c"></div>
      <div class="cauto"><button class="btn master"><?php echo T_("Save") ?></button></div>
    </footer>
  </div>
</form>