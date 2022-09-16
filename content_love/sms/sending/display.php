<div class="alert-info  text-center">
    <?php echo T_("Most of the time this list is empty, Because the sms must be send in that time by cronjob every 1 second"); ?>
</div>
<table class="tbl1 v3 fs12 selectable">
    <thead>
    <tr>
        <th class=""><?php echo T_("ID"); ?></th>
        <th class=""><?php echo T_("SMS ID"); ?></th>
        <th class=""><?php echo T_("Status"); ?></th>
        <th class=""><?php echo T_("datecreated"); ?></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
	<?php foreach (\dash\data::dataTable() as $key => $value) { ?>
        <tr>
            <td><code>#<?php echo $value['id']; ?></code></td>
            <td>
                <a class="text-blue-400" href="<?php echo \dash\url::this() . '/view?id=' . $value['sms_id'] ?>">
                    <code>#<?php echo $value['sms_id']; ?></code>
                </a>
            </td>
            <td><?php echo T_(ucfirst(strval($value['status']))); ?></td>
            <td><?php echo \dash\fit::date_time($value['datecreated']); ?></td>
            <td><?php echo \dash\fit::date_human($value['datecreated']); ?></td>
        </tr>
	<?php } //endfor ?>
    </tbody>
</table>

<?php \dash\utility\pagination::html(); ?>


