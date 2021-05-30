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
				<div class="ltr">

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
				<?php if(!a($bank, 'idpay', 'empty')) {?>
					<div class="cauto"><div class="linkDel btn" data-confirm data-data='{"set_idpay": 1, "delete" : "delete"}'><?php echo T_("Remove") ?></div></div>
				<?php } //endif ?>
				<div class="c"></div>
				<div class="cauto"><button class="btn master"><?php echo T_("Save") ?></button></div>
			</footer>
		</div>
	</div>
</form>