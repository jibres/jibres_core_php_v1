<form method='post' autocomplete="off">
  <div class="avand-md">
    <div class="box">
      <div class="pad">
      <?php if(\dash\data::dataRow_user_id()) {/*nothing*/}else{?>
        <label for="mobile"><?php echo T_("Mobile") ?></label>
        <div class="input">
          <input type="text" name="mobile" id="mobile" maxlength="100" value="<?php echo \dash\data::dataRow_mobile() ?>">
        </div>

        <label for="displayname"><?php echo T_("Name") ?></label>
        <div class="input">
          <input type="text" name="displayname" id="displayname" maxlength="100" value="<?php echo \dash\data::dataRow_displayname() ?>">
        </div>
      <?php } //endif ?>

        <label for="title"><?php echo T_("Title") ?></label>
        <div class="input">
          <input type="text" name="title" id="title" maxlength="100" value="<?php echo \dash\data::dataRow_title() ?>">
        </div>
        <textarea class="txt" name="content" rows="5"><?php echo \dash\data::dataRow_content() ?></textarea>
        <div class="starRating">
          <fieldset>
            <input type="radio" name="star" id="star5" value="5" <?php if(\dash\data::dataRow_star() == '5') { echo 'checked'; } ?>>
            <label for="star5" title="<?php echo T_("Outstanding");?>">5 stars</label>
            <input type="radio" name="star" id="star4" value="4" <?php if(\dash\data::dataRow_star() == '4') { echo 'checked'; } ?>>
            <label for="star4" title="<?php echo T_("Very Good");?>">4 stars</label>
            <input type="radio" name="star" id="star3" value="3" <?php if(\dash\data::dataRow_star() == '3') { echo 'checked'; } ?>>
            <label for="star3" title="<?php echo T_("Good");?>">3 stars</label>
            <input type="radio" name="star" id="star2" value="2" <?php if(\dash\data::dataRow_star() == '2') { echo 'checked'; } ?>>
            <label for="star2" title="<?php echo T_("Poor");?>">2 stars</label>
            <input type="radio" name="star" id="star1" value="1" <?php if(\dash\data::dataRow_star() == '1') { echo 'checked'; } ?>>
            <label for="star1" title="<?php echo T_("Very Poor");?>">1 star</label>
          </fieldset>
        </div>

      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Edit") ?></button>
      </footer>
    </div>
  </div>
</form>