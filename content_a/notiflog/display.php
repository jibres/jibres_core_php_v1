<?php if(\dash\data::messgeGroupBy()) {?>
  <div class="box">
    <div class="pad">
    <table class="tbl1 v4">

      <tbody>
        <tr class="positive">
          <td><?php echo T_("Count all") ?></td>
          <td><?php echo \dash\fit::number(array_sum(array_column(\dash\data::messgeGroupBy(), 'count'))) ?>
            <div class="btn linkDel" data-confirm data-data='{"emptytable": "emptytable"}'><?php echo T_("Delete all") ?></div>
          </td>

        </tr>

<?php foreach (\dash\data::messgeGroupBy() as $key => $value) {?>
  <tr>
    <td><?php echo \dash\get::index($value, 'message') ?></td>
    <td><?php echo \dash\fit::number(\dash\get::index($value, 'count')) ?></td>
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





<?php function htmlSearchBox() { return; ?>

  <div class="cbox fs12">
    <form method="get" action='<?php echo \dash\url::current(); ?>' >
      <div class="input">
        <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>
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



      </tr>
    </thead>
    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
        <tr>


          <td><?php echo \dash\get::index($value, 'id') ?></td>
          <td><?php echo \dash\get::index($value, 'type') ?></td>
          <td><?php echo \dash\get::index($value, 'method') ?></td>
          <td><?php echo \dash\get::index($value, 'message') ?></td>

          <td><?php echo \dash\get::index($value, 'user_id') ?></td>
          <td><?php echo \dash\get::index($value, 'urlkingdom') ?></td>
          <td><?php echo \dash\get::index($value, 'urldir') ?></td>
          <td><?php echo \dash\get::index($value, 'urlquery') ?></td>
          <td><?php echo \dash\get::index($value, 'datecreated') ?></td>


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
    <a class="cauto" href="<?php echo \dash\url::current(); ?>"><?php echo T_("Clear filters"); ?></a>
  </p>
<?php } //endif ?>


<?php function htmlFilterNoResult() {?>
  <p class="f fs14 msg warn2">
    <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
    <a class="cauto" href="<?php echo \dash\url::current(); ?>"><?php echo T_("Clear filters"); ?></a>
  </p>
<?php } //endif ?>


<?php function htmlStartAddNew() {?>
  <div class="msg fs14 success2"><?php echo T_("Hi!") ?></div>
<?php } //endif ?>