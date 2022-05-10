
<div class="f justify-center">
  <div class="c6 m8 x5 s12">
    <div class="box p-4">
      <form method="post" autocomplete="off">

          <?php echo \dash\csrf::html(); ?>
          <label for="firstname"><?php echo T_("First name"); ?></label>
          <div class="input">
            <input type="text" name="firstname" id="firstname" placeholder='<?php echo T_("Firstname"); ?>' value="<?php echo \dash\data::dataRow_firstname(); ?>" maxlength='40' minlength="1" pattern=".{1,40}">
          </div>



          <label for="lastname"><?php echo T_("Last name"); ?></label>
          <div class="input">
            <input type="text" name="lastname" id="lastname" placeholder='<?php echo T_("Lastname"); ?>' value="<?php echo \dash\data::dataRow_lastname(); ?>" maxlength='40' minlength="1" pattern=".{1,40}">
          </div>


          <label for="birthday"><?php echo T_("Birthday"); ?></label>
          <div class="input">
            <input class="datepicker" type="text" name="birthday" id="birthday" placeholder='<?php echo \dash\fit::date("1991/04/15"); ?> *' value="<?php echo \dash\data::dataRow_birthday(); ?>" data-view="year" autocomplete='off'>
          </div>


          <label for="displayname"><?php echo T_("Display name"); ?></label>
          <div class="input">
            <input type="text" name="displayname" id="displayname" placeholder='<?php echo T_("Display name"); ?>' value="<?php echo \dash\data::dataRow_displayname(); ?>" maxlength='40' minlength="1" pattern=".{1,40}" >
          </div>



          <label for="gender"><?php echo T_("Gender"); ?></label>
          <select name="gender" class="select22" id="gender">
            <option value="" readonly><?php echo T_("Please select one item"); ?> *</option>
              <option value="male"  <?php if(\dash\data::dataRow_gender() == 'male') { echo 'selected';} ?>><?php echo T_("Male"); ?></option>
              <option value="female"  <?php if(\dash\data::dataRow_gender() == 'female') { echo 'selected';} ?>><?php echo T_("Female"); ?></option>
              <option value="company"  <?php if(\dash\data::dataRow_gender() == 'company') { echo 'selected';} ?>><?php echo T_("Company"); ?></option>
              <option value="rather not say"  <?php if(\dash\data::dataRow_gender() == 'rather not say' ) { echo 'selected';} ?>><?php echo T_("Rather not say"); ?></option>
          </select>


          <label for="bio" class="mt-2"><?php echo T_("Bio"); ?></label>
          <textarea class="txt mb-4 pB25" name="bio" id="bio" placeholder='<?php echo T_("Bio"); ?>' maxlength='300' rows="3"><?php echo \dash\data::dataRow_bio(); ?></textarea>

        <div class="txtRa">
          <button class="btn-success"><?php echo T_("Save"); ?></button>
        </div>

      </form>
    </div>
  </div>
</div>




