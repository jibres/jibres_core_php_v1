<?php $bank = \dash\data::bankSetting(); ?>


<section class="f" data-option='setting-order-payment-online-mellat' id="setting-order-payment-online-mellat">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Mellat payment"); ?></h3>
      <div class="body">
  		<i class="spay-32-mellat"></i>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_mellat_payment_status" value="1">
    <div class="action">
	  <?php if(a($bank, 'mellat', 'empty')){  ?>
	  	<a class="btn primary" href="<?php echo \dash\url::that(). '/irmellat?init=1' ?>"><?php echo T_("Connect") ?></a>
	  <?php }else{ ?>
      <div class="switch1">
        <input id="imellat_payment_status" type="checkbox" name="mellat_payment_status" <?php if(a($bank, 'mellat', 'status')){ echo 'checked'; } ?>>
        <label for="imellat_payment_status" data-on="<?php echo T_("Enable"); ?>" data-off="<?php echo T_("Disable") ?>"></label>
      </div>
	  <?php } //endif ?>
    </div>
  </form>
  <footer class="txtRa">
  	<?php if(!a($bank, 'mellat', 'empty')){  ?>
  		<a class="btn link" href="<?php echo \dash\url::that(). '/irmellat' ?>"> <?php echo T_("Change connection setting") ?></a>
  	<?php } //endif ?>

  </footer>
</section>



<section class="f" data-option='setting-order-payment-online-zarinpal' id="setting-order-payment-online-zarinpal">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("zarinpal payment"); ?></h3>
      <div class="body">
  		<i class="spay-32-zarinpal"></i>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_zarinpal_payment_status" value="1">
    <div class="action">
	  <?php if(a($bank, 'zarinpal', 'empty')){  ?>
	  	<a class="btn primary" href="<?php echo \dash\url::that(). '/irzarinpal?init=1' ?>"><?php echo T_("Connect") ?></a>
	  <?php }else{ ?>
      <div class="switch1">
        <input id="izarinpal_payment_status" type="checkbox" name="zarinpal_payment_status" <?php if(a($bank, 'zarinpal', 'status')){ echo 'checked'; } ?>>
        <label for="izarinpal_payment_status" data-on="<?php echo T_("Enable"); ?>" data-off="<?php echo T_("Disable") ?>"></label>
      </div>
	  <?php } //endif ?>
    </div>
  </form>
  <footer class="txtRa">
  	<?php if(!a($bank, 'zarinpal', 'empty')){  ?>
  		<a class="btn link" href="<?php echo \dash\url::that(). '/irzarinpal' ?>"> <?php echo T_("Change connection setting") ?></a>
  	<?php } //endif ?>

  </footer>
</section>




<section class="f" data-option='setting-order-payment-online-asanpardakht' id="setting-order-payment-online-asanpardakht">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("asanpardakht payment"); ?></h3>
      <div class="body">
  		<i class="spay-32-asanpardakht"></i>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_asanpardakht_payment_status" value="1">
    <div class="action">
	  <?php if(a($bank, 'asanpardakht', 'empty')){  ?>
	  	<a class="btn primary" href="<?php echo \dash\url::that(). '/irasanpardakht?init=1' ?>"><?php echo T_("Connect") ?></a>
	  <?php }else{ ?>
      <div class="switch1">
        <input id="iasanpardakht_payment_status" type="checkbox" name="asanpardakht_payment_status" <?php if(a($bank, 'asanpardakht', 'status')){ echo 'checked'; } ?>>
        <label for="iasanpardakht_payment_status" data-on="<?php echo T_("Enable"); ?>" data-off="<?php echo T_("Disable") ?>"></label>
      </div>
	  <?php } //endif ?>
    </div>
  </form>
  <footer class="txtRa">
  	<?php if(!a($bank, 'asanpardakht', 'empty')){  ?>
  		<a class="btn link" href="<?php echo \dash\url::that(). '/irasanpardakht' ?>"> <?php echo T_("Change connection setting") ?></a>
  	<?php } //endif ?>

  </footer>
</section>





<div class="avand-lg">
	<form method="post" autocomplete="off">
		<div class="box">
			<header><h2><?php echo T_("Configuration bank payment setting") ?></h2></header>
			<div class="body">
				<?php

					html_block_paymentAsanpardakht($bank);
					html_block_paymentParsian($bank);
					html_block_paymentPayir($bank);
					html_block_paymentIrankhis($bank);
					html_block_idpay($bank);
				 ?>
			</div>
			<footer class="f">
				<div class="c"><a data-ajaxify data-data='{"test": "payment"}' data-method='post' class="btn link"><?php echo T_("Test payment"); ?></a></div>
				<div class="cauto"><button class="btn success"><?php echo T_("Save"); ?></button></div>
			</footer>
		</div>
	</form>
</div>









