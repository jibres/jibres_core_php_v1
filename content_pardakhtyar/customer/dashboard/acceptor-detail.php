
<?php function XAcceptorDetail() {?>

<form method="post" autocomplete="off">
	<input type="hidden" name="formSubmitType" value="acceptor">
	<input type="hidden" name="acceptorid" value="<?php echo \dash\data::dataRowAcceptor_id(); ?>">
	<div class="f">
		<div class="c4 s12">
			<div class="mRa5">
				<?php IacceptorCode(); ?>
			</div>
		</div>

		<div class="c4 s12">
			<div class="mRa5">

			</div>
		</div>
		<div class="c4 s12">
			<div class="mRa5">

			</div>
		</div>
	</div>

	<div data-kerkere='.ShowAcceptorFieldDetail' data-kerkere-icon>جزئیات بیشتر</div>

	<div class="ShowAcceptorFieldDetail" data-kerkere-content='hide'>
		<div class="example">
			<div class="f">
				<div class="c4 s12">
					<div class="mRa5">
			   			<?php Iiin(); ?>
						<?php IfacilitatorAcceptorCode(); ?>
						<?php IacceptorType(); ?>
						<?php IallowScatteredSettlement(); ?>
						<?php Icancelable(); ?>
						<?php Irefundable(); ?>
						<?php Iblockable(); ?>
						<?php IchargeBackable(); ?>
						<?php IsettledSeparately(); ?>
						<?php IacceptCreditCardTransaction(); ?>
						<?php IallowIranianProductsTrx(); ?>

					</div>
				</div>

				<div class="c4 s12">
					<div class="mRa5">

						<?php IallowKaraCardTrx(); ?>
						<?php IallowGoodsBasketTrx(); ?>
						<?php IallowFoodSecurityTrx(); ?>
						<?php IallowJcbCardTrx(); ?>
						<?php IallowUpiCardTrx(); ?>
						<?php IallowVisaCardTrx(); ?>
						<?php IallowMasterCardTrx(); ?>
						<?php IallowAmericanExpressTrx(); ?>
						<?php IallowOtherInternationaCardsTrx(); ?>

					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="txtRa">
		<button class="btn success"><?php echo T_("Update"); ?></button>
	</div>
</form>


<?php } //endfunction ?>



<?php function IallowScatteredSettlement() {?>
<label for="i_allowScatteredSettlement">allowScatteredSettlement <span class="mLa10">xxx</span></label>
<div class="input">
	<input type="text" name="allowScatteredSettlement" id="i_allowScatteredSettlement" value="<?php echo \dash\data::dataRowAcceptor_allowScatteredSettlement(); ?>">
</div>
<?php } //endfunction ?>



<?php function Iiin() {?>
<label for="i_iin">iin <span class="mLa10">کد سویچ ارائه دهنده سرویس</span></label>
<div class="input">
	<input type="text" name="iin" id="i_iin" value="<?php echo \dash\data::dataRowAcceptor_iin(); ?>">
</div>
<?php } //endfunction ?>



<?php function IacceptorCode() {?>
<label for="i_acceptorCode">acceptorCode <span class="mLa10">کد پذیرنده</span></label>
<div class="input">
	<input type="text" name="acceptorCode" id="i_acceptorCode" value="<?php echo \dash\data::dataRowAcceptor_acceptorCode(); ?>">
</div>
<?php } //endfunction ?>



<?php function IacceptorType() {?>
<label for="i_acceptorType">acceptorType <span class="mLa10">نوع پذیرندگی</span></label>
<div class="input">
	<input type="text" name="acceptorType" id="i_acceptorType" value="<?php echo \dash\data::dataRowAcceptor_acceptorType(); ?>">
</div>
<?php } //endfunction ?>



<?php function IfacilitatorAcceptorCode() {?>
<label for="i_facilitatorAcceptorCode">facilitatorAcceptorCode <span class="mLa10">کد پذیرنده پرداختیار</span></label>
<div class="input">
	<input type="text" name="facilitatorAcceptorCode" id="i_facilitatorAcceptorCode" value="<?php echo \dash\data::dataRowAcceptor_facilitatorAcceptorCode(); ?>">
</div>
<?php } //endfunction ?>



