<table class="tbl1 v4 font-14">
    <thead>
        <tr>
            <th>id</th>
            <th>Code</th>
            <th>User</th>
            <th>Date</th>
            <th>Valid</th>
            <th>Type</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (\dash\data::dataTable() as $key => $value) {?>
        <tr>
            <td><?php echo a($value, 'id') ?></td>
            <td><?php echo a($value, 'code') ?></td>
            <td><?php echo a($value, 'user_id') ?></td>
            <td><?php echo \dash\fit::date_time(a($value, 'datecreated')) ?></td>
            <td><?php echo a($value, 'valid') ?></td>
            <td><?php echo a($value, 'errortype') ?></td>
            <td><?php echo a($value, 'message') ?></td>
        </tr>
        <?php } //endfor ?>
    </tbody>
</table>



<?php \dash\utility\pagination::html(); ?>

