<?php require_once(core. 'layout/tools/stepGuide.php'); ?>


<div class="f justify-center">
  <div class="c6 m8 s12">

    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Edit your profile"); ?></h2></header>

      <div class="body">

        <div class="f mB10">
          <div class="c pRa5">
            <div class="radio3">
              <input type="radio" name="type" value="human" id="typehuman" checked>
              <label for="typehuman"><?php echo T_("Real person"); ?></label>
            </div>
          </div>
          <div class="c">
            <div class="radio3">
              <input type="radio" name="type" value="legal" id="typelegal">
              <label for="typelegal"><?php echo T_("Leagal person"); ?></label>
            </div>
          </div>
        </div>

        <div data-response='type' data-response-where='human' data-response-effect='slide'>
          <label for="firstname"><?php echo T_("First name"); ?></label>
          <div class="input">
            <input type="text" name="firstname" id="firstname" placeholder='<?php echo T_("Firstname"); ?>' value="<?php echo \dash\data::dataRow_firstname(); ?>" maxlength='40' minlength="1" pattern=".{1,40}">
          </div>

          <label for="lastname"><?php echo T_("Last name"); ?></label>
          <div class="input">
            <input type="text" name="lastname" id="lastname" placeholder='<?php echo T_("Lastname"); ?>' value="<?php echo \dash\data::dataRow_lastname(); ?>" maxlength='40' minlength="1" pattern=".{1,40}">
          </div>

          <label for="father"><?php echo T_("Father name"); ?></label>
          <div class="input">
            <input type="text" name="father" id="father" placeholder='<?php echo T_("Father name"); ?>' value="<?php echo \dash\data::dataRow_father(); ?>" maxlength='40' minlength="1" pattern=".{1,40}">
          </div>

          <label for="birthday"><?php echo T_("Birthday"); ?></label>
          <div class="input">
            <input class="datepicker" type="text" name="birthday" id="birthday" placeholder='<?php echo \dash\fit::date("1991/04/15"); ?> *' value="<?php echo \dash\data::dataRow_birthday(); ?>" data-view="year" autocomplete='off'>
          </div>


          <label for="gender"><?php echo T_("Gender"); ?></label>
          <select name="gender" class="select22" id="gender">
            <option value="" readonly><?php echo T_("Please select one item"); ?> *</option>
            <option value="male"  <?php if(\dash\data::dataRow_gender() == 'male') { echo 'selected';} ?>><?php echo T_("Male"); ?></option>
            <option value="female"  <?php if(\dash\data::dataRow_gender() == 'female') { echo 'selected';} ?>><?php echo T_("Female"); ?></option>
          </select>
        </div>


        <div data-response='type' data-response-where='legal' data-response-hide data-response-effect='slide'>
          <label for="icompanyname"><?php echo T_("Company name"); ?></label>
          <div class="input">
            <input type="text" name="companyname" id="icompanyname" value="<?php echo \dash\data::dataRow_companyname(); ?>" maxlength="40">
          </div>


          <label for="icompanyregisternumber"><?php echo T_("Company register number"); ?></label>
          <div class="input">
            <input type="text" name="companyregisternumber" id="icompanyregisternumber" value="<?php echo \dash\data::dataRow_companyregisternumber(); ?>" data-format='int' maxlength="10">
          </div>

          <label for="icompanynationalid"><?php echo T_("Company national id"); ?></label>
          <div class="input">
            <input type="text" name="companynationalid" id="icompanynationalid" value="<?php echo \dash\data::dataRow_companynationalid(); ?>" data-format='int' maxlength="11">
          </div>


          <label for="iceonationalcode"><?php echo T_("CEO nationalcode"); ?></label>
          <div class="input">
            <input type="text" name="ceonationalcode" id="iceonationalcode" value="<?php echo \dash\data::dataRow_ceonationalcode(); ?>" data-format='nationalCode'>
          </div>
        </div>


      </div>

      <footer class="txtRa">
        <button class="btn primary"><?php echo T_("Save & Next"); ?></button>
      </footer>
    </form>
  </div>
</div>


