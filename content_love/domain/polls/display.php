<div class="f justify-center">
 <div class="c11 m12 s12">
    <div class="fs14">

    <?php if(\dash\data::dataTable()) {?>

    <div class="tblBox">
        <table class="tbl1 v1">
            <thead>
                <th><?php echo T_("Id"); ?></th>
                <th><?php echo T_("Server id"); ?></th>
                <th><?php echo T_("IRNIC id"); ?></th>
                <th><?php echo T_("Notif count"); ?></th>
                <th><?php echo T_("Index"); ?></th>
                <th><?php echo T_("Note"); ?></th>
                <th><?php echo T_("Date"); ?></th>
            </thead>
            <tbody>
              <?php foreach (\dash\data::dataTable() as $key => $value) {?>
                <tr>
                    <td class="collapsing"><?php echo \dash\get::index($value, 'id'); ?></td>
                    <td><?php echo \dash\get::index($value, 'server_id'); ?></td>
                    <td><?php echo \dash\get::index($value, 'nic_id'); ?></td>
                    <td><?php echo \dash\get::index($value, 'notif_count'); ?></td>
                    <td><?php echo \dash\get::index($value, 'index'); ?></td>
                    <td><?php echo \dash\get::index($value, 'note'); ?></td>
                    <td class="collapsing"><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?></td>
                </tr>
              <?php }// endfor ?>
            </tbody>
        </table>
    </div>
    <?php }else{ ?>

      <div class="msg warn2"><?php echo T_("No action history founded"); ?></div>
    <?php } //endif ?>
    </div>

<?php \dash\utility\pagination::html(); ?>

</div>
