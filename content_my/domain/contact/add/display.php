


<div class="f justify-center">
	<div class="c6 m8 s12">
		<div class="f hide">
			<div class="c s12">

				<a class="dcard x1 <?php if(\dash\request::get('type') === 'old' || !\dash\request::get('type')) { echo 'active'; } ?>" href='<?php echo \dash\url::current(); ?>?type=old'>
				 <div class="statistic blue">
				  <div class="value"><i class="sf-arrow-circle-down"></i></div>
				  <div class="label"><?php echo T_("Add an existing account"); ?></div>
				 </div>
				</a>

			</div>

			<div class="c s12">

				<a class="dcard x1 <?php if(\dash\request::get('type') === 'new' ) { echo 'active'; } ?>" href='<?php echo \dash\url::current(); ?>?type=new'>
				 <div class="statistic green">
				  <div class="value"><i class="sf-plus-circle"></i></div>
				  <div class="label"><?php echo T_("Create new contact"); ?></div>
				 </div>
				</a>

			</div>
		</div>

		<?php if(\dash\request::get('type') === 'new') {?>

			<div class="cbox">
			<h3><?php echo T_("Create new account"); ?></h3>
			<form method="post" autocomplete="off">

				<label for="intitle"><?php echo T_("Title"); ?></label>
				<div class="input">
					<input type="text" name="title" id="intitle">
				</div>

				<div class="f">
					<div class="c6 s12">
						<label for="ifirstname"><?php echo T_("Firstname"); ?> <small class="fc-mute"><?php echo T_("Enter in Latin characters"); ?></small></label>
						<div class="input ltr">
							<input type="text" name="firstname" id="ifirstname" maxlength="100">
						</div>
					</div>
					<div class="c6 s12">
						<div class="mLa5">
							<label for="ilastname"><?php echo T_("Lastname"); ?> <small class="fc-mute"><?php echo T_("Enter in Latin characters"); ?></small></label>
							<div class="input ltr">
								<input type="text" name="lastname" id="ilastname" maxlength="100">
							</div>
						</div>
					</div>
				</div>

				<div class="f">
					<div class="c6 s12">
						<label for="inationalcode"><?php echo T_("Nationalcode or Passport number"); ?></label>
						<div class="input ltr">
							<input type="text" name="nationalcode" id="inationalcode" maxlength="30">
						</div>
					</div>

					<div class="c6 s12">
						<div class="mLa5">
							<label for="iemail"><?php echo T_("Email"); ?></label>
							<div class="input ltr">
								<input type="email" name="email" id="iemail" maxlength="100">
							</div>
						</div>
					</div>
				</div>


				<div class="mB10">
				  <label for='country'><?php echo T_("Country"); ?></label>
				  <select class="select22" name="country" id="country" data-model='country' data-next='#province' >
				    <option value=""><?php echo T_("Choose your country"); ?></option>

				    <?php foreach (\dash\data::countryList() as $key => $value) {?>

				      <option value="<?php echo $key; ?>" > <?php echo \dash\get::index($value, 'name'); if(\dash\language::current() !== 'en') { echo ' - '. T_(ucfirst(\dash\get::index($value, 'name'))); } ?></option>

					<?php } //endif ?>

				  </select>
				</div>

				<div class="mB10" data-status='hide'>
				  <label for='province'><?php echo T_("Province"); ?></label>
				  <select name="province" id="province" class="select22" data-next='#city' >
				    <option value="0"><?php echo T_("Please choose country"); ?></option>

				  </select>
				</div>

				<div class="mB10" data-status='hide'>
				  <label for='city'><?php echo T_("City"); ?></label>
				  <select name="city" id="city" class="select22">
				    <option value=""><?php echo T_("Please choose province"); ?></option>
				  </select>
				</div>



				<div class="f">
					<div class="c6 s12">

						<label for="postcode"><?php echo T_("Post code"); ?></label>
						<div class="input">
						  <input type="text" name="postcode" id="postcode" data-format="postalCode">
						</div>

					</div>
					<div class="c6 s12">
						<div class="mLa5">

							<label for="iphone"><?php echo T_("Phone"); ?></label>
							<div class="input">
							  <input type="text" name="phone" id="iphone" data-format="tel">
							</div>

						</div>
					</div>
				</div>

				<label for="address"><?php echo T_("Address"); ?> <small class="fc-mute"><?php echo T_("Enter in Latin characters"); ?></small></label>
				<textarea class="txt ltr mB10" name="address" id="address" maxlength='300' rows="2"></textarea>


				<div class="check1">
			      <input type="checkbox" name="agree" id="agree">
			      <label for="agree"><?php echo T_("I have read and agree to the terms and conditions"); ?> <small><a target="_blank" href="https://www.nic.ir/Domain_Register_Policy.html"><?php echo T_("Show terms"); ?></a></small></label>
			    </div>


				<div class="txtRa">
					<button class="btn success"><?php echo T_("Create IRNIC handle"); ?></button>
				</div>
			</form>
		</div>


		<?php }else{ ?>




			<div class="cbox">
				<form method="post" autocomplete="off">
					<label for="ioldcontact"><?php echo T_("IRNIC Handle"); ?></label>
					<div class="input ltr">
						<input type="text" name="oldcontact" id="ioldcontact">
					</div>
					<p class="fc-mute"><?php echo T_('Please enter your IRNIC handle that registerd on nic.ir'); ?></p>
					<p class="fc-mute"><?php echo T_("If you don't know about IRNIC, you can register via Jibres or directly on nic.ir website."); ?> <a href="<?php echo \dash\url::current(); ?>?type=new"><?php echo T_('Register IRNIC handle'); ?></a></p>

					<div class="txtRa">
						<button class="btn success"><?php echo T_("Add IRNIC handle"); ?></button>
					</div>
				</form>
			</div>


		<?php } //endif ?>


	</div>
</div>

