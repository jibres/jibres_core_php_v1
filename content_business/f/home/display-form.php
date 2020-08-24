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
			<header class="c-xs-0"><h2><?php echo \dash\data::formDetail_title(); ?></h2></header>
			<div class="body">
				<?php if(\dash\data::formDetail_status() !== 'publish') {?>
					<div class="msg warn txtC txtB"><?php echo T_("Your form is not publish. Only you can view this form.") ?> <a class="btn link" href="<?php echo \lib\store::admin_url(). '/a/form/edit?id='. \dash\data::formDetail_id() ?>"><?php echo T_("Edit form") ?></a></div>
				<?php } //endif ?>
				<?php if(\dash\data::formDetail_file()) {?>
					<img src="<?php echo \dash\data::formDetail_file() ?>" alt="<?php echo \dash\data::formDetail_title(); ?>">
				<?php } // endif ?>
				<?php if(\dash\data::formDetail_desc()) {?>
					<div class="mB20"><?php echo \dash\data::formDetail_desc() ?></div>
				<?php } // endif ?>

				<?php \lib\app\form\generator::html($formItems); ?>

<?php
// foreach ($formItems as $key => $value)
// {
// 	if(!isset($value['type']))
// 	{
// 		continue;
// 	}

// 	switch ($value['type'])
// 	{

// 		case 'short_answer':  c6() ; html_input_short_answer($value); c6(true); break;
// 		case 'displayname':  c6() ; html_input_displayname($value); c6(true); break;
// 		case 'descriptive_answer': c12(); html_input_descriptive_answer($value);c12(true); break;
// 		case 'descriptive_after_short_answer':  c6() ; html_input_descriptive_after_short_answer($value); c6(true); break;
// 		case 'numeric':   html_input_numeric($value); break;
// 		case 'single_choice':  html_input_single_choice($value);  break;
// 		case 'multiple_choice':  c12(); html_input_multiple_choice($value);c12(true); break;
// 		case 'dropdown':  html_input_dropdown($value); break;
// 		case 'date':   html_input_date($value); break;
// 		case 'birthdate':   html_input_birthdate($value); break;
// 		case 'country':  c12(); html_input_country($value);c12(true);  break;
// 		case 'province':  c6() ; html_input_province($value); c6(true); break;
// 		case 'city':  c6() ; html_input_city($value); c6(true); break;
// 		case 'province_city':  c6() ; html_input_province_city($value); c6(true); break;
// 		case 'gender':  c12() ; html_input_gender($value); c12(true); break;
// 		case 'time':   html_input_time($value); break;
// 		case 'tel':   html_input_tel($value); break;
// 		case 'file':  c12(); html_input_file($value);c12(true); break;
// 		case 'nationalcode':  c6() ; html_input_nationalcode($value); c6(true); break;
// 		case 'mobile':   html_input_mobile($value); break;
// 		case 'email':  c6() ; html_input_email($value); c6(true); break;
// 		case 'website':  c6() ; html_input_website($value); c6(true); break;
// 		case 'password':  c6() ; html_input_password($value); c6(true); break;
// 		case 'yes_no':  c12(); html_input_yes_no($value);c12(true);  break;
// 		case 'message':  c12(); html_input_message($value);c12(true);  break;
// 		case 'agree':  c12(); html_input_agree($value);c12(true);  break;

// 		default:
// 			# code...
// 			break;
// 	}
// }
?>

			</div>
			<footer class="txtRa">
				<button class="btn master"><?php echo T_("Submit") ?></button>
			</footer>
		</div>

	</div>
</form>
<?php

function c6($_end = null)
{
	if($_end)
	{
		echo '</div>';
	}
	else
	{
		echo '<div class="c-xs-12 c-sm-6">';
	}
}

function c12($_end = null)
{
	if($_end)
	{
		echo '</div>';
	}
	else
	{
		echo '<div class="c-xs-12 c-sm-12">';
	}
}

function isRequired($value, $_html = false)
{
	if(\dash\get::index($value, 'require'))
	{
		if($_html)
		{
	 		echo ' <small class="fc-red">'.  T_("Required"). '</small> ';
		}
		else
		{
			echo ' required ';
		}
	}
}

