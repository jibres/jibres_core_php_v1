<?php
namespace content_r10\jibres\premium;


class model
{
	public static function post()
	{

		$business_id   = \content_r10\tools::get_current_business_id();
		$premium      = \dash\request::input_body();

		$true_premium = [];
		foreach ($premium as $key => $value)
		{
			if(substr($key, 0, 8) === 'feature_')
			{
				$true_premium[] = $value;
			}
		}

		$args =
		[
			'use_as_budget' => \dash\request::input_body('use_as_budget'),
			'turn_back'     => \dash\request::input_body('turn_back'),
			'page_url'      => \dash\request::input_body('page_url'),

		];

		$result = \lib\app\premium\pay::pay($business_id, $true_premium, $args);

		\content_r10\tools::say($result);
	}
}
?>