<?php if(!\dash\data::dataTable() && !\dash\request::get()) {?>

  <h2><?php echo T_("Contact form") ?></h2>

  <div class="welcome">
    <p><?php echo T_("We give you the opportunity to measure your customers' satisfaction with a variety of questions. In addition, you can get any other information from your audience"); ?></p>
    <h2><?php echo T_("Survey your customers with Form Maker"); ?></h2>

    <div class="buildBtn">
      <a class="btn xl master" href="<?php echo \dash\url::this(). '/add'; ?>" ><?php echo T_("Add contact form now!"); ?></a>
    </div>
  </div>


 <?php }else{ ?>



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







 <?php } //endif ?>





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

        <th class="collapsing">#</th>
        <th><?php echo T_("Title") ?></th>
        <th><?php echo T_("Status") ?></th>
        <th><?php echo T_("Item count") ?></th>
        <th><?php echo T_("Answers count") ?></th>

        <th class="collapsing"><?php echo T_("Edit") ?></th>
        <th class="collapsing"><?php echo T_("Answers") ?></th>
        <th class="collapsing"><?php echo T_("Report") ?></th>
      </tr>
    </thead>
    <tbody class="font-12">
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
        <tr>

          <td class="collapsing"><?php echo \dash\fit::number(\dash\get::index($value, 'id')); ?></td>
          <td><a target="_blank" href="<?php echo \lib\store::url(). '/f/'. \dash\get::index($value, 'id'); ?>"><i class="sf-link-external"></i></a> <?php echo \dash\get::index($value, 'title') ?></td>
          <td><?php echo T_(\dash\get::index($value, 'status')) ?></td>
          <td><?php echo \dash\fit::number(\dash\get::index($value, 'item_count')); ?></td>
          <td><?php echo \dash\fit::number(\dash\get::index($value, 'answer_count')); ?></td>
          <td class="collapsing"><a class="btn link" href="<?php echo \dash\url::that(). '/edit?id='. \dash\get::index($value, 'id'); ?>"><i class="sf-edit"></i> <?php echo T_("Edit") ?></a></td>
          <td class="collapsing"><a class="btn link" href="<?php echo \dash\url::that(). '/answer?id='. \dash\get::index($value, 'id'); ?>"><i class="sf-list"></i> <?php echo T_("Answers") ?></a></td>
          <td class="collapsing"><a class="btn link" href="<?php echo \dash\url::that(). '/report?id='. \dash\get::index($value, 'id'); ?>"><i class="sf-chart"></i> <?php echo T_("Report") ?></a></td>
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