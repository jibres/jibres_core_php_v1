<?php
$planFactor = \dash\data::planFactor();
$meta       = a($planFactor, 'meta');

$totalPrice = a($planFactor, 'total', 'price');
?>
<div class="avand">

    <div class="f">
        <div class="c4 s12 pRa10">

            <div class="stat">
                <h3><?php echo a($planFactor, 'meta', 'action_title'); ?></h3>
                <div class="val ltr"><?php echo a($planFactor, 'meta', 'plan_title') ?></div>
            </div>

			<?php if (is_array(a($planFactor, 'detail'))) {
				foreach ($planFactor['detail'] as $key => $value) { ?>
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
				<?php } /*endforeach*/
			} //endif ?>


        </div>
        <div class="c s12">

			<?php if (a($planFactor, 'access', 'reason')) { ?>
                <div class="alert-danger fs14">
					<?php echo a($planFactor, 'access', 'reason'); ?>
                </div>
			<?php } // endif ?>


            <div class="box impact">
                <div class="body">
                    <table class="tbl1 v5">
                        <tbody>
						<?php if (is_array(a($planFactor, 'factor'))) : foreach (a($planFactor, 'factor') as $item) : ?>
                            <tr>
                                <th>
									<?php echo a($item, 'title') ?>
									<?php if (a($item, 'description')) : ?>
                                        <small class="block"><?php echo a($item, 'description') ?></small>
									<?php endif; ?>
                                </th>
                                <td class="txtRa"><?php echo \dash\fit::number(a($item, 'price')); ?> <?php echo T_("Toman") ?></td>
                            </tr>
						<?php endforeach; endif; ?>


                        </tbody>
                    </table>
                </div>

                <footer class="f">
                    <div class="cauto">
                        <a href="<?php echo \dash\url::this(); ?>"
                           class="btn"><?php echo T_("Cancel") ?></a>
                    </div>
                    <div class="c"></div>
                    <div class="cauto">
                        <div data-confirm data-data='{"refund":"refund"}' class="btn-danger"><?php echo T_("Refund money and cancel plan"); ?></div>
                    </div>
                </footer>
            </div>


        </div>
    </div>

</div>