<?php function Icancelable() {?>
<div class="switch1">
	<input type="checkbox" name="cancelable" id="i_cancelable" <?php if(\dash\data::dataRowAcceptor_cancelable()) {echo 'checked';} ?>>
	<label for="i_cancelable">cancelable <span class="mLa10">امکان لغو تراکنش</span></label>
	<label for="i_cancelable">cancelable <span class="mLa10">امکان لغو تراکنش</span></label>
</div>
<?php } //endfunction ?>



<?php function Irefundable() {?>
<div class="switch1">
	<input type="checkbox" name="refundable" id="i_refundable" <?php if(\dash\data::dataRowAcceptor_refundable()) {echo 'checked';} ?>>
	<label for="i_refundable">refundable <span class="mLa10">xxx</span></label>
	<label for="i_refundable">refundable <span class="mLa10">xxx</span></label>
</div>
<?php } //endfunction ?>



<?php function Iblockable() {?>
<div class="switch1">
	<input type="checkbox" name="blockable" id="i_blockable" <?php if(\dash\data::dataRowAcceptor_blockable()) {echo 'checked';} ?>>
	<label for="i_blockable">blockable <span class="mLa10">xxx</span></label>
	<label for="i_blockable">blockable <span class="mLa10">xxx</span></label>
</div>
<?php } //endfunction ?>



<?php function IchargeBackable() {?>
<div class="switch1">
	<input type="checkbox" name="chargeBackable" id="i_chargeBackable" <?php if(\dash\data::dataRowAcceptor_chargeBackable()) {echo 'checked';} ?>>
	<label for="i_chargeBackable">chargeBackable <span class="mLa10">xxx</span></label>
	<label for="i_chargeBackable">chargeBackable <span class="mLa10">xxx</span></label>
</div>
<?php } //endfunction ?>



<?php function IsettledSeparately() {?>
<div class="switch1">
	<input type="checkbox" name="settledSeparately" id="i_settledSeparately" <?php if(\dash\data::dataRowAcceptor_settledSeparately()) {echo 'checked';} ?>>
	<label for="i_settledSeparately">settledSeparately <span class="mLa10">xxx</span></label>
	<label for="i_settledSeparately">settledSeparately <span class="mLa10">xxx</span></label>
</div>
<?php } //endfunction ?>




<?php function IacceptCreditCardTransaction() {?>
<div class="switch1">
	<input type="checkbox" name="acceptCreditCardTransaction" id="i_acceptCreditCardTransaction" <?php if(\dash\data::dataRowAcceptor_acceptCreditCardTransaction()) {echo 'checked';} ?>>
	<label for="i_acceptCreditCardTransaction">acceptCreditCardTransaction <span class="mLa10">xxx</span></label>
	<label for="i_acceptCreditCardTransaction">acceptCreditCardTransaction <span class="mLa10">xxx</span></label>
</div>
<?php } //endfunction ?>



<?php function IallowIranianProductsTrx() {?>
<div class="switch1">
	<input type="checkbox" name="allowIranianProductsTrx" id="i_allowIranianProductsTrx" <?php if(\dash\data::dataRowAcceptor_allowIranianProductsTrx()) {echo 'checked';} ?>>
	<label for="i_allowIranianProductsTrx">allowIranianProductsTrx <span class="mLa10">xxx</span></label>
	<label for="i_allowIranianProductsTrx">allowIranianProductsTrx <span class="mLa10">xxx</span></label>
</div>
<?php } //endfunction ?>



<?php function IallowKaraCardTrx() {?>
<div class="switch1">
	<input type="checkbox" name="allowKaraCardTrx" id="i_allowKaraCardTrx" <?php if(\dash\data::dataRowAcceptor_allowKaraCardTrx()) {echo 'checked';} ?>>
	<label for="i_allowKaraCardTrx">allowKaraCardTrx <span class="mLa10">xxx</span></label>
	<label for="i_allowKaraCardTrx">allowKaraCardTrx <span class="mLa10">xxx</span></label>
</div>
<?php } //endfunction ?>



<?php function IallowGoodsBasketTrx() {?>
<div class="switch1">
	<input type="checkbox" name="allowGoodsBasketTrx" id="i_allowGoodsBasketTrx" <?php if(\dash\data::dataRowAcceptor_allowGoodsBasketTrx()) {echo 'checked';} ?>>
	<label for="i_allowGoodsBasketTrx">allowGoodsBasketTrx <span class="mLa10">xxx</span></label>
	<label for="i_allowGoodsBasketTrx">allowGoodsBasketTrx <span class="mLa10">xxx</span></label>
</div>
<?php } //endfunction ?>



