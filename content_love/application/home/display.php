<div class="f">

<?php foreach (\dash\data::groupByType() as $key => $value) {?>
        <div class="c s6">
        <a href="<?php echo \dash\url::current(). '?status='. $value['status']; ?>" class="dcard x1 <?php if(\dash\request::get('status') == $value['status']) { echo ' active';} ?>" >
         <div class="statistic">
          <div class="value"><?php echo \dash\fit::number($value['count']); ?></div>
          <div class="label"><?php echo T_($value['status']); ?></div>
         </div>
        </a>
    </div>
<?php } // endfor ?>
</div>



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
            <tr class="fs09">
                <th class="collapsing">#</th>
                <th><?php echo T_("Store"); ?></th>
                <th><?php echo T_("User"); ?></th>
                <th><?php echo T_("Status"); ?></th>
                <th><?php echo T_("Version"); ?></th>
                <th><?php echo T_("Build"); ?></th>

                <th><?php echo T_("Date request"); ?></th>
                <th><?php echo T_("Date queue"); ?></th>
                <th><?php echo T_("Date done"); ?></th>
                <th><?php echo T_("File"); ?></th>

            </tr>
        </thead>
        <tbody class="fs12">

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>

            <tr>
                <td class=""><a class="btn" href="<?php echo \dash\url::that(). '/edit?id='. a($value, 'id'); ?>"><i class="sf-edit"></i></a></td>
                <td>
                    <img src="<?php echo a($value, 'logo'); ?>" class="avatar">
                    <?php echo a($value, 'title'); ?>
                </td>
                <td>

                  <img src="<?php echo a($value, 'user_detail', 'avatar'); ?>" class="avatar">
                    <?php echo a($value, 'user_detail', 'displayname'); ?>
                    <div class="badge light"><?php echo \dash\fit::mobile(a($value, 'user_detail', 'mobile')); ?></div>
                </td>

                <td class=" "><code><?php echo T_(ucfirst(a($value, 'status'))); ?></code></td>
                <td class=" "><code><?php echo \dash\fit::number(a($value, 'version')); ?></code></td>
                <td class=" "><code><?php echo \dash\fit::number(a($value, 'build')); ?></code></td>


                <td class=" "><?php echo \dash\fit::date_human(a($value, 'daterequest')); ?></td>
                <td class=" "><?php echo \dash\fit::date_human(a($value, 'datequeue')); ?></td>
                <td class=" "><?php echo \dash\fit::date_human(a($value, 'datedone')); ?></td>
                <td class=" " title='<?php echo a($value, 'path'); ?>'><?php if(a($value, 'path')) { echo '<a href="https://app.talambar.ir/'. $value['path'].'" class="btn">'.T_("Download").'</a>'; }?></td>
            </tr>
            <tr>
                <td colspan="10" class="ltr text-left pTB5-f"><?php echo a($value, 'meta'); ?></td>
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

