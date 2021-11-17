
  <?php
  if(\dash\data::dataTable())
  {
    if(\dash\data::countNotReviewed())
    {
     ?>
     <div class="f alert-info text-sm">
       <div class="c txtB"><?php echo T_("You have :val not reviewed answer", ['val' => \dash\fit::number(\dash\data::countNotReviewed())]) ?></div>
       <div class="cauto"><div class="btn-primary" data-confirm data-data='{"mark": "all"}'><?php echo T_("Mark all as review") ?></div></div>
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

  <div class="cbox fs12">
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
          <td class="collapsing"><?php if(a($value, 'factor_id')) {?><a href="<?php echo \dash\url::kingdom(). '/a/order/comment?id='. a($value, 'factor_id'); ?>"><?php echo T_("View Order") ?></a><?php } //endif ?></td>
          <td class="collapsing"><?php if(a($value, 'review')){echo "<i class='sf-check fc-black'></i>";}else{echo "<i class='sf-times fc-mute'></i>";} ?></td>
          <td class="collapsing"><a class="btn-link" href="<?php echo \dash\url::that(). '/detail?id='. \dash\request::get('id'). '&aid='. a($value, 'id'); ?>"><?php echo T_("Detail") ?></a></td>
        </tr>
      <?php } //endif ?>
    </tbody>
  </table>
  </div>
 <?php \dash\utility\pagination::html(); ?>

<?php } //endif ?>

<?php function htmlFilter() {?>
  <p class="f fs14 alert-info">
    <span class="c"><?php echo \dash\data::filterBox(); ?></span>
    <a class="cauto" href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'); ?>"><?php echo T_("Clear filters"); ?></a>
  </p>
<?php } //endif ?>

<?php function htmlFilterNoResult() {?>
  <p class="f fs14 alert-warning">
    <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
    <a class="cauto" href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'); ?>"><?php echo T_("Clear filters"); ?></a>
  </p>
<?php } //endif ?>

<?php function htmlStartAddNew() {?>
  <div class="msg fs14 success2"><?php echo T_("Hi!"). ' ' . T_("No anwer found"); ?></div>
<?php } //endif ?>