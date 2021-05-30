<?php $bank = \dash\data::bankSetting(); ?>

<form method="post" autocomplete="off">
	<input type="hidden" name="set_asanpardakht" value="1">
	<div class="avand-sm">
		<div class="box">
			<div class="pad">
				<div class="txtC">
					<i class="spay-128-asanpardakht"></i>
				</div>
				<br>
				<div class="ltr">
					<label for="MerchantID">MerchantID</label>
					<div class="input">
						<input type="text" name="aMerchantID" id="MerchantID" placeholder='MerchantID' value="<?php echo a($bank, 'asanpardakht','MerchantID'); ?>" maxlength='300'>
					</div>
					<label for="MerchantConfigID">MerchantConfigID</label>
					<div class="input">
						<input type="text" name="MerchantConfigID" id="MerchantConfigID" placeholder='MerchantConfigID' value="<?php echo a($bank, 'asanpardakht','MerchantConfigID'); ?>" maxlength='300'>
					</div>
					<label for="Username">Username</label>
					<div class="input">
						<input type="text" name="Username" id="Username" placeholder='Username' value="<?php echo a($bank, 'asanpardakht','Username'); ?>" maxlength='300'>
					</div>

					<label for="Password">Password</label>
					<div class="input">
						<input type="password" name="Password" id="Password" placeholder='Password' value="<?php echo a($bank, 'asanpardakht','Password'); ?>" maxlength='300'>
					</div>
					<label for="EncryptionKey">EncryptionKey</label>
					<div class="input">
						<input type="text" name="EncryptionKey" id="EncryptionKey" placeholder='EncryptionKey' value="<?php echo a($bank, 'asanpardakht','EncryptionKey'); ?>" maxlength='300'>
					</div>
					<label for="EncryptionVector">EncryptionVector</label>
					<div class="input">
						<input type="text" name="EncryptionVector" id="EncryptionVector" placeholder='EncryptionVector' value="<?php echo a($bank, 'asanpardakht','EncryptionVector'); ?>" maxlength='300'>
					</div>
					<label for="MerchantName">MerchantName</label>
					<div class="input">
						<input type="text" name="MerchantName" id="MerchantName" placeholder='MerchantName' value="<?php echo a($bank, 'asanpardakht','MerchantName'); ?>" maxlength='300'>
					</div>
				</div>
			</div>
			<footer class="f">
				<?php if(!a($bank, 'asanpardakht', 'empty')) {?>
					<div class="cauto"><div class="linkDel btn" data-confirm data-data='{"set_asanpardakht": 1, "delete" : "delete"}'><?php echo T_("Remove") ?></div></div>
				<?php } //endif ?>
				<div class="c"></div>
				<div class="cauto"><button class="btn master"><?php echo T_("Save") ?></button></div>
			</footer>
		</div>
	</div>
</form>