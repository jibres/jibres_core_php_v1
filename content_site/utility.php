<?php
namespace content_site;


class utility
{
	private static $fill_by_default_data = false;
	private static $need_redirect        = null;


	public static function fill_by_default_data($_set = null)
	{
		if($_set === false || $_set === true)
		{
			self::$fill_by_default_data = $_set;
		}
		else
		{
			return self::$fill_by_default_data;
		}
	}




	public static function need_redirect($_set = null)
	{
		if($_set === false || $_set === true)
		{
			self::$need_redirect = $_set;
		}
		else
		{
			return self::$need_redirect;
		}
	}


	public static function unset_option(&$_option_list, $_need_unset)
	{
		if(($myKey = array_search($_need_unset, $_option_list)) !== false)
		{
			unset($_option_list[$myKey]);
		}
	}



}
?>