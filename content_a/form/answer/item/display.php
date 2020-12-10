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
    <form method="get" action='<?php echo \dash\url::current(); ?>'>
      <input type="hidden" name="id" value="<?php echo \dash\request::get('id') ?>">
      <input type="hidden" name="iid" value="<?php echo \dash\request::get('iid') ?>">
      <div class="input">
        <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>
        <button class="addon btn "><?php echo T_("Search"); ?></button>
      </div>
    </form>
  </div>
<?php } //endfunction ?>

<?php function htmlTable() {?>
  <table class="tbl1 v1">
    <thead>
      <tr>
        <th class="collapsing"><?php echo T_("Item") ?></th>
        <th class=""><?php echo T_("Answer") ?></th>
        <th class="collapsing"><?php echo T_("Other answer") ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
        <tr>
          <td class="collapsing"><?php echo a($value, 'item_title'); ?></td>
          <td class="">
            <?php echo a($value, 'answer'); ?>
            <?php echo a($value, 'textarea'); ?>
          </td>
          <td class="collapsing"><a class="btn link" href="<?php echo \dash\url::this(). '/answer/detail?id='. \dash\request::get('id'). '&aid='. a($value, 'answer_id') ?>"><?php echo T_("Other answer") ?></a></td>
        </tr>
      <?php } //endif ?>
    </tbody>
  </table>
  <?php \dash\utility\pagination::html(); ?>
<?php } //endif ?>

<?php function htmlFilter() {?>
  <p class="f fs14 msg info2">
    <span class="c"><?php echo \dash\data::filterBox(); ?></span>
    <a class="cauto" href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'). '&iid='. \dash\request::get('iid'); ?>"><?php echo T_("Clear filters"); ?></a>
  </p>
<?php } //endif ?>

<?php function htmlFilterNoResult() {?>
  <p class="f fs14 msg warn2">
    <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
    <a class="cauto" href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'). '&iid='. \dash\request::get('iid'); ?>"><?php echo T_("Clear filters"); ?></a>
  </p>
<?php } //endif ?>

<?php function htmlStartAddNew() {?>
  <div class="msg fs14 success2"><?php echo T_("Hi!") ?></div>
<?php } //endif ?>