<div class="f justify-center">
 <div class="c11 m12 s12">
    <div class="fs14">

    <?php if(\dash\data::dataTable()) {?>

    <div class="tblBox">
        <table class="tbl1 v1">
            <thead>

                <th><?php echo T_("Sum pirce"); ?></th>
                <th><?php echo T_("Sum discount"); ?></th>
                <th><?php echo T_("Sum finalprice"); ?></th>
                <th><?php echo T_("First pay date"); ?></th>
                <th><?php echo T_("Last pay date"); ?></th>
                <th><?php echo T_("Domain count"); ?></th>
                <th><?php echo T_("User"); ?></th>
            </thead>
            <tbody>
              <?php foreach (\dash\data::dataTable() as $key => $value) {?>
                <tr>

                    <td><?php echo \dash\fit::number(\dash\get::index($value, 'sum_price')); ?></td>
                    <td><?php echo \dash\fit::number(\dash\get::index($value, 'sum_discount')); ?></td>
                    <td><?php echo \dash\fit::number(\dash\get::index($value, 'sum_finalprice')); ?></td>
                    <td><?php echo \dash\fit::date_time(\dash\get::index($value, 'first_pay')); ?></td>
                    <td><?php echo \dash\fit::date_time(\dash\get::index($value, 'last_pay')); ?></td>
                    <td><?php echo \dash\fit::number(\dash\get::index($value, 'domain_count')); ?></td>

                    <td class="collapsing">
                      <a href="<?php echo \dash\url::that(). '?user='.\dash\get::index($value, 'user_id'); ?>" class="f userPack">
                        <div class="c pRa10">
                          <div class="mobile"><?php echo \dash\fit::mobile(\dash\get::index($value, 'user_detail', 'mobile')); ?></div>
                          <div class="name"><?php echo \dash\get::index($value, 'user_detail', 'displayname'); ?></div>
                        </div>
                        <img class="cauto" src="<?php echo \dash\get::index($value, 'user_detail', 'avatar'); ?>">
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
