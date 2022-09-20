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
        htmlTable();
        htmlFilter();
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
<?php } //end function ?>


<?php function htmlTable() {?>

    <div class="tblBox font-14">
        <table class="tbl1 v1">
            <thead>
                <th><?php echo T_("Id"); ?></th>
                <th><?php echo T_("Domain"); ?></th>
                <th><?php echo T_("IRNIC id"); ?></th>
                <th><?php echo T_("Notif count"); ?></th>
                <th><?php echo T_("Index"); ?></th>
                <th><?php echo T_("Note"); ?></th>
                <th><?php echo T_("Date"); ?></th>
                <th class="collapsing"></th>
            </thead>
            <tbody>
              <?php foreach (\dash\data::dataTable() as $key => $value) {?>
                <tr>
                    <td class="collapsing"><?php echo a($value, 'id'); ?></td>
                    <td><code><a href="<?php echo \dash\url::current(). '?q='. a($value, 'domain'); ?>"><?php echo a($value, 'domain'); ?></a></code></td>
                    <td><?php echo a($value, 'nic_id'); ?></td>
                    <td><?php echo a($value, 'notif_count'); ?></td>
                    <td><?php echo a($value, 'index'); ?></td>
                    <td><?php echo a($value, 'note'); ?></td>
                    <td class="collapsing"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></td>
                    <td class="collapsing">
                        <i class="sf-thumbnails" data-kerkere=".showDetail<?php echo a($value, 'id') ?>"></i>
                    </td>
                </tr>

                <tr data-kerkere-content='hide' class="showDetail<?php echo a($value, 'id') ?>">
                    <td colspan="8">
<pre class="text-left ltr"><?php echo a($value, 'detail_pretty') ?></pre>
                    </td>
                </tr>
              <?php }// endfor ?>
            </tbody>
        </table>
    </div>

<?php \dash\utility\pagination::html(); ?>
<?php } //end function ?>




<?php function htmlFilter() {?>
<p class="f fs14 alert-warning p-2 rounded">
  <span class="c"><?php echo \dash\data::filterBox(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::current(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //end function ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 alert-warning p-2 rounded">
  <span class="c s12"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?> </span>
  <a class="cauto" href="<?php echo \dash\url::current(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //end function ?>

