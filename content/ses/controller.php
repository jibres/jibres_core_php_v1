<?php
namespace content\ses;

class controller
{
	public static function routing()
	{
		$a =
		[
			'session' => $_SESSION,
			'store' => \lib\store::detail(),
		];

		\dash\code::jsonBoom($a);
	}
}
?>