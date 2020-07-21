
<div class="f justify-center">
	<div class="c6 s12">

		<?php
			bPayTicket();
			bPayTicketDetail();
		?>
	</div>
</div>


<?php function bPayTicket() {?>

<?php
$ticketClass = 'active';
$ticketIcon  = 'sf-plus-circle';
$ticketMsg   = T_('Pay');

if(\dash\data::dataRow_banktoken())
{
	if(\dash\data::dataRow_condition() === 'ok')
	{
		$ticketClass = 'positive';
		$ticketIcon  = 'sf-check-circle';
		$ticketMsg   = T_('Successful');

	}
	elseif(\dash\data::dataRow_condition() === 'error' || \dash\data::dataRow_condition() === 'verify_error')
	{
		$ticketClass = 'negative';
		$ticketIcon  = 'sf-times-circle';
		$ticketMsg   = T_('Error');
	}
	else
	{
		$ticketClass = 'warning';
		$ticketIcon  = 'sf-info-circle';

		if(\dash\data::dataRow_condition() === 'cancel')
		{
			$ticketMsg = T_('Cancel');
		}
		else
		{
			$ticketMsg = '';
		}
	}
}

?>







<div class="payTicket <?php echo $ticketClass; ?>">
	<div class="f fix topBox">
		<div class="c8">
			<div class="payPriceBox">
				<span class="price"><?php echo \dash\fit::number(\dash\data::dataRow_plus()); ?></span>
				<abbr class="unit"><?php echo \lib\currency::unit(); ?></abbr>
			</div>
		</div>
		<div class="cauto">
			<div class="breakLine"><i></i></div>
		</div>
		<div class="c status">
			<span class="myStatus <?php echo $ticketIcon; ?>"></span>
			<abbr class="statusDesc"><?php echo $ticketMsg; ?></abbr>
		</div>
	</div>
</div>

<?php } //endfunction ?>



<?php function bPayTicketDetail() {?>

<?php

$myTurnBackUrl = \dash\data::payDetail_turn_back();

if(\dash\data::payDetail_final_msg())
{

	$myTurnBackUrl = \dash\data::payDetail_turn_back();
	if(strpos($myTurnBackUrl, '?') === false)
	{
		$myTurnBackUrl .= '?token='. \dash\data::dataRow_token();
	}
	else
	{
		$myTurnBackUrl .= '&token='. \dash\data::dataRow_token();
	}

}
?>



		<div class="payTicketDetail">
			<?php if(\dash\data::dataRow_banktoken()) {?>


			<?php }else{ ?>

				<?php if(\dash\data::payDetail_msg_go()) {?>

					<div class="msg info2"><?php echo \dash\data::payDetail_msg_go(); ?></div>

				<?php } ?>

			<?php } ?>

			<?php if(\dash\data::dataRow_banktoken()) {?>


			<table class="tbl1 txtC">
				<tbody>
					<tr>
						<th><?php echo T_("Track id"); ?></th>
						<td><?php echo \dash\coding::encode(\dash\data::dataRow_id()); ?></td>
					</tr>
					<tr>
						<th><?php echo T_("Date"); ?></th>
						<td><?php echo \dash\fit::date_time(\dash\data::dataRow_datemodified()); ?></td>
					</tr>
					<tr>
						<th><?php echo T_("Payment"); ?></th>
						<td><?php echo T_(ucfirst(\dash\data::dataRow_payment())); ?></td>
					</tr>
				</tbody>
			</table>

			<?php } ?>


			<form method="post">
				<?php if(\dash\data::dataRow_condition() === 'request' || \dash\data::dataRow_condition() === 'redirect') {?>


					<div class="msg pTB5 mB5"><?php echo T_("Choose a gateway"); ?></div>
					<div class="msg pA5">

						<?php ipayBank(); ?>

					</div>

					<input type="hidden" name="ok" value="1">

					<button class="btn primary block"><?php echo T_("Pay"); ?></button>

					<?php if(\dash\data::payDetail_turn_back()) {?>

						<div class="f mT5">
							<a  href="<?php echo $myTurnBackUrl; ?>" class="cauto os btn light sm"><?php echo T_("Cancel"); ?></a>
						</div>

					<?php }  ?>

				<?php }else{ ?>

					<?php if(\dash\data::payDetail_turn_back()) {?>
						<a  class="btn success block mT10" href="<?php echo $myTurnBackUrl; ?>"><?php echo T_("Back"); ?></a>
					<?php }  ?>


				<?php } // endif ?>
			</form>
		</div>

	<?php suDetail(); ?>


<?php } //endfunction ?>





