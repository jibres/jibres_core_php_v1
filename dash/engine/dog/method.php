<?php
namespace dash\engine\dog;

/**
 * This class describes a method.
 */
class method
{
	public static function inspection()
	{
		$method = \dash\request::is();

		// we need something for this
		\dash\engine\dog\toys\only::something($method);
		// only can be text
		\dash\engine\dog\toys\only::text($method);

		// disallow html tags
		\dash\engine\dog\toys\block::tags($method);

		$allow_method =
		[
			'get',
			'post',
			'put',
			'patch',
			'delete',
			'head',
			'options',
		];

		\dash\engine\dog\toys\only::enum($method, $allow_method);
	}

}
?>
