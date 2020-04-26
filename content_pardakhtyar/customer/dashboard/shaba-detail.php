
<?php function XIbanDetail() {?>
<div class="f">
	<div class="c5">
		<?php if(\dash\data::dataRowIban() && is_array(\dash\data::dataRowIban())) {
			foreach (\dash\data::dataRowIban() as $key => $value) {?>
		<form method="post" autocomplete="off" class="mA5">

			<input type="hidden" name="formSubmitType" value="iban">
			<input type="hidden" name="ibanid" value="<?php echo \dash\get::index($value, 'id'); ?>">
			<div class="input">
				<div data-confirm data-data='{"formSubmitType" : "removeIban", "ibanidremove" : "<?php echo \dash\get::index($value, 'id'); ?>"}'  class="addon btn danger2"><?php echo T_("Remove"); ?></div>
				<input type="text" name="merchantIban" value="<?php echo \dash\get::index($value, 'merchantIban'); ?>">
				<button class="addon btn primary"><?php echo T_("Update"); ?></button>
			</div>
		</form>
		<?php } //endfor
			} // endif
		?>

	</div>
	<div class="c"></div>

	<div class="c5 mLa20">
		<form method="post" autocomplete="off">
			<input type="hidden" name="formSubmitType" value="iban">
				<label for="i_merchantIban">merchantIban <span class="mLa10">شماره شبا</span></label>
				<div class="input">
					<input type="text" name="merchantIban" id="i_merchantIban" value="<?php echo \dash\data::dataRowCustomer_merchantIban(); ?>" maxlength="34" minlength="26">
				</div>

			<div class="txtRa">
				<button class="btn success"><?php echo T_("Add"); ?></button>
			</div>
		</form>

	</div>
</div>
<?php } //endfunction ?>
