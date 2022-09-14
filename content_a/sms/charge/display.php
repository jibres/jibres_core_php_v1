<?php
$smsChargeDetail = \dash\data::smsChargeDetail();
$userBudget      = a($smsChargeDetail, 'budget');
$charge          = a($smsChargeDetail, 'charge');
$currency        = a($smsChargeDetail, 'currency');
?>

<div class="avand">
    <div class="f justify-center align-center">
        <div class="c8 s12">
            <form method="post" autocomplete="off">
                <div class="box impact">
                    <div class="body">

						<?php if($charge) : ?>
                            <div class="alert-info">
								<?php echo T_("Current charge"); ?>
                                <span class="ltr font-bold"><?php echo \dash\fit::number($charge) . ' ' . $currency; ?></span>
                            </div>

						<?php endif; ?>
                        <div class="input pA5">
                            <label class="addon" for="amount-number"><?php echo \lib\currency::unit(); ?></label>
                            <input id="amount-number" type="tel" name="amount"
                                   value="<?php echo \dash\data::amount(); ?>"
                                   placeholder='<?php echo T_("Enter an amount to charge your SMS panel"); ?>' required
                                   maxlength="12" data-format="price">
                        </div>


                    </div>
                    <footer class="txtRa">

                        <button class="btn-success addon"><?php echo T_("Checkout"); ?></button>
                    </footer>
                </div>
            </form>

        </div>
    </div>
</div>


<?php
return;
?>
<div class="avand">
    <div class="f justify-center align-center">
        <div class="c8 s12">
            <form method="post" autocomplete="off" data-timeout="0">
                <div class="box impact">
                    <div class="body">
                        <table class="tbl1 v5">
                            <tbody>

							<?php if($userBudget) { ?>
                                <tr data-price='<?php echo $totalPrice; ?>'>
                                    <th><?php echo T_("Total Price") ?></th>
                                    <td class="txtRa"><?php echo \dash\fit::number($totalPrice); ?><?php echo T_("Toman") ?></td>
                                </tr>
							<?php } // endif ?>


							<?php $mypayedprice = $totalPrice;
							if($mypayedprice < 0)
							{
								$mypayedprice = 0;
							} ?>
							<?php if($userBudget) { ?>
                                <tr data-budget='<?php echo $userBudget; ?>'>
                                    <th>
                                        <div><?php echo T_("Account Balance") ?></div>
                                        <div class="check1">
                                            <input type="checkbox" name="usebudget" id="budget">
                                            <label for="budget"><?php echo T_("Pay from my account balance"); ?></label>
                                        </div>
                                    </th>
                                    <td class="txtRa">
                                        <span><?php echo \dash\fit::number($userBudget); ?></span>
                                        <span class="text-gray-400 mLa5"><?php echo T_("Toman"); ?></span>
                                    </td>
                                </tr>
							<?php } //endif ?>
							<?php if($mypayedprice): ?>
                                <tr data-payable>
                                    <th><?php echo T_("Amount payable") ?></th>
                                    <td class="txtRa collapsing">
                                    <span class="font-bold fs20"
                                          id='domainPayablePrice'><?php echo \dash\fit::number($mypayedprice) ?></span>
                                        <span class="text-gray-400 mLa5"><?php echo T_("Toman"); ?></span>
                                    </td>
                                </tr>
							<?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <footer class="f">
                        <div class="cauto">
                            <a href="<?php echo \dash\url::here() . '/plan'; ?>"
                               class="btn"><?php echo T_("Cancel") ?></a>
                        </div>
                        <div class="c"></div>
                        <div class="cauto">

                            <button class="btn-success"><?php echo T_("Pay"); ?></button>

                        </div>
                    </footer>
                </div>
            </form>
        </div>
    </div>
</div>