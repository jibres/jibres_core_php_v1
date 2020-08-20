<?php

$formItems = \dash\data::formItems();
if(!is_array($formItems))
{
	$formItems = [];
}

?>
<form method="post" autocomplete="new-password">

	<div class="avand-md">
		<div class="box">
			<div class="body">
<?php
foreach ($formItems as $key => $value)
{
	if(!isset($value['type']))
	{
		continue;
	}

	switch ($value['type'])
	{
		case 'text':
			html_input_text($value);
			break;

		default:
			# code...
			break;
	}
}
?>
			</div>
			<footer class="txtRa">
				<button class="btn master"><?php echo T_("Submit") ?></button>
			</footer>
		</div>

	</div>
</form>






<?php function html_input_text($value) {?>
	<?php $myName = 'text_'. \dash\get::index($value, 'id'); ?>
<label for="<?php echo $myName ?>"><?php echo \dash\get::index($value, 'title') ?></label>
<div class="input">
	<input type="text" name="<?php echo $myName; ?>" id="<?php echo $myName ?>">
</div>


<?php } //endif ?>