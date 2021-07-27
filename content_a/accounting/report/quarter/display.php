<?php

$thisQurarter = \dash\request::get('quarter');
if(!$thisQurarter)
{
	$thisQurarter = 1;
}

$quorumprice = floatval(\dash\data::dataRow_quorumprice());

if(!\dash\request::get('detail'))
{
	require_once('display-summary.php');
}
else
{
	if(\dash\data::oneFactorId())
	{
		require_once('display-detail.php');
	}
	else
	{
		require_once('display-list.php');
	}
}
?>