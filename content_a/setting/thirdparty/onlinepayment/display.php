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


<section class="f" data-option='setting-order-payment-online-parsian' id="setting-order-payment-online-parsian">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("parsian payment"); ?></h3>
      <div class="body">
  		<i class="spay-32-parsian"></i>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_parsian_payment_status" value="1">
    <div class="action">
	  <?php if(a($bank, 'parsian', 'empty')){  ?>
	  	<a class="btn primary" href="<?php echo \dash\url::that(). '/irparsian?init=1' ?>"><?php echo T_("Connect") ?></a>
	  <?php }else{ ?>
      <div class="switch1">
        <input id="iparsian_payment_status" type="checkbox" name="parsian_payment_status" <?php if(a($bank, 'parsian', 'status')){ echo 'checked'; } ?>>
        <label for="iparsian_payment_status" data-on="<?php echo T_("Enable"); ?>" data-off="<?php echo T_("Disable") ?>"></label>
      </div>
	  <?php } //endif ?>
    </div>
  </form>
  <footer class="txtRa">
  	<?php if(!a($bank, 'parsian', 'empty')){  ?>
  		<a class="btn link" href="<?php echo \dash\url::that(). '/irparsian' ?>"> <?php echo T_("Change connection setting") ?></a>
  	<?php } //endif ?>

  </footer>
</section>



<section class="f" data-option='setting-order-payment-online-payir' id="setting-order-payment-online-payir">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("payir payment"); ?></h3>
      <div class="body">
  		<i class="spay-32-payir"></i>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_payir_payment_status" value="1">
    <div class="action">
	  <?php if(a($bank, 'payir', 'empty')){  ?>
	  	<a class="btn primary" href="<?php echo \dash\url::that(). '/irpayir?init=1' ?>"><?php echo T_("Connect") ?></a>
	  <?php }else{ ?>
      <div class="switch1">
        <input id="ipayir_payment_status" type="checkbox" name="payir_payment_status" <?php if(a($bank, 'payir', 'status')){ echo 'checked'; } ?>>
        <label for="ipayir_payment_status" data-on="<?php echo T_("Enable"); ?>" data-off="<?php echo T_("Disable") ?>"></label>
      </div>
	  <?php } //endif ?>
    </div>
  </form>
  <footer class="txtRa">
  	<?php if(!a($bank, 'payir', 'empty')){  ?>
  		<a class="btn link" href="<?php echo \dash\url::that(). '/irpayir' ?>"> <?php echo T_("Change connection setting") ?></a>
  	<?php } //endif ?>

  </footer>
</section>



<section class="f" data-option='setting-order-payment-online-irkish' id="setting-order-payment-online-irkish">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("irkish payment"); ?></h3>
      <div class="body">
      <i class="spay-32-irkish"></i>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_irkish_payment_status" value="1">
    <div class="action">
    <?php if(a($bank, 'irkish', 'empty')){  ?>
      <a class="btn primary" href="<?php echo \dash\url::that(). '/irirkish?init=1' ?>"><?php echo T_("Connect") ?></a>
    <?php }else{ ?>
      <div class="switch1">
        <input id="iirkish_payment_status" type="checkbox" name="irkish_payment_status" <?php if(a($bank, 'irkish', 'status')){ echo 'checked'; } ?>>
        <label for="iirkish_payment_status" data-on="<?php echo T_("Enable"); ?>" data-off="<?php echo T_("Disable") ?>"></label>
      </div>
    <?php } //endif ?>
    </div>
  </form>
  <footer class="txtRa">
    <?php if(!a($bank, 'irkish', 'empty')){  ?>
      <a class="btn link" href="<?php echo \dash\url::that(). '/irirkish' ?>"> <?php echo T_("Change connection setting") ?></a>
    <?php } //endif ?>

  </footer>
</section>




<section class="f" data-option='setting-order-payment-online-idpay' id="setting-order-payment-online-idpay">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("idpay payment"); ?></h3>
      <div class="body">
      <i class="spay-32-idpay"></i>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_idpay_payment_status" value="1">
    <div class="action">
    <?php if(a($bank, 'idpay', 'empty')){  ?>
      <a class="btn primary" href="<?php echo \dash\url::that(). '/iridpay?init=1' ?>"><?php echo T_("Connect") ?></a>
    <?php }else{ ?>
      <div class="switch1">
        <input id="iidpay_payment_status" type="checkbox" name="idpay_payment_status" <?php if(a($bank, 'idpay', 'status')){ echo 'checked'; } ?>>
        <label for="iidpay_payment_status" data-on="<?php echo T_("Enable"); ?>" data-off="<?php echo T_("Disable") ?>"></label>
      </div>
    <?php } //endif ?>
    </div>
  </form>
  <footer class="txtRa">
    <?php if(!a($bank, 'idpay', 'empty')){  ?>
      <a class="btn link" href="<?php echo \dash\url::that(). '/iridpay' ?>"> <?php echo T_("Change connection setting") ?></a>
    <?php } //endif ?>

  </footer>
</section>







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
