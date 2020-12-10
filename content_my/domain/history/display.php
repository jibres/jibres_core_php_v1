<div class="f justify-center">
 <div class="c11 m12 s12">
    <div class="fs14">

    <?php if(\dash\data::dataTable()) {?>

    <div class="tblBox">
        <table class="tbl1 v1">
            <thead>
                <th class="collapsing">&nbsp;</th>
                <th><?php echo T_("Title"); ?></th>
                <th class="collapsing"></th>
                <th class="collapsing"></th>
                <th class="collapsing"><?php echo T_("Date"); ?></th>
            </thead>
            <tbody>
              <?php foreach (\dash\data::dataTable() as $key => $value) {?>
                <tr>
                    <td class="collapsing"><?php echo a($value, 'icon'); ?></td>
                    <td>
                        <?php echo a($value, 'title'); ?>
                    </td>
                    <td class="collapsing">
                        <?php if(a($value, 'domain') && a($value, 'domain_id')) {?>
                            <div>
                                <?php if(a($value, 'verify')) {?>
                                <a class="link" href="<?php echo \dash\url::this(). '/setting?domain='. $value['domain']; ?>">
                                    <code><?php echo a($value, 'domain') ?></code>
                                </a>
                                <?php }else{ ?>
                                    <code><?php echo a($value, 'domain') ?></code>
                                <?php } // endif ?>
                            </div>
                        <?php } // endif ?>
                    </td>
                    <td class="collapsing">
                        <?php if(a($value, 'detail', 'pay_link')) {?>
                            <a href="<?php echo a($value, 'detail', 'pay_link') ?>" target="_blank" class="btn success"><?php echo T_("Pay") ?></a>
                        <?php } // endif ?>
                        <?php echo a($value, 'desc'); ?>

                    </td>
                    <td class="collapsing"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></td>
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
