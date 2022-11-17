<?php require_once(root . 'content_a/products/productName.php'); ?>


    <div class="tblBox">
        <table class="tbl1 v1">
            <thead>
            <tr>

                <th><?php echo T_("ID"); ?></th>
                <th><?php echo T_("Stock"); ?></th>
                <th class="collapsing"></th>
                <th><?php echo T_("Count"); ?></th>
                <th><?php echo T_("Date"); ?></th>
                <th><?php echo T_("Action"); ?></th>
                <th><?php echo T_("Order ID"); ?></th>

            </tr>
            </thead>
            <tbody>
			<?php foreach (\dash\data::dataTable() as $key => $value) :


				if(floatval(a($value, 'count') > 0))
				{
					$color = 'text-green-600';
					// $icon = 'CaretUp';
					$icon = 'CircleChevronUp';
				}
                elseif(floatval(a($value, 'count') < 0))
				{
					$color = 'text-red-600';
					// $icon = 'CaretDown';
					$icon = 'CircleChevronDown';
				}
				else
				{
					$color = 'text-gray-600';
					$icon  = null;
				}

				?>
                <tr>
                    <td><?php echo \dash\fit::text(a($value, 'id')); ?></td>

                    <td><?php echo \dash\fit::number(a($value, 'stock')); ?></td>
                    <td>
                    <span class="<?php echo $color; ?>">

                        <?php if($icon) {
							// echo \dash\utility\icon::svg($icon, 'minor', $color, 'w-4' );
						} ?>

                    </span>
                    </td>
                    <td>


                        <span class="<?php echo $color ?>">
                        <?php echo \dash\fit::number(a($value, 'count')); ?>
                    </span>


                    </td>

                    <td><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></td>
                    <td><?php echo a($value, 't_action'); ?></td>
                    <td>
						<?php if(a($value, 'factor_id')) : ?>
                            <a href="<?php echo \dash\url::here() . '/order/detail?id=' . $value['factor_id'] ?>">
                                #<?php echo a($value, 'factor_id'); ?>
                            </a>
						<?php endif; ?>
                    </td>


                </tr>
			<?php endforeach; ?>
            </tbody>

        </table>
    </div>
<?php \dash\utility\pagination::html() ?>