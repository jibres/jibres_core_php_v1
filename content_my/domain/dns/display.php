<?php
if(\dash\data::dataTable())
{
	if(\dash\data::isFiltered())
	{
		htmlTable();
		htmlFilter();
	}
	else
	{
		htmlTable();

	}

}
else
{
	if(\dash\data::isFiltered())
	{
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
	<form method="get" autocomplete="off" class="mB20" action="<?php echo \dash\url::that(); ?>">
		<div class="input search">
			<input type="text" name="q" placeholder='<?php echo T_("Search"); ?>' value="<?php echo \dash\request::get('q'); ?>">
			<button class="btn addon success"><?php echo T_("Search"); ?></button>
		</div>
	</form>
</div>
<?php } //end function ?>


<?php function htmlTable() {?>
	<div class="tblBox">
	<table class="tbl1 v1">
		<thead>
			<tr>
				<th class="collapsing">#</th>
				<th><?php echo T_("Title"); ?></th>
				<th><?php echo T_("Usage"); ?></th>
				<th><?php echo T_("DNS #1"); ?></th>
				<th><?php echo T_("DNS #2"); ?></th>
				<th><?php echo T_("DNS #3"); ?></th>
				<th><?php echo T_("DNS #4"); ?></th>

				<th class="s0 collapsing"><?php echo T_("Date created"); ?></th>


			</tr>
		</thead>
		<tbody>

			<?php foreach (\dash\data::dataTable() as $key => $value) {?>

			<tr <?php if(isset($value['isdefault']) && $value['isdefault']) { echo 'class="positive"';} ?>>
				<td><?php echo \dash\fit::number($key + 1); ?></td>
				<td>
					<a href="<?php echo \dash\url::that(); ?>/edit?id=<?php echo \dash\coding::encode(\dash\get::index($value, 'id')); ?>" class="<?php if(!isset($value['title'])) { echo 'fc-mute';}else{echo 'link';} ?>">
						<?php if(\dash\get::index($value, 'title')) { echo \dash\get::index($value, 'title'); } else { echo T_("Without title"); } ?>
					</a>
						<?php if(isset($value['isdefault']) && $value['isdefault']) {?> <span class="badge success"><?php echo T_("Default"); ?></span> <?php } //endif ?>
				</td>
				<td><?php echo \dash\fit::number(\dash\get::index($value, 'count_useage')); ?> <a href="<?php echo \dash\url::this(). '?dns='. \dash\coding::encode(\dash\get::index($value, 'id'));  ?>"><i class="sf-question-circle"></i></a></td>
				<td><?php echo \dash\get::index($value, 'ip1'); ?> <br> <?php echo \dash\get::index($value, 'ns1'); ?></td>
				<td><?php echo \dash\get::index($value, 'ip2'); ?> <br> <?php echo \dash\get::index($value, 'ns2'); ?></td>
				<td><?php echo \dash\get::index($value, 'ip3'); ?> <br> <?php echo \dash\get::index($value, 'ns3'); ?></td>
				<td><?php echo \dash\get::index($value, 'ip4'); ?> <br> <?php echo \dash\get::index($value, 'ns4'); ?></td>

				<td class="s0 collapsing">
					<?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?>
				</td>

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
  <a class="cauto" href="<?php echo \dash\url::current(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //end function ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c s12"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?> </span>
  <a class="cauto" href="<?php echo \dash\url::current(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //end function ?>



<?php function htmlStartAddNew() {?>

<div class="fs14 msg info2 mT20">
  <a href="<?php echo \dash\url::current(); ?>/add"><?php echo T_("Add your DNS to list, then you can register domain faster and safer!"); ?></a>
</div>


<?php } //end function ?>




