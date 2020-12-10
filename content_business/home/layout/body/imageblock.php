<?php
$imageblock = [];

if(isset($line_detail['value']['imageblock']) && is_array($line_detail['value']['imageblock']))
{
	$imageblock = $line_detail['value']['imageblock'];
}
if($imageblock)
{
	$myItemClass = 'c';
	$myPadSize = '';
	switch (count($imageblock))
	{
		case 1:
		case 3:
		case 4:
		case 5:
			$myItemClass = 'c';
			break;

		case 2:
			$myItemClass = 'c-xs-12 c-sm-6';
			break;

		case 6:
			$myItemClass = 'c-xs-6 c-sm-4';
			$myPadSize = ' padMore2';
			break;

		default:
			break;
	}
?>


<div class="avand imgLine">
  <div class="row<?php echo $myPadSize; ?>">
<?php foreach ($imageblock as $key => $value)
{
	echo '<div class="'. $myItemClass. '">';
	{
		echo '<a';
		if(a($value, 'target'))
		{
			echo ' target="_blank"';
		}
		if(a($value, 'url'))
		{
			echo ' href="'. a($value, 'url'). '"';
		}
		echo '>';
		{
			echo '<img src="'. \lib\filepath::fix(a($value, 'image')). '"';
			echo 'alt="'. a($value, 'alt'). '"';
			echo '>';
		}
		echo '</a> ';
	}
	echo '</div> ';
}
?>
  </div>
</div>
<?php } //endif ?>