<div class="avand">
<div class="row">
  <div class="c-xs-12 c-sm-4">
      <?php echo \dash\data::dataTableAll(); ?>
  </div>
  <div class="c-xs-12 c">
    <?php $myData = \dash\data::myDataCount(); ?>

  <section class="f">
    <div class="c">
      <a href="<?php echo \dash\url::current(); ?>" class="stat <?php if(!\dash\request::get('type')) { echo 'active';} ?>">
        <h3><?php echo T_("All");?></h3>
        <div class="val"><?php echo \dash\fit::stats(a($myData, 'all'));?></div>
      </a>
    </div>

    <div class="c">
      <a href="<?php echo \dash\url::current(). '?type=group'; ?>" class="stat <?php if(\dash\request::get('type') === 'group') { echo 'active';} ?>">
        <h3><?php echo T_("Group");?></h3>
        <div class="val"><?php echo \dash\fit::stats(a($myData, 'group'));?></div>
      </a>
    </div>
    <div class="c">
      <a href="<?php echo \dash\url::current(). '?type=total'; ?>" class="stat <?php if(\dash\request::get('type') === 'total') { echo 'active';} ?>">
        <h3><?php echo T_("Accounting total");?></h3>
        <div class="val"><?php echo \dash\fit::stats(a($myData, 'total'));?></div>
      </a>
    </div>
    <div class="c">
      <a href="<?php echo \dash\url::current(). '?type=assistant'; ?>" class="stat <?php if(\dash\request::get('type') === 'assistant') { echo 'active';} ?>">
        <h3><?php echo T_("Accounting assistant");?></h3>
        <div class="val"><?php echo \dash\fit::stats(a($myData, 'assistant'));?></div>
      </a>
    </div>

    <div class="c">
      <a href="<?php echo \dash\url::current(). '?type=details'; ?>" class="stat <?php if(\dash\request::get('type') === 'details') { echo 'active';} ?>">
        <h3><?php echo T_("Accounting details");?></h3>
        <div class="val"><?php echo \dash\fit::stats(a($myData, 'details'));?></div>
      </a>
    </div>
  </section>



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

  </div>
</div>

</div>






<?php function htmlSearchBox() {?>
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

  <table class="tbl1 v1 fs14">
    <thead>
      <tr>
        <th class="collapsing"><?php echo T_("ID") ?></th>
        <th class="collapsing"><?php echo T_("code") ?></th>
        <th><?php echo T_("Title") ?></th>
        <th><?php echo T_("Natuer") ?></th>
        <th><?php echo T_("Detailable") ?></th>
        <th class="collapsing"><?php echo T_("Edit") ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
        <tr>
          <td class="collapsing"><span class="text-gray-400"><?php echo \dash\fit::text(a($value, 'id')) ?></span></td>

          <td class="collapsing"><span class="font-bold"><?php echo \dash\fit::text(a($value, 'code')) ?></span></td>
          <td><?php echo a($value, 'title') ?></td>
          <td><?php echo a($value, 'nature') ?></td>
          <td><?php if(a($value, 'detailable')){?><i class="sf-check text-red-800"></i><?php }// endif ?></td>
          <td class="collapsing"><a class="btn-link" href="<?php echo \dash\url::that(). '/edit?id='. a($value, 'id'); ?>"><?php echo T_("Edit") ?></a></td>
        </tr>
      <?php } //endif ?>
    </tbody>
  </table>




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
  <div class="msg fs14 success2"><?php echo T_("Hi!") ?> <a class="btn-link" href="<?php echo \dash\url::that() ?>/add"><?php echo T_("Add new") ?></a></div>
<?php } //endif ?>


