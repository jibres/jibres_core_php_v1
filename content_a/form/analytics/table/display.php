<?php if(\dash\data::filterDetail_title()) {?>
  <div class="box">
    <div class="body">
      <div class="f">
        <div class="cauto"><?php echo \dash\data::filterDetail_title(); ?></div>
        <div class="c"></div>
        <div class="cauto"><a class="btn" href="<?php echo \dash\url::that(). '/filter?'. \dash\request::fix_get(); ?>"><?php echo T_("View filter") ?></a></div>
      </div>

    </div>
  </div>
<?php } //endif ?>
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

<?php function htmlSearchBox() { return;?>
  <div class="cbox fs12">
    <form method="get" action='<?php echo \dash\url::current(); ?>' >
      <input type="hidden" name="id" value="<?php echo \dash\request::get('id') ?>">
      <div class="input">
        <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>
        <button class="addon btn "><?php echo T_("Search"); ?></button>
      </div>
    </form>
  </div>
<?php } //endfunction ?>

<?php function htmlTable() {?>

<?php

  $dataTable = \dash\data::dataTable();

  if(!is_array($dataTable))
  {
    $dataTable = [];
  }

  $fields = \dash\data::fields();


?>
<div class="tblBox">

  <table class="tbl1 v8">
    <thead>
      <tr>
        <?php foreach ($fields as $key => $value) {?>
          <?php if(\dash\get::index($value, 'field') === 'f_answer_id') {?>
            <th class="collapsing"><?php echo T_("Show") ?></th>
            <?php }else{ ?>
            <th class="collapsing"><?php echo \dash\get::index($value, 'title') ?></th>
            <?php }//endif ?>
        <?php } //endif ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
        <tr>
          <?php foreach ($fields as $field) {?>
            <?php if(\dash\get::index($field, 'field') === 'f_answer_id') {?>
              <td><a class="btn primary2 xs" href="<?php echo \dash\url::this(). '/answer/detail?id='. \dash\request::get('id'). '&aid='. \dash\get::index($value, \dash\get::index($field, 'field'))  ?>"><?php echo T_("Show") ?></a></td>
            <?php }else{ ?>
              <td class="collapsing"><?php echo \dash\get::index($value, \dash\get::index($field, 'field')) ?></td>
            <?php }//endif ?>
        <?php } //endif ?>
        </tr>
      <?php } //endif ?>
    </tbody>
  </table>
</div>
 <?php \dash\utility\pagination::html(); ?>

<?php } //endif ?>

<?php function htmlFilter() {?>
  <p class="f fs14 msg info2">
    <span class="c"><?php echo \dash\data::filterBox(); ?></span>
    <a class="cauto" href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'); ?>"><?php echo T_("Clear filters"); ?></a>
  </p>
<?php } //endif ?>

<?php function htmlFilterNoResult() {?>
  <p class="f fs14 msg warn2">
    <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
    <a class="cauto" href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'); ?>"><?php echo T_("Clear filters"); ?></a>
  </p>
<?php } //endif ?>

<?php function htmlStartAddNew() {?>

  <div class="welcome">
    <p><?php echo T_("Create now"); ?></p>
    <h2><?php echo T_("Create form view"); ?></h2>

    <div class="buildBtn">
      <a class="btn xl master" data-data='{"create": "create"}' data-confirm ><?php echo T_("Buil it now"); ?></a>
    </div>
  </div>
<?php } //endif ?>