
<div class="f justify-center">
	<div class="c6 m8 s12">
		<div class="cbox">

			<form method="post" autocomplete="off" class="mB20" >

				<label for="irnicid"><?php echo T_("IRNIC contact"); ?> <small><a href="<?php echo \dash\url::this(); ?>/contact/add"><?php echo T_("Create new IRNIC contact"); ?></a></small></label>
				<select name="irnicid" class="select ui dropdown search addition" id="irnicid">
				<option value=""><?php echo T_("IRNIC contact id"); ?></option>

				<?php foreach (\dash\data::myContactList() as $key => $value) {?>

				  <option value="<?php echo \dash\get::index($value, 'nic_id'); ?>" <?php if(isset($value['isdefault']) && $value['isdefault']) { echo "selected"; } ?>><?php echo \dash\get::index($value, 'nic_id'); ?></option>

				<?php } //endfor ?>

				</select>

				<label for="domain"><?php echo T_("Domain"); ?></label>
				<div class="input ltr">
					<input type="text" name="domain"  id="domain" maxlength="100">
				</div>

				<label for="ips"><?php echo T_("Transfer code"); ?></label>
				<div class="input ltr">
					<input type="text" name="pin"  id="ips" maxlength="100">
				</div>

			    <div class="check1">
			      <input type="checkbox" name="agree" id="agree">
			      <label for="agree"><?php echo T_("I have read and agree to the terms and conditions"); ?> <small><a target="_blank" href="https://www.nic.ir/Domain_Register_Policy.html"><?php echo T_("Show terms"); ?></a></small></label>
			    </div>

				<div class="txtRa">
					<button class="btn success"><?php echo T_("Transfer"); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>


