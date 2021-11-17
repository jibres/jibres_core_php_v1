<?php require_once (root. 'content_love/domain/setting/pageStep.php'); ?>
<div class="f justify-center">
 <div class="c12 m12 s12">

   <div class="fs14">

    <?php if(\dash\data::dataTable()) {?>

    <div class="tblBox">
        <table class="tbl1 v1">
            <thead>
                <th class="collapsing">&nbsp;</th>
                <th><?php echo T_("Title"); ?></th>
                <th class="collapsing"></th>
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
                                <a class="link" href="<?php echo \dash\url::this(). '/setting?domain='. $value['domain']; ?>">
                                    <code><?php echo a($value, 'domain') ?></code>
                                </a>
                            </div>
                        <?php } // endif ?>
                    </td>
                    <td class="collapsing">
                        <?php if(a($value, 'detail', 'pay_link')) {?>
                            <a href="<?php echo a($value, 'detail', 'pay_link') ?>" target="_blank" class="btn-success"><?php echo T_("Pay") ?></a>
                        <?php } // endif ?>
                        <?php echo a($value, 'desc'); ?>

                    </td>
                    <td class="collapsing">
                        <?php if(a($value, 'price')) {?>
                            <?php echo T_("Price"). ': '. \dash\fit::number($value['price']). ' '. \lib\currency::unit(); ?>
                        <?php } // endif ?>
                        <?php if(a($value, 'discount')) {?>
                            <br>
                            <?php echo T_("Discount"). ': '. \dash\fit::number($value['discount']). ' '. \lib\currency::unit(); ?>
                        <?php } // endif ?>
                    </td>
                    <td class="collapsing"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></td>
                </tr>
              <?php }// endfor ?>
            </tbody>
        </table>
    </div>
    <?php }else{ ?>

      <div class="alert-warning"><?php echo T_("No action history founded"); ?></div>
    <?php } //endif ?>
    </div>

<?php \dash\utility\pagination::html(); ?>

 </div>
</div>
