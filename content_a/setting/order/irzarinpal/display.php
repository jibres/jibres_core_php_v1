<?php $bank = \dash\data::bankSetting(); ?>

<form method="post" autocomplete="off">
	<input type="hidden" name="set_zarinpal" value="1">
	<div class="avand-sm">
		<div class="box">
			<div class="pad">
				<div class="txtC">
					<i class="spay-128-zarinpal"></i>
				</div>
				<br>
					<div class="ltr">
						<label for="zMerchantID">MerchantID</label>
						<div class="input">
						  <input type="text" name="zMerchantID" id="zMerchantID" placeholder='zMerchantID' value="<?php echo a($bank, 'zarinpal','MerchantID'); ?>" maxlength='300'>
						</div>
					</div>
			</div>
			<footer class="f">
				<?php if(!a($bank, 'zarinpal', 'empty')) {?>
					<div class="cauto"><div class="linkDel btn" data-confirm data-data='{"set_zarinpal": 1, "delete" : "delete"}'><?php echo T_("Remove") ?></div></div>
				<?php } //endif ?>
				<div class="c"></div>
				<div class="cauto"><button class="btn master"><?php echo T_("Save") ?></button></div>

			</footer>
		</div>
	</div>
</form>