
<div class="fs12">
    <table class="tbl1 v1 responsive">
        <thead>
            <tr class="fs09">

                <th><?php echo T_("Code"); ?></th>
                <th class="txtC"><?php echo T_("Category"); ?></th>
                <th class="txtC"><?php echo T_("Status"); ?></th>
                <th class="txtC"><?php echo T_("View"); ?></th>

            </tr>
        </thead>
        <tbody class="fs12">

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>

            <tr>
                <td>
                    <a href="<?php echo \dash\url::this(); ?>/view?id=<?php echo a($value, 'id'); ?>" class="link"><code><?php echo a($value, 'code'); ?></code></a>
                </td>
                <td class="collapsing txtC"><?php echo a($value, 'category'); ?></td>

                <td class="collapsing txtC"><?php echo T_(a($value, 'status')); ?></td>
                <td class="collapsing txtC"><a class="btn light" href="<?php echo \dash\url::this() .'/card?id='. a($value, 'id'); ?>"><?php echo T_("Show gitft card") ?></a></td>


            </tr>
            <?php } //endfor ?>
        </tbody>
    </table>
</div>
<?php \dash\utility\pagination::html(); ?>
