<?php $bank = \dash\data::bankSetting(); ?>

<form method="post" autocomplete="off">
	<input type="hidden" name="set_zarinpal" value="1">
	<div class="avand-sm">
		<div class="box">
			<div class="pad">
				<img class="block" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/bank/zarinpal.svg" alt='ZarinPal'>

				<div class="switch1 mT50">
					<input type="checkbox" name="zarinpal" id="zarinpal" <?php if(a($bank, 'zarinpal', 'status')) { echo 'checked';} ?> >
					<label for="zarinpal"></label>
					<label for="zarinpal"><?php echo T_("Enable zarinpal payment"); ?></label>
				</div>

				<div class="ltr mt-2" data-response='zarinpal' <?php if(a($bank, 'zarinpal', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >

					<label for="zMerchantID">MerchantID</label>
					<div class="input">
						<input type="text" name="zMerchantID" id="zMerchantID" placeholder='zMerchantID' value="<?php echo a($bank, 'zarinpal','MerchantID'); ?>" maxlength='300'>
					</div>
				</div>
			</div>
			<footer class="f">
				<div class="cauto"><?php if(a($bank, 'zarinpal', 'status')) { echo \dash\app\transaction\add::test_payment_link('zarinpal'); }?></div>
				<div class="c"></div>
				<div class="cauto"><button class="btn master"><?php echo T_("Save") ?></button></div>
			</footer>
		</div>
	</div>
</form>