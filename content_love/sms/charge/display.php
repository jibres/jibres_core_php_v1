<table class="tbl1 v1 fs12 selectable">
    <thead>
    <tr>
        <th class="collapsing"><?php echo T_("ID"); ?></th>
        <th class=""><?php echo T_("Business"); ?></th>

        <th class=""><?php echo T_("Amount"); ?></th>
        <th class=""><?php echo T_("Transaction"); ?></th>

        <th class="collapsing"><?php echo T_("datecreated"); ?></th>
    </tr>
    </thead>
    <tbody>
	<?php foreach (\dash\data::dataTable() as $key => $value) { ?>

        <tr>
            <td class="collapsing">
                <a class="text-blue-400 " href="<?php echo \dash\url::this() . '/view?id=' . $value['id'] ?>">
                    <code>#<?php echo $value['id'] ?></code>
                </a>
            </td>

            <td class="">
                <a href="<?php echo \dash\url::here() . '/store/setting?id=' . $value['store_id']; ?>">
					<?php echo a($value, 'store_id'); ?>
                </a>
            </td>

            <td class="">
                <span class="font-bold"><?php echo \dash\fit::number(floatval($value['amount'])); ?></span>
                <small class="text-gray-400"><?php echo \lib\currency::jibres_currency(true) ?></small>
            </td>

            <td class="">
                <a href="<?php echo \dash\url::here() . '/store/setting?id=' . $value['store_id']; ?>">
                    <code>#<?php echo a($value, 'transaction_id'); ?></code>
                </a>
            </td>



            <td class="collapsing">
                <div><?php echo \dash\fit::date_time($value['datecreated']); ?></div>
            </td>
        </tr>


	<?php } //endfor ?>
    </tbody>
</table>

<?php \dash\utility\pagination::html(); ?>


