<?php
namespace lib\app\website_status;

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

		$save = \lib\db\setting\update::overwirte_platform_cat_key($data['status'], 'website', 'status', 'active');

		if($save)
		{

			\dash\file::delete(\dash\engine\store::website_addr(). \lib\store::id());

			\dash\notif::ok(T_("Your status was saved"));
			return true;
		}
		else
		{
			\dash\log::oops('db');
			return false;
		}
	}


}
?>
