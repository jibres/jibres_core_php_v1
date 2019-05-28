<?php
namespace content_a\setting\plan;


class model
{
	/**
	 * post data and update or insert plan data
	 */
	public static function post()
	{
		$plan         = \dash\request::post('plan');

		$meta =
		[
			'period'       => \dash\request::post('period'),
		];

		if(\dash\permission::supervisor())
		{
			$meta['manual']       = \dash\request::post('manualPlanChange');
			$meta['manualplan']   = \dash\request::post('manualplan');
			$meta['manualexpire'] = \dash\request::post('expireplan');
		}

		\lib\app\store\plan::set($plan, $meta);
	}
}
?>