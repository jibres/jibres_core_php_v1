<?php
namespace lib\app\branding;



class removebranding
{
	public static function plan_list()
	{
		$list = [];
		$list[] =
		[
			'key'           => '1month',
			'title'         => T_("1 Month"),
			'price'         => 100000,
			'currency'      => 'IRT',
			'currency_name' => \lib\currency::name('IRT'),
		];

		$list[] =
		[
			'key'           => '1year',
			'title'         => T_("1 Year"),
			'price'         => 1000000,
			'currency'      => 'IRT',
			'currency_name' => \lib\currency::name('IRT'),
		];

		return $list;
	}


	public static function set($_args)
	{
		\dash\notif::warn('not ready');
		return;
		var_dump($_args);exit();
	}

}
?>