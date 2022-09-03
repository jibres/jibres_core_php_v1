<div class="tblBox">

    <table class="tbl1 v1 fs12 selectable">
        <thead>
        <tr>

            <th><?php echo T_("id"); ?></th>
            <th><?php echo T_("Store_id"); ?></th>
            <th><?php echo T_("User"); ?></th>
            <th><?php echo T_("Customer"); ?></th>
            <th><?php echo T_("Staff"); ?></th>


            <th><?php echo T_("datecreated"); ?></th>
            <th class="collapsing"><?php echo T_("Setting"); ?></th>

        </tr>
        </thead>
        <tbody>
		<?php foreach (\dash\data::dataTable() as $key => $value) { ?>

            <tr>
                <td><code><?php echo a($value, 'id'); ?></code></td>
                <td>
                    <a href="<?php echo \dash\url::kingdom() . '/' . \dash\store_coding::encode(a($value, 'store_id')); ?>">
                        <code><?php echo \dash\store_coding::encode(a($value, 'store_id')); ?></code>
                        <br>
                        <span><?php echo a($value, 'title') ?></span>
                    </a>

                </td>

                <td>
                    <img src="<?php echo a($value, 'user_detail', 'avatar'); ?>" class="avatar">
					<?php echo a($value, 'user_detail', 'displayname'); ?>
                    <br>
                    <div class="badge light"><?php echo \dash\fit::mobile(a($value, 'user_detail', 'mobile')); ?></div>
                    <a target="_blank"
                       href="<?php echo \dash\url::kingdom() . '/enter?userid=' . \dash\coding::decode(a($value, 'creator')); ?>"><i
                                class="sf-in-alt"></i></a>
                </td>
                <td><?php echo HTMLCheckIsCustormer(a($value, 'customer')) ?></td>
                <td><?php echo HTMLCheckIsCustormer(a($value, 'staff')) ?></td>


                <td title="<?php echo \dash\fit::date_time(a($value, 'datecreated')); ?>">
					<?php echo \dash\fit::date_human(a($value, 'datecreated')); ?>
                </td>
                <td class="collapsing">
                    <a href="<?php echo \dash\url::that() . '/change?id=' . a($value, 'id') ?>"
                       class="btn-link"><?php echo T_("Setting") ?></a>
                </td>

            </tr>
            <tr class="">
                <td colspan="7">
                    <pre class="hide"><?php print_r($value) ?></pre>
                </td>
            </tr>

		<?php } //endfor ?>
        </tbody>
    </table>
</div>


<?php \dash\utility\pagination::html(); ?>


<?php
function HTMLCheckIsCustormer($value)
{
	if ($value)
	{
		return \dash\utility\icon::svg('CircleTick', 'major', 'green', 'w-4');
	}
	else
	{
		return \dash\utility\icon::svg('CircleCancel', 'major', 'red', 'w-4');
	}
}

?>

