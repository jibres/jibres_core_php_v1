

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

                <th data-sort="<?php echo \dash\get::index($sortLink, 'factordate', 'order'); ?>" ><a href="<?php echo \dash\get::index($sortLink, 'factordate', 'link'); ?>"><?php echo T_("Date"); ?></a></th>

                <th data-sort="<?php echo \dash\get::index($sortLink, 'title', 'order'); ?>" ><a href="<?php echo \dash\get::index($sortLink, 'title', 'link'); ?>"><?php echo T_("Title"); ?></a></th>
                <th><?php echo T_("Thirdparty") ?></th>
                <th data-sort="<?php echo \dash\get::index($sortLink, 'total', 'order'); ?>" ><a href="<?php echo \dash\get::index($sortLink, 'total', 'link'); ?>"><?php echo T_("Total pay"); ?></a></th>
                <th data-sort="<?php echo \dash\get::index($sortLink, 'sumvat', 'order'); ?>" ><a href="<?php echo \dash\get::index($sortLink, 'sumvat', 'link'); ?>"><?php echo T_("Sum vat"); ?></a></th>
                <th><?php echo T_("Season") ?></th>

            </tr>
        </thead>
        <tbody class="fs12">

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>

            <tr>
                <td><?php echo \dash\fit::date(\dash\get::index($value, 'factordate')); ?></td>
                <td>
                    <a href="<?php echo \dash\url::this(); ?>/edit?id=<?php echo \dash\get::index($value, 'id'); ?>" class="link">

                         <?php echo \dash\get::index($value, 'title'); ?>

                    </a>
                </td>

                   <td class="collapsing">
                  <a href="<?php echo \dash\url::that(). '?user='.\dash\get::index($value, 'user_id'); ?>" class="f align-center userPack">
                    <div class="c pRa10">
                      <div class="mobile" data-copy="<?php echo \dash\get::index($value, 'user_detail', 'mobile'); ?>"><?php echo \dash\fit::mobile(\dash\get::index($value, 'user_detail', 'mobile')); ?></div>
                      <div class="name"><?php echo \dash\get::index($value, 'user_detail', 'displayname'); ?></div>
                    </div>
                    <img class="cauto" src="<?php echo \dash\get::index($value, 'user_detail', 'avatar'); ?>">
                  </a>
                </td>
                <td>
                    <?php echo \dash\fit::number(\dash\get::index($value, 'total')); ?>
                </td>
                <td>
                    <?php echo \dash\fit::number(\dash\get::index($value, 'sumvat')); ?>
                </td>
                <td><?php echo \dash\fit::number(\dash\get::index($value, 'season')); ?></td>



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

