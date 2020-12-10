<div class="f justify-center">
 <div class="c11 m12 s12">
    <div class="fs14">

    <?php if(\dash\data::dataTable()) {?>

    <div class="tblBox">
        <table class="tbl1 v1">
            <thead>
                <th><?php echo T_("Title"); ?></th>
                <th><?php echo T_("Bank"); ?></th>
                <th><?php echo T_("IBAN"); ?></th>

                <th class="collapsing"><?php echo T_("Date"); ?></th>
            </thead>
            <tbody>
              <?php foreach (\dash\data::dataTable() as $key => $value) {?>
                <tr>
                    <td><?php echo a($value, 'title'); ?></td>
                    <td><?php echo a($value, 'bank'); ?></td>
                    <td><?php echo a($value, 'merchantIban'); ?></td>


                    <td class="collapsing"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></td>
                </tr>
              <?php }// endfor ?>
            </tbody>
        </table>
    </div>
    <?php }else{ ?>

      <div class="msg warn2"><?php echo T_("No IBAN was found"); ?></div>
    <?php } //endif ?>
    </div>

<?php \dash\utility\pagination::html(); ?>

</div>
