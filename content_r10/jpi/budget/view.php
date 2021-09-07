<?php
namespace content_r10\jpi\budget;


class view
{
	public static function config()
	{

		$result =
		[
			'budget'   => rand(),
			'currency' => \lib\currency::unit(),
		];

		\content_r10\tools::say($result);
	}
}
?>