
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







<?php function htmlSearchBox() {?>
<div class="f justify-center">
    <div class="c7 x4 s12">
    <div class="fs12">
        <form method="get" autocomplete="off" class="mB20" action="<?php echo \dash\url::that(); ?>">
            <div class="input search ltr">
                <input type="text" name="q" placeholder='<?php echo T_("Search"); ?>' value="<?php echo \dash\validate::search_string(); ?>">
                <button class="btn addon success"><?php echo T_("Search"); ?></button>
            </div>
        </form>
    </div>
    </div>
</div>
<?php } //endfunction ?>


<?php function htmlTable() {?>
<div class="f">

<?php foreach (\dash\data::dataTable() as $key => $value) {?>
    <div class="c2 pA5">
        <a class="stat x70 available" href="<?php echo \dash\url::this(). '/buy/'. \dash\get::index($value, 'domain'); ?>">
            <h3><?php echo T_("Available") ?></h3>
            <div class="val ltr"><?php echo \dash\get::index($value, 'root'); ?> <small>.<?php echo \dash\get::index($value, 'tld'); ?></small></div>
        </a>
    </div>
<?php } //endfor ?>
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
    </div>

<?php } //endfunction ?>

