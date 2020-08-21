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

		case 'short_answer': html_input_short_answer($value); break;
		case 'descriptive_answer': html_input_descriptive_answer($value); break;
		case 'descriptive_after_short_answer': html_input_descriptive_after_short_answer($value); break;
		case 'numeric': html_input_numeric($value); break;
		case 'single_choice': html_input_single_choice($value); break;
		case 'multiple_choice': html_input_multiple_choice($value); break;
		case 'dropdown': html_input_dropdown($value); break;
		case 'date': html_input_date($value); break;
		case 'birthdate': html_input_birthdate($value); break;
		case 'country': html_input_country($value); break;
		case 'province': html_input_province($value); break;
		case 'city': html_input_city($value); break;
		case 'gender': html_input_gender($value); break;
		case 'time': html_input_time($value); break;
		case 'tel': html_input_tel($value); break;
		case 'file': html_input_file($value); break;
		case 'nationalcode': html_input_nationalcode($value); break;
		case 'mobile': html_input_mobile($value); break;
		case 'email': html_input_email($value); break;
		case 'website': html_input_website($value); break;
		case 'password': html_input_password($value); break;

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

<?php
function isRequired($value, $_html = false)
{
	if(\dash\get::index($value, 'require'))
	{
		if($_html)
		{
	 		echo '<small class="fc-red">'.  T_("Required"). '</small>';
		}
		else
		{
			echo ' required ';
		}
	}
}

function myName($value)
{
	echo 'answer_'. \dash\get::index($value, 'id');
}

function myID($value)
{
	echo 'id_answer_'. \dash\get::index($value, 'id');
}

function HtmlPlaceholder($value)
{
	if(isset($value['type']) && isset($value['setting'][$value['type']]['placeholder']) && $value['setting'][$value['type']]['placeholder'] && is_string($value['setting'][$value['type']]['placeholder']))
	{
		echo ' placeholder="'. $value['setting'][$value['type']]['placeholder']. '" ';
	}
}

function HtmlMin($value)
{
	if(isset($value['type']) && isset($value['setting'][$value['type']]['min']) && $value['setting'][$value['type']]['min'] && is_numeric($value['setting'][$value['type']]['min']))
	{
		echo ' min="'. $value['setting'][$value['type']]['min']. '" ';
	}
}

function HtmlMax($value)
{
	if(isset($value['type']) && isset($value['setting'][$value['type']]['max']) && $value['setting'][$value['type']]['max'] && is_numeric($value['setting'][$value['type']]['max']))
	{
		echo ' max="'. $value['setting'][$value['type']]['max']. '" ';
	}
}

function HtmlMaxLen($value)
{
	if(isset($value['maxlen']) && is_numeric($value['maxlen']))
	{
		echo ' maxlength="'. $value['maxlen']. '" ';
	}
}

?>




<?php function html_input_short_answer($value) {?>
<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
<div class="input">
	<input type="text" name="<?php myName($value); ?>" id="<?php myID($value); ?>" <?php isRequired($value); HtmlPlaceholder($value); HtmlMaxLen($value) ?> >
</div>
<?php } //endfunction ?>



<?php function html_input_descriptive_answer($value) {?>
<?php

$rows = 2;
if(isset($value['maxlen']) && is_numeric($value['maxlen']))
{
	if($value['maxlen'] > 1000)
	{
		$rows = 5;
	}
}
?>
<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
<textarea class="txt" rows="<?php echo $rows ?>" id="<?php myID($value); ?>" name="<?php myName($value); ?>" <?php isRequired($value); HtmlPlaceholder($value); HtmlMaxLen($value) ?>></textarea>
<?php } //endfunction ?>



<?php function html_input_descriptive_after_short_answer($value) {?>
	<div class="msg">Comming...</div>
<?php } //endfunction ?>



<?php function html_input_numeric($value) {?>
<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
<div class="input">
	<input type="number" name="<?php myName($value); ?>" id="<?php myID($value); ?>" <?php isRequired($value); HtmlPlaceholder($value); HtmlMaxLen($value); HtmlMin($value); HtmlMax($value) ?> >
</div>
<?php } //endfunction ?>



<?php function html_input_single_choice($value) {?>
single_choice <br>
<?php } //endfunction ?>



<?php function html_input_multiple_choice($value) {?>
multiple_choice <br>
<?php } //endfunction ?>



<?php function html_input_dropdown($value) {?>
dropdown <br>
<?php } //endfunction ?>



<?php function html_input_date($value) {?>
date <br>
<?php } //endfunction ?>



<?php function html_input_birthdate($value) {?>
<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
<div class="input">
	<input type="date" name="<?php myName($value); ?>" id="<?php myID($value); ?>" data-format='date' <?php isRequired($value); HtmlPlaceholder($value); ?> >
</div>
<?php } //endfunction ?>



<?php function html_input_country($value) {?>
country <br>
<?php } //endfunction ?>



<?php function html_input_province($value) {?>
province <br>
<?php } //endfunction ?>



<?php function html_input_city($value) {?>
city <br>
<?php } //endfunction ?>



<?php function html_input_gender($value) {?>
gender <br>
<?php } //endfunction ?>



<?php function html_input_time($value) {?>
time <br>
<?php } //endfunction ?>



<?php function html_input_tel($value) {?>
<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
<div class="input">
	<input type="tel" name="<?php myName($value); ?>" id="<?php myID($value); ?>" data-format='tel' <?php isRequired($value); HtmlPlaceholder($value); HtmlMaxLen($value); ?> >
</div>
<?php } //endfunction ?>



<?php function html_input_file($value) {?>
file <br>
<?php } //endfunction ?>



<?php function html_input_nationalcode($value) {?>
<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
<div class="input">
	<input type="tel" name="<?php myName($value); ?>" id="<?php myID($value); ?>" data-format='nationalCode' <?php isRequired($value); HtmlPlaceholder($value); HtmlMaxLen($value); ?> >
</div>
<?php } //endfunction ?>



<?php function html_input_mobile($value) {?>
mobile <br>
<?php } //endfunction ?>



<?php function html_input_email($value) {?>
email <br>
<?php } //endfunction ?>



<?php function html_input_website($value) {?>
website <br>
<?php } //endfunction ?>



<?php function html_input_password($value) {?>
password <br>
<?php } //endfunction ?>


