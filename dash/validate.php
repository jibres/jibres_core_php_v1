<?php
namespace dash;
/**
 * Class for validate
 */
class validate
{

	public static function __callStatic($_function, $_args)
	{
		return \dash\cleanse::data($_function, ...$_args);
	}
}
?>