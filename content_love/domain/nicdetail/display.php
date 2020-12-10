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

                    <td><code><?php echo a($value, 'nic_id'); ?></code></td>
                    <td><?php echo a($value, 'person'); ?></td>
                    <td><?php echo a($value, 'email'); ?></td>
                    <td><?php echo a($value, 'address'); ?></td>

                    <td><?php echo a($value, 'org'); ?></td>

                    <td class="collapsing">
                        <div>
                            <?php echo a($value, 'phone'); ?>
                        </div>
                        <div>
                            <?php echo a($value, 'mobile'); ?>
                        </div>
                        <div>
                            <?php echo a($value, 'fax'); ?>
                        </div>
                    </td>
                    <td class="collapsing">
                        <div>
                            <?php echo \dash\fit::date_time(a($value, 'datecreated')); ?>
                        </div>
                        <div>
                            <?php echo \dash\fit::date_human(a($value, 'datemodified')); ?>
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
