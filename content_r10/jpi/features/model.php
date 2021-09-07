<?php
namespace content_r10\jpi\features;


class model
{
	public static function post()
	{

		$post = \dash\request::input_body();
		print_r($post);exit;
		// $result =
		// [
		// 	'budget'   => \dash\user::budget(),
		// 	'currency' => \lib\currency::unit(),
		// ];

		// \content_r10\tools::say($result);
	}
}
?>