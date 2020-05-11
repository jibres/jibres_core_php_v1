<?php
namespace lib\app\website\status;

class set
{

	public static function status($_args)
	{
		$condition =
		[
			'status' => ['enum' => ['publish', 'comingsoon', 'visitcard']],
		];

		$require = ['status'];

		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$save = \lib\db\setting\update::overwirte_platform_cat_key_lang($data['status'], 'website', 'status', 'active', \dash\language::current());

		\lib\app\website\generator::remove_catch();

		\dash\notif::ok(T_("Your status was saved"));

		return true;

	}


}
?>
