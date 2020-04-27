<?php require_once(core. 'layout/tools/stepGuide.php'); ?>


<div class="f justify-center">
  <div class="c6 m8 s12">

    <form method="post" autocomplete="off" class="box impact">
      <?php if(\dash\request::get('type') === 'real') {?>
        <header><h2><?php echo T_("Complete your profile"); ?></h2></header>
      <?php }else{ ?>
        <header><h2><?php echo T_("Enter your company detail"); ?></h2></header>
      <?php } //endif ?>

      <div class="body">

        <?php if(\dash\request::get('type') === 'real') {?>

          <div class="f mB10">
            <div class="c pRa5">
              <div class="radio3">
                <input type="radio" name="gender" value="male" id="gendermale">
                <label for="gendermale"><?php echo T_("Mr"); ?></label>
              </div>
            </div>
            <div class="c">
              <div class="radio3">
                <input type="radio" name="gender" value="female" id="genderfemale">
                <label for="genderfemale"><?php echo T_("Mrs"); ?></label>
              </div>
            </div>
          </div>

          <div class="f">
            <div class="c6 s12 pRa10">
              <label for="firstname"><?php echo T_("First name"); ?></label>
              <div class="input">
                <input type="text" name="firstname" id="firstname" placeholder='<?php echo T_("Firstname"); ?>' value="<?php echo \dash\data::dataRow_firstname(); ?>" maxlength='50' minlength="1" pattern=".{1,50}">
              </div>
            </div>
            <div class="c6 s12">
              <label for="ifirstname_en"> <small><?php echo T_("Enter in English!") ?></small> <small class="fc-red"><?php echo T_("Required"); ?></small></label>
              <div class="input ltr">
                <input type="text" name="firstname_en" id="ifirstname_en" placeholder="Firstname *" maxlength="50" required>
              </div>
            </div>
          </div>

          <div class="f">
            <div class="c6 s12 pRa10">
              <label for="lastname"><?php echo T_("Last name"); ?></label>
              <div class="input">
                <input type="text" name="lastname" id="lastname" placeholder='<?php echo T_("Lastname"); ?>' value="<?php echo \dash\data::dataRow_lastname(); ?>" maxlength='50' minlength="1" pattern=".{1,50}">
              </div>
            </div>
            <div class="c6 s12">
              <label for="ilastname_en"> <small><?php echo T_("Enter in English!") ?></small> <small class="fc-red"><?php echo T_("Required"); ?></small></label>
              <div class="input ltr">
                <input type="text" name="lastname_en" id="ilastname_en" placeholder="Lastname *" maxlength="50" required>
              </div>
            </div>
          </div>

          <div class="f">
            <div class="c6 s12 pRa10">
              <label for="father"><?php echo T_("Father name"); ?></label>
              <div class="input">
                <input type="text" name="father" id="father" placeholder='<?php echo T_("Father name"); ?>' value="<?php echo \dash\data::dataRow_father(); ?>" maxlength='50' minlength="1" pattern=".{1,50}">
              </div>
            </div>
            <div class="c6 s12">
              <label for="ifather_en"> <small><?php echo T_("Enter in English!") ?></small> <small class="fc-red"><?php echo T_("Required"); ?></small></label>
              <div class="input ltr">
                <input type="text" name="father_en" id="ifather_en" placeholder="Father name *" maxlength="50" required>
              </div>
            </div>
          </div>

          <div class="f">
            <div class="c6 s12 pRa10">
              <label for="inationalcode"><?php echo T_("Iranian National Code"); ?></label>
              <div class="input ltr">
                <input type="text" name="nationalcode" id="inationalcode" placeholder="" maxlength="10" required>
              </div>
            </div>
            <div class="c6 s12">
              <label for="birthdate"><?php echo T_("Birthday"); ?></label>
              <div class="input ltr">
                <input type="text" name="birthdate" id="birthdate" placeholder='<?php echo \dash\fit::date("1991/04/15"); ?> *' data-format='date' value="<?php echo \dash\data::dataRow_birthdate(); ?>" autocomplete='off' required>
              </div>
            </div>
          </div>



        <?php } //endif ?>


        <?php if(\dash\request::get('type') === 'legal') {?>


          <div class="f">
            <div class="c6 s12 pRa10">
              <label for="companyname"><?php echo T_("Company name"); ?></label>
              <div class="input">
                <input type="text" name="companyname" id="companyname" placeholder='<?php echo T_("Firstname"); ?>' value="<?php echo \dash\data::dataRow_companyname(); ?>" maxlength='50' minlength="1" pattern=".{1,50}" required>
              </div>
            </div>
            <div class="c6 s12">
              <label for="icompanyname_en"> <small><?php echo T_("Enter in English!") ?></small> <small class="fc-red"><?php echo T_("Required"); ?></small></label>
              <div class="input ltr">
                <input type="text" name="companyname_en" id="icompanyname_en" placeholder="Company name *" maxlength="50" required>
              </div>
            </div>
          </div>


          <label for="icompanynationalid"><?php echo T_("Company national id"); ?></label>
          <div class="input">
            <input type="text" name="companynationalid" id="icompanynationalid" value="<?php echo \dash\data::dataRow_companynationalid(); ?>" data-format='int' maxlength="11" required>
          </div>



          <label for="icompanyregisternumber"><?php echo T_("Company register number"); ?></label>
          <div class="input">
            <input type="text" name="companyregisternumber" id="icompanyregisternumber" value="<?php echo \dash\data::dataRow_companyregisternumber(); ?>" data-format='int' maxlength="10">
          </div>



          <label for="iceonationalcode"><?php echo T_("CEO nationalcode"); ?></label>
          <div class="input">
            <input type="text" name="ceonationalcode" id="iceonationalcode" value="<?php echo \dash\data::dataRow_ceonationalcode(); ?>" data-format='nationalCode'>
          </div>

        <?php }//endif ?>

          <label for="iphone"><?php echo T_("Phone"); ?></label>
          <div class="input">
            <input type="text" name="phone" id="iphone" value="<?php echo \dash\data::dataRow_phone(); ?>" data-format='tel' required>
          </div>

      </div>

      <footer class="txtRa">
        <button class="btn primary"><?php echo T_("Save & Next"); ?></button>
      </footer>
    </form>
  </div>
</div>


