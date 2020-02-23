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
<div class="tblBox fs12">
	<table class="tbl1 v1">
		<thead>
			<tr>
				<th><?php echo T_("IRNIC handle"); ?></th>
				<th class="collapsing txtC"><?php echo T_("Holder");; ?></th>
				<th class="collapsing txtC"><?php echo T_("Admin");; ?></th>
				<th class="collapsing txtC"><?php echo T_("Technical");; ?></th>
				<th class="collapsing txtC"><?php echo T_("billing");; ?></th>
				<th class="collapsing"><?php echo T_("Action"); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach (\dash\data::dataTable() as $key => $value) {?>

			<tr <?php if(isset($value['isdefault']) && $value['isdefault']) { echo 'class="positive"'; } ?>>
				<td>
					<a href="<?php echo \dash\url::that(); ?>/edit?id=<?php echo \dash\coding::encode(\dash\get::index($value, 'id')); ?>">
						<code><?php echo \dash\get::index($value, 'nic_id'); ?></code> <?php if(isset($value['isdefault']) && $value['isdefault']) {?> <span class="badge success mLa10"><?php echo T_("Default"); ?></span> <?php }// endif ?>
						<div class="mT10"><?php echo substr(\dash\get::index($value, 'title'), 0, 50); ?></div>
					</a>

				</td>
				<td class="txtC"><?php if(isset($value['holder']) && $value['holder']) { echo '<i class="sf-check fc-green"></i>'; } else{ echo '<i class="sf-times fc-red"></i>'; }?></td>
				<td class="txtC"><?php if(isset($value['admin']) && $value['admin']) { echo '<i class="sf-check fc-green"></i>'; } else{ echo '<i class="sf-times fc-red"></i>'; }?></td>
				<td class="txtC"><?php if(isset($value['tech']) && $value['tech']) { echo '<i class="sf-check fc-green"></i>'; } else{ echo '<i class="sf-times fc-red"></i>'; }?></td>
				<td class="txtC"><?php if(isset($value['bill']) && $value['bill']) { echo '<i class="sf-check fc-green"></i>'; } else{ echo '<i class="sf-times fc-red"></i>'; }?></td>
				<td class="collapsing"><a href="<?php echo \dash\url::that(); ?>/edit?id=<?php echo \dash\coding::encode(\dash\get::index($value, 'id')); ?>" class="btn outline primary"><?php echo T_("Edit"); ?></a></td>
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

<div class="fs14 msg info2 pTB20">
  <p><?php echo T_("Hi!"); ?></p>
  <p><a href="<?php echo \dash\url::current(); ?>/add"><?php echo T_("Try to start with add new contact!"); ?></a></p>

</div>


<?php } //end function ?>

