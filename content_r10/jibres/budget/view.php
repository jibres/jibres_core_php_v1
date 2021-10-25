<?php
namespace content_r10\jibres\budget;


class view
{
	public static function config()
	{

		$result =
		[
			'budget'   => \dash\user::budget(),
			'currency' => \lib\currency::unit(),
		];

		\content_r10\tools::say($result);
	}
}
?>