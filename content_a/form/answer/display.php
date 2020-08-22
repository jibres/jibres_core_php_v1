


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
    <form method="get" action='<?php echo \dash\url::current(); ?>' >
      <div class="input">
        <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>
        <button class="addon btn "><?php echo T_("Search"); ?></button>
      </div>
    </form>
  </div>
<?php } //endfunction ?>





<?php function htmlTable() {?>

  <table class="tbl1 v1">
    <thead>
      <tr>

        <th class="collapsing"><?php echo T_("User") ?></th>
        <th class="collapsing"><?php echo T_("Start date") ?></th>
        <th class="collapsing"><?php echo T_("End date") ?></th>
        <th class="collapsing"><?php echo T_("Detail") ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
        <tr>


          <td class="collapsing"><span class="txtB"><?php if(\dash\get::index($value, 'user_id')) { echo T_("User"); }else{ echo T_("Unknown"); } ?></span></td>
          <td class="collapsing"><?php echo \dash\fit::date_time(\dash\get::index($value, 'startdate')); ?></td>
          <td class="collapsing"><?php echo \dash\fit::date_time(\dash\get::index($value, 'enddate')); ?></td>

          <td class="collapsing"><a class="btn link" href="<?php echo \dash\url::that(). '/detail?id='. \dash\request::get('id'). '&aid='. \dash\get::index($value, 'id'); ?>"><?php echo T_("Detail") ?></a></td>
        </tr>
      <?php } //endif ?>
    </tbody>
  </table>




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
  <div class="msg fs14 success2"><?php echo T_("Hi!") ?> <a class="btn link" href="<?php echo \dash\url::that() ?>/add"><?php echo T_("Add new") ?></a></div>
<?php } //endif ?>