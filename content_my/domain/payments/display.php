<div class="f justify-center">
 <div class="c11 m12 s12 fs14">

    <?php if(\dash\data::dataTable()) {?>

    <div class="tblBox">
        <table class="tbl1 v1">
            <thead>
                <th><?php echo T_("Domain"); ?></th>
                <th><?php echo T_("Period"); ?></th>
                <th><?php echo T_("Price"); ?></th>
                <th><?php echo T_("Discount"); ?></th>
                <th><?php echo T_("Final price"); ?></th>
                <th><?php echo T_("Date"); ?></th>
            </thead>
            <tbody>
     	      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
                <tr>
                    <td>
                    <?php if(a($value, 'domain') && a($value, 'domain_id')) {?>
                        <div>
                            <a class="link" href="<?php echo \dash\url::this(). '/setting?domain='. $value['domain']; ?>">
                                <code><?php echo a($value, 'domain') ?></code>
                            </a>
                        </div>
                    <?php } // endif ?>
                    </td>
                    <td><?php echo a($value, 'period_title'); ?></td>
                    <td><?php if(a($value, 'price')) {?><?php echo \dash\fit::number(a($value, 'price')); ?> <small><?php echo \lib\currency::unit(); ?></small><?php }//endif ?></td>
                    <td><?php if(a($value, 'discount')) {?><?php echo \dash\fit::number(a($value, 'discount')); ?> <small><?php echo \lib\currency::unit(); ?></small><?php }//endif ?></td>
                    <td><?php if(a($value, 'finalprice')) {?><?php echo \dash\fit::number(a($value, 'finalprice')); ?> <small><?php echo \lib\currency::unit(); ?></small><?php }//endif ?></td>
                    <td class="collapsing"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></td>
                </tr>
              <?php }// endfor ?>
            </tbody>
        </table>
    </div>
    <?php }else{ ?>

      <div class="msg warn2"><?php echo T_("No billing history founded"); ?></div>
    <?php } //endif ?>

<?php \dash\utility\pagination::html(); ?>

</div>
