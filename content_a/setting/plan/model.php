<?php
namespace content_a\setting\plan;


class model extends \content_a\main\model
{
/**
	 * get plan data to show
	 */
	public function plan()
	{
		if(!$this->login())
		{
			return false;
		}

		if(!\lib\store::id())
		{
			\lib\db\logs::set('plan:invalid:store', $this->login('id'));
			\lib\debug::error(T_("Invalid store!"), 'store');
			return false;
		}

		return \lib\db\storeplans::current(\lib\store::id());

	}

	/**
	 * post data and update or insert plan data
	 */
	public function post_plan()
	{
		if(!$this->login())
		{
			return false;
		}

		$plan = \lib\utility::post('plan');
		if(!$plan)
		{
			\lib\db\logs::set('plan:plan:not:set', $this->login('id'));
			\lib\debug::error(T_("Please select one of plan"), 'plan');
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
			\lib\db\logs::set('plan:invalid:plan', $this->login('id'));
			\lib\debug::error(T_("Invalid plan!"), 'plan');
			return false;
		}

		if(!\lib\store::id())
		{
			\lib\db\logs::set('plan:invalid:store', $this->login('id'));
			\lib\debug::error(T_("Invalid store!"), 'store');
			return false;
		}

		if(!\lib\store::is_creator())
		{
			\lib\db\logs::set('plan:no:access:to:change:plan', $this->login('id'));
			\lib\debug::error(T_("No access to change plan"), 'store');
			return false;
		}

		$args =
		[
			'store_id' => \lib\store::id(),
			'plan'     => $plan,
			'creator'  => $this->login('id'),
		];
		$result = \lib\db\storeplans::set($args);

		if($result)
		{
			\lib\debug::true(T_("Your store plan was changed"));
			if(\lib\debug::$status)
			{
				$this->redirector(\lib\url::pwd());
			}
		}
		else
		{
			// \lib\debug::error(T_("Can not save this plan of your store"));
			return false;
		}
	}
}
?>