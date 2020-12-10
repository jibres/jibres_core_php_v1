<?php if(\dash\data::actionList()) {?>
  <?php foreach (\dash\data::actionList() as $key => $value) {?>
		<div class="msg primary">
			<h2><?php echo $key ?></h2>
			<div class="txtL">
				<div class="btn warn" data-confirm data-data='<?php echo json_decode($value); ?>'>Run request</div>
			</div>
		</div>
  <?php }//endfor ?>
<?php }//endif ?>


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
  <form method="get" action='<?php echo \dash\url::this(); ?>'>
    <div class="input">
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" <?php \dash\layout\autofocus::html() ?>  data-pass='submit' autocomplete='off'>
      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
  </form>
</div>
<?php } //endfunction ?>


<?php function htmlTable() {?>

  <table class="tbl1 v1 cbox fs12">
    <thead>
      <tr>
        <th><?php echo T_("Action"); ?></th>
        <th><?php echo T_("Tracking Number"); ?></th>
        <th><?php echo T_("Public detail"); ?></th>
        <th><?php echo T_("Iranian Detail"); ?></th>

        <th><?php echo T_("Company Detail"); ?></th>
      </tr>
    </thead>

    <tbody>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>

      <tr >
        <td class="collapsing">
          <a href="<?php echo \dash\url::this(); ?>/show?id=<?php echo a($value, 'id'); ?>" class="btn danger xs">Show detail</a>
          <small class="block"><?php echo a($value, 'response_txt'); ?></small>
        </td>
        <td>
          <?php echo \dash\fit::date_human(a($value, 'datecreated')); ?>
	        <div><small><?php echo T_("trackingNumber"); ?></small> <b><?php echo a($value, 'trackingNumber'); ?></b></div>
	        <div><small><?php echo T_("trackingNumberPsp"); ?></small> <b><?php echo a($value, 'trackingNumberPsp'); ?></b></div>
        </td>

        <td>
          <div><small><?php echo T_("requestType"); ?></small> <b><?php echo a($value, 'requestType'); ?></b></div>
        </td>
        <td>
			    <div><small><?php echo T_("request_id"); ?></small> <b><?php echo a($value, 'request_id'); ?></b></div>
	        <div><small><?php echo T_("user_id"); ?></small> <b><?php echo a($value, 'user_id'); ?></b></div>
        </td>
        <td>
	        <div><small><?php echo T_("sendtime"); ?></small> <b><?php echo a($value, 'sendtime'); ?></b></div>
	        <div><small><?php echo T_("responsetime"); ?></small> <b><?php echo a($value, 'responsetime'); ?></b></div>
	        <div><small><?php echo T_("diff"); ?></small> <b><?php echo a($value, 'diff'); ?></b></div>
	        <div><small><?php echo T_("datecreated"); ?></small> <b><?php echo a($value, 'datecreated'); ?></b></div>
	        <div><small><?php echo T_("datemodified"); ?></small> <b><?php echo a($value, 'datemodified'); ?></b></div>
        </td>

      </tr>

      <?php } //endfor ?>
    </tbody>
  </table>

<?php \dash\utility\pagination::html(); ?>

<?php } //endfunction ?>


<?php function htmlFilter() {?>
<p class="f fs14 msg info2">
  <span class="c"><?php echo \dash\data::dataFilter() ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/customer"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endfunction ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/customer"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endfunction ?>


<?php function htmlStartAddNew() {?>
<p class="fs14 msg success2 pTB20"><?php echo T_("Hi!"); ?> No check list found</p>
<?php } //endfunction ?>

