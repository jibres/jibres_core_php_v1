<?php
namespace dash\waf\gate;

/**
 * This class describes a method.
 */
class method
{
	public static function inspection()
	{
		$method = \dash\request::is();

		// we need something for this
		\dash\waf\gate\toys\only::something($method);
		// only can be text
		\dash\waf\gate\toys\only::text($method);

		// disallow html tags
		\dash\waf\gate\toys\block::tags($method);

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

		\dash\waf\gate\toys\only::enum($method, $allow_method);
	}

}
?>
