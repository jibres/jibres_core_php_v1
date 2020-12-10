<div class="f justify-center">
 <div class="c11 m12 s12">
    <div class="fs14">

    <?php if(\dash\data::dataTable()) {?>

    <div class="tblBox">
        <table class="tbl1 v1">
            <thead>
                <th class="collapsing">&nbsp;</th>
                <th><?php echo T_("Title"); ?></th>
                <th></th>
                <th></th>
                <th><?php echo T_("Date"); ?></th>
                <th><?php echo T_("User"); ?></th>
            </thead>
            <tbody>
              <?php foreach (\dash\data::dataTable() as $key => $value) {?>
                <tr>
                    <td class="collapsing"><?php echo a($value, 'icon'); ?></td>
                    <td>
                        <?php echo a($value, 'title'); ?>
                    </td>
                    <td>
                        <?php if(a($value, 'domain') && a($value, 'domain_id')) {?>
                            <div>
                                <a class="link" href="<?php echo \dash\url::this(). '/setting?id='. $value['domain_id']; ?>">
                                    <code><?php echo a($value, 'domain') ?></code>
                                </a>
                            </div>
                        <?php } // endif ?>
                    </td>
                    <td>
                        <?php if(a($value, 'detail', 'pay_link')) {?>
                            <a href="<?php echo a($value, 'detail', 'pay_link') ?>" target="_blank" class="btn success"><?php echo T_("Pay") ?></a>
                        <?php } // endif ?>
                        <?php echo a($value, 'desc'); ?>

                    </td>
                    <td class="collapsing"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></td>
                    <td class="collapsing">
                      <a href="<?php echo \dash\url::that(). '?user='. a($value, 'user_id'); ?>" class="f align-center userPack">
                        <div class="c pRa10">
                          <div class="mobile"><?php echo \dash\fit::mobile(a($value, 'user_detail', 'mobile')); ?></div>
                          <div class="name"><?php echo a($value, 'user_detail', 'displayname'); ?></div>
                        </div>
                        <img class="cauto" src="<?php echo a($value, 'user_detail', 'avatar'); ?>">
                      </a>
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