<?php function IallowFoodSecurityTrx() {?>
<div class="switch1">
	<input type="checkbox" name="allowFoodSecurityTrx" id="i_allowFoodSecurityTrx" <?php if(\dash\data::dataRowAcceptor_allowFoodSecurityTrx()) {echo 'checked';} ?>>
	<label for="i_allowFoodSecurityTrx">allowFoodSecurityTrx <span class="mLa10">xxx</span></label>
	<label for="i_allowFoodSecurityTrx">allowFoodSecurityTrx <span class="mLa10">xxx</span></label>
</div>
<?php } //endfunction ?>



<?php function IallowJcbCardTrx() {?>
<div class="switch1">
	<input type="checkbox" name="allowJcbCardTrx" id="i_allowJcbCardTrx" <?php if(\dash\data::dataRowAcceptor_allowJcbCardTrx()) {echo 'checked';} ?>>
	<label for="i_allowJcbCardTrx">allowJcbCardTrx <span class="mLa10">xxx</span></label>
	<label for="i_allowJcbCardTrx">allowJcbCardTrx <span class="mLa10">xxx</span></label>
</div>
<?php } //endfunction ?>



<?php function IallowUpiCardTrx() {?>
<div class="switch1">
	<input type="checkbox" name="allowUpiCardTrx" id="i_allowUpiCardTrx" <?php if(\dash\data::dataRowAcceptor_allowUpiCardTrx()) {echo 'checked';} ?>>
	<label for="i_allowUpiCardTrx">allowUpiCardTrx <span class="mLa10">xxx</span></label>
	<label for="i_allowUpiCardTrx">allowUpiCardTrx <span class="mLa10">xxx</span></label>
</div>
<?php } //endfunction ?>



<?php function IallowVisaCardTrx() {?>
<div class="switch1">
	<input type="checkbox" name="allowVisaCardTrx" id="i_allowVisaCardTrx" <?php if(\dash\data::dataRowAcceptor_allowVisaCardTrx()) {echo 'checked';} ?>>
	<label for="i_allowVisaCardTrx">allowVisaCardTrx <span class="mLa10">xxx</span></label>
	<label for="i_allowVisaCardTrx">allowVisaCardTrx <span class="mLa10">xxx</span></label>
</div>
<?php } //endfunction ?>



<?php function IallowMasterCardTrx() {?>
<div class="switch1">
	<input type="checkbox" name="allowMasterCardTrx" id="i_allowMasterCardTrx" <?php if(\dash\data::dataRowAcceptor_allowMasterCardTrx()) {echo 'checked';} ?>>
	<label for="i_allowMasterCardTrx">allowMasterCardTrx <span class="mLa10">xxx</span></label>
	<label for="i_allowMasterCardTrx">allowMasterCardTrx <span class="mLa10">xxx</span></label>
</div>
<?php } //endfunction ?>


<?php function IallowAmericanExpressTrx() {?>
<div class="switch1">
	<input type="checkbox" name="allowAmericanExpressTrx" id="i_allowAmericanExpressTrx" <?php if(\dash\data::dataRowAcceptor_allowAmericanExpressTrx()) {echo 'checked';} ?>>
	<label for="i_allowAmericanExpressTrx">allowAmericanExpressTrx <span class="mLa10">xxx</span></label>
	<label for="i_allowAmericanExpressTrx">allowAmericanExpressTrx <span class="mLa10">xxx</span></label>
</div>
<?php } //endfunction ?>



<?php function IallowOtherInternationaCardsTrx() {?>
<div class="switch1">
	<input type="checkbox" name="allowOtherInternationaCardsTrx" id="i_allowOtherInternationaCardsTrx" <?php if(\dash\data::dataRowAcceptor_allowOtherInternationaCardsTrx()) {echo 'checked';} ?>>
	<label for="i_allowOtherInternationaCardsTrx">allowOtherInternationaCardsTrx <span class="mLa10">xxx</span></label>
	<label for="i_allowOtherInternationaCardsTrx">allowOtherInternationaCardsTrx <span class="mLa10">xxx</span></label>
</div>
<?php } //endfunction ?>


