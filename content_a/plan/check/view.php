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

		var_dump($result);
		exit();


	}

}
