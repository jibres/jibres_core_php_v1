<?php
namespace lib\app\setting;


class search
{
	public static function links()
	{
		$list = [];

		$settingUrl = \dash\url::kingdom(). '/a/setting';

		$list[] =
		[
			'link' => $settingUrl. '/general/title',
			'title' => T_("Business Title"),
			'group' => T_("General setting"),
		];

		$list[] =
		[
			'link' => $settingUrl. '/general/logo',
			'title' => T_("Business Logo"),
			'group' => T_("General setting"),
		];

		$list[] =
		[
			'link' => $settingUrl. '/general/lang',
			'title' => T_("Business Language"),
			'group' => T_("General setting"),
		];

		$list[] =
		[
			'link' => $settingUrl. '/general/units',
			'title' => T_("Business Unit"),
			'group' => T_("General setting"),
		];



		return $list;
	}
}
?>