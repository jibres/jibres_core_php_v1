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

        <?php if(!\dash\data::profileDetail_pre_company()) {?>

          <div class="f mB10">
            <div class="c pRa5">
              <div class="radio3">
                <input type="radio" name="gender" value="male" id="gendermale" <?php if(\dash\data::profileDetail_pre_gender() === 'male') {echo 'checked';} ?>>
                <label for="gendermale"><?php echo T_("Mr"); ?></label>
              </div>
            </div>
            <div class="c">
              <div class="radio3">
                <input type="radio" name="gender" value="female" id="genderfemale" <?php if(\dash\data::profileDetail_pre_gender() === 'female') {echo 'checked';} ?>>
                <label for="genderfemale"><?php echo T_("Mrs"); ?></label>
              </div>
            </div>
          </div>

          <div class="f">
            <div class="c6 s12 pRa10">
              <label for="firstname"><?php echo T_("First name"); ?></label>
              <div class="input">
                <input type="text" name="firstname" value="<?php echo \dash\data::profileDetail_pre_firstname(); ?>" id="firstname" placeholder='<?php echo T_("Firstname"); ?>'  maxlength='50' minlength="1" pattern=".{1,50}">
              </div>
            </div>
            <div class="c6 s12">
              <label for="ifirstname_en"> <small><?php echo T_("Enter in English!") ?></small> <small class="fc-red"><?php echo T_("Required"); ?></small></label>
              <div class="input ltr">
                <input type="text" name="firstname_en" value="<?php echo \dash\data::profileDetail_pre_firstname_en(); ?>" id="ifirstname_en" placeholder="Firstname *" maxlength="50" required>
              </div>
            </div>
          </div>

          <div class="f">
            <div class="c6 s12 pRa10">
              <label for="lastname"><?php echo T_("Last name"); ?></label>
              <div class="input">
                <input type="text" name="lastname" value="<?php echo \dash\data::profileDetail_pre_lastname(); ?>" id="lastname" placeholder='<?php echo T_("Lastname"); ?>'  maxlength='50' minlength="1" pattern=".{1,50}">
              </div>
            </div>
            <div class="c6 s12">
              <label for="ilastname_en"> <small><?php echo T_("Enter in English!") ?></small> <small class="fc-red"><?php echo T_("Required"); ?></small></label>
              <div class="input ltr">
                <input type="text" name="lastname_en" value="<?php echo \dash\data::profileDetail_pre_lastname_en(); ?>" id="ilastname_en" placeholder="Lastname *" maxlength="50" required>
              </div>
            </div>
          </div>

          <div class="f">
            <div class="c6 s12 pRa10">
              <label for="father"><?php echo T_("Father name"); ?></label>
              <div class="input">
                <input type="text" name="father" value="<?php echo \dash\data::profileDetail_pre_father(); ?>" id="father" placeholder='<?php echo T_("Father name"); ?>'  maxlength='50' minlength="1" pattern=".{1,50}">
              </div>
            </div>
            <div class="c6 s12">
              <label for="ifather_en"> <small><?php echo T_("Enter in English!") ?></small> <small class="fc-red"><?php echo T_("Required"); ?></small></label>
              <div class="input ltr">
                <input type="text" name="father_en" value="<?php echo \dash\data::profileDetail_pre_father_en(); ?>" id="ifather_en" placeholder="Father name *" maxlength="50" required>
              </div>
            </div>
          </div>

          <div class="f">
            <div class="c6 s12 pRa10">
              <label for="inationalcode"><?php echo T_("Iranian National Code"); ?></label>
              <div class="input ltr">
                <input type="text" name="nationalcode" value="<?php echo \dash\data::profileDetail_pre_nationalcode(); ?>" id="inationalcode" placeholder="" maxlength="10" required>
              </div>
            </div>
            <div class="c6 s12">
              <label for="birthdate"><?php echo T_("Birthday"); ?></label>
              <div class="input ltr">
                <input type="text" name="birthdate" value="<?php echo \dash\data::profileDetail_pre_birthdate(); ?>" id="birthdate" placeholder='<?php echo \dash\fit::date("1991/04/15"); ?> *' data-format='date'  autocomplete='off' required>
              </div>
            </div>
          </div>



        <?php } //endif ?>


        <?php if(\dash\data::profileDetail_pre_company()) {?>


          <div class="f">
            <div class="c6 s12 pRa10">
              <label for="companyname"><?php echo T_("Company name"); ?></label>
              <div class="input">
                <input type="text" name="companyname" value="<?php echo \dash\data::profileDetail_pre_companyname(); ?>" id="companyname" placeholder='<?php echo T_("Firstname"); ?>'  maxlength='50' minlength="1" pattern=".{1,50}" required>
              </div>
            </div>
            <div class="c6 s12">
              <label for="icompanyname_en"> <small><?php echo T_("Enter in English!") ?></small> <small class="fc-red"><?php echo T_("Required"); ?></small></label>
              <div class="input ltr">
                <input type="text" name="companyname_en" value="<?php echo \dash\data::profileDetail_pre_companyname_en(); ?>" id="icompanyname_en" placeholder="Company name *" maxlength="50" required>
              </div>
            </div>
          </div>


          <label for="icompanynationalid"><?php echo T_("Company national id"); ?></label>
          <div class="input">
            <input type="text" name="companynationalid" value="<?php echo \dash\data::profileDetail_pre_companynationalid(); ?>" id="icompanynationalid"  data-format='int' maxlength="11" required>
          </div>



          <label for="icompanyregisternumber"><?php echo T_("Company register number"); ?></label>
          <div class="input">
            <input type="text" name="companyregisternumber" value="<?php echo \dash\data::profileDetail_pre_companyregisternumber(); ?>" id="icompanyregisternumber"  data-format='int' maxlength="10">
          </div>



          <label for="iceonationalcode"><?php echo T_("CEO nationalcode"); ?></label>
          <div class="input">
            <input type="text" name="ceonationalcode" value="<?php echo \dash\data::profileDetail_pre_ceonationalcode(); ?>" id="iceonationalcode"  data-format='nationalCode'>
          </div>

        <?php }//endif ?>

          <label for="iphone"><?php echo T_("Phone"); ?></label>
          <div class="input">
            <input type="text" name="phone" value="<?php echo \dash\data::profileDetail_pre_phone(); ?>" id="iphone"  data-format='tel' required>
          </div>

      </div>

      <footer class="txtRa">
        <button class="btn primary"><?php echo T_("Save & Next"); ?></button>
      </footer>
    </form>
  </div>
</div>


