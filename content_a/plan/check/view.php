<?php
namespace content_a\plan\check;


class view
{

	public static function config()
	{
		$result   = [];
		$result[] =
			[
				'permission:simple',
				\lib\app\plan\planCheck::access('permission', 'simple1'),
			];


		$result[] =
			[
				'permission:simple',
				\lib\app\plan\planCheck::access('permission', 'simple'),
			];

		$load = \lib\app\plan\planCheck::get('sms', 'cost');


		$result[] =
			[
				'sms',
				$load,


			];





		var_dump($result);
		exit();


	}

}
