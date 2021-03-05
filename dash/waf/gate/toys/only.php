<?php
namespace dash\waf\gate\toys;
/**
 * dash main configure
 */
class only
{
	public static function something($_txt)
	{
		if(!$_txt)
		{
			\dash\header::status(428, 'need something...');
		}
	}


	public static function text($_txt)
	{
		if(!is_string($_txt))
		{
			\dash\header::status(428, 'only T');
		}
	}


	public static function array($_arr)
	{
		if(!is_array($_arr))
		{
			\dash\header::status(428, 'only A');
		}
	}


	public static function json($_str)
	{
		$arr = json_decode($_str, true);

		self::array($arr);
	}


	public static function maybe_json($_str)
	{
		// if have { in string try to decode json
		if(strpos($_str, '{') !== false)
		{
			self::json($_str);
		}
	}


	public static function object($_obj)
	{
		if(!is_object($_obj))
		{
			\dash\header::status(428, 'only O');
		}
	}


	public static function float($_num)
	{
		if(!is_float($_num))
		{
			\dash\header::status(428, 'only F');
		}
	}


	public static function int($_num)
	{
		if(!is_int($_num))
		{
			\dash\header::status(428, 'only I');
		}
	}


	public static function numberic($_num)
	{
		if(!is_numberic($_num))
		{
			\dash\header::status(428, 'only N');
		}
	}


	public static function bool($_num)
	{
		if(!is_bool($_num))
		{
			\dash\header::status(428, 'only B');
		}
	}


	public static function string($_string)
	{
		if(!is_numeric($_string) && !is_string($_string))
		{
			\dash\header::status(428, 'only S');
		}
	}


	public static function a_z0_9_($_txt)
	{
		if(!preg_match("/^[A-Za-z0-9\_]+$/", $_txt))
		{
			\dash\header::status(428, 'only a-z0-9_');
		}
	}


	public static function a_z0_9_dash($_txt)
	{
		if(!preg_match("/^[A-Za-z0-9\_\-]+$/", $_txt))
		{
			\dash\header::status(428, 'only a-z0-9_-');
		}
	}


	public static function order($_txt)
	{
		if($_txt === 'desc' || $_txt === 'asc')
		{
			// ok
		}
		else
		{
			\dash\header::status(428, 'order !');
		}
	}


	public static function enum($_txt, $_enum)
	{
		if(in_array($_txt, $_enum))
		{
			// ok
		}
		else
		{
			\dash\header::status(428, 'enum !');
		}
	}

}
?>
