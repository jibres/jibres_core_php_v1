<?php
require_once (__DIR__. '/../ticketTypes.php');

if(\dash\data::dataTable())
{
  if(\dash\data::dataFilter())
  {
    detailCards();
    htmlSearchBox();
    require_once (__DIR__ .'/../ticketTable.php');
    htmlFilter();
  }
  else
  {
    detailCards();
    htmlSearchBox();
    require_once (__DIR__ .'/../ticketTable.php');

  }
}
else
{
  if(\dash\data::dataFilter() || \dash\request::get())
  {
    htmlSearchBox();
    htmlFilterNoResult();
  }
  else
  {
    htmlStartAddNew();
  }
}
?>





<?php function htmlSearchBox() {?>
  <?php if(\dash\user::id()) {?>
    <div class="cbox fs12">
      <form method="get" action='<?php echo \dash\url::this(). \dash\data::moduleType(); ?>' data-action>
        <div class="input">
          <?php
          foreach (\dash\request::get() as $key => $value)
          {
            echo "<input type='hidden' name='$key' value='$value'>";
          }
          ?>

          <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>
          <button class="addon btn "><?php echo T_("Search"); ?></button>
        </div>
      </form>
    </div>
  <?php } //endif ?>
<?php } //endfunction ?>



<?php function htmlFilter() {?>
<p class="f fs14 msg info2">
  <span class="c"><?php echo \dash\data::dataFilter(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/<?php echo \dash\url::module(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endfunction ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::this(). \dash\data::accessGet(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endfunction ?>


<?php function htmlStartAddNew() {?>
<p class="fs14 msg success2 pTB20"><?php echo T_("No ticket was found"); ?> <a class="txtB" href="<?php echo \dash\url::this(); ?>/add"><?php echo T_("Add new ticket"); ?></a></p>
<?php } //endfunction ?>




<?php function detailCards() {?>

<?php if(\dash\user::id()) {?>
<div class="f mB10">
    <div class="s12 m4">
      <a class="dcard" href="<?php echo \dash\url::here(); ?>/ticket?status=open<?php echo \dash\data::accessGetAnd(); ?>">
        <div class="statistic sm teal">
          <div class="label mB10"><i class="fs20 mRa5 sf-life-ring"></i> <?php echo T_("Active tickets"); ?></div>
          <div class="value counter"><?php echo \dash\fit::number(\dash\data::sidebarDetail_open()); ?></div>
        </div>
      </a>
    </div>
    <div class="s6 m4">
      <a class="dcard" href="<?php echo \dash\url::here(); ?>/ticket<?php echo \dash\data::accessGet(); ?>">
        <div class="statistic sm ">
          <div class="label mB10"><i class="fs20 mRa5 sf-question-circle"></i> <?php echo T_("Tickets"); ?></div>
          <div class="value"><?php echo \dash\fit::number(\dash\data::sidebarDetail_all()); ?></div>
        </div>
      </a>
    </div>

    <div class="s6 m4">
      <a class="dcard" href="<?php echo \dash\url::here(); ?>/message<?php echo \dash\data::accessGet(); ?>">
        <div class="statistic sm">
          <div class="label mB10"><i class="fs20 mRa5 sf-chat"></i> <?php echo T_("Replies"); ?></div>
          <div class="value"><?php echo \dash\fit::date(\dash\data::sidebarDetail_message()); ?></div>
        </div>
      </a>
    </div>


  <?php if(\dash\permission::check('supportTicketReport')) {?>
    <div class="c3 m6 s12">
      <a class="dcard" href="<?php echo \dash\url::here(); ?>/ticket/report">
        <div class="statistic sm">
          <div class="label mB10"><i class="fs20 mRa5 sf-clock-o"></i> <?php echo T_("Avg. First Response"); ?> <small><?php echo T_("Last month"); ?></small></div>
          <div class="value"><?php echo \dash\fit::number(\dash\data::sidebarDetail_avgfirst()); ?> <small class="fs05"><?php echo T_("Minute"); ?></small></div>
        </div>
      </a>
    </div>
  <?php } //endif ?>

  <?php if(\dash\permission::check('supportTicketReport')) {?>
    <div class="c3 m6 s12">
      <a class="dcard" href="<?php echo \dash\url::here(); ?>/ticket/report">
        <div class="statistic sm">
          <div class="label mB10"><i class="fs20 mRa5 sf-calendar-check-o"></i> <?php echo T_("Avg. Time to Archive"); ?> <small><?php echo T_("Last month"); ?></small></div>
          <div class="value"><?php echo \dash\fit::number(\dash\data::sidebarDetail_avgarchive()); ?> <small class="fs05"><?php echo T_("Hours"); ?></small></div>
        </div>
      </a>
    </div>
  <?php } //endif ?>

  </div>




<?php } //endif ?>
<?php } //endfunction ?>

