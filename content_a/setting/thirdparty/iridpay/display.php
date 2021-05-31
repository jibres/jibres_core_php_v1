<?php $bank = \dash\data::bankSetting(); ?>

<form method="post" autocomplete="off">
	<input type="hidden" name="set_idpay" value="1">
	<div class="avand-sm">
		<div class="box">
			<div class="pad">
				<div class="txtC">
					<i class="spay-128-idpay"></i>
				</div>
				<br>
				<div class="switch1">
				 <input type="checkbox" name="idpay" id="idpay" <?php if(a($bank, 'idpay', 'status')) { echo 'checked';} ?> >
				 <label for="idpay"></label>
				 <label for="idpay"><?php echo T_("Enable idpay payment"); ?></label>
				</div>

				<div class="ltr mT10" data-response='idpay' <?php if(a($bank, 'idpay', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >

					<label for="apikey">API KEY</label>
					<div class="input">
					  <input type="text" name="apikey" id="apikey" placeholder='apikey' value="<?php echo a($bank, 'idpay','apikey'); ?>" maxlength='300'>
					</div>

				</div>
			</div>
			<footer class="f">
				<?php if(!a($bank, 'idpay', 'empty')) {?>
					<div class="cauto"><div class="linkDel btn" data-confirm data-data='{"set_idpay": 1, "delete" : "delete"}'><?php echo T_("Remove") ?></div></div>
				<?php } //endif ?>
				<div class="c"></div>
				<div class="cauto"><button class="btn master"><?php echo T_("Save") ?></button></div>
			</footer>
		</div>
	</div>
</form>