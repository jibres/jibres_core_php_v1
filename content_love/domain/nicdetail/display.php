<div class="f justify-center">
 <div class="s12 m12 s12">
    <div class="fs12">

    <?php if(\dash\data::dataTable()) {?>

    <div class="tblBox">
        <table class="tbl1 v1">
            <thead>

                <th><?php echo T_("IRNIC"); ?></th>
                <th><?php echo T_("Person"); ?></th>
                <th><?php echo T_("Email"); ?></th>
                <th><?php echo T_("Address"); ?></th>
                <th><?php echo T_("Org"); ?></th>
                <th class="collapsing"><?php echo T_("Phone") ?></th>
                <th class="collapsing"><?php echo T_("Date"); ?></th>


            </thead>
            <tbody>
              <?php foreach (\dash\data::dataTable() as $key => $value) {?>
                <tr>

                    <td><code><?php echo \dash\get::index($value, 'nic_id'); ?></code></td>
                    <td><?php echo \dash\get::index($value, 'person'); ?></td>
                    <td><?php echo \dash\get::index($value, 'email'); ?></td>
                    <td><?php echo \dash\get::index($value, 'address'); ?></td>

                    <td><?php echo \dash\get::index($value, 'org'); ?></td>

                    <td class="collapsing">
                        <div>
                            <?php echo \dash\get::index($value, 'phone'); ?>
                        </div>
                        <div>
                            <?php echo \dash\get::index($value, 'mobile'); ?>
                        </div>
                        <div>
                            <?php echo \dash\get::index($value, 'fax'); ?>
                        </div>
                    </td>
                    <td class="collapsing">
                        <div>
                            <?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?>
                        </div>
                        <div>
                            <?php echo \dash\fit::date_human(\dash\get::index($value, 'datemodified')); ?>
                        </div>
                    </td>


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
