



<?php require_once(root. 'content_crm/member/pageSteps.php'); ?>

<div class="f">

 <div class="cauto s12 pA5">
	<?php require_once(root. 'content_crm/member/psidebar.php'); ?>

 </div>

 <div class="c s12 pA5">

	<form class="cbox" method="post" autocomplete="off">


	 <div class="f">
	   <div class="c pRa5">

			<label for="displayname"><?php echo T_("Display name"); ?></label>
			<div class="input">
			  <input type="text" name="displayname" id="displayname"  value="<?php echo \dash\data::dataRowMember_displayname(); ?>" maxlength='40' minlength="1" pattern=".{1,40}">
			</div>

	   </div>
	   <div class="c">

			<label for="title"><?php echo T_("Nick name"); ?></label>
			<div class="input">
			  <input type="text" name="title" id="title"  value="<?php echo \dash\data::dataRowMember_title(); ?>" maxlength='40' minlength="1" pattern=".{1,40}"  >
			</div>


	   </div>
	 </div>



	 <div class="f">
	   <div class="c pRa5">
			<label for="name"><?php echo T_("Name"); ?></label>
			<div class="input">
			  <input type="text" name="name" id="name" placeholder='<?php echo T_("Name"); ?>' value="<?php echo \dash\data::dataRowMember_firstname(); ?>" autofocus maxlength='40' minlength="1" pattern=".{1,40}" >
			</div>
	   </div>
	   <div class="c">
			<label for="lastName"><?php echo T_("Last name"); ?></label>
			<div class="input">
			  <input type="text" name="lastName" id="lastName" placeholder='<?php echo T_("Last name"); ?>' value="<?php echo \dash\data::dataRowMember_lastname(); ?>" maxlength='60'>
			</div>
	   </div>
	 </div>

	 <div class="f">
	   <div class="c pRa5">
			<label for="father"><?php echo T_("Father name"); ?></label>
			<div class="input">
			  <input type="text" name="father" id="father" placeholder='<?php echo T_("Father name"); ?>' value="<?php echo \dash\data::dataRowMember_father(); ?>" maxlength='50'>
			</div>
	   </div>
	   <div class="c">
			<label for="birthday"><?php echo T_("Birthday"); ?></label>
			<div class="input ltr">
			  <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date"  name="birthday" id="birthday"  value="<?php echo \dash\data::dataRowMember_jalali_birthday(); ?>"  autocomplete='off'>
			</div>
	   </div>
	 </div>

	<label for="mobile"><?php echo T_("Mobile"); ?></label>
	<div class="input">
	  <input type="tel" name="mobile" id="mobile" placeholder='<?php echo T_("Like 09120123456"); ?>' value="<?php echo \dash\data::dataRowMember_mobile(); ?>" maxlength='30'>
	</div>

	  <div class="mB10">
	  <label for='nationality'><?php echo T_("Nationality"); ?></label>
	  <div class="ui fluid search selection dropdown">
	    <input type="hidden" name="nationality" value="<?php if(\dash\data::dataRowMember_nationality()) {?><?php echo \dash\data::dataRowMember_nationality(); ?><?php }else{ ?>IR<?php } //endif ?>">
	    <i class="dropdown icon"></i>
	    <div class="default text"><?php echo T_("Choose your nationality"); ?></div>
	    <div class="menu">
	    	<?php foreach (\dash\data::countryList() as $key => $value) {?>

	      <div class="item" data-value="<?php echo $key; ?>">
	        <i class="<?php echo mb_strtolower($value['iso2']); ?> flag"></i><?php echo T_($value['name']); ?><small class="description"><?php echo ucfirst($value['name']); ?></small>
	      </div>
		<?php }//endfor ?>
	    </div>
	  </div>
	</div>
	  <div class="f" data-response='nationality' data-response-where='IR' data-response-effect='slide' <?php if(\dash\data::dataRowMember_nationality() && \dash\data::dataRowMember_nationality() !== 'IR') { echo 'data-response-hide';}?>>

	   <div class="c s12 pRa5">
	   	<label for='nationalcode'><?php echo T_("National Id"); ?></label>
		<div class="input">
		 <input type="tel" name='nationalcode' id='nationalcode' value="<?php echo \dash\data::dataRowMember_nationalcode(); ?>" placeholder='<?php echo T_("10 digit national code"); ?>'  />
		</div>
	   </div>
	  </div>
	  <div class="f" data-response='nationality' data-response-where-not='IR' data-response-effect='slide' <?php if(\dash\data::dataRowMember_nationality() && \dash\data::dataRowMember_nationality() == 'IR') { echo 'data-response-hide';}?>>
	   <div class="c s12 pRa5">
	   	<label for='passport'><?php echo T_("Passport id"); ?> <small class="fc-red">* <?php echo T_("Require"); ?></small></label>
		<div class="input ltr">
		 <input name='pasportcode' id='passport' value="<?php echo \dash\data::dataRowMember_pasportcode(); ?>" placeholder='<?php echo T_("Passport id"); ?> *'   />
		</div>
	   </div>
	   <div class="c s12 pRa5">
	   	<label for='passportdate'><?php echo T_("Passport expire date"); ?> <small class="fc-red">* <?php echo T_("Require"); ?></small></label>
		<div class="input ltr">
		   <input class="datepicker" type="text" name="passportdate" id="passportdate"  value="<?php echo \dash\data::dataRowMember_pasportdate(); ?>" maxlength='20' autocomplete='off' >
		</div>
	   </div>
	  </div>

	<div class="f">
		<div class="c mRa10">
			<div class="mT10">
			  <label for="gender"><?php echo T_("Gender"); ?></label>
			  <select name="gender" class="ui dropdown select">
			    <option value="" readonly><?php echo T_("Please select one itme"); ?></option>
			    <option value="male" <?php if(\dash\data::dataRowMember_gender() == 'male') { echo 'selected';} ?> ><?php echo T_("Male"); ?></option>
			    <option value="female" <?php if(\dash\data::dataRowMember_gender() == 'female') { echo 'selected';} ?> ><?php echo T_("Female"); ?></option>
			  </select>
			</div>
		</div>
		<div class="c">
			<div class="mT10">
			  <label for="marital"><?php echo T_("Marital"); ?></label>
			  <select name="marital" class="ui dropdown select">
			    <option value="" readonly><?php echo T_("Please select one itme"); ?></option>
			    <option value="single" <?php if(\dash\data::dataRowMember_marital() == 'single') { echo 'selected';} ?>><?php echo T_("Single"); ?></option>
			    <option value="married" <?php if(\dash\data::dataRowMember_marital() == 'married') { echo 'selected';} ?>><?php echo T_("Married"); ?></option>
			  </select>
			</div>
		</div>
	</div>




	<label for="bio"><?php echo T_("Bio"); ?></label>
	<textarea class="txt " name="bio" maxlength='300' rows="3"><?php echo \dash\data::dataRowMember_bio(); ?></textarea>

	 <div class="f pA5 pT20">
		<button class="btn primary block mT20"><?php echo T_("Save"); ?></button>
	 </div>
	</form>
 </div>
</div>
