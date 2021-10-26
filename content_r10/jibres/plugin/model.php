<?php
namespace content_r10\jibres\plugin;


class model
{
	public static function post()
	{

		$business_id = \content_r10\tools::get_current_business_id();
		$plugin      = \dash\request::input_body();

		$true_plugin = [];

		foreach ($plugin as $key => $value)
		{
			if(substr($key, 0, 7) === 'plugin_')
			{
				$true_plugin[] = $value;
			}
		}

		$args =
		[
			'use_as_budget' => \dash\request::input_body('use_as_budget'),
			'turn_back'     => \dash\request::input_body('turn_back'),
			'page_url'      => \dash\request::input_body('page_url'),
		];

		$result = \lib\app\plugin\activate::activate($business_id, $true_plugin, $args);

		\content_r10\tools::say($result);
	}
}
?>