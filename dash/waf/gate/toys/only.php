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
			\dash\waf\dog::BITE('need something...', 428);
		}
	}


	public static function text($_txt)
	{
		if(!is_string($_txt))
		{
			\dash\waf\dog::BITE('only T', 428);
		}
	}


	public static function array($_arr)
	{
		if(!is_array($_arr))
		{
			\dash\waf\dog::BITE('only A', 428);
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
			\dash\waf\dog::BITE('only O', 428);
		}
	}


	public static function float($_num)
	{
		if(!is_float($_num))
		{
			\dash\waf\dog::BITE('only F', 428);
		}
	}


	public static function int($_num)
	{
		if(!is_int($_num))
		{
			\dash\waf\dog::BITE('only I', 428);
		}
	}


	public static function numberic($_num)
	{
		if(!is_numberic($_num))
		{
			\dash\waf\dog::BITE('only N', 428);
		}
	}


	public static function bool($_num)
	{
		if(!is_bool($_num))
		{
			\dash\waf\dog::BITE('only B', 428);
		}
	}


	public static function string($_string)
	{
		if(!is_numeric($_string) && !is_string($_string))
		{
			\dash\waf\dog::BITE('only S', 428);
		}
	}


	public static function a_z0_9_($_txt)
	{
		if(!preg_match("/^[A-Za-z0-9\_]+$/", $_txt))
		{
			\dash\waf\dog::BITE('only a-z0-9_', 428);
		}
	}


	public static function a_z0_9_dash($_txt)
	{
		if(!preg_match("/^[A-Za-z0-9\_\-]+$/", $_txt))
		{
			\dash\waf\dog::BITE('only a-z0-9_-', 428);
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
			\dash\waf\dog::BITE('order !', 428);
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
			\dash\waf\dog::BITE('enum !', 428);
		}
	}

}
?>
