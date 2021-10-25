<?php
namespace content_r10\jibres\features;


class model
{
	public static function post()
	{

		$business_id   = \content_r10\tools::get_current_business_id();
		$features      = \dash\request::input_body();

		$true_features = [];
		foreach ($features as $key => $value)
		{
			if(substr($key, 0, 8) === 'feature_')
			{
				$true_features[] = $value;
			}
		}

		$args =
		[
			'use_as_budget' => \dash\request::input_body('use_as_budget'),
			'turn_back'     => \dash\request::input_body('turn_back'),
			'page_url'      => \dash\request::input_body('page_url'),

		];

		$result = \lib\features\pay::pay($business_id, $true_features, $args);

		\content_r10\tools::say($result);
	}
}
?>