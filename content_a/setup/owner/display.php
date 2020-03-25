

<div id="get_started_card">
  <div class="body">
    <div class="pad">
      <h1><?php echo \dash\face::title(); ?></h1>
      <p><?php echo T_("Fill your name and public detail to save on your store."); ?></p>
      <form method="post" autocomplete="off">

        <label for="gender"><?php echo T_("Gender"); ?></label>
        <div>
          <select name="gender" class="select22" id="gender">
            <?php if(!\dash\data::dataRow_gender()) {?>

            <option disabled selected></option>
            <?php } //endif ?>
            <option value="male" <?php if(\dash\data::dataRow_gender() == 'male') { echo 'selected'; } ?> ><?php echo T_("Male"); ?></option>
            <option value="female" <?php if(\dash\data::dataRow_gender() == 'female') { echo 'selected'; } ?> ><?php echo T_("Female"); ?></option>
          </select>
        </div>

        <label for="firstname"><?php echo T_("First name"); ?></label>
        <div class="input">
          <input type="text" name="firstname" id="firstname" value="<?php echo \dash\data::dataRow_firstname(); ?>" maxlength='40'>
        </div>

        <label for="lastname"><?php echo T_("Last name"); ?></label>
        <div class="input">
          <input type="text" name="lastname" id="lastname" value="<?php echo \dash\data::dataRow_lastname(); ?>" maxlength='40'>
        </div>

        <label for="birthday"><?php echo T_("Birthday"); ?> <b><?php echo T_("yyyy/mm/dd"); ?></b></label>

        <div class="input">
          <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="birthday" id="birthday" value="<?php echo \dash\data::dataRow_jalali_birthday(); ?>" autocomplete='off'>
        </div>


        <div class="f align-center mB10">
          <div class="c fc-mute"><?php echo \dash\data::stepDesc(); ?></div>
          <div class="cauto os"><button class="btn primary"><?php echo T_("Save"); ?></button></div>
        </div>

      </form>
    </div>
  </div>
</div>