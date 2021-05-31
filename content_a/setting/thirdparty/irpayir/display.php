<?php $bank = \dash\data::bankSetting(); ?>

<form method="post" autocomplete="off">
	<input type="hidden" name="set_payir" value="1">
	<div class="avand-sm">
		<div class="box">
			<div class="pad">
				<div class="txtC">
					<i class="spay-128-payir"></i>
				</div>
				<br>

				<div class="switch1">
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
				<?php if(!a($bank, 'payir', 'empty')) {?>
					<div class="cauto"><div class="linkDel btn" data-confirm data-data='{"set_payir": 1, "delete" : "delete"}'><?php echo T_("Remove") ?></div></div>
				<?php } //endif ?>
				<div class="c"></div>
				<div class="cauto"><button class="btn master"><?php echo T_("Save") ?></button></div>
			</footer>
		</div>
	</div>
</form>