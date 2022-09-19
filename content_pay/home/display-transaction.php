
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
$ticketIcon  = 'plus-circle-fill';
$ticketMsg   = T_('Pay');

if(\dash\data::dataRow_banktoken())
{
	if(\dash\data::dataRow_condition() === 'ok')
	{
		$ticketClass = 'positive';
		$ticketIcon  = 'check-circle-fill';
		$ticketMsg   = T_('Successful');

	}
	elseif(\dash\data::dataRow_condition() === 'error' || \dash\data::dataRow_condition() === 'verify_error')
	{
		$ticketClass = 'negative';
		$ticketIcon  = 'x-circle-fill';
		$ticketMsg   = T_('Error');
	}
	else
	{
		$ticketClass = 'warning';
		$ticketIcon  = 'info-circle-fill';

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
				<div class="priceBlock">
					<span class="price"><?php echo \dash\fit::number(\dash\data::dataRow_plus()); ?></span>
				</div>
				<abbr class="unit"><?php echo \dash\data::dataRow_currency_name(); ?></abbr>
			</div>
		</div>
		<div class="cauto">
			<div class="breakLine"><i></i></div>
		</div>
		<div class="c status">
			<span class="myStatus"><?php echo \dash\utility\icon::bootstrap($ticketIcon); ?></span>
			<abbr class="statusDesc"><?php echo $ticketMsg; ?></abbr>
		</div>
	</div>
</div>
<?php } //endfunction




function bPayTicketDetail() {?>

<?php

$myTurnBackUrl = \dash\data::payDetail_turn_back();

if(\dash\data::payDetail_final_msg())
{

	$myTurnBackUrl = \dash\data::payDetail_turn_back();
	if(\dash\str::strpos($myTurnBackUrl, '?') === false)
	{
		$myTurnBackUrl .= '?jftoken='. \dash\data::dataRow_token();
	}
	else
	{
		$myTurnBackUrl .= '&jftoken='. \dash\data::dataRow_token();
	}

}
?>



		<div class="payTicketDetail">
			<?php if(\dash\data::dataRow_banktoken()) {?>


			<?php }else{ ?>

				<?php if(\dash\data::payDetail_msg_go()) {?>

					<div class="alert-info"><?php echo \dash\data::payDetail_msg_go(); ?></div>

				<?php } ?>

			<?php } ?>

			<?php if(\dash\data::dataRow_banktoken()) {?>


			<table class="tbl1 text-center">
				<tbody>
					<tr>
						<th><?php echo T_("Track id"); ?></th>
						<td><code><?php echo \dash\data::dataRow_id(); ?></code></td>
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


			<form method="post" autocomplete="off">

				<?php if(\dash\data::dataRow_condition() === 'request' || \dash\data::dataRow_condition() === 'redirect') {?>

					<?php echo \dash\csrf::html(); ?>
					<?php ipayBank(); ?>


					<div class="px-1 flex">
						<input type="hidden" name="ok" value="1">
						<div class="flex-grow">
							<button class="btn-primary block w-36"><?php echo T_("Pay"); ?></button>
						</div>


					<?php if(\dash\data::payDetail_turn_back()) {?>
						<a <?php if(!\dash\engine\store::inStore()){ echo "data-direct";} ?> href="<?php echo $myTurnBackUrl; ?>" class="btn-outline-secondary"><?php echo T_("Cancel"); ?></a>
					<?php }  ?>

				<?php }else{ ?>

					<?php if(\dash\data::payDetail_turn_back()) {?>
						<a <?php if(!\dash\engine\store::inStore()){ echo "data-direct";} ?> class="btn-primary" href="<?php echo $myTurnBackUrl; ?>"><?php echo T_("Continue"); ?></a>
					<?php }  ?>


				<?php } // endif ?>
					</div>
			</form>
		</div>

	<?php suDetail(); ?>
<?php } //endfunction













 function ipayBank() {?>

<?php
$myPayment = \dash\data::myPayment();
if(!is_array($myPayment))
{
	$myPayment = [];
}

$dp = \dash\request::get('dp'); // default payment
$dp = \dash\validate::string_100($dp, false);

$selected = $dp;

// if(!\dash\engine\store::inStore())
// {
// 	$selected = 'zarinpal';
// }

if(!$selected && \dash\data::myPaymentDefault())
{
	$selected = \dash\data::myPaymentDefault();
}

if(!$selected && \dash\engine\store::inStore())
{
	$default_payment = \lib\store::detail('default_payment');
	if($default_payment)
	{
		$selected = $default_payment;
	}
}


?>
	<?php if(!array_filter($myPayment)) {?>
		<p class="font-bold text-center mt-2"><?php echo T_("No payment gateway was founded") ?></p>
	<?php }else{ ?>
		<div class="pb-2"><?php echo T_("Choose a gateway"); ?></div>
		<div class="pb-2">
			<?php if(isset($myPayment['parsian']['status']) && $myPayment['parsian']['status']) {?>
			<div class="radioGateway" title='<?php echo T_("Parsian"); ?>'>
			<input type="radio" name="bank" value="parsian" id="parsian"  <?php if($selected === 'parsian') { echo 'checked';} ?>>
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
			<input type="radio" name="bank" value="irKish" id="irKish" <?php if($selected === 'irkish') { echo 'checked';} ?>>
			<label for='irKish' class="spay-64-irkish"></label>
			</div>
			<?php } //endif ?>

			<?php if(isset($myPayment['zarinpal']['status']) && $myPayment['zarinpal']['status']) {?>
			<div class="radioGateway">
			<input type="radio" name="bank" value="ZarinPal" id="ZarinPal" <?php if($selected === 'zarinpal') { echo 'checked';} ?>>
			<label for='ZarinPal' class="spay-64-zarinpal"></label>
			</div>
			<?php } //endif ?>

			<?php if(isset($myPayment['payir']['status']) && $myPayment['payir']['status']) {?>
			<div class="radioGateway">
			<input type="radio" name="bank" value="payir" id="payir" <?php if($selected === 'payir') { echo 'checked';} ?>>
			<label for='payir' class="spay-64-payir"></label>
			</div>
			<?php } //endif ?>

			<?php if(isset($myPayment['idpay']['status']) && $myPayment['idpay']['status']) {?>
			<div class="radioGateway">
			<input type="radio" name="bank" value="idpay" id="idpay" <?php if($selected === 'idpay') { echo 'checked';} ?>>
			<label for='idpay'>
				<?php require_once('idpay.php') ?>
			</label>
			</div>
			<?php } //endif ?>

			<?php if(isset($myPayment['mellat']['status']) && $myPayment['mellat']['status']) {?>
			<div class="radioGateway">
			<input type="radio" name="bank" value="mellat" id="mellat" <?php if($selected === 'mellat') { echo 'checked';} ?>>
			<label for='mellat' class="spay-64-mellat"></label>
			</div>
			<?php } //endif ?>

			<?php if(isset($myPayment['payping']['status']) && $myPayment['payping']['status']) {?>
			<div class="radioGateway">
			<input type="radio" name="bank" value="payping" id="payping" <?php if($selected === 'payping') { echo 'checked';} ?>>
			<label for='payping'><img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/bank/payping.png" alt='PayPing'></label>
			</div>
			<?php } //endif ?>
			<?php if(isset($myPayment['nextpay']['status']) && $myPayment['nextpay']['status']) {?>
			<div class="radioGateway">
			<input type="radio" name="bank" value="nextpay" id="nextpay" <?php if($selected === 'nextpay') { echo 'checked';} ?>>
			<label for='nextpay'><img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/bank/nextpay.png" alt='Nextpay'></label>
			</div>
			<?php } //endif ?>

			<?php if(isset($myPayment['sep']['status']) && $myPayment['sep']['status']) {?>
			<div class="radioGateway">
			<input type="radio" name="bank" value="sep" id="sep" <?php if($selected === 'sep') { echo 'checked';} ?>>
			<label for='sep' class="spay-64-sepah"></label>
			</div>
			<?php } //endif ?>
		</div>
	<?php } //endif ?>
<?php } // endfunction









 function suDetail() {?>

<?php if(!\dash\permission::supervisor()) {return;}?>

<h3 data-kerkere='.iDetailKerkere' class="msg mt-2" data-kerkere-icon='close'><?php echo T_("Detail"); ?></h3>
<div class="iDetailKerkere ltr" data-kerkere-content='hide'>
	<div class="box p-4">
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