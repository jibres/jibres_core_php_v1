

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
<div class="fs12">
    <form method="get" autocomplete="off" class="mb-4" action="<?php echo \dash\url::that(); ?>">
        <div class="input search">
            <input type="text" name="q" placeholder='<?php echo T_("Search"); ?>' value="<?php echo \dash\validate::search_string(); ?>">
            <button class="btn addon success"><?php echo T_("Search"); ?></button>
        </div>
    </form>
</div>
<?php } //endfunction ?>


<?php function htmlTable() {?>
<?php $sortLink = \dash\data::sortLink(); ?>

<div class="fs12">
    <table class="tbl1 v1 responsive">
        <thead>
            <tr class="text-sm">

                <th data-sort="<?php echo a($sortLink, 'domain', 'order'); ?>" ><a href="<?php echo a($sortLink, 'domain', 'link'); ?>"><?php echo T_("Domain"); ?></a></th>

                <th class="text-left" data-sort="<?php echo a($sortLink, 'dateexpire', 'order'); ?>"><a href="<?php echo a($sortLink, 'dateexpire', 'link'); ?>"><?php echo T_("Expire date"); ?></a></th>
                <th class="text-left" data-sort="<?php echo a($sortLink, 'dateregister', 'order'); ?>"><a href="<?php echo a($sortLink, 'dateregister', 'link'); ?>"><?php echo T_("Create date"); ?></a></th>
                <th class="text-left" data-sort="<?php echo a($sortLink, 'dateupdate', 'order'); ?>"><a href="<?php echo a($sortLink, 'dateupdate', 'link'); ?>"><?php echo T_("Date modified"); ?></a></th>
                <th class="text-center"><?php echo T_("Status"); ?></th>
                <th class="text-left"><?php echo T_("DNS"); ?></th>
            </tr>
        </thead>
        <tbody class="fs12">

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>
            <tr>
               <td>
                    <a href="<?php echo \dash\url::that(); ?>/detail?id=<?php echo a($value, 'id'); ?>" class="link-primary"><code><?php echo a($value, 'domain'); ?></code></a>
                </td>

                <td class="collapsing text-left"><?php echo \dash\fit::date(a($value, 'dateexpire')); ?></td>
                <td class="collapsing text-left"><?php echo \dash\fit::date(a($value, 'dateregister')); ?></td>
                <td class="collapsing text-left"><?php echo \dash\fit::date(a($value, 'dateupdate')); ?></td>
                <td class="collapsing text-center"><?php echo T_(a($value, 'status')); ?></td>
                <td class="collapsing ltr text-left">
                    <code><?php echo a($value, 'ns1'); ?></code>
                    <br>
                    <code><?php echo a($value, 'ns2'); ?></code>
                </td>

            </tr>
            <?php } //endfor ?>
        </tbody>
    </table>
</div>
<?php \dash\utility\pagination::html(); ?>

<?php } //endfunction ?>




<?php function htmlFilter() {?>
<p class="f fs14 alert-warning p-2 rounded">
  <span class="c"><?php echo \dash\data::filterBox(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>

<?php } //endfunction ?>





<?php function htmlStartAddNew() {?>

<div class="alert-info p-4 rounded">
  <p><?php echo T_("Hi!"); ?></p>


</div>

<?php } //endfunction ?>

