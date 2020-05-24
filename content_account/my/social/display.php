

<form method="post" enctype="multipart/form-data" autocomplete="off">
  <div class="f justify-center">
    <div class="c6 m8 x5 s12">

      <?php \dash\utility\hive::html(); ?>
      <div class="cbox">
        <h3 class="txtC mB20"><?php echo \dash\face::title(); ?></h3>


            <label for="website"><?php echo T_("Website"); ?></label>
            <div class="input ltr">
              <input type="url" name="website" id="website" placeholder='<?php echo T_("like"); ?> https://ermile.com' value="<?php echo \dash\data::dataRow_website(); ?>" maxlength='40' minlength="1" pattern=".{1,40}">
              <span class="addon"><i class="sf-earth"></i></span>
            </div>

          <hr>

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

          <label for="instagram"><?php echo T_("Instagram"); ?></label>
          <div class="input ltr">
            <span class="addon">instagram.com/</span>
            <input type="text" name="instagram" id="instagram" placeholder='<?php echo T_("Instagram"); ?>' value="<?php echo \dash\data::dataRow_instagram(); ?>" maxlength='30' minlength="1">
            <span class="addon"><i class="sf-instagram"></i></span>
          </div>


          <div class="txtRa pT10">
            <button class="btn success"><?php echo T_("Save"); ?></button>
          </div>

      </div>

    </div>
  </div>
</form>




