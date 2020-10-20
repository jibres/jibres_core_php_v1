
<?php $sortLink = \dash\data::sortLink(); ?>

<div class="fs12">
    <table class="tbl1 v1 responsive">
        <thead>
            <tr class="fs09">
                <th><?php echo T_("Domain"); ?></th>
                <th><?php echo T_("Date created"); ?></th>

            </tr>
        </thead>
        <tbody class="fs12">

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>

            <tr <?php  if(\dash\get::index($value, 'status') === 'disable') { echo 'class="negative"'; }?> >
                <td>
                    <a href="<?php echo \dash\url::this(); ?>/setting?domain=<?php echo \dash\get::index($value, 'name'); ?>" class="link flex"><code><?php echo \dash\get::index($value, 'name'); ?></code></a>
                </td>
                <td>
                	<?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')) ?>
                </td>


            </tr>
            <?php } //endfor ?>
        </tbody>
    </table>
</div>
<?php \dash\utility\pagination::html(); ?>