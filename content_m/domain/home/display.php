

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
    <form method="get" autocomplete="off" class="mB20" action="<?php echo \dash\url::that(); ?>">
        <div class="input search">
            <input type="text" name="q" placeholder='<?php echo T_("Search"); ?>' value="<?php echo \dash\request::get('q'); ?>">
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
            <tr class="fs09">
                <th><?php echo T_("User"); ?></th>
                <th data-sort="<?php echo \dash\get::index($sortLink, 'name', 'order'); ?>" ><a href="<?php echo \dash\get::index($sortLink, 'name', 'link'); ?>"><?php echo T_("Domain"); ?></a></th>
                <th></th>
                <th class="txtL" data-sort="<?php echo \dash\get::index($sortLink, 'dateexpire', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'dateexpire', 'link'); ?>"><?php echo T_("Expire date"); ?></a></th>
                <th class="txtL" data-sort="<?php echo \dash\get::index($sortLink, 'dateregister', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'dateregister', 'link'); ?>"><?php echo T_("Create date"); ?></a></th>
                <th class="txtL" data-sort="<?php echo \dash\get::index($sortLink, 'dateupdate', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'dateupdate', 'link'); ?>"><?php echo T_("Date modified"); ?></a></th>
                <th class="txtC"><?php echo T_("Status"); ?></th>
                <th class="txtL"><?php echo T_("DNS"); ?></th>
            </tr>
        </thead>
        <tbody class="fs12">

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>

            <tr>
                <td>

                  <img src="<?php echo \dash\get::index($value, 'user_detail', 'avatar'); ?>" class="avatar">
                    <?php echo \dash\get::index($value, 'user_detail', 'displayname'); ?>
                    <div class="badge light"><?php echo \dash\fit::mobile(\dash\get::index($value, 'user_detail', 'mobile')); ?></div>
                </td>
                <td>
                    <a href="<?php echo \dash\url::that(); ?>/detail?id=<?php echo \dash\get::index($value, 'id'); ?>" class="link"><code><?php echo \dash\get::index($value, 'name'); ?></code></a>
                </td>
                <td class="collapsing">

                    <div class="ibtn wide"><?php echo '<span>'.T_("Lock"). '</span>'; if(isset($value['lock']) && $value['lock']) { echo '<i class="sf-lock fc-green"></i>'; } else{ echo '<i class="sf-unlock fc-red"></i>'; }?></div>

                    <div class="ibtn wide"><?php echo '<span>'.T_("Autorenew"). '</span>'; if(isset($value['autorenew']) && $value['autorenew']) { echo '<i class="sf-refresh fc-blue"></i>'; } else{ echo '<i class="sf-times fc-red"></i>'; }?></div>
                </td>
                <td class="collapsing txtL"><?php echo \dash\fit::date(\dash\get::index($value, 'dateexpire')); ?></td>
                <td class="collapsing txtL"><?php echo \dash\fit::date(\dash\get::index($value, 'dateregister')); ?></td>
                <td class="collapsing txtL"><?php echo \dash\fit::date(\dash\get::index($value, 'dateupdate')); ?></td>
                <td class="collapsing txtC"><?php echo T_(\dash\get::index($value, 'status')); ?></td>
                <td class="collapsing ltr txtL">
                    <code><?php echo \dash\get::index($value, 'ns1'); ?></code>
                    <br>
                    <code><?php echo \dash\get::index($value, 'ns2'); ?></code>
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
  <a class="cauto" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>

<?php } //endfunction ?>





<?php function htmlStartAddNew() {?>

<div class="fs14 msg info2 pTB20">
  <p><?php echo T_("Hi!"); ?></p>


</div>

<?php } //endfunction ?>

