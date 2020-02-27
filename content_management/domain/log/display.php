

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
                <th class="collapsing">#</th>
                <th><?php echo T_("User"); ?></th>
                <th><?php echo T_("Type"); ?></th>
                <th><?php echo T_("Client ID / Server ID"); ?></th>

                <th><?php echo T_("Resutl code"); ?></th>
                <th><?php echo T_("Date send"); ?></th>
                <th><?php echo T_("Date response"); ?></th>

            </tr>
        </thead>
        <tbody class="fs12">

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>

            <tr>
                <td class="collapsing"><a href="<?php echo \dash\url::that(). '/view?id='. \dash\get::index($value, 'id'); ?>"><i class="sf-rain-1"></i></a></td>
                <td>

                  <img src="<?php echo \dash\get::index($value, 'user_detail', 'avatar'); ?>" class="avatar">
                    <?php echo \dash\get::index($value, 'user_detail', 'displayname'); ?>
                    <div class="badge light"><?php echo \dash\fit::mobile(\dash\get::index($value, 'user_detail', 'mobile')); ?></div>
                </td>

                <td class="collapsing "><code><?php echo \dash\get::index($value, 'type'); ?></code></td>

                <td class="collapsing ">
                    <div class="fs08">
                        <code><?php echo \dash\get::index($value, 'client_id'); ?></code>
                        <br>
                        <code><?php echo \dash\get::index($value, 'server_id'); ?></code>
                    </div>
                </td>

                <td class="collapsing "><code><?php echo \dash\get::index($value, 'result_code'); ?></code></td>


                <td class="collapsing "><?php echo \dash\fit::date(\dash\get::index($value, 'datesend')); ?></td>
                <td class="collapsing "><?php echo \dash\fit::date(\dash\get::index($value, 'dateresponse')); ?></td>


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

