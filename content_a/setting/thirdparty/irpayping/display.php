<?php $bank = \dash\data::bankSetting(); ?>

<form method="post" autocomplete="off">
	<input type="hidden" name="set_payping" value="1">
	<div class="avand-sm">
		<div class="box">
			<div class="pad">
				<img class="block" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/bank/payping.png" alt='PayPing'>

				<div class="switch1 mT20">
				 <input type="checkbox" name="payping" id="payping" <?php if(a($bank, 'payping', 'status')) { echo 'checked';} ?> >
				 <label for="payping"></label>
				 <label for="payping"><?php echo T_("Enable payping payment"); ?></label>
				</div>

				<div class="ltr mT10" data-response='payping' <?php if(a($bank, 'payping', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >

					<label for="token">Token</label>
					<div class="input">
					  <input type="text" name="token" id="token" placeholder='Token' value="<?php echo a($bank, 'payping','token'); ?>" maxlength='300'>
					</div>
				</div>
			</div>
			<footer class="f">
				<div class="cauto"><?php if(a($bank, 'payping', 'status')) { echo \dash\app\transaction\add::test_payment_link('payping'); }?></div>
				<div class="c"></div>
				<div class="cauto"><button class="btn master"><?php echo T_("Save") ?></button></div>
			</footer>
		</div>
	</div>
</form>