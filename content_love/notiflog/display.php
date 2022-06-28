<?php if(\dash\data::messgeGroupBy()) {?>
  <div class="box">
    <div class="pad">
    <table class="tbl1 v4">

      <tbody>
        <tr class="positive">
          <td><?php echo T_("Count all") ?></td>
          <td><?php echo \dash\fit::number(array_sum(array_column(\dash\data::messgeGroupBy(), 'count'))) ?>
            <div class="btn-link-danger" data-confirm data-data='{"emptytable": "emptytable"}'><?php echo T_("Delete all") ?></div>
          </td>

        </tr>

<?php foreach (\dash\data::messgeGroupBy() as $key => $value) {?>
  <tr>
    <td><?php echo a($value, 'message') ?></td>
    <td><?php echo \dash\fit::number(a($value, 'count')) ?></td>
  </tr>
<?php } //endif ?>
      </tbody>
    </table>
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





<?php function htmlSearchBox() { ?>

  <div class="cbox fs12">
    <form method="get" action='<?php echo \dash\url::current(); ?>' >
      <div class="input">
        <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>
        <button class="addon btn "><?php echo T_("Search"); ?></button>
      </div>
    </form>
  </div>
<?php } //endfunction ?>





<?php function htmlTable() {?>
<div class="tblBox fs14">

  <table class="tbl1 v1">
    <thead>
      <tr>


      <th><?php echo T_("id") ?></th>
      <th><?php echo T_("type") ?></th>
      <th><?php echo T_("method") ?></th>
      <th><?php echo T_("message") ?></th>

      <th><?php echo T_("user_id") ?></th>
      <th><?php echo T_("urlkingdom") ?></th>
      <th><?php echo T_("urldir") ?></th>
      <th><?php echo T_("urlquery") ?></th>
      <th><?php echo T_("datecreated") ?></th>
      <th class="collapsing"></th>


      </tr>
    </thead>
    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
        <tr>
          <td><?php echo a($value, 'id') ?></td>
          <td><?php echo a($value, 'type') ?></td>
          <td><?php echo a($value, 'method') ?></td>
          <td><?php echo a($value, 'message') ?></td>

          <td><?php echo a($value, 'user_id') ?></td>
          <td><?php echo a($value, 'urlkingdom') ?></td>
          <td><?php echo a($value, 'urldir') ?></td>
          <td><?php echo a($value, 'urlquery') ?> </td>
          <td><?php echo a($value, 'datecreated') ?></td>
          <td class="collapsing"><i class="sf-list-ul" title="<?php echo a($value, 'urlkingdom'). '/'. a($value, 'urldir'). '?'. a($value, 'urlquery') ?>"></i></td>


        </tr>
        <?php if(a($value, 'meta')) {?>
          <tr class="ltr">
            <td colspan="10" class="ltr text-left"><span class="ltr"><?php echo a($value, 'meta') ?></span></td>
          </tr>
      <?php }//endif ?>
      <?php } //endif ?>
    </tbody>
  </table>
</div>




  <?php \dash\utility\pagination::html(); ?>

<?php } //endif ?>




















<?php function htmlFilter() {?>
  <p class="f fs14 alert-info">
    <span class="c"><?php echo \dash\data::filterBox(); ?></span>
    <a class="cauto" href="<?php echo \dash\url::current(); ?>"><?php echo T_("Clear filters"); ?></a>
  </p>
<?php } //endif ?>


<?php function htmlFilterNoResult() {?>
  <p class="f fs14 alert-warning">
    <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
    <a class="cauto" href="<?php echo \dash\url::current(); ?>"><?php echo T_("Clear filters"); ?></a>
  </p>
<?php } //endif ?>


<?php function htmlStartAddNew() {?>
  <div class="msg fs14 success2"><?php echo T_("Hi!") ?></div>
<?php } //endif ?>