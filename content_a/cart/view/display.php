

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
  <form method="get" action='<?php echo \dash\url::this(); ?>' data-action>
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
        <th>{%trans "Product"%}</th>
        <th>{%trans "Count"%}</th>
        <th>{%trans "Date"%}</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($dataTable as $key => $value) {?>

      <tr class="">
        <td><?php echo @$value['title']; ?></td>
        <td><?php echo \dash\fit::number(@$value['count']); ?></td>
        <td><?php echo \dash\fit::date(@$value['date']); ?></td>
      </tr>
      <?php } //endfor ?>
    </tbody>
  </table>

<?php \dash\utility\pagination::html(); ?>

<?php } //endif ?>




















<?php function htmlFilter() {?>
<p class="f fs14 msg info2">
  <span class="c"><?php echo \dash\data::dataFilter(); ?></span>
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

