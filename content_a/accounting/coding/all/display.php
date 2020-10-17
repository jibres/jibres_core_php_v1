<div class="avand">

    <?php $myData = \dash\data::myDataCount(); ?>

  <section class="f">
    <div class="c">
      <a href="<?php echo \dash\url::current(); ?>" class="stat <?php if(!\dash\request::get('type')) { echo 'active';} ?>">
        <h3><?php echo T_("All");?></h3>
        <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'all'));?></div>
      </a>
    </div>

    <div class="c">
      <a href="<?php echo \dash\url::current(). '?type=group'; ?>" class="stat <?php if(\dash\request::get('type') === 'group') { echo 'active';} ?>">
        <h3><?php echo T_("Group");?></h3>
        <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'group'));?></div>
      </a>
    </div>
    <div class="c">
      <a href="<?php echo \dash\url::current(). '?type=total'; ?>" class="stat <?php if(\dash\request::get('type') === 'total') { echo 'active';} ?>">
        <h3><?php echo T_("Accounting total");?></h3>
        <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'total'));?></div>
      </a>
    </div>
    <div class="c">
      <a href="<?php echo \dash\url::current(). '?type=assistant'; ?>" class="stat <?php if(\dash\request::get('type') === 'assistant') { echo 'active';} ?>">
        <h3><?php echo T_("Accounting assistant");?></h3>
        <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'assistant'));?></div>
      </a>
    </div>

    <div class="c">
      <a href="<?php echo \dash\url::current(). '?type=details'; ?>" class="stat <?php if(\dash\request::get('type') === 'details') { echo 'active';} ?>">
        <h3><?php echo T_("Accounting details");?></h3>
        <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'details'));?></div>
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

        <th class="collapsing"><?php echo T_("code") ?></th>
        <th class="collapsing"><?php echo T_("Title") ?></th>
        <th class="collapsing"><?php echo T_("Natuer group") ?></th>
        <th class="collapsing"><?php echo T_("Balance type") ?></th>
        <th><?php echo T_("Detail") ?></th>
        <th class="collapsing"><?php echo T_("Edit") ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
        <tr>


          <td class="collapsing"><span class="txtB"><?php echo \dash\fit::text(\dash\get::index($value, 'code')) ?></span></td>
          <td class="collapsing"><?php echo \dash\get::index($value, 'title') ?></td>
          <td class="collapsing"><?php echo T_(ucfirst(\dash\get::index($value, 'naturegroup'))); ?></td>
          <td class="collapsing"><?php echo T_(ucfirst(\dash\get::index($value, 'balancetype'))); ?></td>
          <td class="fs08">
              <div class="ibtn mT5"><?php if(\dash\data::loadDetail_naturecontrol()) {echo '<i class="sf-check fc-green"></i>';}else{echo '<i class="sf-times fc-red"></i>';} ?> <span><?php echo T_("naturecontrol"); ?></span></div>
                      <div class="ibtn mT5"><?php if(\dash\data::loadDetail_exchangeable()) {echo '<i class="sf-check fc-green"></i>';}else{echo '<i class="sf-times fc-red"></i>';} ?> <span><?php echo T_("exchangeable"); ?></span></div>
                      <div class="ibtn mT5"><?php if(\dash\data::loadDetail_followup()) {echo '<i class="sf-check fc-green"></i>';}else{echo '<i class="sf-times fc-red"></i>';} ?> <span><?php echo T_("followup"); ?></span></div>
                      <div class="ibtn mT5"><?php if(\dash\data::loadDetail_currency()) {echo '<i class="sf-check fc-green"></i>';}else{echo '<i class="sf-times fc-red"></i>';} ?> <span><?php echo T_("Accounting currency"); ?></span></div>
                      <div class="ibtn mT5"><?php if(\dash\data::loadDetail_detailable()) {echo '<i class="sf-check fc-green"></i>';}else{echo '<i class="sf-times fc-red"></i>';} ?> <span><?php echo T_("Detailable"); ?></span></div>
          </td>
          <td class="collapsing"><a class="btn link" href="<?php echo \dash\url::that(). '/edit?id='. \dash\get::index($value, 'id'); ?>"><?php echo T_("Edit") ?></a></td>
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