<?php function ipayBank() {?>

<?php
$myPayment = \dash\data::myPayment();
?>


	<?php if(isset($myPayment['parsian']['status']) && $myPayment['parsian']['status']) {?>
	<div class="radioGateway" title='<?php echo T_("Parsian"); ?>'>
	<input type="radio" name="bank" value="parsian" id="parsian"  checked>
	<label for='parsian' class="spay-64-parsian"></label>
	</div>
	<?php } //endif ?>

	<?php if(isset($myPayment['asanpardakht']['status']) && $myPayment['asanpardakht']['status']) {?>
	<div class="radioGateway">
	<input type="radio" name="bank" value="asanpardakht" id="asanpardakht" >
	<label for='asanpardakht' class="spay-64-asanpardakht"></label>
	</div>
	<?php } //endif ?>

	<?php if(isset($myPayment['irkish']['status']) && $myPayment['irkish']['status']) {?>
	<div class="radioGateway">
	<input type="radio" name="bank" value="irKish" id="irKish" >
	<label for='irKish' class="spay-64-irkish"></label>
	</div>
	<?php } //endif ?>

	<?php if(isset($myPayment['zarinpal']['status']) && $myPayment['zarinpal']['status']) {?>
	<div class="radioGateway">
	<input type="radio" name="bank" value="ZarinPal" id="ZarinPal" >
	<label for='ZarinPal' class="spay-64-zarinpal"></label>
	</div>
	<?php } //endif ?>

	<?php if(isset($myPayment['payir']['status']) && $myPayment['payir']['status']) {?>
	<div class="radioGateway">
	<input type="radio" name="bank" value="payir" id="payir" >
	<label for='payir' class="spay-64-payir"></label>
	</div>
	<?php } //endif ?>

	<?php if(isset($myPayment['mellat']['status']) && $myPayment['mellat']['status']) {?>
	<div class="radioGateway">
	<input type="radio" name="bank" value="mellat" id="mellat" >
	<label for='mellat' class="spay-64-mellat"></label>
	</div>
	<?php } //endif ?>

	<?php if(isset($myPayment['sep']['status']) && $myPayment['sep']['status']) {?>
	<div class="radioGateway">
	<input type="radio" name="bank" value="sep" id="sep" >
	<label for='sep' class="spay-64-sepah"></label>
	</div>
	<?php } //endif ?>

<?php } // endfunction ?>

























<?php function suDetail() {?>

<?php if(!\dash\permission::supervisor()) {return;}?>

<h3 data-kerkere='.iDetailKerkere' class="msg mT10" data-kerkere-icon='close'><?php echo T_("Detail"); ?></h3>
<div class="iDetailKerkere ltr" data-kerkere-content='hide'>
	<div class="cbox">
		<div class="f">
			<h3 data-kerkere-icon='close' data-kerkere='.kerkereDetail1'>Payment response <small>Setting</small></h3>
				<div class="c s12 kerkereDetail1" data-kerkere-content='hide'>
					<pre><?php print_r(\dash\data::dataRow_payment_response()); ?></pre>
				</div>
			<h3 data-kerkere-icon='close' data-kerkere='.kerkereDetail2'>Payment response1 <small>Bank token</small></h3>
				<div class="c s12 kerkereDetail2" data-kerkere-content='hide'>
					<pre><?php print_r(\dash\data::dataRow_payment_response1()); ?></pre>
				</div>
			<h3 data-kerkere-icon='close' data-kerkere='.kerkereDetail3'>Payment response2 <small>Bank back</small></h3>
				<div class="c s12 kerkereDetail3" data-kerkere-content='hide'>
					<pre><?php print_r(\dash\data::dataRow_payment_response2()); ?></pre>
				</div>
			<h3 data-kerkere-icon='close' data-kerkere='.kerkereDetail4'>Payment response3 <small>Bank verify</small></h3>
				<div class="c s12 kerkereDetail4" data-kerkere-content='hide'>
					<pre><?php print_r(\dash\data::dataRow_payment_response3()); ?></pre>
				</div>
			<h3 data-kerkere-icon='close' data-kerkere='.kerkereDetail5'>Payment record <small>DB</small></h3>
				<div class="c s12 kerkereDetail5" data-kerkere-content='hide'>
					<pre><?php print_r(\dash\data::dataRow()); ?></pre>
				</div>
		</div>
	</div>
</div>



<?php } //endfunction ?>

