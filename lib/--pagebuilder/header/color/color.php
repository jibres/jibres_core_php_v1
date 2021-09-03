<?php
namespace lib\pagebuilder\header\color;


class color
{

	public static function template()
	{
		$list = [];
		$list[] =
		[
			'title'     => 'ABC',
			'txt_color' => '#141414',
			'bg_color'  => '#ababab',
		];

		$list[] =
		[
			'title'     => 'ABC 1',
			'txt_color' => '#ffffff',
			'bg_color'  => '#000000',
		];

		$list[] =
		[
			'title'     => 'ABC 2',
			'txt_color' => '#e4de1b',
			'bg_color'  => '#890ba2',
		];

		return $list;
	}

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
