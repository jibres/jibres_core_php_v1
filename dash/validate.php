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

			// $meta['continue_with_error'] = true;
		}
		else
		{
			// $meta['continue_with_error'] = true;
		}
		\dash\cleanse::$status = true;
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

		if(is_array($_a) || is_array($_b))
		{
			return false;
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



	/**
	 * Get string searched in search input
	 */
	public static function search_string()
	{
		$q = \dash\request::get('q');

		if($q)
		{
			$q = \dash\validate::search($q, false);
		}

		return $q;
	}


	/**
	 * Determines whether the specified continue is not bottom.
	 *
	 * @param      boolean  $_continue  The continue
	 *
	 * @return     boolean  True if the specified continue is not bottom, False otherwise.
	 */
	public static function is_not_bot($_continue = false)
	{
		if(\dash\agent::isBot())
		{
			if($_continue)
			{
				// not exist code
				return false;
			}
			else
			{
				\dash\header::status(400, T_("You were identified as a robot. Contact your system administrator if you feel that something has happened"));
			}
		}
		return false;
	}
}
?>