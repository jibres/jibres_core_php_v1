

<div class="avand">
	<div class="box">
		<header><h2><?php echo T_("Choose your address") ?></h2></header>
		<div class="body">
			<form method="post" autocomplete="off">
			<?php if(\dash\user::login()) {?>
				<?php if(\dash\data::addressDataTable()) {?>

					<?php foreach (\dash\data::addressDataTable() as $key => $value) {?>

						<div class="radio3 mB10">
							<input  id="address<?php echo $key; ?>" type="radio" name="address_id" value="<?php echo \dash\get::index($value, 'id'); ?>" <?php if(count(\dash\data::addressDataTable()) === 1) {echo 'checked';} ?>>
							<label for="address<?php echo $key; ?>"><?php echo \dash\get::index($value, 'address'); ?></label>
						</div>

					<?php } //endfor ?>

				<?php } // endif ?>
				<h3 data-kerkere='.addNewAddress' data-kerkere-icon><?php echo T_("Add new address") ?></h3>
				<div class="addNewAddress fs08" <?php if(\dash\data::addressDataTable()) {?> data-kerkere-content='hide' <?php } // endif ?>>
					<?php bAddressAdd(); ?>
				</div>
				<?php bPaymentList(); ?>

				<button class="btn master" type="submit" name="button" value="saveorder"><?php echo T_("Pay"); ?></button>

			<?php }else{ //else ?>

				<?php bAddressAdd(); ?>
				<?php bPaymentList(); ?>
				<button class="btn master" type="submit" name="button" value="saveorder"><?php echo T_("Pay"); ?></button>
			<?php } // endif ?>

			</form>
		</div>


	</div>



	<?php if(\dash\data::dataTable()) {?>

		<div class="row mT10">

			<?php foreach (\dash\data::dataTable() as $key => $value) {?>
				<div class="c-xs-12 c-sm-6 c-lg-4 c-xxl-3">
					<a class="jProduct1" href="<?php echo \dash\get::index($value, 'url'); ?>">
						<img src="<?php echo \dash\get::index($value, 'thumb') ?>" alt="<?php echo \dash\get::index($value, 'title') ?>">
						<footer>
							<div class="title"><?php echo \dash\get::index($value, 'title') ?></div>
							<div class="price"><span><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?></span> <span class="unit"><?php echo \dash\get::index($value, 'unit'); ?></span></div>
							<div class="title"><?php echo \dash\fit::number(\dash\get::index($value, 'count')); ?></div>

						</footer>
					</a>
				</div>
			<?php } //endfor ?>
		</div>
	<?php }else{ // no product in cart ?>
		<div class="msg warn2 txtC txtB fs14"><?php echo T_("No product in your cart") ?></div>
	<?php } //endif ?>
</div>




<?php function bPaymentList() {?>
	<?php if(\dash\data::paymentWay()) {?>

		<?php foreach (\dash\data::paymentWay() as $key => $value) {?>

			<div class="radio3 mB10">
				<input  id="payway<?php echo $key; ?>" type="radio" name="payway" value="<?php echo \dash\get::index($value, 'key'); ?>" <?php if($key === 'online') { echo 'checked';} ?>>
				<label for="payway<?php echo $key; ?>"><?php echo \dash\get::index($value, 'title'); ?></label>
			</div>

		<?php } //endfor ?>

	<?php } // endif ?>
<?php } //endfunction ?>




<?php function bAddressAdd() {?>


      <label for="name"><?php echo T_("Name"); ?></label>
      <div class="input">
        <input type="text" name="name" id="name" value="<?php if(\dash\data::dataRowAddress_name()) { echo \dash\data::dataRowAddress_name(); }elseif(\dash\data::dataRowMember()) { echo \dash\data::dataRowMember_displayname(); }elseif(!\dash\data::dataRowAddress()) { echo \dash\user::detail('displayname');}?>" maxlength='40' minlength="1" placeholder='<?php echo T_("Name of person in this address"); ?>'>
      </div>


      <div class="mB10">
          <label for='country'><?php echo T_("Country"); ?></label>
          <select class="select22" name="country" id="country" data-model='country' data-next='#province' data-next-default='<?php echo \dash\data::dataRowAddress_province(); ?>'>
            <option value=""><?php echo T_("Choose your country"); ?></option>
            <?php foreach (\dash\data::countryList() as $key => $value) {?>

              <option value="<?php echo $key; ?>" <?php if(\dash\data::dataRowAddress_country() == $key) { echo 'selected';} ?>><?php echo ucfirst($value['name']); if(\dash\language::current() != 'en') { echo ' - '. T_(ucfirst($value['name']));} ?></option>

            <?php } //endif ?>
          </select>
        </div>


        <div class="mB10" data-status='hide'>
          <label for='province'><?php echo T_("Province"); ?></label>
          <select name="province" id="province" class="select22" data-next='#city' data-next-default='<?php echo \dash\data::dataRowAddress_city(); ?>'>
            <option value="0"><?php echo T_("Please choose country"); ?></option>
            <option value="<?php echo \dash\data::dataRowAddress_province(); ?>" selected><?php echo \dash\data::dataRowAddress_province(); ?></option>
          </select>
        </div>


        <div class="mB10" data-status='hide'>
          <label for='city'><?php echo T_("City"); ?></label>
          <select name="city" id="city" class="select22">
            <option value=""><?php echo T_("Please choose province"); ?></option>
          </select>
        </div>


      <label for="address"><?php echo T_("Address"); ?> <small class="fc-red"><?php echo T_("Require"); ?></small></label>
      <textarea class="txt mB10 pB25" name="address" required maxlength='300' rows="2"><?php echo \dash\data::dataRowAddress_address(); ?></textarea>

      <label for="postcode"><?php echo T_("Post code"); ?></label>
      <div class="input ltr">
        <input type="text" name="postcode" id="postcode" value="<?php echo \dash\data::dataRowAddress_postcode(); ?>" data-format="postalCode" >
      </div>

    <div class="f">
      <div class="c pRa5">



          <label for="iphone"><?php echo T_("Phone"); ?></label>
          <div class="input">
            <input type="text" name="phone" id="iphone" value="<?php echo \dash\data::dataRowAddress_phone(); ?>" data-format="tel">
          </div>

      </div>
      <div class="c">

        <label for="iMobile"><?php echo T_("Mobile"); ?></label>
        <div class="input">
          <input type="tel" name="mobile" id="iMobile" value="<?php if(\dash\data::dataRowAddress_mobile()) { echo \dash\data::dataRowAddress_mobile(); }elseif(\dash\data::dataRowMember_mobile()){ echo \dash\data::dataRowMember_mobile();}elseif(!\dash\data::dataRowAddress()){ echo \dash\user::detail('mobile');} ?>" data-format="tel">
        </div>


      </div>
    </div>

    <div class="switch1 mB20 mT20">
     <input type="checkbox" name="company" id="company" <?php if(\dash\data::dataRowAddress_company())  { echo 'checked'; } ?>>
     <label for="company" data-on='<?php echo T_("Yes"); ?>' data-off='<?php echo T_("No"); ?>'></label>
     <label for="company" ><?php echo T_("Is this a company's address?"); ?></label>
    </div>

    <?php if(\dash\user::login()) {?>
    	<button class="btn master mTB20" name="save_address" value="new_address"><?php echo T_("Save address"); ?></button>
	<?php } //endif ?>


<?php } //endfunction ?>
