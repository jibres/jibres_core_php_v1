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
		$_args['bg_color']  = 'color';
		$_args['txt_color'] = 'color';


		return $_args;
	}


	public static function ready_for_db($_data)
	{
		// needless to save title
		if(!a($_data, 'set_color'))
		{
			return $_data;
		}

		$background              = [];
		$background['txt_color'] = $_data['txt_color'];
		$background['bg_color']  = $_data['bg_color'];

		$_data['background'] = json_encode($background, JSON_UNESCAPED_UNICODE);

		\lib\pagebuilder\tools\tools::input_exception('background');

		unset($_data['bg_color']);
		unset($_data['txt_color']);
		unset($_data['set_color']);

		return $_data;

	}


	public static function ready($_data)
	{


		return $_data;
	}


}
?>
