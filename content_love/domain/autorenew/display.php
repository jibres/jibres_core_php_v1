<table class="tbl1 v1 ltr font-18">
    <thead>
        <tr>
            <th class="ltr txtL">#</th>
            <th class="ltr txtL">Date expire</th>
            <th class="ltr txtL">Auto renew period IR</th>
            <th class="txtC">Auto renew period COM</th>
            <th class="txtC">Renew Notif</th>
            <th class="txtC">Renew Try</th>
        </tr>
    </thead>
    <tbody class="ltr txtL">

        <?php foreach (\dash\data::myList() as $key => $value) {?>
        <tr class="ltr txtL">
            <td class="ltr txtL">
                <a href="<?php echo \dash\url::this(); ?>/setting?id=<?php echo \dash\coding::encode(a($value, 'myid')); ?>" class="link"><code><?php echo a($value, 'name'); ?></code></a>
            </td>
            <td class="ltr txtL"><?php echo \dash\fit::date_time(a($value, 'dateexpire')); ?></td>
            <td class="ltr txtL"><?php echo a($value, 'autorenewperiod'); ?></td>
            <td class="txtC"><?php echo a($value, 'autorenewperiodcom'); ?></td>
            <td class="txtC"><?php echo \dash\fit::date_time(a($value, 'renewnotif')); ?></td>
            <td class="txtC"><?php echo \dash\fit::date_time(a($value, 'renewtry')); ?></td>

        </tr>
        <?php } //endfor ?>
    </tbody>
</table>
