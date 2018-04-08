<?php
namespace content_a\setting\plan;


class model extends \content_a\main\model
{
/**
	 * get plan data to show
	 */
	public function plan()
	{
		if(!\dash\user::login())
		{
			return false;
		}

		if(!\lib\store::id())
		{
			\dash\db\logs::set('plan:invalid:store', \dash\user::id());
			\dash\notif::error(T_("Invalid store!"), 'store');
			return false;
		}

		return \lib\db\storeplans::current(\lib\store::id());

	}

	/**
	 * post data and update or insert plan data
	 */
	public function post_plan()
	{
		if(!\dash\user::login())
		{
			return false;
		}

		$plan = \dash\request::post('plan');
		if(!$plan)
		{
			\dash\db\logs::set('plan:plan:not:set', \dash\user::id());
			\dash\notif::error(T_("Please select one of plan"), 'plan');
			return false;
		}


		/**
		 * list of active plan
		 *
		 * @var        array
		 */
		$all_plan_list =
		[
			// 'free',
			// 'pro',
			// 'business'
			'free',
			// 'simple',
			'standard',
			'standard_year',
			// 'full'
		];

		if(!in_array($plan, $all_plan_list))
		{
			\dash\db\logs::set('plan:invalid:plan', \dash\user::id());
			\dash\notif::error(T_("Invalid plan!"), 'plan');
			return false;
		}

		if(!\lib\store::id())
		{
			\dash\db\logs::set('plan:invalid:store', \dash\user::id());
			\dash\notif::error(T_("Invalid store!"), 'store');
			return false;
		}

		if(!\lib\store::is_creator())
		{
			\dash\db\logs::set('plan:no:access:to:change:plan', \dash\user::id());
			\dash\notif::error(T_("No access to change plan"), 'store');
			return false;
		}

		$args =
		[
			'store_id' => \lib\store::id(),
			'plan'     => $plan,
			'creator'  => \dash\user::id(),
		];
		$result = \lib\db\storeplans::set($args);

		if($result)
		{
			\dash\notif::ok(T_("Your store plan was changed"));
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}
		else
		{
			// \dash\notif::error(T_("Can not save this plan of your store"));
			return false;
		}
	}
}
?>