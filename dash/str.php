<?php
namespace dash;

class str
{
	public static function substr_space($_string, $_len)
	{
		if(!$_string || !is_string($_string))
		{
			return $_string;
		}

		$raw = substr($_string, 0, $_len);

		$last_space_position = strrpos($raw, ' ');

		if($last_space_position === false)
		{
			return $raw;
		}


		if(mb_strlen($raw) < $_len)
		{
			return $raw;
		}

		$text = substr($_string, 0, $last_space_position);

		return $text;

	}


	/**
	 * Check input in strpos
	 *
	 * @param      string  $_haystack  The haystack
	 * @param      string  $_needle    The needle
	 * @param      int     $_offset    The offset
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function strpos($_haystack, $_needle, $_offset = 0)
	{
		if(!is_string($_haystack))
		{
			return false;
		}

		if(!is_string($_needle))
		{
			return false;
		}

		if(!is_int($_offset))
		{
			$_offset = intval($_offset);
		}

		return strpos($_haystack, $_needle, $_offset);
	}



	public static function urldecode($_str)
	{
		if(!is_string($_str))
		{
			$_str = '';
		}

		return urldecode($_str);
	}
}
?>