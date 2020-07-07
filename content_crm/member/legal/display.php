



<?php require_once(root. 'content_crm/member/pageSteps.php'); ?>

<div class="f">

	<div class="cauto s12 pA5">
		<?php require_once(root. 'content_crm/member/psidebar.php'); ?>

	</div>

	<div class="c s12 pA5">

		<form class="cbox" method="post" autocomplete="off">

			<label for="icompanyname"><?php echo T_("Company name"); ?></label>
			<div class="input">
				<input type="text" name="companyname" id="icompanyname" value="<?php echo \dash\data::dataRowLegal_companyname(); ?>" maxlength="40">
			</div>


			<label for="icompanyregisternumber"><?php echo T_("Company register number"); ?></label>
			<div class="input">
				<input type="text" name="companyregisternumber" id="icompanyregisternumber" value="<?php echo \dash\data::dataRowLegal_companyregisternumber(); ?>" data-format='int' maxlength="10">
			</div>

			<label for="icompanynationalid"><?php echo T_("Company national id"); ?></label>
			<div class="input">
				<input type="text" name="companynationalid" id="icompanynationalid" value="<?php echo \dash\data::dataRowLegal_companynationalid(); ?>" data-format='int' maxlength="11">
			</div>

			<label for="icompanyeconomiccode"><?php echo T_("Economic code"); ?></label>
			<div class="input">
				<input type="text" name="companyeconomiccode" id="icompanyeconomiccode" value="<?php echo \dash\data::dataRowLegal_companyeconomiccode(); ?>" data-format='int' maxlength="12">
			</div>


			<label for="iceonationalcode"><?php echo T_("CEO nationalcode"); ?></label>
			<div class="input">
				<input type="text" name="ceonationalcode" id="iceonationalcode" value="<?php echo \dash\data::dataRowLegal_ceonationalcode(); ?>" data-format='nationalCode'>
			</div>




			<div class="mB10">
				<label for='country'><?php echo T_("Country"); ?></label>
				<select class="select22" name="country" id="country" data-model='country' data-next='#province' data-next-default='<?php echo \dash\data::dataRowLegal_province(); ?>'>
					<option value=""><?php echo T_("Choose your country"); ?></option>
					<?php foreach (\dash\data::countryList() as $key => $value) {?>

						<option value="<?php echo $key; ?>" <?php if(\dash\data::dataRowLegal_country() == $key) { echo 'selected';} ?>><?php echo ucfirst($value['name']); if(\dash\language::current() != 'en') { echo ' - '. T_(ucfirst($value['name']));} ?></option>

					<?php } //endif ?>
				</select>
			</div>


			<div class="mB10" data-status='hide'>
				<label for='province'><?php echo T_("Province"); ?></label>
				<select name="province" id="province" class="select22" data-next='#city' data-next-default='<?php echo \dash\data::dataRowLegal_city(); ?>'>
					<option value="0"><?php echo T_("Please choose country"); ?></option>
					<option value="<?php echo \dash\data::dataRowLegal_province(); ?>" selected><?php echo \dash\data::dataRowLegal_province(); ?></option>
				</select>
			</div>


			<div class="mB10" data-status='hide'>
				<label for='city'><?php echo T_("City"); ?></label>
				<select name="city" id="city" class="select22">
					<option value=""><?php echo T_("Please choose province"); ?></option>
				</select>
			</div>


			<label for="address"><?php echo T_("Address"); ?></label>
			<textarea class="txt mB10 pB25" name="address"  maxlength='300' rows="2"><?php echo \dash\data::dataRowLegal_address(); ?></textarea>

			<label for="postcode"><?php echo T_("Post code"); ?></label>
			<div class="input ltr">
				<input type="text" name="postcode" id="postcode" value="<?php echo \dash\data::dataRowLegal_postcode(); ?>" data-format="postalCode" >
			</div>




			<label for="iphone"><?php echo T_("Phone"); ?></label>
			<div class="input">
				<input type="text" name="phone" id="iphone" value="<?php echo \dash\data::dataRowLegal_phone(); ?>" data-format="tel">
			</div>

			<label for="ifax"><?php echo T_("Fax"); ?></label>
			<div class="input">
				<input type="text" name="fax" id="ifax" value="<?php echo \dash\data::dataRowLegal_fax(); ?>" data-format="tel">
			</div>



			<button class="btn primary block mT20" name="btn" value="add"><?php echo T_("Save"); ?></button>

		</form>
	</div>
</div>
