
<?php


if(\dash\data::dataTable())
{
  if(\dash\data::dataFilter())
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
  if(\dash\data::dataFilter())
  {

    htmlSearchBox();
    htmlFilterNoResult();


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
      <tr class="fs08">
        <th class="collapsing">&nbsp;</th>
        <th><?php echo T_("Title"); ?></th>
        <th class="s0"><?php echo T_("Slug"); ?></th>
        <th class="collapsing s0"><?php echo T_("Count product"); ?></th>

      </tr>
    </thead>

    <tbody>
      <?php foreach ($dataTable as $key => $value) {?>

      <tr>
        <td class="collapsing">
          <?php if(isset($value['file']) && $value['file']) {?><img src="<?php echo \dash\get::index($value, 'file'); ?>" class="avatar"><?php } //endif ?>
        </td>
        <td ><a class="txtB" href="<?php echo \dash\url::here(); ?>/category/edit?id=<?php echo \dash\get::index($value, 'id'); ?>"><i class="sf-edit-write mRa10"></i><?php echo \dash\get::index($value, 'title'); ?></a>
          <br>
          <span class="fc-mute fs09"><?php echo \dash\get::index($value, 'parent_title'); ?></span>
        </td>
        <td class="s0"><?php echo \dash\get::index($value, 'full_slug'); ?></td>
        <td class="s0 collapsing">
          <a href="<?php echo \dash\url::here(); ?>/products?catid=<?php echo \dash\get::index($value, 'id'); ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'count')); ?> <small class="fc-mute"><?php echo T_("Product"); ?></small></a>
        </td>

      </tr>
      <?php } //endfor ?>
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


