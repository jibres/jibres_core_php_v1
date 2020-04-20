<div class="f justify-center">
    <div class="c7 x4 s12">

<?php
if(\dash\data::dataTable())
{
    if(\dash\data::isFiltered())
    {
        htmlSearchBox();
        htmlTable();
        htmlFilter();
    }
    else
    {
        htmlSearchBox();
        htmlTable();
    }

}
else
{
    if(\dash\data::isFiltered())
    {
        htmlSearchBox();

        htmlFilter();
    }
    else
    {
        htmlStartAddNew();
    }
}
?>
    </div>
</div>







<?php function htmlSearchBox() {?>
    <div class="fs12">
        <form method="get" autocomplete="off" class="mB20" action="<?php echo \dash\url::that(); ?>">
            <div class="input search ltr">
                <input type="text" name="q" placeholder='<?php echo T_("Search"); ?>' value="<?php echo \dash\request::get('q'); ?>">
                <button class="btn addon success"><?php echo T_("Search"); ?></button>
            </div>
        </form>
    </div>
<?php } //endfunction ?>


<?php function htmlTable() {?>
    <?php $sortLink = \dash\data::sortLink(); ?>

    <div class="fs12">
        <table class="tbl1 v5 responsive">
            <tbody class="fs12">

                <?php foreach (\dash\data::dataTable() as $key => $value) {?>

                    <tr>
                        <td>
                            <a href="<?php echo \dash\url::this(). '/buy/'. \dash\get::index($value, 'domain'); ?>" class="btn success2"><?php echo T_("Buy"); ?></a>
                        </td>
                        <td class="collapsing">
                            <div class="link ltr"><?php echo \dash\get::index($value, 'domain'); ?></div>
                        </td>
                    </tr>
                <?php } //endfor ?>
            </tbody>
        </table>
    </div>
    <?php \dash\utility\pagination::html(); ?>

<?php } //endfunction ?>




<?php function htmlFilter() {?>
    <p class="f fs14 msg warn2">
        <span class="c"><?php echo \dash\data::filterBox(); ?></span>
        <a class="cauto" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
    </p>

<?php } //endfunction ?>





<?php function htmlStartAddNew() {?>

    <div class="fs14 msg info2 pTB20">
        <p><?php echo T_("Hi!"); ?></p>
        <p><a href="<?php echo \dash\url::that(); ?>/buy"><?php echo T_("Buy your first winning domain!"); ?></a></p>

    </div>

<?php } //endfunction ?>

