<form method="post" autocomplete="off" id="formfreedonate">
	<div class="avand-sm">
		<div class="box">
			<div class="pad">

				<input type="hidden" name="donate" value="donate">

				<label for="mobile"><?php echo T_("Mobile") ?></label>
				<div class="input">
					<input type="tel" id="mobile" name="mobile" value="<?php echo \dash\data::myMobile() ?>" data-format='mobile-enter' maxlength="15">
				</div>
				<label for="amount"><?php echo T_("Amount") ?></label>
				<div class="input">
					<input type="tel" id="amount" name="amount" value="<?php echo \dash\data::myAmount() ?>" data-format='price' maxlength="8">
				</div>
			</div>
			<footer>
				<button class="btn master block"><?php echo T_("Pay") ?></button>
			</footer>
		</div>
	</div>
</form>