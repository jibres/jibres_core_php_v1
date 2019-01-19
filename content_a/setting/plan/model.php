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
			'continuation' => \dash\request::post('continuation'),
		];

		\lib\app\store\plan::set($plan, $meta);
	}
}
?>