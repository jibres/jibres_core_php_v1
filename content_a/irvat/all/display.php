

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

                <th data-sort="<?php echo \dash\get::index($sortLink, 'title', 'order'); ?>" ><a href="<?php echo \dash\get::index($sortLink, 'title', 'link'); ?>"><?php echo T_("Title"); ?></a></th>
                <th class="txtL collapsing" data-sort="<?php echo \dash\get::index($sortLink, 'factordate', 'order'); ?>" ><a href="<?php echo \dash\get::index($sortLink, 'factordate', 'link'); ?>"><?php echo T_("Date"); ?></a></th>
                <th class="txtL collapsing"><?php echo T_("Season") ?></th>
                <th class="txtL" data-sort="<?php echo \dash\get::index($sortLink, 'total', 'order'); ?>" ><a href="<?php echo \dash\get::index($sortLink, 'total', 'link'); ?>"><?php echo T_("Total pay"); ?></a></th>
                <th class="txtL" data-sort="<?php echo \dash\get::index($sortLink, 'subtotalitembyvat', 'order'); ?>" ><a href="<?php echo \dash\get::index($sortLink, 'subtotalitembyvat', 'link'); ?>"><?php echo T_("Total item by vat"); ?></a></th>
                <th class="txtL" data-sort="<?php echo \dash\get::index($sortLink, 'sumvat', 'order'); ?>" ><a href="<?php echo \dash\get::index($sortLink, 'sumvat', 'link'); ?>"><?php echo T_("Sum vat"); ?></a></th>
                <th class="txtL collapsing"><?php echo T_("Economic code") ?><br><?php echo T_("Company national id"); ?> </th>
                <th class="txtC collapsing"><?php echo T_("Thirdparty") ?></th>

            </tr>
        </thead>
        <tbody class="">

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>

            <tr>
                <td>
                    <a href="<?php echo \dash\url::this(); ?>/edit?id=<?php echo \dash\get::index($value, 'id'); ?>" class="link">

                         <?php echo \dash\get::index($value, 'title'); ?>

                    </a>
                </td>

                <td class="ltr txtL"><?php echo \dash\fit::date(\dash\get::index($value, 'factordate')); ?></td>
                <td class="ltr txtL"><?php echo \dash\fit::text(\dash\get::index($value, 'year'). ' / '. \dash\get::index($value, 'season')); ?></td>
                <td class="ltr txtL"><?php echo \dash\fit::number(\dash\get::index($value, 'total')); ?></td>
                <td class="ltr txtL"><?php echo \dash\fit::number(\dash\get::index($value, 'subtotalitembyvat')); ?></td>
                <td class="ltr txtL"><?php echo \dash\fit::number(\dash\get::index($value, 'sumvat')); ?></td>

                <td class="fs08 txtL ltr collapsing">
                  <div><?php echo \dash\fit::text(\dash\get::index($value, 'user_detail_legal', 'companyeconomiccode')); ?></div>
                  <div><?php echo \dash\fit::text(\dash\get::index($value, 'user_detail_legal', 'companynationalid')); ?></div>
                </td>

                <td class="collapsing">
                  <div  class="f align-center userPack">
                    <div class="c pRa10">
                      <div class="mobile" data-copy="<?php echo \dash\get::index($value, 'user_detail_legal', 'mobile'); ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'user_detail_legal', 'mobile')); ?></div>
                      <div class="name"><?php echo \dash\get::index($value, 'user_detail_legal', 'companyname'); ?></div>
                    </div>
                    <img class="cauto" src="<?php echo \dash\get::index($value, 'user_detail', 'avatar'); ?>">
                  </div>
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

