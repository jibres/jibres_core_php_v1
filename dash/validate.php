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


	/**
	 * check is Equal 2 string
	 *
	 * @param      string   $_a     { parameter_description }
	 * @param      string   $_b     { parameter_description }
	 *
	 * @return     boolean  True if equal, False otherwise.
	 */
	public static function is_equal($_a, $_b)
	{
		if($_a === $_b)
		{
			return true;
		}

		if((string) $_a == (string) $_b)
		{
			return true;
		}

		if(($_a == '' || is_null($_a) || $_a == null) && ($_b == '' || is_null($_b) || $_b == null))
		{
			return true;
		}

		return false;
	}
}
?>