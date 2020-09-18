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
  $dataTable = \dash\data::dataTable();
  if(!is_array($dataTable))
  {
    $dataTable = [];
  }

  if($dataTable)
  {
    if(\dash\data::isFiltered())
    {
      htmlSearchBox(count($dataTable));
      htmlTable();
      htmlFilter();
    }
    else
    {
      htmlSearchBox(count($dataTable));
      htmlTable();
    }

  }
  else
  {
    if(\dash\data::isFiltered())
    {
      htmlSearchBox(count($dataTable));

      htmlFilter();
    }
    else
    {
      htmlStartAddNew();
    }
  }
  ?>







 <?php } //endif ?>





<?php function htmlSearchBox($_count) { if($_count > 10) {?>

  <div class="cbox fs12">
    <form method="get" action='<?php echo \dash\url::current(); ?>' >
      <div class="input">
        <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>
        <button class="addon btn "><?php echo T_("Search"); ?></button>
      </div>
    </form>
  </div>
<?php } /*end if*/ } //endfunction ?>





<?php function htmlTable() {?>


<nav class="items">
 <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
      <li><a class="f" href="<?php echo \dash\url::that(). '/edit?id='. \dash\get::index($value, 'id'); ?>"><div class="key"><?php echo \dash\get::index($value, 'title');?></div><div class="value"><?php echo \dash\fit::number(\dash\get::index($value, 'answer_count')); ?></div><div class="go"></div></a></li>
    <?php } // endfor ?>
 </ul>
</nav>

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