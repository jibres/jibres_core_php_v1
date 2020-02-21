<?php
namespace dash\engine;


class history
{
	public static function save()
	{
		$myUrl = \dash\url::pwd();
		$myHistory = [];
		// get old history
		if(isset($_SESSION['history']) && is_array($_SESSION['history']))
		{
			$myHistory = $_SESSION['history'];
		}
		// add to history
		array_push($myHistory, $myUrl);
		// remove more than 5 history
		if(count($myHistory) > 5)
		{
			array_shift($myHistory);
		}
		$_SESSION['history'] = $myHistory;
	}

	public static function last()
	{
		if(isset($_SESSION['history']) && is_array($_SESSION['history']))
		{
			return end($_SESSION['history']);
		}
		return null;
	}
}
?>
