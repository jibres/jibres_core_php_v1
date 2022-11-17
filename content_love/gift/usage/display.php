
<div class="fs12">
    <table class="tbl1 v1 responsive">
        <thead>
            <tr class="text-sm">
                <th><?php echo T_("Transaction ID"); ?></th>
                <th><?php echo T_("Price"); ?></th>
                <th><?php echo T_("Discount"); ?></th>
                <th><?php echo T_("Discount Percent"); ?></th>
                <th><?php echo T_("Final price"); ?></th>
                <th><?php echo T_("Date"); ?></th>
                <th class="collapsing"><?php echo T_("User"); ?></th>
            </tr>
        </thead>
        <tbody class="fs12">

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>

            <tr>

                <td><?php echo \dash\fit::number(a($value, 'transaction_id')); ?></td>
                <td><?php echo \dash\fit::number(a($value, 'price')); ?></td>
                <td><?php echo \dash\fit::number(a($value, 'discount')); ?></td>
                <td><?php echo \dash\fit::number(a($value, 'discountpercent')); ?></td>
                <td><?php echo \dash\fit::number(a($value, 'finalprice')); ?></td>
                <td><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></td>

                <td class="collapsing">
                  <a href="<?php echo \dash\url::that(). '?user='. a($value, 'user_id'); ?>" class="f align-center userPack">
                    <div class="c pRa10">
                      <div class="mobile" data-copy="<?php echo a($value, 'mobile'); ?>"><?php echo \dash\fit::mobile(a($value, 'mobile')); ?></div>
                      <div class="name"><?php echo a($value, 'displayname'); ?></div>
                    </div>
                    <img class="cauto" src="<?php echo a($value, 'avatar'); ?>">
                  </a>
                </td>

            </tr>
            <?php } //endfor ?>
        </tbody>
    </table>
</div>
<?php \dash\utility\pagination::html(); ?>
