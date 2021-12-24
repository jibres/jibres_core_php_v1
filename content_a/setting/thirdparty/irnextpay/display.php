<?php $bank = \dash\data::bankSetting(); ?>

<form method="post" autocomplete="off">
	<input type="hidden" name="set_nextpay" value="1">
	<div class="avand-sm">
		<div class="box">
			<div class="pad">
				<img class="block mb-5" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/bank/nextpay-banner.png" alt='nextPay'>
				<div class="switch1">
				 <input type="checkbox" name="nextpay" id="nextpay" <?php if(a($bank, 'nextpay', 'status')) { echo 'checked';} ?> >
				 <label for="nextpay"></label>
				 <label for="nextpay"><?php echo T_("Enable nextpay payment"); ?></label>
				</div>
				<div class="ltr mT10" data-response='nextpay' <?php if(a($bank, 'nextpay', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >
					<label for="apikey">API KEY</label>
					<div class="input">
					  <input type="text" name="apikey" id="apikey" placeholder='apikey' value="<?php echo a($bank, 'nextpay','apikey'); ?>" maxlength='300'>
					</div>
				</div>
			</div>
			<footer class="f">
				<div class="cauto"><?php if(a($bank, 'nextpay', 'status')) { echo \dash\app\transaction\add::test_payment_link('nextpay'); }?></div>
				<div class="c"></div>
				<div class="cauto"><button class="btn master"><?php echo T_("Save") ?></button></div>
			</footer>
		</div>
	</div>
</form>