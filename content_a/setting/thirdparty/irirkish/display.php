<?php $bank = \dash\data::bankSetting(); ?>

<form method="post" autocomplete="off">
	<input type="hidden" name="set_irkish" value="1">
	<div class="avand-sm">
		<div class="box">
			<div class="pad">
				<img class="block" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/bank/irkish.jpg" alt='Irkish'>

				<div class="switch1 mT20">
				 <input type="checkbox" name="irkish" id="irkish" <?php if(a($bank, 'irkish', 'status')) { echo 'checked';} ?> >
				 <label for="irkish"></label>
				 <label for="irkish"><?php echo T_("Enable irkish payment"); ?></label>
				</div>

				<div class="ltr mT10" data-response='irkish' <?php if(a($bank, 'irkish', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >
					<label for="merchantId">merchantId</label>
					<div class="input">
						<input type="text" name="imerchantId" id="merchantId" placeholder='merchantId' value="<?php echo a($bank, 'irkish','merchantId'); ?>" maxlength='300'>
					</div>
					<label for="sha1">sha1</label>
					<div class="input">
						<input type="text" name="sha1" id="sha1" placeholder='sha1' value="<?php echo a($bank, 'irkish','sha1'); ?>" maxlength='500'>
					</div>
				</div>
			</div>
			<footer class="f">
				<div class="cauto"><?php if(a($bank, 'irkish', 'status')) { echo \dash\app\transaction\add::test_payment_link('irkish'); }?></div>
				<div class="c"></div>
				<div class="cauto"><button class="btn master"><?php echo T_("Save") ?></button></div>
			</footer>
		</div>
	</div>
</form>