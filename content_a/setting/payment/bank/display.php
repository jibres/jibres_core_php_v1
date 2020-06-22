<?php $bank = \dash\data::bankSetting(); ?>
<div class="avand-lg">
	<form method="post" autocomplete="off">
		<div class="box">
			<header><h2><?php echo T_("Configuration bank payment setting") ?></h2></header>
			<div class="body">
				<?php
					html_block_paymentMellat($bank);
					html_block_paymentZarinpal($bank);
					html_block_paymentAsanpardakht($bank);
					html_block_paymentParsian($bank);
					html_block_paymentPayir($bank);
					html_block_paymentIrankhis($bank);
				 ?>
			</div>
			<footer class="txtRa">
				<button class="btn success"><?php echo T_("Save"); ?></button>
			</footer>
		</div>
	</form>
</div>






<?php function html_block_paymentMellat($bank) {?>
<div class="switch1">
 <input type="checkbox" name="mellat" id="mellat" <?php if(\dash\get::index($bank, 'mellat', 'status')) { echo 'checked';} ?> >
 <label for="mellat"></label>
 <label for="mellat"><?php echo T_("Enable mellat payment"); ?></label>
</div>

<div class="f mT10" data-response='mellat' data-response-effect='slide' <?php if(\dash\get::index($bank, 'mellat', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >
	<div class="c4 pLa5">
		<label for="TerminalId">TerminalId</label>
		<div class="input">
		  <input type="text" name="TerminalId" id="TerminalId" placeholder='TerminalId' value="<?php echo \dash\get::index($bank, 'mellat','TerminalId'); ?>" maxlength='300'>
		</div>
	</div>


	<div class="c4 pLa5">
		<label for="UserName">UserName</label>
		<div class="input">
		  <input type="text" name="UserName" id="UserName" placeholder='UserName' value="<?php echo \dash\get::index($bank, 'mellat','UserName'); ?>" maxlength='300'>
		</div>
	</div>


	<div class="c4 pLa5">
		<label for="UserPassword">UserPassword</label>
		<div class="input">
		  <input type="password" name="UserPassword" id="UserPassword" placeholder='UserPassword' value="<?php echo \dash\get::index($bank, 'mellat','UserPassword'); ?>" maxlength='300'>
		</div>
	</div>


</div>

<?php } // endfunction ?>



<?php function html_block_paymentZarinpal($bank) {?>
<div class="switch1">
 <input type="checkbox" name="zarinpal" id="zarinpal" <?php if(\dash\get::index($bank, 'zarinpal', 'status')) { echo 'checked';} ?> >
 <label for="zarinpal"></label>
 <label for="zarinpal"><?php echo T_("Enable zarinpal payment"); ?></label>
</div>

<div class="f mT10" data-response='zarinpal' data-response-effect='slide' <?php if(\dash\get::index($bank, 'zarinpal', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >
	<div class="c mLa5">
		<label for="zMerchantID">MerchantID</label>
		<div class="input">
		  <input type="text" name="zMerchantID" id="zMerchantID" placeholder='zMerchantID' value="<?php echo \dash\get::index($bank, 'zarinpal','MerchantID'); ?>" maxlength='300'>
		</div>
	</div>

	<div class="c mLa5">
		<label for="Description">Description</label>
		<div class="input">
		  <input type="text" name="zDescription" id="Description" placeholder='Description' value="<?php echo \dash\get::index($bank, 'zarinpal','Description'); ?>" maxlength='300'>
		</div>
	</div>

</div>

<?php } // endfunction ?>



<?php function html_block_paymentAsanpardakht($bank) {?>
<div class="switch1">
 <input type="checkbox" name="asanpardakht" id="asanpardakht" <?php if(\dash\get::index($bank, 'asanpardakht', 'status')) { echo 'checked';} ?> >
 <label for="asanpardakht"></label>
 <label for="asanpardakht"><?php echo T_("Enable asanpardakht payment"); ?></label>
</div>

<div class="f mT10" data-response='asanpardakht' data-response-effect='slide' <?php if(\dash\get::index($bank, 'asanpardakht', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >
	<div class="c6 pLa5">
		<label for="MerchantID">MerchantID</label>
		<div class="input">
		  <input type="text" name="aMerchantID" id="MerchantID" placeholder='MerchantID' value="<?php echo \dash\get::index($bank, 'asanpardakht','MerchantID'); ?>" maxlength='300'>
		</div>
	</div>
	<div class="c6 pLa5">
		<label for="MerchantConfigID">MerchantConfigID</label>
		<div class="input">
		  <input type="text" name="MerchantConfigID" id="MerchantConfigID" placeholder='MerchantConfigID' value="<?php echo \dash\get::index($bank, 'asanpardakht','MerchantConfigID'); ?>" maxlength='300'>
		</div>
	</div>


	<div class="c6 pLa5">
		<label for="Username">Username</label>
		<div class="input">
		  <input type="text" name="Username" id="Username" placeholder='Username' value="<?php echo \dash\get::index($bank, 'asanpardakht','Username'); ?>" maxlength='300'>
		</div>
	</div>


	<div class="c6 pLa5">
		<label for="Password">Password</label>
		<div class="input">
		  <input type="password" name="Password" id="Password" placeholder='Password' value="<?php echo \dash\get::index($bank, 'asanpardakht','Password'); ?>" maxlength='300'>
		</div>
	</div>


	<div class="c6 pLa5">
		<label for="EncryptionKey">EncryptionKey</label>
		<div class="input">
		  <input type="text" name="EncryptionKey" id="EncryptionKey" placeholder='EncryptionKey' value="<?php echo \dash\get::index($bank, 'asanpardakht','EncryptionKey'); ?>" maxlength='300'>
		</div>
	</div>



	<div class="c6 pLa5">
		<label for="EncryptionVector">EncryptionVector</label>
		<div class="input">
		  <input type="text" name="EncryptionVector" id="EncryptionVector" placeholder='EncryptionVector' value="<?php echo \dash\get::index($bank, 'asanpardakht','EncryptionVector'); ?>" maxlength='300'>
		</div>
	</div>


	<div class="c6 pLa5">
		<label for="MerchantName">MerchantName</label>
		<div class="input">
		  <input type="text" name="MerchantName" id="MerchantName" placeholder='MerchantName' value="<?php echo \dash\get::index($bank, 'asanpardakht','MerchantName'); ?>" maxlength='300'>
		</div>
	</div>

</div>

<?php } // endfunction ?>


<?php function html_block_paymentParsian($bank) {?>
<div class="switch1">
 <input type="checkbox" name="parsian" id="parsian" <?php if(\dash\get::index($bank, 'parsian', 'status')) { echo 'checked';} ?> >
 <label for="parsian"></label>
 <label for="parsian"><?php echo T_("Enable parsian payment"); ?></label>
</div>

<div class="f mT10" data-response='parsian' data-response-effect='slide' <?php if(\dash\get::index($bank, 'parsian', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >
	<div class="c12 mLa5">
		<label for="LoginAccount">LoginAccount</label>
		<div class="input">
		  <input type="text" name="LoginAccount" id="LoginAccount" placeholder='LoginAccount' value="<?php echo \dash\get::index($bank, 'parsian','LoginAccount'); ?>" maxlength='300'>
		</div>
	</div>
</div>

<?php } // endfunction ?>


<?php function html_block_paymentPayir($bank) {?>
<div class="switch1">
 <input type="checkbox" name="payir" id="payir" <?php if(\dash\get::index($bank, 'payir', 'status')) { echo 'checked';} ?> >
 <label for="payir"></label>
 <label for="payir"><?php echo T_("Enable payir payment"); ?></label>
</div>

<div class="f mT10" data-response='payir' data-response-effect='slide' <?php if(\dash\get::index($bank, 'payir', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >
	<div class="c12 mLa5">
		<label for="api">Api</label>
		<div class="input">
		  <input type="text" name="api" id="api" placeholder='api' value="<?php echo \dash\get::index($bank, 'payir','api'); ?>" maxlength='300'>
		</div>
	</div>
</div>

<?php } // endfunction ?>


<?php function html_block_paymentIrankhis($bank) {?>
<div class="switch1">
 <input type="checkbox" name="irkish" id="irkish" <?php if(\dash\get::index($bank, 'irkish', 'status')) { echo 'checked';} ?> >
 <label for="irkish"></label>
 <label for="irkish"><?php echo T_("Enable irkish payment"); ?></label>
</div>

<div class="f mT10" data-response='irkish' data-response-effect='slide' <?php if(\dash\get::index($bank, 'irkish', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >
	<div class="c4 pLa5">
		<label for="merchantId">merchantId</label>
		<div class="input">
		  <input type="text" name="imerchantId" id="merchantId" placeholder='merchantId' value="<?php echo \dash\get::index($bank, 'irkish','merchantId'); ?>" maxlength='300'>
		</div>
	</div>

	<div class="c4 pLa5">
		<label for="sha1">sha1</label>
		<div class="input">
		  <input type="text" name="sha1" id="sha1" placeholder='sha1' value="<?php echo \dash\get::index($bank, 'irkish','sha1'); ?>" maxlength='500'>
		</div>
	</div>

	<div class="c4 pLa5">
		<label for="description">Description</label>
		<div class="input">
		  <input type="text" name="idescription" id="description" placeholder='description' value="<?php echo \dash\get::index($bank, 'irkish','description'); ?>" maxlength='500'>
		</div>
	</div>
</div>

<?php } // endfunction ?>

