<?php
namespace dash\engine\dog\toys;
/**
 * dash main configure
 */
class only
{
	public static function text($_txt)
	{
		if(!is_string($_txt))
		{
			\dash\header::status(428, 'only S');
		}
	}


	public static function array($_arr)
	{
		if(!is_array($_arr))
		{
			\dash\header::status(428, 'only A');
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
}
?>
