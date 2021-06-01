<?php $bank = \dash\data::bankSetting(); ?>

<form method="post" autocomplete="off">
	<input type="hidden" name="set_payir" value="1">
	<div class="avand-sm">
		<div class="box">
			<div class="pad">
				<img class="block" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/bank/payir.png" alt='Payir'>

				<div class="switch1 mT20">
				 <input type="checkbox" name="payir" id="payir" <?php if(a($bank, 'payir', 'status')) { echo 'checked';} ?> >
				 <label for="payir"></label>
				 <label for="payir"><?php echo T_("Enable payir payment"); ?></label>
				</div>

				<div class="ltr mT10" data-response='payir' <?php if(a($bank, 'payir', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >

					<label for="api">Api</label>
					<div class="input">
					  <input type="text" name="api" id="api" placeholder='api' value="<?php echo a($bank, 'payir','api'); ?>" maxlength='300'>
					</div>
				</div>
			</div>
			<footer class="f">
				<div class="cauto"><?php if(a($bank, 'payir', 'status')) { echo \dash\app\transaction\add::test_payment_link('payir'); }?></div>
				<div class="c"></div>
				<div class="cauto"><button class="btn master"><?php echo T_("Save") ?></button></div>
			</footer>
		</div>
	</div>
</form>