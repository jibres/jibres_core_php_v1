<table class="tbl1 v1 ltr font-18">
    <thead>
        <tr>
            <th class="ltr text-left">#</th>
            <th class="ltr text-left">Date expire</th>
            <th class="ltr text-left">Auto renew period IR</th>
            <th class="text-center">Auto renew period COM</th>
            <th class="text-center">Renew Notif</th>
            <th class="text-center">Renew Try</th>
        </tr>
    </thead>
    <tbody class="ltr text-left">

        <?php foreach (\dash\data::myList() as $key => $value) {?>
        <tr class="ltr text-left">
            <td class="ltr text-left">
                <a href="<?php echo \dash\url::this(); ?>/setting?id=<?php echo \dash\coding::encode(a($value, 'myid')); ?>" class="link"><code><?php echo a($value, 'name'); ?></code></a>
            </td>
            <td class="ltr text-left"><?php echo \dash\fit::date_time(a($value, 'dateexpire')); ?></td>
            <td class="ltr text-left"><?php echo a($value, 'autorenewperiod'); ?></td>
            <td class="text-center"><?php echo a($value, 'autorenewperiodcom'); ?></td>
            <td class="text-center"><?php echo \dash\fit::date_time(a($value, 'renewnotif')); ?></td>
            <td class="text-center"><?php echo \dash\fit::date_time(a($value, 'renewtry')); ?></td>

        </tr>
        <?php } //endfor ?>
    </tbody>
</table>
