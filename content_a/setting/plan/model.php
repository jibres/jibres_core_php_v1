<?php
namespace content_a\setting\plan;


class model extends \content_a\main\model
{
/**
	 * get plan data to show
	 */
	public function plan()
	{
		if(!\lib\user::login())
		{
			return false;
		}

		if(!\lib\store::id())
		{
			\lib\db\logs::set('plan:invalid:store', \lib\user::id());
			\lib\notif::error(T_("Invalid store!"), 'store');
			return false;
		}

		return \lib\db\storeplans::current(\lib\store::id());

	}

	/**
	 * post data and update or insert plan data
	 */
	public function post_plan()
	{
		if(!\lib\user::login())
		{
			return false;
		}

		$plan = \lib\request::post('plan');
		if(!$plan)
		{
			\lib\db\logs::set('plan:plan:not:set', \lib\user::id());
			\lib\notif::error(T_("Please select one of plan"), 'plan');
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
			\lib\db\logs::set('plan:invalid:plan', \lib\user::id());
			\lib\notif::error(T_("Invalid plan!"), 'plan');
			return false;
		}

		if(!\lib\store::id())
		{
			\lib\db\logs::set('plan:invalid:store', \lib\user::id());
			\lib\notif::error(T_("Invalid store!"), 'store');
			return false;
		}

		if(!\lib\store::is_creator())
		{
			\lib\db\logs::set('plan:no:access:to:change:plan', \lib\user::id());
			\lib\notif::error(T_("No access to change plan"), 'store');
			return false;
		}

		$args =
		[
			'store_id' => \lib\store::id(),
			'plan'     => $plan,
			'creator'  => \lib\user::id(),
		];
		$result = \lib\db\storeplans::set($args);

		if($result)
		{
			\lib\notif::true(T_("Your store plan was changed"));
			if(\lib\notif::$status)
			{
				\lib\redirect::pwd();
			}
		}
		else
		{
			// \lib\notif::error(T_("Can not save this plan of your store"));
			return false;
		}
	}
}
?>