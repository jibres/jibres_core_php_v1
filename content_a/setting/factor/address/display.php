<form method="post" autocomplete="off">
	<div class="avand-md">
		<div class="box">
			<div class="pad">
				<div class="mB10">
					<label for='country'><?php echo T_("Country"); ?></label>
					<select class="select22" name="country" id="country" data-model='country' data-next='#province' data-next-default='<?php echo \dash\data::dataRow_factor_province(); ?>'>
						<option value=""><?php echo T_("Choose your country"); ?></option>
						<?php foreach (\dash\data::countryList() as $key => $value) {?>

							<option value="<?php echo $key; ?>" <?php if(\dash\data::dataRow_factor_country() == $key) { echo 'selected';} ?>><?php echo ucfirst($value['name']); if(\dash\language::current() != 'en') { echo ' - '. T_(ucfirst($value['name']));} ?></option>

						<?php } //endif ?>
					</select>
				</div>


				<div class="mB10" data-status='hide'>
					<label for='province'><?php echo T_("Province"); ?></label>
					<select name="province" id="province" class="select22" data-next='#city' data-next-default='<?php echo \dash\data::dataRow_factor_city(); ?>'>
						<option value="0"><?php echo T_("Please choose country"); ?></option>
						<option value="<?php echo \dash\data::dataRow_factor_province(); ?>" selected><?php echo \dash\data::dataRow_factor_province(); ?></option>
					</select>
				</div>


				<div class="mB10" data-status='hide'>
					<label for='city'><?php echo T_("City"); ?></label>
					<select name="city" id="city" class="select22">
						<option value=""><?php echo T_("Please choose province"); ?></option>
					</select>
				</div>

				<label for="address"><?php echo T_("Address"); ?></label>
				<textarea class="txt mB10 pB25" name="address" id="address" maxlength='300' rows="2"><?php echo \dash\data::dataRow_factor_address(); ?></textarea>

				<label for="postcode"><?php echo T_("Post code"); ?></label>
				<div class="input">
					<input type="text" name="postcode" id="postcode" value="<?php echo \dash\data::dataRow_factor_postcode(); ?>" data-format="postalCode">
				</div>

				<label for="iphone"><?php echo T_("Phone"); ?></label>
				<div class="input">
					<input type="text" name="phone" id="iphone" value="<?php echo \dash\data::dataRow_factor_phone(); ?>" data-format="tel">
				</div>


			</div>
			<footer class="txtRa">
				<button class="btn master"><?php echo T_("Save"); ?></button>
			</footer>
		</div>
	</div>
</form>
