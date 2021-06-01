<?php $bank = \dash\data::bankSetting(); ?>

<form method="post" autocomplete="off">
	<input type="hidden" name="set_parsian" value="1">
	<div class="avand-sm">
		<div class="box">
			<div class="pad">
				<img class="block" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/bank/parsian.png" alt='Parsian'>

				<div class="switch1 mT20">
				 <input type="checkbox" name="parsian" id="parsian" <?php if(a($bank, 'parsian', 'status')) { echo 'checked';} ?> >
				 <label for="parsian"></label>
				 <label for="parsian"><?php echo T_("Enable parsian payment"); ?></label>
				</div>

				<div class="ltr mT10" data-response='parsian' <?php if(a($bank, 'parsian', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >

					<label for="LoginAccount">LoginAccount</label>
					<div class="input">
					  <input type="text" name="LoginAccount" id="LoginAccount" placeholder='LoginAccount' value="<?php echo a($bank, 'parsian','LoginAccount'); ?>" maxlength='300'>
					</div>
				</div>
			</div>
			<footer class="f">
				<div class="cauto"><?php if(a($bank, 'parsian', 'status')) { echo \dash\app\transaction\add::test_payment_link('parsian'); }?></div>
				<div class="c"></div>
				<div class="cauto"><button class="btn master"><?php echo T_("Save") ?></button></div>
			</footer>
		</div>
	</div>
</form>