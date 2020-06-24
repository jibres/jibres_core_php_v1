<?php
namespace dash;
/**
 * Class for validate
 */
class validate
{

	public static function __callStatic($_function, $_args)
	{
		$data  = null;
		$notif = true;
		$meta  = [];

		if(array_key_exists(0, $_args))
		{
			$data = $_args[0];
		}

		if(array_key_exists(1, $_args))
		{
			$notif = $_args[1];
		}

		if(array_key_exists(2, $_args))
		{
			$meta = $_args[2];

			$meta['continue_with_error'] = true;
		}
		else
		{
			$meta['continue_with_error'] = true;
		}

		return \dash\cleanse::data($_function, $data, $notif, $meta);
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