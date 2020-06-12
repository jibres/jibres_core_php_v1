

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
<div class="cbox fs12">
  <form method="get" action='<?php echo \dash\url::this(); ?>' >
    <div class="input">
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" autofocus autocomplete='off'>

      <?php if(\dash\request::get('type')) {?>

      <input type="hidden" name="type" value="<?php echo \dash\request::get('type'); ?>">

      <?php } // endif ?>

      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
  </form>
</div>
<?php } //endfunction ?>





<?php function htmlTable() {?>

<?php
$sortLink = \dash\data::sortLink();
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}

?>

  <table class="tbl1 v1 cbox fs12">
    <thead>
      <tr>
        <th class="collapsing"><?php echo T_("View"); ?></th>
        <th><?php echo T_("Product count"); ?></th>
        <th><?php echo T_("Item count"); ?></th>
        <th><?php echo T_("Date"); ?></th>
        <th class="collapsing"><?php echo T_("User"); ?></th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($dataTable as $key => $value) {?>

      <tr class="">
        <td class="collapsing"><a href="<?php echo \dash\url::this(); ?>/add?user=<?php echo \dash\get::index($value, 'user_id'); ?>"><i class="sf-list"></i> <?php echo T_("Detail"); ?></a></td>

        <td>
          <?php echo \dash\fit::number(\dash\get::index($value, 'product_count')); ?> <small><?php echo T_("Product"); ?></small>
        </td>
        <td>
          <?php echo \dash\fit::number(\dash\get::index($value, 'item_count')); ?> <small><?php echo T_("Item"); ?></small>
        </td>
        <td><?php echo \dash\fit::date_human(\dash\get::index($value, 'date')); ?></td>

      <td class="collapsing">
          <a href="<?php echo \dash\url::that(). '/add?user='.\dash\get::index($value, 'user_id'); ?>" class="f align-center userPack">
            <div class="c pRa10">
              <div class="mobile" data-copy="<?php echo \dash\get::index($value, 'mobile'); ?>"><?php echo \dash\fit::mobile(\dash\get::index($value, 'mobile')); ?></div>
              <div class="name"><?php echo \dash\get::index($value, 'displayname'); ?></div>
            </div>
            <img class="cauto" src="<?php echo \dash\get::index($value, 'avatar'); ?>">
          </a>
        </td>
      </tr>
      <?php } //endif ?>
    </tbody>
  </table>

<?php \dash\utility\pagination::html(); ?>

<?php } //endif ?>




















<?php function htmlFilter() {?>
<p class="f fs14 msg info2">
  <span class="c"><?php echo \dash\data::filterBox(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/<?php echo \dash\url::module(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/<?php echo \dash\url::module(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>


<?php function htmlStartAddNew() {?>
<p class="fs14 msg success2 pTB20"><?php echo T_("No record exist!"); ?></p>
<?php } //endif ?>


