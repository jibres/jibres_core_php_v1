<table class="tbl1 v1 fs12 selectable">
    <thead>
    <tr>
        <th class="collapsing"><?php echo T_("ID"); ?></th>
        <th class=""><?php echo T_("Mobile"); ?></th>
        <th class=""><?php echo T_("Status"); ?></th>
        <th class=""><?php echo T_("Count"); ?></th>
        <th class=""><?php echo T_("Price"); ?></th>
        <th class=""><?php echo T_("Store"); ?></th>
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
				<?php echo \dash\fit::mobile($value['mobile']); ?>
            </td>

            <td class="">
                <div><?php echo T_(ucfirst(strval($value['status']))); ?></div>
            </td>

            <td class="" title="<?php echo T_("Length"). ': '. \dash\fit::number($value['len']) ?>">
                <span class="font-bold"><?php echo \dash\fit::number($value['smscount']); ?></span>
                <small class="text-gray-400"><?php echo T_("SMS") ?></small>
            </td>


            <td class="">
                <span class="font-bold"><?php echo \dash\fit::number(floatval($value['final_cost'])); ?></span>
                <small class="text-gray-400"><?php echo \lib\currency::jibres_currency(true) ?></small>
            </td>


            <td class="">

                <?php echo a($value, 'store_id'); ?>
            </td>
            <td class="collapsing">
                <div><?php echo \dash\fit::date_time($value['datecreated']); ?></div>
            </td>

        </tr>
        <tr>
            <td colspan="7"><?php echo $value['message']; ?></td>
        </tr>

	<?php } //endfor ?>
    </tbody>
</table>

<?php \dash\utility\pagination::html(); ?>


