<?php
namespace content_r10\jibres\plan;


class view
{

	public static function config()
	{
		$business_id = \content_r10\tools::get_current_business_id();
		if(\dash\request::get('gethistory'))
		{
			$result = \lib\app\plan\storePlan::activePlanHistory($business_id);
		}
		elseif(\dash\request::get('factor'))
		{
			$result = \lib\app\plan\planFactor::calculate($business_id, \dash\request::get());
		}
		elseif(\dash\request::get('list'))
		{
			$args =
			[
				'order'       => \dash\request::get('order'),
				'sort'        => \dash\request::get('sort'),
				'action'      => \dash\request::get('action'),
				'status'      => \dash\request::get('status'),
				'setby'       => \dash\request::get('setby'),
				'user'        => \dash\request::get('user'),
				'plan'        => \dash\request::get('plan'),
				'reason'      => \dash\request::get('reason'),
				'periodtype'  => \dash\request::get('periodtype'),
				'business_id' => \dash\request::get('business_id'),
			];

			$result = \lib\app\plan\search::list(\dash\validate::search_string(), $args);
			$meta =
				[
					'is_filtered' => \lib\app\plan\search::is_filtered(),
				];


			\dash\notif::meta($meta);
		}
		else
		{
			$result = \lib\app\plan\storePlan::currentPlan($business_id);
		}

		\content_r10\tools::say($result);
	}

}

?>