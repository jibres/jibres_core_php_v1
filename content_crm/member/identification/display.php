<?php require_once(root. 'content_crm/member/userDetail.php'); ?>

	<form method="post" autocomplete="off">
		<div class="box">
			<div class="body">
				<div class="f">
					<div class="c pRa5">
						<label for="name"><?php echo T_("Name"); ?></label>
						<div class="input">
							<input type="text" name="name" id="name" placeholder='<?php echo T_("Name"); ?>' value="<?php echo \dash\data::dataRowMember_firstname(); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='40' minlength="1" pattern=".{1,40}" >
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
							<input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date"  name="birthday" id="birthday"  value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::date(\dash\data::dataRowMember_birthday())); ?>"  autocomplete='off'>
						</div>
					</div>
				</div>

				<div class="f mB20">
					<div class="c mRa10">
						<div class="mT10">
							<label for="gender"><?php echo T_("Gender"); ?></label>
							<select name="gender" class="select22">
								<option value="" readonly><?php echo T_("Please select one itme"); ?></option>
								<option value="male" <?php if(\dash\data::dataRowMember_gender() == 'male') { echo 'selected';} ?> ><?php echo T_("Male"); ?></option>
								<option value="female" <?php if(\dash\data::dataRowMember_gender() == 'female') { echo 'selected';} ?> ><?php echo T_("Female"); ?></option>
							</select>
						</div>
					</div>
					<div class="c">
						<div class="mT10">
							<label for="marital"><?php echo T_("Marital"); ?></label>
							<select name="marital" class="select22">
								<option value="" readonly><?php echo T_("Please select one itme"); ?></option>
								<option value="single" <?php if(\dash\data::dataRowMember_marital() == 'single') { echo 'selected';} ?>><?php echo T_("Single"); ?></option>
								<option value="married" <?php if(\dash\data::dataRowMember_marital() == 'married') { echo 'selected';} ?>><?php echo T_("Married"); ?></option>
							</select>
						</div>
					</div>
				</div>


				<div class="mB10">
					<label for='country'><?php echo T_("Nationality"); ?></label>
					<select class="select22" name="nationality" id="country" data-model='country' >
						<option value=""><?php echo T_("Choose your country"); ?></option>
						<?php foreach (\dash\data::countryList() as $key => $value) {?>

							<option value="<?php echo $key; ?>" <?php if(\dash\data::dataRowMember_nationality() == $key) { echo 'selected';} ?>><?php echo ucfirst($value['name']); if(\dash\language::current() != 'en') { echo ' - '. T_(ucfirst($value['name']));} ?></option>

						<?php } //endif ?>
					</select>
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
							<input data-format='date' type="text" name="passportdate" id="passportdate"  value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::date(\dash\data::dataRowMember_pasportdate())); ?>" maxlength='20' autocomplete='off' >
						</div>
					</div>
				</div>


				<?php if(false) {?>

				<?php $detail = \dash\data::dataRowMember_detail(); ?>

				<div class="mB10">
					<label for="file1"><?php echo T_("ID card image"); ?></label>
					<div data-uploader data-name='file1' data-final='#finalImagefile1'>
						<input type="file" accept="image/*" id="file1">
						<label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
						<label for="file1"><img id="finalImagefile1" <?php if(\dash\data::dataRow_inquiryimage()) {?>src="<?php echo \dash\data::dataRow_inquiryimage(); ?>" <?php } //endif ?> alt="<?php echo T_("File") ?>"></label>
					</div>
				</div>

				<?php if(isset($detail['file1'])) {?><a href="<?php echo a($detail, 'file1'); ?>" target="_blank"><img class="size-we200 block mLRa" src="<?php echo a($detail, 'file1'); ?>"></a><?php } // endif ?>


				<div class="mB10">
					<label for="file2"><?php echo T_("National card photo"); ?></label>
					<div data-uploader data-name='file2' data-final='#finalImagefile2'>
						<input type="file" accept="image/*" id="file2">
						<label for="file2"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
						<label for="file2"><img id="finalImagefile2" <?php if(\dash\data::dataRow_inquiryimage()) {?>src="<?php echo \dash\data::dataRow_inquiryimage(); ?>" <?php } //endif ?> alt="<?php echo T_("File") ?>"></label>
					</div>
				</div>

				<?php if(isset($detail['file2'])) {?><a href="<?php echo a($detail, 'file2'); ?>" target="_blank"><img class="size-we200 block mLRa" src="<?php echo a($detail, 'file2'); ?>"></a><?php } // endif ?>

			<?php } //endif ?>

			</div>
			<footer class="txtRa">
				<button class="btn master"><?php echo T_("Save") ?></button>
			</footer>
		</div>
	</form>