<?php function html_block_paymentAsanpardakht($bank) {?>
<div class="switch1">
 <input type="checkbox" name="asanpardakht" id="asanpardakht" <?php if(a($bank, 'asanpardakht', 'status')) { echo 'checked';} ?> >
 <label for="asanpardakht"></label>
 <label for="asanpardakht"><?php echo T_("Enable asanpardakht payment"); ?></label>
</div>

<div class="f mT10" data-response='asanpardakht' <?php if(a($bank, 'asanpardakht', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >
	<div class="c6 pLa5">
		<label for="MerchantID">MerchantID</label>
		<div class="input">
		  <input type="text" name="aMerchantID" id="MerchantID" placeholder='MerchantID' value="<?php echo a($bank, 'asanpardakht','MerchantID'); ?>" maxlength='300'>
		</div>
	</div>
	<div class="c6 pLa5">
		<label for="MerchantConfigID">MerchantConfigID</label>
		<div class="input">
		  <input type="text" name="MerchantConfigID" id="MerchantConfigID" placeholder='MerchantConfigID' value="<?php echo a($bank, 'asanpardakht','MerchantConfigID'); ?>" maxlength='300'>
		</div>
	</div>


	<div class="c6 pLa5">
		<label for="Username">Username</label>
		<div class="input">
		  <input type="text" name="Username" id="Username" placeholder='Username' value="<?php echo a($bank, 'asanpardakht','Username'); ?>" maxlength='300'>
		</div>
	</div>


	<div class="c6 pLa5">
		<label for="Password">Password</label>
		<div class="input">
		  <input type="password" name="Password" id="Password" placeholder='Password' value="<?php echo a($bank, 'asanpardakht','Password'); ?>" maxlength='300'>
		</div>
	</div>


	<div class="c6 pLa5">
		<label for="EncryptionKey">EncryptionKey</label>
		<div class="input">
		  <input type="text" name="EncryptionKey" id="EncryptionKey" placeholder='EncryptionKey' value="<?php echo a($bank, 'asanpardakht','EncryptionKey'); ?>" maxlength='300'>
		</div>
	</div>



	<div class="c6 pLa5">
		<label for="EncryptionVector">EncryptionVector</label>
		<div class="input">
		  <input type="text" name="EncryptionVector" id="EncryptionVector" placeholder='EncryptionVector' value="<?php echo a($bank, 'asanpardakht','EncryptionVector'); ?>" maxlength='300'>
		</div>
	</div>


	<div class="c6 pLa5">
		<label for="MerchantName">MerchantName</label>
		<div class="input">
		  <input type="text" name="MerchantName" id="MerchantName" placeholder='MerchantName' value="<?php echo a($bank, 'asanpardakht','MerchantName'); ?>" maxlength='300'>
		</div>
	</div>

</div>

<?php } // endfunction ?>


<?php function html_block_paymentParsian($bank) {?>
<div class="switch1">
 <input type="checkbox" name="parsian" id="parsian" <?php if(a($bank, 'parsian', 'status')) { echo 'checked';} ?> >
 <label for="parsian"></label>
 <label for="parsian"><?php echo T_("Enable parsian payment"); ?></label>
</div>

<div class="f mT10" data-response='parsian' <?php if(a($bank, 'parsian', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >
	<div class="c12 mLa5">
		<label for="LoginAccount">LoginAccount</label>
		<div class="input">
		  <input type="text" name="LoginAccount" id="LoginAccount" placeholder='LoginAccount' value="<?php echo a($bank, 'parsian','LoginAccount'); ?>" maxlength='300'>
		</div>
	</div>
</div>

<?php } // endfunction ?>


<?php function html_block_paymentPayir($bank) {?>
<div class="switch1">
 <input type="checkbox" name="payir" id="payir" <?php if(a($bank, 'payir', 'status')) { echo 'checked';} ?> >
 <label for="payir"></label>
 <label for="payir"><?php echo T_("Enable payir payment"); ?></label>
</div>

<div class="f mT10" data-response='payir' <?php if(a($bank, 'payir', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >
	<div class="c12 mLa5">
		<label for="api">Api</label>
		<div class="input">
		  <input type="text" name="api" id="api" placeholder='api' value="<?php echo a($bank, 'payir','api'); ?>" maxlength='300'>
		</div>
	</div>
</div>

<?php } // endfunction ?>


<?php function html_block_paymentIrankhis($bank) {?>
<div class="switch1">
 <input type="checkbox" name="irkish" id="irkish" <?php if(a($bank, 'irkish', 'status')) { echo 'checked';} ?> >
 <label for="irkish"></label>
 <label for="irkish"><?php echo T_("Enable irkish payment"); ?></label>
</div>

<div class="f mT10" data-response='irkish' <?php if(a($bank, 'irkish', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >
	<div class="c4 pLa5">
		<label for="merchantId">merchantId</label>
		<div class="input">
		  <input type="text" name="imerchantId" id="merchantId" placeholder='merchantId' value="<?php echo a($bank, 'irkish','merchantId'); ?>" maxlength='300'>
		</div>
	</div>

	<div class="c4 pLa5">
		<label for="sha1">sha1</label>
		<div class="input">
		  <input type="text" name="sha1" id="sha1" placeholder='sha1' value="<?php echo a($bank, 'irkish','sha1'); ?>" maxlength='500'>
		</div>
	</div>

	<div class="c4 pLa5">
		<label for="description">Description</label>
		<div class="input">
		  <input type="text" name="idescription" id="description" placeholder='description' value="<?php echo a($bank, 'irkish','description'); ?>" maxlength='500'>
		</div>
	</div>
</div>

<?php } // endfunction ?>


<?php function html_block_idpay($bank) {?>
<div class="switch1">
 <input type="checkbox" name="idpay" id="idpay" <?php if(a($bank, 'idpay', 'status')) { echo 'checked';} ?> >
 <label for="idpay"></label>
 <label for="idpay"><?php echo T_("Enable idpay payment"); ?></label>
</div>

<div class="f mT10" data-response='idpay' <?php if(a($bank, 'idpay', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >
	<div class="c12 mLa5">
		<label for="apikey">API KEY</label>
		<div class="input">
		  <input type="text" name="apikey" id="apikey" placeholder='apikey' value="<?php echo a($bank, 'idpay','apikey'); ?>" maxlength='300'>
		</div>
	</div>
</div>

<?php } // endfunction ?>
