<div class="avand-xl">
	<?php require_once(root. 'content_crm/member/userDetail.php'); ?>
	<?php if(false) {?>
		<?php if(!\dash\data::accountingDetailsId()) {?>
			<form method="post" autocomplete="off">
				<div class="box">
					<div class="body">
						<input type="hidden" name="accounting" value="accounting">
						<p>
							<?php echo T_("When entering an invoice for this legal entity in the accounting department, what detailed code should be registered for this invoice?") ?>
						</p>
						<?php if(\dash\data::assistantList()) {?>
							<label for="assistant_id"><?php echo T_("Parent") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
							<select class="select22" name="assistant_id">
								<option value=""><?php echo T_("Please choose assistant_id") ?></option>
								<?php foreach (\dash\data::assistantList() as $key => $value) {?>
									<option value="<?php echo \dash\get::index($value, 'id') ?>"><?php echo \dash\get::index($value, 'full_title'); ?></option>
								<?php } // endfor ?>
							</select>
						<?php } // endif ?>

						<label for="iaccountindetailname"><?php echo T_("Accounting detail name"); ?></label>
						<div class="input">
							<input type="text" name="accountindetailname" id="iaccountindetailname" value="<?php echo \dash\data::dataRowMember_displayname(); ?>" maxlength="40">
						</div>
					</div>
					<footer class="f">
						<div class="cauto"><a class="btn link" href="<?php echo \dash\url::kingdom(). '/a/accounting/coding'; ?>"><?php echo T_("Maname accounting coding") ?></a></div>
						<div class="c"></div>
						<div class="cauto"><button class="btn master"><?php echo T_("Save") ?></button></div>
					</footer>
				</div>
			</form>
		<?php }else{ ?>

			<div class="box">
				<header><h2><?php echo T_("Accounting") ?></h2></header>
				<div class="body">
					<div class="msg success2"><?php echo \dash\data::accountingDetailsId_full_title() ?></div>
				</div>

				<footer class="f">
					<div class="cauto"><div data-confirm data-data='{"accounting" : "accounting", "removeassistant" : "removeassistant"}' class="btn linkDel"><?php echo T_("Disconnect") ?></div></div>
					<div class="c"></div>
					<div class="cauto"><a class="btn link" href="<?php echo \dash\url::kingdom(). '/a/accounting/coding?q='. \dash\data::accountingDetailsId_title(); ?>"><?php echo T_("Maname accounting coding") ?></a></div>

				</footer>
			</div>

		<?php } //endif ?>
	<?php } //endif ?>

	<form class="box" method="post" autocomplete="off">
		<div class="body">

			<div class="row">
				<div class="c-xs-12 c-sm-6">
					<label for="icompanyname"><?php echo T_("Company name"); ?></label>
					<div class="input">
						<input type="text" name="companyname" id="icompanyname" value="<?php echo \dash\data::dataRowLegal_companyname(); ?>" maxlength="100">
					</div>
				</div>

				<div class="c-xs-12 c-sm-6">
					<label for="iceonationalcode"><?php echo T_("CEO nationalcode"); ?></label>
					<div class="input">
						<input type="text" name="ceonationalcode" id="iceonationalcode" value="<?php echo \dash\data::dataRowLegal_ceonationalcode(); ?>" data-format='nationalCode'>
					</div>
				</div>

				<div class="c-xs-12 c-sm-4">
					<label for="icompanyregisternumber"><?php echo T_("Company register number"); ?></label>
					<div class="input">
						<input type="text" name="companyregisternumber" id="icompanyregisternumber" value="<?php echo \dash\data::dataRowLegal_companyregisternumber(); ?>" data-format='int' maxlength="10">
					</div>
				</div>

				<div class="c-xs-12 c-sm-4">
					<label for="icompanynationalid"><?php echo T_("Company national id"); ?></label>
					<div class="input">
						<input type="text" name="companynationalid" id="icompanynationalid" value="<?php echo \dash\data::dataRowLegal_companynationalid(); ?>" data-format='int' maxlength="11">
					</div>
				</div>

				<div class="c-xs-12 c-sm-4">
					<label for="icompanyeconomiccode"><?php echo T_("Economic code"); ?></label>
					<div class="input">
						<input type="text" name="companyeconomiccode" id="icompanyeconomiccode" value="<?php echo \dash\data::dataRowLegal_companyeconomiccode(); ?>" data-format='int' maxlength="12">
					</div>
				</div>


				<div class="c-xs-12 c-sm-12">

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
				</div>

				<div class="c-xs-12 c-sm-6">
					<label for="postcode"><?php echo T_("Post code"); ?></label>
					<div class="input ltr">
						<input type="text" name="postcode" id="postcode" value="<?php echo \dash\data::dataRowLegal_postcode(); ?>" data-format="postalCode" >
					</div>
				</div>
				<div class="c-xs-12 c-sm-6">
					<label for="iphone"><?php echo T_("Phone"); ?></label>
					<div class="input">
						<input type="text" name="phone" id="iphone" value="<?php echo \dash\data::dataRowLegal_phone(); ?>" data-format="tel">
					</div>

				</div>
				<div class="c-xs-12 c-sm-6">

					<label for="ifax"><?php echo T_("Fax"); ?></label>
					<div class="input">
						<input type="text" name="fax" id="ifax" value="<?php echo \dash\data::dataRowLegal_fax(); ?>" data-format="tel">
					</div>
				</div>
				<div class="c-xs-12 c-sm-6">

					<label for="iurl"><?php echo T_("Url"); ?></label>
					<div class="input">
						<input type="url" name="url" id="iurl" value="<?php echo \dash\data::dataRowLegal_url(); ?>" >
					</div>
				</div>
			</div>


		</div>


		<footer class="txtRa">
			<button class="btn primary" name="btn" value="add"><?php echo T_("Save"); ?></button>
		</footer>

	</form>
</div>


