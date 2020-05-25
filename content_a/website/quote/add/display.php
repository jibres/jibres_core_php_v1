

<div class="avand-sm">

  <form method="post" autocomplete="off" >

    <div data-uploader data-name='image' data-ratio="1" data-final='#finalImage' data-preview-circle data-uploader-circle>
      <input type="file" accept="image/jpeg, image/png" id="image1">
      <label for="image1"><?php echo T_('Drag &amp; Drop your picture or Browse'); ?></label>

      <?php if(\dash\data::dataRow_image()) {?>
        <label for="image1">
          <img id='finalImage' src="<?php echo \dash\data::dataRow_image() ?>" alt='<?php echo T_("User avatar") ?>'>
        </label>
      <?php } ?>
    </div>

    <div class="box">


      <div class="body">

        <label for="displayname"><?php echo T_("User display name"); ?></label>
        <div class="input">
          <input type="text" name="displayname" id="displayname" value="<?php echo \dash\data::dataRow_displayname() ?>" maxlength="50"  >
        </div>

        <label for="job"><?php echo T_("User job"); ?></label>
        <div class="input">
          <input type="text" name="job" id="job" value="<?php echo \dash\data::dataRow_job() ?>" maxlength="50"  >
        </div>

        <textarea name="text" class="txt" rows="5" placeholder="<?php echo T_("Quote") ?>"><?php echo \dash\data::dataRow_text() ?></textarea>

        <label><?php echo T_("User star"); ?></label>
        <div class="radioRating togglable">
          <div class="rateBox">
            <input type="radio" name="star" id="star-1" value="1" <?php if(\dash\data::dataRow_star() == '5') { echo "checked";} ?>>
            <label for="star-1"></label>
            <input type="radio" name="star" id="star-2" value="2" <?php if(\dash\data::dataRow_star() == '4') { echo "checked";} ?>>
            <label for="star-2"></label>
            <input type="radio" name="star" id="star-3" value="3" <?php if(\dash\data::dataRow_star() == '3') { echo "checked";} ?>>
            <label for="star-3"></label>
            <input type="radio" name="star" id="star-4" value="4" <?php if(\dash\data::dataRow_star() == '2') { echo "checked";} ?>>
            <label for="star-4"></label>
            <input type="radio" name="star" id="star-5" value="5" <?php if(\dash\data::dataRow_star() == '1') { echo "checked";} ?>>
            <label for="star-5"></label>

          </div>
        </div>
      </div>

      <footer class="txtRa">
        <?php if(\dash\data::dataRow()) {?>
          <div class="f">
            <div class="cauto">
              <div data-confirm data-data='{"remove": "quote"}' class="btn linkDel"><?php echo T_("Remove"); ?></div>
            </div>
            <div class="c"></div>
            <div class="cauto">
              <button class="btn primary"><?php echo T_("Edit"); ?></button>
            </div>
          </div>
        <?php }else{ ?>
          <button class="btn success"><?php echo T_("Add"); ?></button>
        <?php } //endif ?>
      </footer>

    </div>
  </form>

</div>