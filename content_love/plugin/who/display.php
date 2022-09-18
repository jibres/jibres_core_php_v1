<table class="tbl1 v1">
	<thead>
	<tr>
		<th>plugin</th>
		<th>business</th>
		<th>status</th>
		<th>expiredate</th>
	</tr>
	</thead>
	<tbody>

	<?php foreach (\dash\data::result_activeplugin() as $item) :	?>
	<tr>
		<td><?php echo a($item, 'plugin') ?></td>
		<td>
			<?php echo a($item, 'store_id') ?>
			<div>
				<a href="<?php echo \dash\url::kingdom(). '/'. \dash\store_coding::encode($item['store_id']). '/a/plugin' ?>">enter to admin</a>
			</div>
            <div>
                <a href="<?php echo \dash\url::this(). '/manage?id='. $item['store_id']; ?>">plugin list</a>
            </div>
		</td>
		<td><?php echo a($item, 'status') ?></td>
		<td><?php echo \dash\fit::date_time(a($item, 'expiredate')) ?></td>

	</tr>
	<?php endforeach; ?>
	</tbody>
</table>

sms charge
<table class="tbl1 v1">
    <thead>
    <tr>
        <th>plugin</th>
        <th>business</th>
        <th>status</th>
        <th>packagecount</th>
        <th>usage</th>
        <th>remain</th>

    </tr>
    </thead>
    <tbody>

	<?php foreach (\dash\data::result_smscharge() as $item) :	?>
        <tr>
            <td><?php echo a($item, 'plugin') ?></td>
            <td>
				<?php echo a($item, 'store_id') ?>
                <div>
                    <a href="<?php echo \dash\url::kingdom(). '/'. \dash\store_coding::encode($item['store_id']). '/a/plugin' ?>">enter to admin</a>
                </div>
                <div>
                    <a href="<?php echo \dash\url::this(). '/manage?id='. $item['store_id']; ?>">plugin list</a>
                </div>
            </td>
            <td><?php echo a($item, 'status') ?></td>
            <td><?php echo \dash\fit::number(a($item, 'packagecount')) ?></td>
            <td>
                <?php
				$count_usage = \lib\db\sms\get::sum_sms_sended_by_package_id(a($item, 'store_id'), a($item, 'id'));

				 echo \dash\fit::number(floatval($count_usage));

                ?>
            </td>
            <td>
                <?php
				echo \dash\fit::number(floatval(a($item, 'packagecount')) - floatval($count_usage));
                ?>

            </td>

        </tr>
	<?php endforeach; ?>
    </tbody>
</table>
