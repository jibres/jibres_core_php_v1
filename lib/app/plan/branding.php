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
		if(\lib\store::branding_is_expired())
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


	public static function buy($_args)
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

		$jibres_user_id = \dash\user::jibres_user();
		$choose_plan['user_id'] = $jibres_user_id;

		// check can register this time

		$check = \lib\app\plan\history::check('branding', \lib\store::id(), $choose_plan);
		if(!$check)
		{
			return false;
		}

		$get =
		[
			'b' => \lib\store::code(),
			'p' => a($choose_plan, 'key'),
		];

		$url = \dash\url::sitelang(). '/my/branding?'. \dash\request::build_query($get);
		\dash\redirect::to($url, 'jibres');
		return;


		$temp_args =
		[
			'type'        => 'branding',
			'store_id'    => \lib\store::id(),
			'choose_plan' => $choose_plan,
		];

		// go to bank
		$meta =
		[
			'msg_go'        => T_("Remove jibres branding for :val ", ['val' => a($choose_plan, 'title')]),
			'auto_go'       => false,
			'auto_back'     => true,
			'final_msg'     => true,
			'turn_back'     => \dash\url::pwd(),
			'user_id'       => $jibres_user_id,
			'amount'        => abs(a($choose_plan, 'price')),
			'final_fn'      => ['/lib/app/plan/branding', 'after_pay'],
			'final_fn_args' => $temp_args,
		];


		$result_pay = \dash\utility\pay\start::api($meta);

		// start transaction
		// plus budget
		// minus budget
		// save plan history
		// reset business catch


	}

}
?>