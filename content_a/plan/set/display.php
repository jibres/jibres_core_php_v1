<?php
$planFactor = \dash\data::planFactor();
$meta       = a($planFactor, 'meta');
$userBudget = a($planFactor, 'user', 'budget');
$totalPrice = a($planFactor, 'total', 'price');
?>
<div class="avand">
	<?php $giftCode = 0; ?>
    <div class="f">
        <div class="c4 s12 pRa10">
            <div class="stat">
                <h3><?php echo a($planFactor, 'meta', 'action_title'); ?></h3>
                <div class="val ltr"><?php echo a($planFactor, 'meta', 'plan_title') ?></div>
            </div>
			<?php if (is_array(a($planFactor, 'detail')))  { foreach ($planFactor['detail'] as $key => $value) { ?>
                <nav class="items">
                    <ul>
                        <li>
                            <div class="f item">
                                <div class="key"><?php echo $value['title']; ?></div>
                                <div class="value ltr font-bold"><?php echo $value['value']; ?></div>
                                <div class="go detail"></div>
                            </div>
                        </li>
                    </ul>
                </nav>
			<?php } /*endforeach*/ } //endif ?>
        </div>
        <div class="c s12">
			<?php if (a($planFactor, 'access', 'reason')) { ?>
                <div class="alert-danger fs14">
					<?php echo a($planFactor, 'access', 'reason'); ?>
                    <?php if(a($planFactor, 'access', 'errorCancelPlan')): ?>
                    <div class="mt-4">
                        <?php echo T_("To cancel current plan click here"); ?>
                        <a class="btn-danger" href="<?php echo \dash\url::this(). '/cancel' ?>"><?php echo T_("Cancel plan"); ?></a>
                    </div>
                <?php endif ?>
                </div>
			<?php } // endif ?>
            <?php if(false) {?>
            <div class="box impact">
                <div class="body">
                    <form method="get" autocomplete="off" action="<?php echo \dash\url::current(); ?>">
                        <input type="hidden" name="p" value="<?php echo \dash\request::get('p'); ?>">

                        <label for="gift"><?php echo T_("If you have gift cart enter here") ?> 🎁</label>
                        <div class="input ltr">
                            <input type="text" name="gift" value="<?php echo \dash\request::get('gift'); ?>" id="gift"
                                   maxlength="50" placeholder='<?php echo T_("Gift code") ?>'>
                            <button class="btn-primary addon"><?php echo T_("Apply"); ?></button>
                        </div>
                    </form>

					<?php if (\dash\request::get('gift')) { ?>
						<?php if (\dash\data::giftDetail_msgsuccess()) { ?>
                            <div class="alert-success"><?php echo nl2br(\dash\data::giftDetail_msgsuccess()); ?></div>
						<?php }// endif ?>
						<?php
						$giftCode = \dash\data::giftDetail_discount();
						if (\dash\data::giftDetail_type() === 'percent')
						{
							// echo T_("Gift percent"). ':';
							// echo \dash\fit::number(\dash\data::giftDetail_giftpercent());
							// echo T_("%");
						}
                        elseif (\dash\data::giftDetail_type() === 'amount')
						{
							// echo T_("Gift amount"). ':';
							// echo \dash\fit::number(\dash\data::giftDetail_giftamount());
						}
						else
						{
							echo '<div class="alert-danger f align-center">';
							echo '<div class="c" id="giftcardmessageerror">';
							if (\dash\data::gitfErrorMessage())
							{
								echo \dash\data::gitfErrorMessage();
							}
							else
							{
								echo T_("Invalid gift code") . ' 😔';
							}
							echo '</div>';
							echo '</div>';
						}
						?>
					<?php } // endif ?>
                </div>
            </div>
            <?php } //endif ?>

            <form method="post" autocomplete="off" data-timeout="0">
                <div class="box impact">
                    <div class="body">
                        <table class="tbl1 v5">
                            <tbody>
                            <?php if(is_array(a($planFactor, 'factor'))) : foreach (a($planFactor, 'factor') as $item) : ?>
                                <tr >
                                    <th>
                                        <?php echo a($item, 'title') ?>
                                        <?php if(a($item, 'description')) :?>
                                        <small class="block"><?php echo a($item, 'description') ?></small>
                                        <?php endif; ?>
                                    </th>

                                    <td class="txtRa"><?php echo \dash\fit::number(a($item, 'price')); ?> <?php echo T_("Toman") ?></td>


                                </tr>
                            <?php  endforeach; endif; ?>
							<?php if ($giftCode || $userBudget) { ?>
                                <tr data-price='<?php echo $totalPrice; ?>'>
                                    <th><?php echo T_("Total Price") ?></th>
                                    <td class="txtRa"><?php echo \dash\fit::number($totalPrice); ?> <?php echo T_("Toman") ?></td>
                                </tr>
							<?php } // endif ?>

							<?php if ($giftCode) { ?>
                                <tr data-gift='<?php echo $giftCode; ?>'>
                                    <th><?php echo T_("Your Gift") ?>
										<?php
										if (\dash\data::giftDetail_type() === 'percent')
										{
											echo '(';
											echo \dash\fit::number(\dash\data::giftDetail_giftpercent());
											echo T_("%");
											echo ')';
										}
										?>
                                    </th>
                                    <td class="txtRa">
                                        <span><?php echo \dash\fit::number($giftCode); ?></span>
                                        <span class="text-gray-400 mLa5"><?php echo T_("Toman"); ?></span>
                                    </td>
                                </tr>
							<?php } // endif ?>
							<?php $mypayedprice = $totalPrice - $giftCode;
							if ($mypayedprice < 0) {
								$mypayedprice = 0;
							} ?>
							<?php if ($userBudget && $mypayedprice) { ?>
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
                            <a href="<?php echo \dash\url::this() . '/choose'; ?>"
                               class="btn"><?php echo T_("Cancel") ?></a>
                        </div>
                        <div class="c"></div>
                        <div class="cauto">
                            <?php if(a($planFactor, 'access', 'ok')) :?>
                            <button class="btn-success"><?php echo T_("Pay"); ?></button>
                            <?php else: ?>
                                <button class="btn-success disabled"><?php echo T_("Pay"); ?></button>
                            <?php endif; ?>
                        </div>
                    </footer>
                </div>
            </form>
        </div>
    </div>
</div>