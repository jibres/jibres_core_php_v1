<?php
$storeData = \dash\data::store_store_data();
?>
<form method="post" autocomplete="off">
  <div class="avand-md">
    <div class="box">
      <div class="pad">
        <?php \dash\csrf::html(); ?>
        <div data-uploader data-name='logo' data-ratio="1" data-final='#finalImage' data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' data-preview-circle data-autoSend data-uploader-circle>
              <input type="file" accept="image/jpeg, image/png" id="image1">
              <label for="image1"><?php echo T_('Drag &amp; Drop website logo or Browse'); ?></label>
              <?php if(a($storeData, 'logo')) {?>
                <label for="image1">
                  <img id='finalImage' src="<?php echo a($storeData, 'logo') ?>" alt='<?php echo T_("Your logo") ?>'>
                </label>
              <?php }?>
            </div>

        <label for="ititle"><?php echo T_("Website title"); ?> <span class="fc-red">*</span></label>
        <div class="input">
          <input type="text" name="title" id="ititle" placeholder='<?php echo T_("Name"); ?>' value="<?php echo a($storeData, 'title'); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1"  required>
        </div>

        <label for="desc"><?php echo T_("Website Description"); ?></label>
        <textarea class="txt mB10" name="desc"  maxlength='2000' rows="3"><?php echo a($storeData, 'desc'); ?></textarea>




          <label for="instagram"><?php echo T_("Instagram"); ?></label>
          <div class="input ltr">
            <span class="addon">instagram.com/</span>
            <input type="text" name="instagram" id="instagram" placeholder='<?php echo T_("Instagram"); ?>' value="<?php echo \dash\data::dataRow_instagram(); ?>" maxlength='30' minlength="1">
            <span class="addon"><i class="sf-instagram"></i></span>
          </div>

          <label for="facebook"><?php echo T_("Facebook"); ?></label>
          <div class="input ltr">
            <span class="addon">facebook.com/</span>
            <input type="text" name="facebook" id="facebook" placeholder='<?php echo T_("Facebook"); ?>' value="<?php echo \dash\data::dataRow_facebook(); ?>" maxlength='30' minlength="1">
            <span class="addon"><i class="sf-facebook-official"></i></span>
          </div>

          <label for="twitter"><?php echo T_("Twitter"); ?></label>
          <div class="input ltr">
            <span class="addon">twitter.com/</span>
            <input type="text" name="twitter" id="twitter" placeholder='<?php echo T_("Twitter"); ?>' value="<?php echo \dash\data::dataRow_twitter(); ?>" maxlength='30' minlength="1">
            <span class="addon"><i class="sf-twitter"></i></span>
          </div>

          <label for="linkedin"><?php echo T_("Linkedin"); ?></label>
          <div class="input ltr">
            <span class="addon">linkedin.com/</span>
            <input type="text" name="linkedin" id="linkedin" placeholder='<?php echo T_("Linkedin"); ?>' value="<?php echo \dash\data::dataRow_linkedin(); ?>" maxlength='30' minlength="1">
            <span class="addon"><i class="sf-linkedin"></i></span>
          </div>


      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Let's go"); ?></button>
      </footer>
    </div>
</form>