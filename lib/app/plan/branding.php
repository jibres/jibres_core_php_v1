<?php
namespace lib\app\plan;



class branding
{
	public static function price_list()
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


	public static function set($_branding)
	{
		if(\lib\store::branding_time())
		{
			\dash\notif::error(T_("You must first pay a plan to deactive jibres branding"));
			return false;
		}


		$branding = $_branding ? 'yes' : 'no';

		\lib\db\setting\update::overwirte_cat_key($branding, 'store_setting', 'force_branding');

		if($branding === 'yes')
		{
			\dash\notif::ok(T_("Jibres branding was active in your website"));
		}
		else
		{
			\dash\notif::ok(T_("Jibres branding was deactive in your website"));
		}
		\lib\store::reset_cache();
		return true;
	}


	public static function remove($_args)
	{

		if(!isset($_args['plan']))
		{
			\dash\notif::error(T_("Please choose a plan"));
			return false;
		}

		$plan = $_args['plan'];
		$plan = \dash\validate::string_50($plan);
		if(!$plan)
		{
			\dash\notif::error(T_("Please choose a plan"));
			return false;
		}

		$choose_plan = [];

		$list = self::price_list();
		foreach ($list as $key => $value)
		{
			if(isset($value['key']) && $value['key'] === $plan)
			{
				$choose_plan = $value;
			}
		}

		if(!$choose_plan)
		{
			\dash\notif::error(T_("Invalid plan"));
			return false;
		}


		// start transaction
		// plus budget
		// minus budget
		// save plan history
		// reset business catch

		\lib\app\plan\history::set('branding', \lib\store::id(), $choose_plan);

	}

}
?>