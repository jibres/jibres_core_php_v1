

<?php


if(\dash\data::dataTable())
{
  if(\dash\data::dataFilter())
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
  if(\dash\data::dataFilter())
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
<div class="cbox fs12">
  <form method="get" action='<?php echo \dash\url::this(); ?>' >
    <div class="input">
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>

      <?php if(\dash\request::get('type')) {?>

      <input type="hidden" name="type" value="<?php echo \dash\request::get('type'); ?>">

      <?php } // endif ?>

      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
  </form>
</div>
<?php } //endfunction ?>





<?php function htmlTable() {?>

<?php
$sortLink = \dash\data::sortLink();
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}

?>

<table class="tbl1 v3 cbox fs12">
  <thead>
    <tr>
      <th><?php echo T_("User"); ?></th>
      <th><?php echo T_("Chatid"); ?></th>

      <th><?php echo T_("Count"); ?></th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($dataTable as $key => $value) {?>

    <tr>
      <td class="collapsing">
        <a href="<?php echo \dash\url::that(); ?>?user_id=<?php echo \dash\get::index($value, 'user_id'); ?>">
          <img src="<?php echo \dash\get::index($value, 'avatar'); ?>" class="avatar mRa5" alt="<?php echo \dash\get::index($value, 'displayname'); ?>">
          <span class="txtB s0 fs08"><?php echo \dash\get::index($value, 'displayname'); ?></span>
        </a>
        <div class="txtRa fs08">
          <a href="<?php echo \dash\url::that(); ?>?mobile=<?php echo \dash\get::index($value, 'mobile'); ?>" title='<?php echo T_("Mobile"); ?>'><?php echo \dash\get::index($value, 'mobile'); ?></a>
          <a href="<?php echo \dash\url::that(); ?>?userid=<?php echo \dash\get::index($value, 'user_id'); ?>" class="badge" title='<?php echo T_("User id"); ?>'><?php echo \dash\get::index($value, 'user_id'); ?></a>
        </div>
        <div class="txtRa fs08" data-tippy-placement='left' title='<?php echo T_("Telegram chatid"); ?>'>
          <a href="<?php echo \dash\url::that(); ?>?chatid=<?php echo \dash\get::index($value, 'chatid'); ?>"><?php echo \dash\get::index($value, 'chatid'); ?></a>
        </div>
        <nav class="txtRa">
          <a href="<?php echo \dash\url::that(); ?>?user_id=<?php echo \dash\get::index($value, 'user_id'); ?>" title='<?php echo T_("User logs"); ?>'><i class="sf-briefcase"></i></a>
          <a href="<?php echo \dash\url::kingdom(); ?>/crm/member/glance?id=<?php echo \dash\coding::encode(\dash\get::index($value, 'user_id')); ?>" title='<?php echo T_("User Profile"); ?>'><i class="sf-user-md"></i></a>

        </nav>
      </td>
      <td class="">
        <a href="<?php echo \dash\url::this(); ?>/log?chatid=<?php echo \dash\get::index($value, 'chatid'); ?>">
          <?php echo \dash\get::index($value, 'chatid'); ?>
        </a>
      </td>

      <td class="">
          <?php echo \dash\get::index($value, 'count'); ?> </td>

    </tr>
<?php } //endfor ?>
  </tbody>
</table>

<?php \dash\utility\pagination::html(); ?>

<?php } //endif ?>


<?php function htmlFilter() {?>
<p class="f fs14 msg info2">
  <span class="c"><?php echo \dash\data::dataFilter(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/<?php echo \dash\url::module(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/<?php echo \dash\url::module(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>


<?php function htmlStartAddNew() {?>
<p class="fs14 msg success2 pTB20"><?php echo T_("No record exist!"); ?></p>
<?php } //endif ?>


