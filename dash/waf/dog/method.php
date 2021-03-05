<?php
namespace dash\waf\dog;

/**
 * This class describes a method.
 */
class method
{
	public static function inspection()
	{
		$method = \dash\request::is();

		// we need something for this
		\dash\waf\dog\toys\only::something($method);
		// only can be text
		\dash\waf\dog\toys\only::text($method);

		// disallow html tags
		\dash\waf\dog\toys\block::tags($method);

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

		\dash\waf\dog\toys\only::enum($method, $allow_method);
	}

}
?>
