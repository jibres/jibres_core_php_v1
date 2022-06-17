
  <?php
  if(\dash\data::dataTable())
  {
    if(\dash\data::countNotReviewed())
    {
     ?>
     <div class="alert-info text-sm flex align-center mb-2">
       <div class="c font-bold"><?php echo T_("You have :val not reviewed answer", ['val' => \dash\fit::number(\dash\data::countNotReviewed())]) ?></div>
       <div class="cauto"><div class="btn-primary btn-sm" data-confirm data-data='{"mark": "all"}'><?php echo T_("Mark all as review") ?></div></div>
     </div>
      <?php
    }
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

  <div class="cbox text-xs my-2">
    <form method="get" action='<?php echo \dash\url::current(); ?>' >
      <input type="hidden" name="id" value="<?php echo \dash\request::get('id') ?>">
      <div class="input">
        <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>
        <button class="addon btn "><?php echo T_("Search"); ?></button>
      </div>
    </form>
  </div>
<?php } //endfunction ?>

<?php function htmlTable() {?>
  <div class="tblBox">

  <table class="tbl1 v1">
    <thead>
      <tr>
        <th class="collapsing"><?php echo T_("ID") ?></th>

        <th><?php echo T_("Start date") ?></th>
        <th><?php echo T_("End date") ?></th>
        <th><?php echo T_("Count answer") ?></th>
        <th><?php echo T_("Status") ?></th>
        <th class="collapsing"></th>
        <th class="collapsing"><?php echo T_("Review") ?></th>
        <th class="collapsing"><?php echo T_("Detail") ?></th>

      </tr>
    </thead>
    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
        <tr>
          <td class="collapsing"><?php echo \dash\fit::number(a($value, 'id')) ?></td>
          <td><?php echo \dash\fit::date_time(a($value, 'startdate')); ?></td>
          <td><?php echo \dash\fit::date_time(a($value, 'enddate')); ?></td>
          <td><?php echo \dash\fit::number(a($value, 'count_answer')); ?></td>
          <td><?php echo T_(strval(a($value, 'status'))); ?></td>
          <td class="collapsing"><?php if(a($value, 'factor_id')) {?><a href="<?php echo \dash\url::kingdom(). '/a/order/comment?id='. a($value, 'factor_id'); ?>"><?php echo T_("View Order") ?></a><?php } //endif ?></td>
          <td class="collapsing"><?php if(a($value, 'review')){echo \dash\utility\icon::svg('check-circle', 'bootstrap', 'green', 'w-4') ;}else{echo \dash\utility\icon::svg('question-circle', 'bootstrap', '#D3D3D3', 'w-4');} ?></td>
          <td class="collapsing"><a class="btn-link" href="<?php echo \dash\url::that(). '/detail?id='. \dash\request::get('id'). '&aid='. a($value, 'id'); ?>"><?php echo T_("Detail") ?></a></td>
        </tr>
      <?php } //endif ?>
    </tbody>
  </table>
  </div>
 <?php \dash\utility\pagination::html(); ?>

<?php } //endif ?>

<?php function htmlFilter() {?>
  <p class="alert-info text-sm f">
    <span class="c"><?php echo \dash\data::filterBox(); ?></span>
    <a class="cauto" href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'); ?>"><?php echo T_("Clear filters"); ?></a>
  </p>
<?php } //endif ?>

<?php function htmlFilterNoResult() {?>
  <p class="alert-warning f text-sm">
    <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
    <a class="cauto" href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'); ?>"><?php echo T_("Clear filters"); ?></a>
  </p>
<?php } //endif ?>

<?php function htmlStartAddNew() {?>
  <div class="alert-success text-sm"><?php echo T_("Hi!"). ' ' . T_("No anwer found"); ?></div>
<?php } //endif ?>