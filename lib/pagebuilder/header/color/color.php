<?php
namespace lib\pagebuilder\header\color;


class color
{


	public static function allow()
	{
		if(\dash\url::isLocal())
		{
			return true;
		}

		return false;
	}

	public static function input_condition($_args = [])
	{
		$_args['set_color'] = 'bit';
		$_args['bg_color']     = 'color';


		return $_args;
	}


	public static function ready_for_db($_data)
	{
		// needless to save title
		if(!a($_data, 'set_color'))
		{
			return $_data;
		}

		unset($_data['bg_color']);

		unset($_data['set_color']);

		return $_data;

	}


	public static function ready($_data)
	{


		return $_data;
	}


}
?>
