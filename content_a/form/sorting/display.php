	<div class="box">
		<div class="body">
			<span><?php echo T_("Form Title"); ?></span>
			<span class="txtB"> <?php echo \dash\data::dataRow_title(); ?></span>
		</div>
	</div>

	<?php
$dataTable = \dash\data::formItems();

if(!is_array($dataTable))
{
  $dataTable = [];
}
?>

<div class="msg minimal info2 txtB font-14"><?php echo T_("Drag the item and move it where you want to change the question sort. Items is sorted from left to right") ?></div>

<form method="post" data-sortable data-willy class="ltr row">
<?php foreach ($dataTable as $key => $value) {?>
 <div class="c-xs-6 c-sm-6 c-md-4 c-xl-3 c-xxl-2">
 	<input type="hidden" name="sort[]" value="<?php echo \dash\get::index($value, 'id'); ?>">
  <div class="sortItem" data-handle><?php echo \dash\fit::number($key+1). '. '. \dash\get::index($value, 'title'); ?></div>
 </div>
<?php } //endfor ?>
</form>
