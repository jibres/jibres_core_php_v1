<?php
if(!isset($myPercent))
{
	$myPercent = 0;
}
if(!$myPercent || $myPercent < 0)
{
	$myPercent = 0;
}
if($myPercent > 100)
{
	$myPercent = 100;
}
if(!isset($myColor))
{
	$myColor = null;
}
if(!$myColor)
{
	if($myPercent == 100)
	{
		$myColor = 'green';
	}
	elseif($myPercent >= 70)
	{
		$myColor = 'blue';
	}
	elseif($myPercent >= 50)
	{
		$myColor = 'yellow';
	}
	elseif($myPercent >= 30)
	{
		$myColor = 'orange';
	}
	elseif($myPercent >= 10)
	{
		$myColor = 'red';
	}
}

?><div class="circularChart" data-color='<?php echo $myColor;?>'><svg viewBox="0 0 36 36"><path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/><path class="circle" stroke-dasharray="<?php echo $myPercent;?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/><text class="percentage" x="18" y="20.35"><?php echo $myPercent;?>%</text></svg></div>