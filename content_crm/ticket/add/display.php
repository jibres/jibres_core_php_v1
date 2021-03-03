<div class="avand-md">
  <form method="post" autocomplete="off" >
    <div class="box">
      <div class="pad">
        <label><?php echo T_("Ticket owner") ?></label>
        <div>
         <select name="user_id" class="select22"  data-model='html'  data-ajax--url='<?php echo \dash\url::kingdom(); ?>/crm/api?type=sale&json=true&list=customer' data-shortkey-search data-placeholder='<?php echo T_("Choose ticket owner"); ?>'>
          </select>
        </div>
        <label for="title"><?php echo T_("Subject") ?></label>
        <div class="input">
          <input  type="text" name="title" placeholder="<?php echo T_("Subject") ?>" maxlength="100">
        </div>
        <textarea class="txt" name="content" rows="3" <?php \dash\layout\autofocus::html() ?> placeholder='<?php echo T_("Type here ...") ?>'></textarea>

        <div class="mT10" data-uploader data-name='file' data-file-max-size='<?php echo \dash\data::maxFileSize() ?>'>
          <input type="file"  id="file1">
          <label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
        </div>

      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Add Ticket") ?></button>
      </footer>
    </div>
  </form>
</div>