function HtmlDesc($value)
{
	if(\dash\get::index($value, 'desc'))
	{
	 	echo ' <div class="fc-mute mB20 fs09">'.  \dash\get::index($value, 'desc'). '</div> ';
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

function HtmlPlaceholder($value, $_select_mode = false, $_special = null)
{
	if(isset($value['type']) && isset($value['setting'][$value['type']]['placeholder']) && $value['setting'][$value['type']]['placeholder'] && is_string($value['setting'][$value['type']]['placeholder']))
	{
		if($_select_mode)
		{
			echo $value['setting'][$value['type']]['placeholder'];
		}
		else
		{
			echo ' placeholder="'. $value['setting'][$value['type']]['placeholder']. '" ';
		}
	}
	else
	{
		if($_select_mode)
		{
			if($_special)
			{
				echo $_special;
			}
			else
			{
				echo T_("Please select one item");
			}
		}
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


function html_input_short_answer($value)
{
	echo '<label for="';
	 myID($value);
	 echo '">';
	{
		echo \dash\get::index($value, 'title');
		isRequired($value, true);
	}
	echo '</label>';

	echo '<div class="input">';
	{
		echo '<input type="text" name="';
		myName($value);
		echo '" id="';
		myID($value);
		echo '" ';
		isRequired($value);
		HtmlPlaceholder($value);
		HtmlMaxLen($value);
		echo '>';
	}
	echo '</div>';

	HtmlDesc($value);

} //endfunction



function html_input_descriptive_answer($value) {?>
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
<div class="mB10">
	<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
	<textarea class="txt" rows="<?php echo $rows ?>" id="<?php myID($value); ?>" name="<?php myName($value); ?>" <?php isRequired($value); HtmlPlaceholder($value); HtmlMaxLen($value) ?>></textarea>
</div>
<?php HtmlDesc($value); } //endfunction



function html_input_displayname($value) {?>
<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
<div class="input">
	<input type="text" name="<?php myName($value); ?>" id="<?php myID($value); ?>" <?php isRequired($value); HtmlPlaceholder($value); HtmlMaxLen($value) ?> >
</div>
<?php HtmlDesc($value); } //endfunction



function html_input_descriptive_after_short_answer($value) {?>
<!-- comming soon -->
<?php } //endfunction



function html_input_numeric($value) {?>
<div class="c-xs-6 c-6">
<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
<div class="input">
	<input type="tel" name="<?php myName($value); ?>" id="<?php myID($value); ?>" data-format='price' <?php isRequired($value); HtmlPlaceholder($value); HtmlMaxLen($value); HtmlMin($value); HtmlMax($value) ?> >
</div>
</div>
<?php HtmlDesc($value); } //endfunction



function html_input_single_choice($value) {?>
<div class="c-sm-12 c-12">
	<div class="mB10">
		<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
		<div class="row">
			<?php if(isset($value['choice']) && is_array($value['choice'])) { foreach ($value['choice'] as $k => $v) { ?>
				<div class="c-xs-12 c-sm-12">
					<div class="radio3">
						<input type="radio" name="<?php myName($value); ?>" id="<?php myID($value); echo $k; ?>">
						<label for="<?php myID($value); echo $k; ?>"><?php echo \dash\get::index($v, 'title'); ?></label>
					</div>
				</div>
			<?php } /*endfor*/ } /*endif*/ ?>
		</div>
	</div>
</div>
<?php HtmlDesc($value); } //endfunction



function html_input_multiple_choice($value) {?>
<div class="mB10">
<label class="txtB" for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
<div class="row">
	<?php if(isset($value['choice']) && is_array($value['choice'])) { foreach ($value['choice'] as $k => $v) { ?>
		<div class="c-xs-12 c-sm-12">
			<div class="check1">
				<input type="checkbox" name="<?php myName($value); ?>[]" id="<?php myID($value); echo $k; ?>" value="<?php echo \dash\get::index($v, 'title') ?>">
				<label for="<?php myID($value); echo $k; ?>"><?php echo \dash\get::index($v, 'title'); ?></label>
			</div>
		</div>
	<?php } /*endfor*/ } /*endif*/ ?>
</div>
</div>
<?php HtmlDesc($value); } //endfunction



function html_input_dropdown($value) {?>
<div class="c-xs-6 c-6">
	<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
	<div class="mB10">
		<select class="select22" id="<?php myID($value); ?>" name="<?php myName($value); ?>" data-placeholder="<?php HtmlPlaceholder($value, true); ?>">
			<option value=""><?php HtmlPlaceholder($value, true); ?></option>
			<?php if(isset($value['choice']) && is_array($value['choice'])) { foreach ($value['choice'] as $k => $v) { ?>
				<option value="<?php echo \dash\get::index($v, 'title') ?>"><?php echo \dash\get::index($v, 'title'); ?></option>
			<?php } /*endfor*/ } /*endif*/ ?>
		</select>
	</div>
</div>
<?php HtmlDesc($value); } //endfunction



function html_input_date($value) {?>
<div class="c-xs-6 c-6">
	<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
	<div class="input">
		<input type="text" name="<?php myName($value); ?>" id="<?php myID($value); ?>" data-format='date' <?php isRequired($value); HtmlPlaceholder($value); ?> >
	</div>
</div>
<?php HtmlDesc($value); } //endfunction



function html_input_birthdate($value) {?>
<div class="c-xs-6 c-6">
	<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
	<div class="input">
		<input type="text" name="<?php myName($value); ?>" id="<?php myID($value); ?>" data-format='date' <?php isRequired($value); HtmlPlaceholder($value); ?> >
	</div>
</div>
<?php HtmlDesc($value); } //endfunction



function html_input_country($value) {?>
<div class="mB10">
<label for='<?php myID($value) ?>'><?php echo T_("Country"); ?></label>
<select class="select22" name="<?php myName($value) ?>" id="<?php myID($value) ?>" data-model='country' data-next='#province' data-next-default='IR'>
  <option value=""><?php HtmlPlaceholder($value, true, T_("Choose your country")) ?></option>
  <?php foreach (\dash\data::countryList() as $key => $value) {?>
    <option value="<?php echo $key; ?>"><?php echo ucfirst($value['name']); if(\dash\language::current() != 'en') { echo ' - '. T_(ucfirst($value['name']));} ?></option>
  <?php } //endif ?>
</select>
</div>
<?php HtmlDesc($value); } //endfunction



function html_input_province($value) {?>
<?php HtmlDesc($value); } //endfunction



function html_input_city($value) {?>
<?php HtmlDesc($value); } //endfunction




function html_input_province_city($value) {?>
<div class="mB10">
<label for='<?php myID($value) ?>'><?php echo T_("City"); ?></label>
<select class="select22" name="<?php myName($value) ?>" id="<?php myID($value) ?>">
  <option value=""><?php HtmlPlaceholder($value, true, T_("Choose your city")) ?></option>
  <?php foreach (\dash\data::cityList() as $key => $value) {?><option value="<?php echo $key; ?>"><?php echo $value ?></option><?php } //endif ?>
</select>
</div>
<?php HtmlDesc($value); } //endfunction



function html_input_gender($value) {?>
<div class="mB10">
	<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
	<div class="row">
		<div class="c-xs-12 c-sm-6">
			<div class="radio3">
				<input type="radio" name="<?php myName($value); ?>" value="male" id="<?php myID($value); echo 'male'; ?>">
				<label for="<?php myID($value); echo 'male'; ?>"><?php echo T_("I'm Male"); ?></label>
			</div>
		</div>
		<div class="c-xs-12 c-sm-6">
			<div class="radio3">
				<input type="radio" name="<?php myName($value); ?>" value="female" id="<?php myID($value); echo 'female'; ?>">
				<label for="<?php myID($value); echo 'female'; ?>"><?php echo T_("I'm Female"); ?></label>
			</div>
		</div>
	</div>
</div>
<?php HtmlDesc($value); } //endfunction



function html_input_time($value) {?>
<div class="c-xs-6 c-6">
	<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
	<div class="input">
		<input type="tel" name="<?php myName($value); ?>" id="<?php myID($value); ?>" data-format='time' <?php isRequired($value); HtmlPlaceholder($value); ?> >
	</div>
</div>
<?php HtmlDesc($value); } //endfunction



function html_input_tel($value) {?>
<div class="c-xs-6 c-6">
	<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
	<div class="input">
		<input type="tel" name="<?php myName($value); ?>" id="<?php myID($value); ?>" data-format='tel' <?php isRequired($value); HtmlPlaceholder($value); HtmlMaxLen($value); ?> >
	</div>
</div>
<?php HtmlDesc($value); } //endfunction



function html_input_file($value) {
if(isset($value['setting']['file']['accept']))
{
	$accept = $value['setting']['file']['accept'];
}
else
{
	$accept = "*";
}

?>
<div data-uploader data-name='<?php myName($value) ?>' data-final='#finalImage<?php myID($value) ?>'>
	<input type="file" accept="<?php echo $accept; ?>" id="<?php myID($value) ?>">
	<label for="<?php myID($value) ?>"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
	<label for="<?php myID($value) ?>"><img id="finalImage<?php myID($value) ?>" alt="<?php echo T_("File") ?>"></label>
</div>

<?php HtmlDesc($value); } //endfunction



function html_input_nationalcode($value) {?>
<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
<div class="input">
	<input type="tel" name="<?php myName($value); ?>" id="<?php myID($value); ?>" data-format='nationalCode' <?php isRequired($value); HtmlPlaceholder($value); HtmlMaxLen($value); ?> >
</div>
<?php HtmlDesc($value); } //endfunction



function html_input_mobile($value) {?>
<div class="c-xs-6 c-6">
	<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
	<div class="input">
		<input type="tel" maxlength="15" name="<?php myName($value); ?>" id="<?php myID($value); ?>" data-format='mobile-enter' <?php isRequired($value); HtmlPlaceholder($value); ?> >
	</div>
</div>
<?php HtmlDesc($value); } //endfunction



function html_input_email($value) {?>
<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
<div class="input">
	<input type="email" maxlength="100" name="<?php myName($value); ?>" id="<?php myID($value); ?>"  <?php isRequired($value); HtmlPlaceholder($value); ?> >
</div>
<?php HtmlDesc($value); } //endfunction



function html_input_website($value) {?>
<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
<div class="input">
	<input type="url" maxlength="100" name="<?php myName($value); ?>" id="<?php myID($value); ?>"  <?php isRequired($value); HtmlPlaceholder($value); ?> >
</div>
<?php HtmlDesc($value); } //endfunction



function html_input_password($value) {?>
<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
<div class="input">
	<input type="password" maxlength="100" name="<?php myName($value); ?>" id="<?php myID($value); ?>"  <?php isRequired($value); HtmlPlaceholder($value); ?> >
</div>
<?php HtmlDesc($value); } //endfunction



function html_input_message($value)
{
	if(isset($value['title']))
	{
		if(isset($value['setting']['message']['color']) && $value['setting']['message']['color'])
		{
			$class = null;
			switch ($value['setting']['message']['color'])
			{
				case 'red':		$class = 'danger2'; break;
				case 'green':	$class = 'success2'; break;
				case 'blue':	$class = 'primary2'; break;
				case 'yellow':	$class = 'warn2'; break;
				default: break;
			}
		}
		echo '<div class="msg '. $class .'">'. $value['title'];
		if(isset($value['desc']))
		{
			echo '<p>'. $value['desc'] .'</p>';
		}
		echo '</div>';
	}
} //endfunction



function html_input_agree($value)
{
	if(isset($value['title']))
	{
		if(isset($value['setting']['agree']['color']) && $value['setting']['agree']['color'])
		{
			$class = null;
			switch ($value['setting']['agree']['color'])
			{
				case 'red':		$class = 'danger2'; break;
				case 'green':	$class = 'success2'; break;
				case 'blue':	$class = 'primary2'; break;
				case 'yellow':	$class = 'warn2'; break;
				default: break;
			}
		}
		echo '<div class="msg '. $class .'">';
			if(isset($value['desc']))
			{
				echo '<p>'. $value['desc'] .'</p>';
			}
			echo '<div class="check1">';
				echo '<input type="checkbox" name="'; myName($value); echo '" id="'; myID($value); echo '" value="1">';
				echo '<label for="'; myID($value); echo '">'. $value['title'].'</label>';
			echo '</div>';
		echo '</div>';
	}
} //endfunction


function html_input_yes_no($value) {?>
<div class="mB10">
	<label for="<?php myID($value); ?>"><?php echo \dash\get::index($value, 'title') ?> <?php isRequired($value, true); ?></label>
	<div class="row">
		<div class="c-xs-6 c-sm-6">
			<div class="radio3">
				<input type="radio" name="<?php myName($value); ?>" value="1" id="<?php myID($value); echo 'yes'; ?>">
				<label for="<?php myID($value); echo 'yes'; ?>"><?php echo T_("Yes"); ?></label>
			</div>
		</div>
		<div class="c-xs-6 c-sm-6">
			<div class="radio3">
				<input type="radio" name="<?php myName($value); ?>" value="0" id="<?php myID($value); echo 'no'; ?>">
				<label for="<?php myID($value); echo 'no'; ?>"><?php echo T_("No"); ?></label>
			</div>
		</div>
	</div>
</div>
<?php HtmlDesc($value); } //endfunction ?>