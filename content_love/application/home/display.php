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
                <td class=""><a class="btn" href="<?php echo \dash\url::that(). '/edit?id='. \dash\get::index($value, 'id'); ?>"><i class="sf-edit"></i></a></td>
                <td>
                    <img src="<?php echo \dash\get::index($value, 'logo'); ?>" class="avatar">
                    <?php echo \dash\get::index($value, 'title'); ?>
                </td>
                <td>

                  <img src="<?php echo \dash\get::index($value, 'user_detail', 'avatar'); ?>" class="avatar">
                    <?php echo \dash\get::index($value, 'user_detail', 'displayname'); ?>
                    <div class="badge light"><?php echo \dash\fit::mobile(\dash\get::index($value, 'user_detail', 'mobile')); ?></div>
                </td>

                <td class=" "><code><?php echo T_(ucfirst(\dash\get::index($value, 'status'))); ?></code></td>
                <td class=" "><code><?php echo \dash\fit::number(\dash\get::index($value, 'version')); ?></code></td>
                <td class=" "><code><?php echo \dash\fit::number(\dash\get::index($value, 'build')); ?></code></td>


                <td class=" "><?php echo \dash\fit::date_human(\dash\get::index($value, 'daterequest')); ?></td>
                <td class=" "><?php echo \dash\fit::date_human(\dash\get::index($value, 'datequeue')); ?></td>
                <td class=" "><?php echo \dash\fit::date_human(\dash\get::index($value, 'datedone')); ?></td>
                <td class=" " title='<?php echo \dash\get::index($value, 'path'); ?>'><?php if(\dash\get::index($value, 'path')) { echo '<a href="https://app.talambar.ir/'. $value['path'].'" class="btn">'.T_("Download").'</a>'; }?></td>
            </tr>
            <tr>
                <td colspan="10" class="ltr txtL pTB5-f"><?php echo \dash\get::index($value, 'meta'); ?></td>
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

