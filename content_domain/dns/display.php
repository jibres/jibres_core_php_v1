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
		htmlTable();
		htmlFilter();
	}
	else
	{
		htmlStartAddNew();
	}
}
?>







<?php function htmlSearchBox() {?>
<div class="fs12">
	<form method="get" autocomplete="off" class="mB20" action="<?php echo \dash\url::this(); ?>">
		<div class="input search">
			<input type="text" name="q" placeholder='<?php echo T_("Search"); ?>' value="<?php echo \dash\request::get('q'); ?>">
			<button class="btn addon success"><?php echo T_("Search"); ?></button>
		</div>
	</form>
</div>
<?php } //end function ?>


<?php function htmlTable() {?>
	<div class="tblBox">
	<table class="tbl1 v4">
		<thead>
			<tr>
				<th class="collapsing">#</th>
				<th><?php echo T_("Title"); ?></th>
				<th><?php echo T_("Usage"); ?></th>
				<th><?php echo T_("DNS #1"); ?></th>
				<th><?php echo T_("DNS #2"); ?></th>
				<th><?php echo T_("DNS #3"); ?></th>
				<th><?php echo T_("DNS #4"); ?></th>

				<th class="s0"><?php echo T_("Date created"); ?></th>

				<th class="collapsing"><?php echo T_("Action"); ?></th>
			</tr>
		</thead>
		<tbody>

			<?php foreach (\dash\data::dataTable() as $key => $value) {?>

			<tr <?php if(isset($value['isdefault']) && $value['isdefault']) { echo 'class="positive"';} ?>>
				<td class="collapsing"><?php echo \dash\fit::number($key + 1); ?></td>
				<td><?php echo @$value['title']; ?> <?php if(isset($value['isdefault']) && $value['isdefault']) {?> <span class="badge success"><?php echo T_("Default"); ?></span> <?php } //endif ?></td>
				<td><?php echo \dash\fit::number(@$value['count_useage']); ?></td>
				<td><?php echo @$value['ip1']; ?> <br> <?php echo @$value['ns1']; ?></td>
				<td><?php echo @$value['ip2']; ?> <br> <?php echo @$value['ns2']; ?></td>
				<td><?php echo @$value['ip3']; ?> <br> <?php echo @$value['ns3']; ?></td>
				<td><?php echo @$value['ip4']; ?> <br> <?php echo @$value['ns4']; ?></td>

				<td class="s0">
					<?php echo \dash\fit::date(@$value['datecreated']); ?>
				</td>
				<td class="collapsing"><a href="<?php echo \dash\url::this(); ?>/edit?id=<?php echo \dash\coding::encode(@$value['id']); ?>" class="btn info2"><?php echo T_("Manage dns"); ?></a></td>
			</tr>
			<?php } //endfor ?>
		</tbody>
	</table>
</div>

<?php \dash\utility\pagination::html(); ?>
<?php } //end function ?>




<?php function htmlFilter() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo \dash\data::filterBox(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //end function ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c s12"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?> </span>
  <a class="cauto" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //end function ?>



<?php function htmlStartAddNew() {?>

<div class="fs14 msg info2 pTB20">
  <p><?php echo T_("Hi!"); ?></p>
  <p><a href="<?php echo \dash\url::that(); ?>/add"><?php echo T_("Try to start with add new dns!"); ?></a></p>

</div>


<?php } //end function ?>




