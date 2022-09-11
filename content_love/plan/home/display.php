<div class="tblBox">

    <table class="tbl1 v1 fs12 selectable">
        <thead>
        <tr>
            <th><?php echo T_("Business"); ?></th>
            <th><?php echo T_("Plan"). ' / '. T_("Action");?></th>
            <th><?php echo T_("Start Date"). ' / '. T_("Expire Date"); ?></th>
            <th><?php echo T_("Period"); ?></th>
            <th><?php echo T_("Price"); ?></th>
            <th><?php echo T_("Status"). ' / '. T_("Reason"); ?></th>
            <th><?php echo T_("User"); ?></th>
            <th><?php echo T_("datecreated"); ?></th>
            <th class="collapsing"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach (\dash\data::dataTable() as $key => $value) : ?>
            <tr>
                <td class="collapsing">
                    <a class="block"
                       href="<?php echo \dash\url::that() . '?' . \dash\request::build_query(['business_id' => a($value, 'store_id')]) ?>">
                        <code>
                            <?php echo a($value, 'store_id'); ?>
                        </code>
                    </a>
                    <a class="block"
                       href="<?php echo \dash\url::kingdom() . '/' . \dash\store_coding::encode(a($value, 'store_id')); ?>">
                        <code>
                            <?php echo \dash\store_coding::encode(a($value, 'store_id')); ?>
                        </code>
                    </a>
                </td>
                <td>
                    <a href="<?php echo \dash\url::this() . \dash\request::full_get(['plan' => $value['plan']]) ?>">
                        <?php echo a($value, 't_plan'). ' / '. T_(strval(a($value, 'action'))) ?>
                    </a>
                </td>
                <td>
                    <span class="block text-green-600" title="<?php echo T_("Start Date"); ?>"><?php echo \dash\fit::date_time(a($value, 'startdate')) ?></span>
                    <?php if(a($value, 'expirydate')) : ?>
                    <span class="block text-red-600" title="<?php echo T_("Expire date"); ?>"><?php echo \dash\fit::date_time(a($value, 'expirydate')) ?></span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo \dash\url::this(). \dash\request::full_get(['periodtype' => $value['periodtype']]) ?>">
                        <?php echo T_(strval(a($value, 'periodtype'))) ?>
                    </a>
                    <small class="txt-gray-500 block"><?php echo \dash\fit::number(a($value, 'days')) . ' '. T_("Day") ?> </small>
                </td>
                <td>
                    <?php echo \dash\fit::price(a($value, 'finalprice')) ?>
                    <small class="block text-gray-400"><?php echo \lib\currency::name($value['currency']) ?></small>
                </td>
                <td>
                    <a href="<?php echo \dash\url::this(). \dash\request::full_get(['status' => $value['status']]) ?>">
                        <?php
                        echo T_(strval(a($value, 'status')));
                        if(a($value, 'reason'))
						{
                            echo ' / '. T_($value['reason']);
                        }

                        ?>
                    </a>
                </td>
                <td>
                    <img src="<?php echo a($value, 'user_detail', 'avatar'); ?>" class="avatar">
                    <?php echo a($value, 'user_detail', 'displayname'); ?>
                    <br>
                    <div class="badge light"><?php echo \dash\fit::mobile(a($value, 'user_detail', 'mobile')); ?></div>
                </td>
                <td title="<?php echo a($value, 'datecreated'); ?>">
                    <?php echo \dash\fit::date_human(a($value, 'datecreated')); ?>
                    <small class="block text-gray-400"><?php echo \dash\fit::date_time($value['datecreated']) ?></small>
                </td>
                <td class="collapsing">
                    <a href="<?php echo \dash\url::this() . '/detail?id=' . a($value, 'id') ?>"
                       class="btn-primary btn-sm"><?php echo T_("Detail") ?></a>
                </td>

            </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php \dash\utility\pagination::html(); ?>


