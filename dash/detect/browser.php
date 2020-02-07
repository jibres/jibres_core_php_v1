<?php
namespace dash\detect;

class browser
{
	public static function deadbrowserDetection()
	{
		$currentBrowser = \dash\data::browser();
		$browsers =
		[
			"chrome"      => 64.0,
			"firefox"     => 60.0,
			"gecko"       => 60.0,
			"crios"       => 67.0,
			"msie"        => 11.0,
			"edge"        => 13,
			"opera"       => 50.0,
			"safari"      => 534.57,
			'applewebkit' => 600,
		];

		if (isset($browsers[$currentBrowser['browser_name']]))
		{
			if($currentBrowser['browser_name'] == 'msie')
			{
				\dash\data::youAreDead(T_("You are using Internet Explorer."). ' '. T_('Really!!!'). ' '. T_('IE is DIE!'));
			}
			elseif ($currentBrowser['browser_math_number'] < $browsers[$currentBrowser['browser_name']])
			{

				$msg = T_("You need to update your :browser to new version.", ['browser' => $currentBrowser['browser_name']. ' '. $currentBrowser['browser_math_number']]). ' '. T_('The world is changing rapidly!');

				\dash\data::youAreDead($msg);
			}
			else
			{
				// $myMsg2 = T_("Hooray! You are using the latest version");
			}
		}
		else
		{
			\dash\data::youAreDead(T_("Please use famous browser to have better experience!"));
		}
	}
}
?>